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
                    <th style="width: 10%;">Total Hour</th>
                    <th style="">Omset</th>
                    <th style="width: 15%;">Cost</th>
                    <th style="width:5%;text-align: center;">Approval</th>
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

<!--Modal Approve Live Stream Activity-->
<div class="modal fade" data-backdrop="static" id="modal-approve-live-stream-activity">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-approve-live-stream-activity" action="{{route('approve-live-stream-activity')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Approve Live Stream Activity Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="streamer_name" class="col-sm-4 col-form-label">Streamer</label>
                        <div class="col-sm-8">
                            <input type="text" name="streamer_name" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="platform_name" class="col-sm-4 col-form-label">Platform Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="platform_name" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="platform_account_name" class="col-sm-4 col-form-label">Platform Account</label>
                        <div class="col-sm-8">
                            <input type="text" name="platform_account_name" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="live_stream_date" class="col-sm-4 col-form-label">Live Stream Date</label>
                        <div class="col-sm-8">
                            <input type="text" name="live_stream_date" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="started_time" class="col-sm-4 col-form-label">Started Time</label>
                        <div class="col-sm-8">
                            <input type="text" name="started_time" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stoped_time" class="col-sm-4 col-form-label">Stoped Time</label>
                        <div class="col-sm-8">
                            <input type="text" name="stoped_time" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_hour" class="col-sm-4 col-form-label">Total Hour</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_hour" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sales_turn_over" class="col-sm-4 col-form-label">Omset</label>
                        <div class="col-sm-8">
                            <input type="text" name="sales_turn_over" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_cost" class="col-sm-4 col-form-label">Cost</label>
                        <div class="col-sm-8">
                            <input type="text" name="total_cost" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Approve
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Approve Live Stream Activity-->

<!--Modal Stop Live Stream Activity-->
<div class="modal fade" data-backdrop="static" id="modal-stop-live-stream-activity">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-stop-live-stream-activity" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Stop Live Stream Activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="sales_turn_over" class="col-sm-3 col-form-label">Omset</label>
                        <div class="col-sm-9">
                            <input type="text" id="sales_turn_over" class="form-control autonumeric" name="sales_turn_over" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="live_stream_activity_id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-power-off"></i> STOP
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Stop Live Stream Activity-->


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

                        let started_time = row.started_time;
                        let stoped_time = row.stoped_time;

                        let live_stream_date_template ='';
                            live_stream_date_template+=data;
                            live_stream_date_template+='<br>';
                            live_stream_date_template+= moment(started_time).format('YYYY-MM-DD HH:mm');
                            live_stream_date_template+='<br>'
                            if(stoped_time!=null){
                                live_stream_date_template+= moment(stoped_time).format('YYYY-MM-DD HH:mm');
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
                                live_stream_activity_approval_template+='<button class="btn btn-approve btn-xs btn-primary">';
                                live_stream_activity_approval_template+=    'Approve';
                                live_stream_activity_approval_template+='</button>';
                                
                            }
                            
                        return live_stream_activity_approval_template;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+=data;
                    return action;
                }},
            ],
            order: [
                [ 3, "desc" ],
            ],
        });
        

        //Autonumeric amount
        new AutoNumeric('.autonumeric',{
            digitGroupSeparator:'.',
            decimalCharacter:',',
            decimalPlaces:'0',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });

        //Block Stop Live Stream Activity Trigger
        liveStreamActivityDT.on('click', '.btn-stop', function (e) {
            let data = liveStreamActivityDT.row(e.target.closest('tr')).data();
            console.log(data);
            $('#form-stop-live-stream-activity').attr('action', '/live-stream-activity/stop');
            $('#form-stop-live-stream-activity').find("input[name='live_stream_activity_id']").val(data.id);
            $('#modal-stop-live-stream-activity').modal('show');
        });
        //ENDBlock Stop Live Stream Activity Trigger
    
        //Block Approve Live Stream Activity Trigger
        liveStreamActivityDT.on('click', '.btn-approve', function (e) {
            let data = liveStreamActivityDT.row(e.target.closest('tr')).data();
            console.log(data);
            let sales_turn_over = accounting.formatNumber(data.sales_turn_over,{
                            precision: 0,
                            thousand: ".",
                            decimal : ","
                        });
            let total_cost = accounting.formatNumber(data.live_stream_activity_cost.total_cost,{
                            precision: 0,
                            thousand: ".",
                            decimal : ","
                        });
            
            $('#form-approve-live-stream-activity').find("input[name='streamer_name']").val(data.streamer.name);
            $('#form-approve-live-stream-activity').find("input[name='platform_name']").val(data.platform_account.platform.name);
            $('#form-approve-live-stream-activity').find("input[name='platform_account_name']").val(data.platform_account.name);
            $('#form-approve-live-stream-activity').find("input[name='live_stream_date']").val(data.live_stream_date);
            $('#form-approve-live-stream-activity').find("input[name='started_time']").val(data.started_time);
            $('#form-approve-live-stream-activity').find("input[name='stoped_time']").val(data.stoped_time);
            $('#form-approve-live-stream-activity').find("input[name='total_hour']").val(data.live_stream_activity_cost.total_hour);
            $('#form-approve-live-stream-activity').find("input[name='sales_turn_over']").val(sales_turn_over);
            $('#form-approve-live-stream-activity').find("input[name='total_cost']").val(total_cost);
            $('#form-approve-live-stream-activity').find("input[name='id']").val(data.id);
            $('#modal-approve-live-stream-activity').modal('show');
        });
        //ENDBlock Approve Live Stream Activity Trigger

        //Block Approve Live Stream Activity
        $('#form-approve-live-stream-activity').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-approve-live-stream-activity').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-approve-live-stream-activity')[0].reset();
                        $('#modal-approve-live-stream-activity').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        liveStreamActivityDT.ajax.reload();
                        $('#form-approve-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-approve-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    let errors = jqXHR.responseJSON;
                    let error_template = "";
                    $.each(errors.errors, function(key, value) {
                        console.log(value);
                        error_template += '<p>' + value + '</p>'; //showing only the first error.
                    });
                    console.log(error_template);
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        position: 'bottomRight',
                        autohide: true,
                        delay: 5000,
                        icon: 'fas fa-exclamation-circle',
                        title: 'Error',
                        subtitle: 'Validation error',
                        body: error_template
                    });
                    $('#form-approve-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Approve Live Stream Activity
        

        //Block Stop Live Stream Activity
        $('#form-stop-live-stream-activity').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-stop-live-stream-activity').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-stop-live-stream-activity')[0].reset();
                        $('#modal-stop-live-stream-activity').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        liveStreamActivityDT.ajax.reload();
                        $('#form-stop-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-stop-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    let errors = jqXHR.responseJSON;
                    //console.log(errors);
                    let error_template = "";
                    //console.log(textStatus);
                    $.each(errors.errors, function(key, value) {
                        console.log(value);
                        error_template += '<p>' + value + '</p>'; //showing only the first error.
                    });
                    console.log(error_template);
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        position: 'bottomRight',
                        autohide: true,
                        delay: 5000,
                        icon: 'fas fa-exclamation-circle',
                        title: 'Error',
                        subtitle: 'Validation error',
                        body: error_template
                    });
                    $('#form-stop-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Stop Live Stream Activity


    });

</script>
@endsection
