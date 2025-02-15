<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DataTables;
use App\Models\PaymentNote;

class PaymentNoteDatatablesController extends Controller
{
    public function index(Request $request)
    {
        $data = PaymentNote::query()
            ->with([
                'user'=>function($query){
                    return $query->select('users.id', 'users.name');
                }
            ])
            ->select('payment_notes.*');

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
