<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLiveStreamActivityRequest;

use App\Models\LiveStreamActivity;

use App\Events\LiveStreamActivityIsSaved;


class LiveStreamActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
}
