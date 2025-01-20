<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSavingTransactionRequest;

use App\Models\SavingTransaction;

class SavingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('saving-transaction.index');
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
    public function store(StoreSavingTransactionRequest $request)
    {
        $response=[];

        //transaction receipt processing
        //transaction receipt file name
        $tr_filename = time().'.'.$request->transaction_receipt->extension();
        $request->transaction_receipt->move(public_path('transaction-receipt'), $tr_filename);

        //save new transaction receipt
        try {
            $transaction_receipt = new SavingTransaction;
            $transaction_receipt->user_id = \Auth::user()->id;
            $transaction_receipt->transaction_source = $request->transaction_source;
            $transaction_receipt->sender_name = $request->sender_name;
            $transaction_receipt->bank_account_id = $request->bank_account_id;
            $transaction_receipt->amount = extract_to_decimal($request->amount);
            $transaction_receipt->transaction_date = $request->transaction_date;
            $transaction_receipt->transaction_receipt = $tr_filename;
            $transaction_receipt->umrah_manifest_id = $request->umrah_manifest_id;
            $transaction_receipt->save();

            $response['status'] = TRUE;
            $response['message'] = 'Transaction has been saved';
            $response['data']['url'] = url('home');
            
        } catch (Exception $e) {
            return $e;
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
