@extends('adminlte::page')

@section('title', 'Payment Note :: Create')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Payment Note</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('/payment-note')}}">
                        Payment Note
                    </a>
                </li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <form class="form-horizontal" id="form-create-payment-note" action="{{ route('payment-note.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-header">
        <h3 class="card-title">Form Create Payment Note</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="user_id" class="col-sm-4 col-form-label">Streamer</label>
            <div class="col-sm-8">
                <select class="form-control" name="user_id" id="user_id" style="width:100%;"></select>
            </div>
        </div>

        <div class="form-group row">
          <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
          <div class="col-sm-4">
                <div class="input-group dateonly" id="start_date" data-target-input="nearest">
                    <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#start_date" readonly />
                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
          <div class="col-sm-4">
                <div class="input-group dateonly" id="end_date" data-target-input="nearest">
                    <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date" readonly />
                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
          </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label">Description</label>
            <div class="col-sm-8">
                <input type="text" name="title" class="form-control">
            </div>
        </div>

    </div>
    <div class="card-footer clearfix" style="display: block;">
        <a href="{{ url('payment-note') }}" class="btn btn-sm btn-default">Cancel</a>
        <button type="submit" class="btn btn-sm btn-primary float-right" title="Save payment note">
            <i class="fas fa-save"></i> Save
        </button>
    </div>
    </form>
</div>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        
        //Block Create Payment Note
        $('#form-create-payment-note').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-create-payment-note').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-create-payment-note')[0].reset();
                        $('#modal-create-payment-note').modal('hide');
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
                        $('#form-create-payment-note').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-create-payment-note').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-create-payment-note').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Create Payment Note

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

        $('.dateonly').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });

    });

</script>
@endsection
