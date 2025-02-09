@extends('adminlte::page')

@section('title', 'Live Stream Activity :: Create')

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
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <form class="form-horizontal" id="form-create-live-stream-activity" action="{{ route('live-stream-activity.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Form Create Live Stream Activity</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">        
        <div class="form-group row">
            <label for="user_id" class="col-sm-4 col-form-label">Streamer</label>
            <div class="col-sm-8">
                <select class="form-control" name="user_id" id="user_id" style="width:100%;"></select>
            </div>
        </div>
        <div class="form-group row">
            <label for="platform_account_id" class="col-sm-4 col-form-label">Platform Account</label>
            <div class="col-sm-8">
                <select class="form-control" name="platform_account_id" id="platform_account_id" style="width:100%;"></select>
            </div>
        </div>
        
        <div class="form-group row">
          <label for="live_stream_date" class="col-sm-4 col-form-label">Live Stream Date</label>
          <div class="col-sm-4">
                <div class="input-group dateonly" id="live_stream_date" data-target-input="nearest">
                    <input type="text" name="live_stream_date" class="form-control datetimepicker-input" data-target="#live_stream_date" readonly />
                    <div class="input-group-append" data-target="#live_stream_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
          </div>
        </div>
        
        <div class="form-group row">
            <label for="started_time" class="col-sm-4 col-form-label">Started Time</label>
            <div class="col-sm-4">
                <div class="input-group datetime" id="started_time" data-target-input="nearest">
                    <input type="text" name="started_time" class="form-control datetimepicker-input" data-target="#started_time"/>
                    <div class="input-group-append" data-target="#started_time" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="stoped_time" class="col-sm-4 col-form-label">Stoped Time</label>
            <div class="col-sm-4">
                <div class="input-group datetime" id="stoped_time" data-target-input="nearest">
                    <input type="text" name="stoped_time" class="form-control datetimepicker-input" data-target="#stoped_time"/>
                    <div class="input-group-append" data-target="#stoped_time" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="sales_turn_over" class="col-sm-4 col-form-label">Omset</label>
            <div class="col-sm-4">
                <div class="input-group" id="sales_turn_over" data-target-input="nearest">
                    <input type="text" name="sales_turn_over" class="form-control autonumeric"/>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-money-bill"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer clearfix" style="display: block;">
        <button type="submit" class="btn btn-sm btn-primary" title="Save new Live Stream Activity">
            <i class="fas fa-save"></i> Save
        </button>
    </div>
    </form>
</div>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        
        //Block Create Live Stream Activity
        $('#form-create-live-stream-activity').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-create-live-stream-activity').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-create-live-stream-activity')[0].reset();
                        $('#modal-create-live-stream-activity').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        //platformDT.ajax.reload();
                        window.location.href = data.data.url;
                        $('#form-create-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-create-live-stream-activity').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-create-live-stream-activity').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Create Live Stream Activity       


        //Block select streamer
        $('#user_id').select2({
            placeholder: 'Select Streamer',
            ajax: {
                url: "{!! url('/user/select2Streamer') !!}",
                dataType: 'json',
                delay: 250,
                processResults: function (data, params) {
                  params.page = params.page || 1;
                  return {
                    results:  $.map(data.data, function (item) {
                        return{
                            text: item.name,
                            id: item.id,
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
            templateResult : templateResultStreamer,
        });

        function templateResultStreamer(results){
          if(results.loading){
            return "Searching...";
          }
          var markup = '<span>';
              markup+=  results.text;
              markup+= '</span>';
          return $(markup);
        }
        //ENDBlock select streamer

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
        

        /*$('#live_stream_date').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });*/

        $('.dateonly').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });

        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            icons: { time: 'far fa-clock' } 
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

    });

</script>
@endsection
