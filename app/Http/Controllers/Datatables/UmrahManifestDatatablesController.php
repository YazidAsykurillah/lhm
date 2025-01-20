<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmrahManifest;
use DataTables;

class UmrahManifestDatatablesController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->can('access-all-umrah-manifest')){
            $data = UmrahManifest::query()
            ->with(
                [
                    'umrah_batch'=>function($query){
                        return $query->select(
                            'umrah_batches.id',
                            'umrah_batches.code_batch',
                            'umrah_batches.departure_schedule',
                            'umrah_batches.return_schedule',
                        );
                    }
                ]
            )
            ->select('umrah_manifests.*');
        }else{
            $data = UmrahManifest::query()
            ->with(
                [
                    'umrah_batch'=>function($query){
                        return $query->select(
                            'umrah_batches.id',
                            'umrah_batches.code_batch',
                            'umrah_batches.departure_schedule',
                            'umrah_batches.return_schedule',
                        );
                    }
                ]
            )
            ->with(
                [
                    'user'=>function($query){
                        return $query->select(
                            'users.id',
                            'users.name',
                        );
                    }
                ]
            )
            ->with(
                [
                    'participants'=>function($query){
                        return $query->select('id','name','umrah_manifest_id');
                    }
                ]
            )
            ->select('umrah_manifests.*')
            ->where('user_id','=',\Auth::user()->id);
        }
        
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
