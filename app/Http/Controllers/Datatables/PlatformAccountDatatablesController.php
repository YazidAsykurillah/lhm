<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\PlatformAccount;
class PlatformAccountDatatablesController extends Controller
{
    public function getByPlatform(Request $request, string $id)
    {
        $data = PlatformAccount::query()
            ->where('platform_id','=', $id)
            ->select('platform_accounts.*');
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
