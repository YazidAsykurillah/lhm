
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">On Going Live Stream Activity</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <table class="table table-bordered nowrap" id="table-ongoing-live-stream-activity" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:40%;">Platform</th>
                            <th style="width:15%;">Date</th>
                            <th style="width:15%;">Started Time</th>
                            <th style="">Duration</th>
                            <th style="width:10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="button" id="btn-start" class="btn btn-sm btn-success" title="Start new live stream activity">
                    <i class="fas fa-play"></i>&nbsp;&nbsp;START
                </button>
            </div>
        </div>
    </div>
</div>

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

<!--Modal Start Live Stream Activity-->
<div class="modal fade" data-backdrop="static" id="modal-start-live-stream-activity">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-start-live-stream-activity" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Start Live Stream Activity</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="platform_account_id" class="col-sm-4 col-form-label">Platform Account</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="platform_account_id" id="platform_account_id" style="width:100%;"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-play"></i> Start
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Start Live Stream Activity-->

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

    //OnGoing Live Stream Acitivy Datatable Refreseh status
    var refresh_status = true;

    //Datatable
    var oGliveStreamActivityDT = $('#table-ongoing-live-stream-activity').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('ongoing-live-stream-activity-datatables') }}",
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
                        let live_stream_date_template ='';
                            live_stream_date_template+=data;
                            live_stream_date_template+='<br>';
                        return live_stream_date_template;
                    }
                },
                {
                    data: 'started_time',
                    name: 'started_time',
                    render:function(data, type, row, meta){
                        let started_time_template ='';
                            started_time_template+= moment(data).format('YYYY-MM-DD HH:mm');
                        return started_time_template;
                    }
                },
                {
                    data: 'duration',
                    name: 'duration',
                    searchable:false,
                    orderable:false,
                    render:function(data, type, row, meta){
                        let duration_template ='';
                            duration_template+= data;
                        return duration_template;
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
        

        //Block Stop Live Stream Activity Trigger
        oGliveStreamActivityDT.on('click', '.btn-stop', function (e) {
            let data = oGliveStreamActivityDT.row(e.target.closest('tr')).data();
            console.log(data);
            $('#form-stop-live-stream-activity').attr('action', '/live-stream-activity/stop');
            $('#form-stop-live-stream-activity').find("input[name='live_stream_activity_id']").val(data.id);
            $('#modal-stop-live-stream-activity').modal('show');
        });
        //ENDBlock Stop Live Stream Activity Trigger

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
                        oGliveStreamActivityDT.ajax.reload();
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


        //Block Start Live Stream Activity Trigger
        $('#btn-start').on('click', function(){
            $('#form-start-live-stream-activity').attr('action', '/live-stream-activity/start');
            $('#modal-start-live-stream-activity').modal('show');
            
            
        });
        //ENDBlock Start Live Stream Activity Trigger

        //Block Start Live Stream Activity
        $('#form-start-live-stream-activity').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-start-live-stream-activity').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-start-live-stream-activity')[0].reset();
                        $('#modal-start-live-stream-activity').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        oGliveStreamActivityDT.ajax.reload();
                        $('#form-start-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-start-live-stream-activity').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-start-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Start Live Stream Activity

        //Autonumeric amount
        new AutoNumeric('.autonumeric',{
            digitGroupSeparator:'.',
            decimalCharacter:',',
            decimalPlaces:'0',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });

        //Block select Platform Account
        $('#platform_account_id').select2({
            placeholder: 'Select Platform Account',
            ajax: {
                url: "{!! url('/platform-account/select2') !!}",
                dataType: 'json',
                delay: 250,
                processResults: function (data, params) {
                  params.page = params.page || 1;
                  return {
                    results:  $.map(data.data, function (item) {
                        return{
                            text: item.name,
                            id: item.id,
                            platform_name:item.platform.name
                        }
                    }),
                    pagination: {
                      more: (params.page * data.per_page) < data.total
                    },
                  };
                },
                cache: true
            },
            allowClear : true,
            templateResult : templateResultPlatformAccount,
            templateSelection:templateSelectionPlatformAccount
        });

        function templateResultPlatformAccount(results){
            if(results.loading){
                return "Searching...";
            }
            var markup ='';
                markup+='<span>';
                markup+=    results.platform_name;
                markup+=    '<br/>';
                markup+=    '<i class="fas fa-fw fa-user"></i>';
                markup+=    results.text;
                markup+='</span>';
            return $(markup);
        }

        function templateSelectionPlatformAccount(platformAccount){
            if(!platformAccount.id){
                return platformAccount.text
            }
            let $platformAccount = $(
                '<span><span></span></span>'
            );
            $platformAccount.find("span").text(platformAccount.platform_name+' - '+platformAccount.text);
            return $platformAccount;
        }
        //ENDBlock select Platform Account

        
        
        //Refresh datatable every one minutes
        var dtRefresher = setInterval(function(){
            console.log('refreshed');
            oGliveStreamActivityDT.ajax.reload();
        }, 120000);

        
        

    });
</script>
@endsection
