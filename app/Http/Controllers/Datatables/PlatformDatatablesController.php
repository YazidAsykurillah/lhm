<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Platform;

class PlatformDatatablesController extends Controller
{
    public function index(Request $request)
    {
        $data = Platform::query()
        ->with([
            'platform_accounts'=>function($query){
                return $query->select('platform_accounts.platform_id','platform_accounts.id','platform_accounts.name');
            }
        ])
        ->select('platforms.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    //$btn = '<a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit">Edit</a>';
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
