<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentNoteRequest;
use App\Services\PaymentNoteService;

use App\Events\PaymentNoteIsSaved;

use App\Models\PaymentNote;
use App\Models\LiveStreamActivity;

class PaymentNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment-note.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('payment-note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentNoteRequest $request)
    {
        
        $response = [];
        $code = 'PN_'.$request->user_id.'_'.$request->start_date.'_'.$request->end_date.'_'.time();
        try {

            $payment_note = new PaymentNote;
            $payment_note->user_id = $request->user_id;
            $payment_note->start_date = $request->start_date;
            $payment_note->end_date = $request->end_date;
            $payment_note->title = $request->title;
            $payment_note->code = $code;
            $payment_note->save();

            //select related live stream activities
            $affectedLiveStreamActivities = LiveStreamActivity::query()
                                        ->whereHas('live_stream_activity_approval', function($query){
                                            $query->where('is_approved','=', TRUE);
                                        })
                                        ->where('user_id','=', $payment_note->user_id)
                                        ->where('stoped_time','!=', NULL)
                                        ->where('live_stream_date','>=', $payment_note->start_date)
                                        ->where('live_stream_date','<=', $payment_note->end_date)
                                        ->where('payment_note_id','=', NULL)
                                        ->get();
            if(count($affectedLiveStreamActivities)){
                
                $affectedLiveStreamActivities->toQuery()->update([
                    'payment_note_id' => $payment_note->id,
                ]);
            }

            //fire event PaymentNoteIsSaved
            event(new PaymentNoteIsSaved($payment_note));

            //run payment note service
            $pn_service = new PaymentNoteService($payment_note);
            $pn_service->update_amount();


            $response['status'] = TRUE;
            $response['message'] = 'Payment Note has been saved';
            $response['data']['url'] = url('payment-note');
        } catch (Exception $e) {
            
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment_note = PaymentNote::findOrFail($id);
        return view('payment-note.show')
            ->with('payment_note', $payment_note);
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
