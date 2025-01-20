<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingTransaction;
use DataTables;
class SavingTransactionDatatablesController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->can('access-all-saving-transaction')){
            $data = SavingTransaction::query()
            ->select('saving_transactions.*');
        }else{
            $data = SavingTransaction::query()
            ->select('saving_transactions.*')
            ->with([
                'bank_account'=>function($query){
                    return $query->select(
                        'bank_accounts.id',
                        'bank_accounts.name',
                    );
                }
            ])
            ->with([
                'umrah_manifest'=>function($query){
                    return $query->select(
                        'umrah_manifests.id',
                        'umrah_manifests.user_id',

                    );
                }
            ])
            ->with([
                'umrah_manifest.umrah_batch'=>function($query){
                    return $query->select(
                        'umrah_batches.id',
                        'umrah_batches.code_batch',
                        'umrah_batches.departure_schedule',
                        'umrah_batches.return_schedule',

                    );
                }
            ])
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
