<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Models\LiveStreamActivity;

class LiveStreamActivityDatatablesController extends Controller
{
    public function index(Request $request)
    {
        $data = LiveStreamActivity::query()
            ->with([
                'streamer'=>function($query){
                    return $query->select('users.id', 'users.name');
                }
            ])
            ->with(
                [
                    'platform_account'=>function($query){
                        return $query->select('platform_accounts.id','platform_accounts.name', 'platform_accounts.platform_id');
                    }
                ]
            )
            ->with([
                'platform_account.platform'=>function($query){
                    return $query->select('platforms.id','platforms.name');
                }
            ])
            ->with([
                'live_stream_activity_cost'=>function($query){
                    return $query->select(
                        'live_stream_activity_costs.live_stream_activity_id',
                        'live_stream_activity_costs.id',
                        'live_stream_activity_costs.total_hour',
                        'live_stream_activity_costs.total_cost',
                    );
                }
            ])
            ->with([
                'live_stream_activity_approval'=>function($query){
                    return $query->select(
                        'live_stream_activity_approvals.live_stream_activity_id',
                        'live_stream_activity_approvals.id',
                        'live_stream_activity_approvals.is_approved',
                        'live_stream_activity_approvals.approver_id',
                    );
                }
            ])
            ->with([
                'live_stream_activity_approval.approver'=>function($query){
                    return $query->select(
                        'users.id',
                        'users.name',
                    );
                }
            ])
            ->select('live_stream_activities.*');

        if(\Auth::user()->canNot('view-all-live-stream-activity')){
            $data->where('user_id','=', \Auth::user()->id);
        }

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    //$btn = '<a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit">Edit</a>';
                    return NULL;
                })
                ->rawColumns(['action'])
                ->make(true);
    }


    //Ongoing live stream activity
    public function getOngoing(Request $request)
    {
        $data = LiveStreamActivity::query()
            ->with([
                'streamer'=>function($query){
                    return $query->select('users.id', 'users.name');
                }
            ])
            ->with(
                [
                    'platform_account'=>function($query){
                        return $query->select('platform_accounts.id','platform_accounts.name', 'platform_accounts.platform_id');
                    }
                ]
            )
            ->with([
                'platform_account.platform'=>function($query){
                    return $query->select('platforms.id','platforms.name');
                }
            ])
            
            ->where('stoped_time','=', NULL)
            ->select('live_stream_activities.*');

            if(\Auth::user()->canNot('view-all-live-stream-activity')){
                $data->where('user_id','=', \Auth::user()->id);
            }


        return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('current_time', function($row){
                    return Carbon::parse(Carbon::now())->format('Y-m-d H:i');
                })

                ->addColumn('duration', function($row){
                    $started_time = Carbon::parse($row->started_time);
                    $curent_time = Carbon::parse(now());
                    $totalDuration = $started_time->diffForHumans($curent_time, CarbonInterface::DIFF_ABSOLUTE, false, 2);
                    return $totalDuration;
                    
                })
                ->addColumn('action', function($row){
                    $btn ='<a href="javascript:void(0)" class="btn btn-danger btn-xs btn-stop">';
                    $btn.=  '<i class="fa fa-power-off"></i>&nbsp;&nbsp;STOP';
                    $btn.='</a>';
                    return $btn;
                })
                ->rawColumns(['current_time','duration','action'])
                ->make(true);
    }

}
