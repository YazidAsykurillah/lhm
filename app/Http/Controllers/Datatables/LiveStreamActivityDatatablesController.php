<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
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
