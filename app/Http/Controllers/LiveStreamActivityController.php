<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLiveStreamActivityRequest;
use App\Http\Requests\StartLiveStreamActivityRequest;
use App\Http\Requests\StopLiveStreamActivityRequest;
use App\Http\Requests\ApproveLiveStreamActivityRequest;
use App\Events\LiveStreamActivityIsSaved;
use Carbon\Carbon;
use App\Models\LiveStreamActivity;
use App\Models\LiveStreamActivityApproval;



class LiveStreamActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        return view('live-stream-activity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('live-stream-activity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLiveStreamActivityRequest $request)
    {
        $response = [];

        try {
            
            $live_stream_activity = new LiveStreamActivity;
            $live_stream_activity->user_id = $request->user_id;
            $live_stream_activity->platform_account_id = $request->platform_account_id;
            $live_stream_activity->live_stream_date = $request->live_stream_date;
            $live_stream_activity->started_time = $request->started_time;
            $live_stream_activity->stoped_time = $request->stoped_time;
            $live_stream_activity->sales_turn_over = extract_to_decimal($request->sales_turn_over);
            $live_stream_activity->save();

            //fire event LiveStreamActivityIsSaved
            event(new LiveStreamActivityIsSaved($live_stream_activity));

            $response['status'] = TRUE;
            $response['message'] = 'Live Stream Activity has been saved';
            $response['data']['url'] = url('live-stream-activity');

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


    public function renderMyLiveStreamActivityView(Request $request)
    {
        return view('live-stream-activity.my-index');
    }


    public function stopLiveStreamActivity(StopLiveStreamActivityRequest $request)
    {
        $response = [];
        try {
            
            $live_stream_activity = LiveStreamActivity::findOrFail($request->live_stream_activity_id);
            $live_stream_activity->stoped_time = Carbon::parse(Carbon::now())->format('Y-m-d H:i');
            $live_stream_activity->sales_turn_over = extract_to_decimal($request->sales_turn_over);
            $live_stream_activity->save();
            event(new LiveStreamActivityIsSaved($live_stream_activity));

            $response['status'] = TRUE;
            $response['message'] = 'Live Stream Activity has been stoped';

        } catch (Exception $e) {
               
        }   
        return response()->json($response);
    }

    public function startLiveStreamActivity(StartLiveStreamActivityRequest $request)
    {
        $response = [];
        try {

            $live_stream_activity = new LiveStreamActivity;
            $live_stream_activity->user_id = \Auth::user()->id;
            $live_stream_activity->platform_account_id = $request->platform_account_id;
            $live_stream_activity->live_stream_date = Carbon::parse(Carbon::now())->format('Y-m-d');
            $live_stream_activity->started_time = Carbon::parse(Carbon::now())->format('Y-m-d H:i');
            $live_stream_activity->save();
            
            event(new LiveStreamActivityIsSaved($live_stream_activity));

            $response['status'] = TRUE;
            $response['message'] = 'Live Stream Activity has been stoped';

        } catch (Exception $e) {
               
        }   
        return response()->json($response);
    }


    public function approve(ApproveLiveStreamActivityRequest $request)
    {
        
        $response = [];
        try {
            $live_stream_activity_approval = LiveStreamActivityApproval::updateOrCreate(
                [
                    'live_stream_activity_id'=>$request->id
                ],
                [
                    'is_approved'=>TRUE,
                    'approver_id'=>\Auth::user()->id
                ],
            );
            $response['status'] = TRUE;
            $response['message'] = 'Live Stream Activity has been approved';
        } catch (Exception $e) {
            
        }
        return response()->json($response);
    }

}
