@extends('adminlte::page')

@section('title', 'Live Stream Activity :: Index')

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
                    <a href="{{url('/live-stream-activity')}}">
                        Live Stream Activity
                    </a>
                </li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Live Stream Activity List</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
        </div>
    </div>
    <div class="card-body">
        
        <table class="table table-bordered nowrap" id="table-live-stream-activity" style="width:100%">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width: 10%;">Streamer</th>
                    <th style="width: 10%;">Platform</th>
                    <th style="width: 10%;">Date</th>
                    <th style="width: 10%;">Duration (hour)</th>
                    <th style="width: 10%;">Cost</th>
                    <th style="">Omset</th>
                    <th style="width:5%;">Approval Status</th>
                    <th style="width:10%;">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>   
        
    </div>
    <div class="card-footer clearfix" style="display: block;">
        <a href="{{ url('live-stream-activity/create') }}" class="btn btn-sm btn-primary" title="Create new Live Stream Activity">
            Add New
        </a>
    </div>
</div>



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
                    data: 'streamer',
                    name: 'streamer.name',
                    render:function(data, type, row, meta){
                        let streamer_template='';
                            streamer_template+=data.name;
                        return streamer_template;
                    }
                    
                },
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
                        let live_stream_date_template ='';
                            live_stream_date_template+=data;
                            live_stream_date_template+='<br>';
                            live_stream_date_template+= moment(row.started_time).format('YYYY-MM-DD HH:mm');
                            live_stream_date_template+='<br>'
                            live_stream_date_template+= moment(row.stoped_time).format('YYYY-MM-DD HH:mm');
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
                    data: 'live_stream_activity_approval',
                    name: 'live_stream_activity_approval.is_approved',
                    render:function(data, type, row, meta){
                        let live_stream_activity_approval_template='';
                            if(data == null){
                                return live_stream_activity_approval_template;
                            }
                            if(data.is_approved == true){
                                live_stream_activity_approval_template+='<i class="fas fa-check-circle" title="Disetujui"></i>';
                                live_stream_activity_approval_template+='<br>';
                                live_stream_activity_approval_template+='<span class="badge bg-default">';
                                live_stream_activity_approval_template+=    '<i class="fas fa-user"></i>&nbsp;';
                                live_stream_activity_approval_template+=    data.approver.name;
                                live_stream_activity_approval_template+='</span>';
                            }else{
                                live_stream_activity_approval_template+= '<i class="fas fa-stopwatch" title="Belum disetujui"></i>';
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
                [ 3, "desc" ],
            ],
        });


        


    });

</script>
@endsection
