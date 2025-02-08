<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePlatformAccountRequest;
use App\Http\Requests\UpdatePlatformAccountRequest;

use Illuminate\Http\Request;

use App\Models\PlatformAccount;

class PlatformAccountController extends Controller
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
    public function store(StorePlatformAccountRequest $request)
    {
        $response = [];
        try {
            $platform_account = new PlatformAccount;
            $platform_account->platform_id = $request->platform_id;
            $platform_account->name = $request->name;
            $platform_account->save();
            
            $response['status'] = TRUE;
            $response['message'] = 'Platform Account has been saved';

        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UpdatePlatformAccountRequest $request, string $id)
    {
        $response = [];
        try {
            $platform_account = PlatformAccount::findOrFail($id);
            $platform_account->name = $request->name;
            $platform_account->save();
            
            $response['status'] = TRUE;
            $response['message'] = 'Platform Account has been saved';

        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
