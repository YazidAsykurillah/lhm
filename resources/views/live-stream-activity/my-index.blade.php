@extends('adminlte::page')

@section('title', 'Live Stream Activity')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Live Stream Activity</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('my-live-stream-activity')}}">
                        Live Stream Activity
                    </a>
                </li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Live Stream Activity History</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <table class="table table-bordered nowrap" id="table-live-stream-activity" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width: 10%;">Platform</th>
                            <th style="width: 15%;">Date</th>
                            <th style="width: 10%;">Total Hour</th>
                            <th style="">Omset</th>
                            <th style="width: 15%;">Cost</th>
                            <th style="width:5%;">Approval Status</th>
                            <th style="width:10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                <div id="data-table-button-tools" class=""></div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        var liveStreamActivityDT = $('#table-live-stream-activity').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('live-stream-activity-datatables') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
                {
                    data: 'platform_account.platform',
                    name: 'platform_account.platform.name',
                    orderable:true,
                    render:function(data, type, row, meta){
                        let platform_template='';
                            platform_template+=data.name;
                            platform_template+='<br>';
                            platform_template+='<span class="badge bg-info">';
                            platform_template+= row.platform_account.name;
                            platform_template+='</span>';
                        return platform_template;
                    }
                },
                {
                    data: 'live_stream_date',
                    name: 'live_stream_date',
                    render:function(data, type, row, meta){
                        let started_time = row.started_time;
                        let stoped_time = row.stoped_time;

                        let live_stream_date_template ='';
                            live_stream_date_template+=data;
                            live_stream_date_template+='<br>';
                            live_stream_date_template+= moment(started_time).format('YYYY-MM-DD HH:mm');
                            live_stream_date_template+='<br>';
                            if(stoped_time!=null){
                                live_stream_date_template+= moment(row.stoped_time).format('YYYY-MM-DD HH:mm');
                            }else{
                                live_stream_date_template+='<span class="badge bg-warning"><i class="fas fa-hourglass-start"></i> On Going<span>';
                            }
                            
                        return live_stream_date_template;
                    }
                },
                {
                    data: 'live_stream_activity_cost.total_hour',
                    name: 'live_stream_activity_cost.total_hour',
                    render:function(data, type, row, meta){
                        let live_stream_total_hour_template ='';
                            live_stream_total_hour_template+=data;
                        return live_stream_total_hour_template;
                    }
                },
                {
                    data: 'sales_turn_over',
                    name: 'sales_turn_over',
                    render:function(data, type, row, meta){
                        return accounting.formatNumber(data,{
                            precision: 0,
                            thousand: ".",
                            decimal : ","
                        });
                    }
                },
                {
                    data: 'live_stream_activity_cost.total_cost',
                    name: 'live_stream_activity_cost.total_cost',
                    render:function(data, type, row, meta){
                        return accounting.formatNumber(data,{
                            precision: 0,
                            thousand: ".",
                            decimal : ","
                        });
                    }
                },
                
                {
                    data: 'live_stream_activity_approval',
                    name: 'live_stream_activity_approval.is_approved',
                    render:function(data, type, row, meta){
                        let live_stream_activity_approval_template='';
                            if(data == null){
                                return live_stream_activity_approval_template;
                            }
                            if(data.is_approved == true){
                                live_stream_activity_approval_template+='<span class="badge bg-green">';
                                live_stream_activity_approval_template+=    'Approved';
                                live_stream_activity_approval_template+='</span>';
                                live_stream_activity_approval_template+='<br>';
                                live_stream_activity_approval_template+='<span class="badge bg-default">';
                                live_stream_activity_approval_template+=    '<i class="fas fa-user"></i>&nbsp;';
                                live_stream_activity_approval_template+=    data.approver.name;
                                live_stream_activity_approval_template+='</span>';
                            }else if(data.is_approved == false && row.stoped_time != null){
                                live_stream_activity_approval_template+='<span class="badge bg-yellow">';
                                live_stream_activity_approval_template+=    'Need Approval';
                                live_stream_activity_approval_template+='</span>';
                                live_stream_activity_approval_template+='<br>';
                                
                            }
                            
                        return live_stream_activity_approval_template;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        
                    return action;
                }},
            ],
            order: [
                [ 2, "desc" ],
            ],
        });

    });

</script>
@endsection
