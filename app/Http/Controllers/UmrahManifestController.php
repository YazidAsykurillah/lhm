<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUmrahManifestRequest;
use App\Models\User;
use App\Models\UmrahManifest;
use App\Models\Participant;

class UmrahManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmrahManifestRequest $request)
    {
        $response = [];

        try {
            $add_user_as_participant = FALSE;
            if($request->has('add_user_as_participant') && $request->add_user_as_participant=='on'){
                $add_user_as_participant = TRUE;
            }
            $user = User::findOrFail($request->user_id);

            //create umrah manifest model
            $umrah_manifest = UmrahManifest::updateOrCreate(
                [
                    'umrah_batch_id'=>$request->umrah_batch_id,
                    'user_id'=>$request->user_id,
                ],
                [
                    'umrah_batch_id'=>$request->umrah_batch_id,
                    'user_id'=>$request->user_id,
                ],
            );

            if($add_user_as_participant == TRUE){
                $this->registerUserAsParticipant($user, $umrah_manifest);
            }
            $response['status'] = TRUE;
            $response['message'] = 'Pendaftaran Peserta Berhasil';
            $response['data']['url'] = url('umrah-batch/'.$request->umrah_batch_id);

        } catch (Exception $e) {
            
        }
        return response()->json($response);

        

    }

    protected function registerUserAsParticipant($user, $umrah_manifest)
    {
        $participant = Participant::updateOrCreate(
            [
                'umrah_manifest_id'=>$umrah_manifest->id,
                'is_registered_as_user'=>TRUE,
                'user_id_identifier'=>$user->id
            ],
            [
                'name'=>$user->name,
                'phone_number'=>$user->phone_number,
                'gender'=>$user->gender,
                'address'=>$user->address,
                'ktp_number'=>$user->ktp_number,
                'passport_number'=>$user->passport_number,
            ],
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $umrah_manifest = UmrahManifest::findOrFail($id);
        return view('umrah-manifest.show')
            ->with('umrah_manifest', $umrah_manifest);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
