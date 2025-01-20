<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\UmrahBatch;
use App\Models\UmrahManifest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->hasRole('Admin')){
            return view('home');
        }else{
            if(\Auth::user()->is_profile_updated == TRUE){

                //ambil manifest yang terkait user
                $umrah_manifest_options = [];
                if(\Auth()->user()->umrah_manifests){
                    foreach(\Auth()->user()->umrah_manifests as $umrah_manifest){
                        if($umrah_manifest->umrah_batch->availability == 'available'){
                            $umrah_manifest_options[] = [
                                'umrah_manifest_id'=>$umrah_manifest->id,
                                'umrah_batch_code'=>$umrah_manifest->umrah_batch->code_batch,
                            ];    
                        }
                        
                    }
                }
                
                
                return view('home')
                    ->with('umrah_manifest_options', $umrah_manifest_options);
            }
            return redirect('my-profile');
        }
        
        //
        
    }
}
