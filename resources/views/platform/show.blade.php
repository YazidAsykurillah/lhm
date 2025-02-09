@extends('adminlte::page')

@section('title', 'Platform Detail :: '.$platform->name.'')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Platform</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('/platform')}}">
                        Platform
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{url('/platform/'.$platform->id.'')}}">
                        {{ $platform->name }}
                    </a>
                </li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Platform Information</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:50%">Name:</th>
                        <td>{{$platform->name}}</td>
                    </tr>
                    </tbody>
                </table>
                
            </div>
            <div class="card-footer clearfix" style="display: block;">
                <!-- <a href="{{ url('platform/'.$platform->id.'/edit') }}" class="" title="Create new platform">
                    Edit
                </a> -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Platform Accounts Information</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table-platform-accounts">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th>Name</th>
                            <th style="width:15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
                
            </div>
            <div class="card-footer clearfix" style="display: block;">
                <button id="btn-add-platform-account" class="btn btn-sm btn-primary" title="Add new platform account">
                    Add New
                </button>
            </div>
        </div>
    </div>
</div>

<!--Modal Create Platform Account-->
<div class="modal fade" data-backdrop="static" id="modal-create-platform-account">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-create-platform-account" action="{{ route('platform-account.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create Platform Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="platform_id" value="{{ $platform->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Create Platform Account-->

<!--Modal Edit Platform Account-->
<div class="modal fade" data-backdrop="static" id="modal-edit-platform-account">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-edit-platform-account" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Edit Platform Account</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="platform_id" value="{{ $platform->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Edit Platform Account-->



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        var platformAccountDT = $('#table-platform-accounts').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('platform/'.$platform->id.'/plaform-account-datatables') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
                {
                    data: 'name',
                    name: 'name',
                    render:function(data, type, row, meta){
                        let name_template ='';
                            name_template+= data;
                        return name_template;

                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+='<button class="btn btn-default btn-xs btn-edit-platform-account" title="Edit">';
                        action+=    '<i class="fas fa-edit"></i>';
                        action+='</button>';
                        action+='&nbsp;';
                        action+='<button class="btn btn-default btn-xs btn-delete" title="Delete">';
                        action+=    '<i class="fas fa-trash"></i>';
                        action+='</button>';
                    return action;
                }},
            ],
            order: [
                [ 1, "asc" ],
            ],
        });


        $('#btn-add-platform-account').on('click', function(){

            $('#modal-create-platform-account').modal('show');
        });

        //Block Save Platform Account
        $('#form-create-platform-account').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-create-platform-account').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-create-platform-account')[0].reset();
                        $('#modal-create-platform-account').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        platformAccountDT.ajax.reload();
                        $('#form-create-platform-account').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-create-platform-account').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-create-platform-account').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Save Platform Account

        //Block Edit Platform Account Trigger
        platformAccountDT.on('click', '.btn-edit-platform-account', function (e) {
            let data = platformAccountDT.row(e.target.closest('tr')).data();
            console.log(data);
            $('#form-edit-platform-account').attr('action', '/platform-account/'+data.id+'');
            $('#form-edit-platform-account').find("input[name='name']").val(data.name);
            $('#modal-edit-platform-account').modal('show');
        });
        //ENDBlock Edit Platform Account Trigger

        //Block Edit Platform Account
        $('#form-edit-platform-account').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-edit-platform-account').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-edit-platform-account')[0].reset();
                        $('#modal-edit-platform-account').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        platformAccountDT.ajax.reload();
                        $('#form-edit-platform-account').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-edit-platform-account').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-edit-platform-account').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Edit Platform Account

    });
</script>
@endsection
