<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmrahBatch;
use DataTables;
class UmrahBatchDatatablesController extends Controller
{
    public function index(Request $request)
    {
        $data = UmrahBatch::query()
        ->select('umrah_batches.*');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
