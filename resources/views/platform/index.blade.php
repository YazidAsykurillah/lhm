@extends('adminlte::page')

@section('title', 'Platform :: Index')

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
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Platform List</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
        </div>
    </div>
    <div class="card-body">
        
            <table class="table table-bordered nowrap" id="table-platform" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th>Name</th>
                        <th style="width:25%;">Platform Accounts</th>
                        <th style="width:10%;">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>    
        
        
    </div>
    <div class="card-footer clearfix" style="display: block;">
        <button id="btn-create" class="btn btn-sm btn-primary" title="Create new platform">
            Add New
        </button>
    </div>
</div>

<!--Modal Create Platform-->
<div class="modal fade" data-backdrop="static" id="modal-create-platform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-create-platform" action="{{ route('platform.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Create Platform</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Create Platform-->

<!--Modal Edit Platform-->
<div class="modal fade" data-backdrop="static" id="modal-edit-platform">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-edit-platform" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Edit Platform</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Edit Platform-->


@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        var platformDT = $('#table-platform').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('platform-datatables') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
                {
                    data: 'name',
                    name: 'name',
                    render:function(data, type, row, meta){
                        let name_template ='';
                            name_template+='<a href="{{ url('platform') }}/'+row.id+'">';
                            name_template+= data;
                            name_template+='</a>';
                        return name_template;

                    }
                },
                {
                    data: 'platform_accounts',
                    name: 'platform_accounts.name',
                    orderable:false,
                    render:function(data, type, row, meta){
                        let platform_accounts_template = '';
                        if(row.platform_accounts.length >0){
                            $.each( row.platform_accounts, function( key, value ){
                                platform_accounts_template+='<span class="badge bg-default">';
                                platform_accounts_template+=    value.name;
                                platform_accounts_template+='</span>&nbsp;';
                            });
                        }
                        return platform_accounts_template;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+='<button class="btn btn-default btn-xs btn-edit" title="Edit">';
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


        $('#btn-create').on('click', function(){
            $('#modal-create-platform').modal('show');
        });

        //Block Create Platform
        $('#form-create-platform').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-create-platform').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-create-platform')[0].reset();
                        $('#modal-create-platform').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        platformDT.ajax.reload();
                        $('#form-create-platform').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-create-platform').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-create-platform').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Create Platform

        //Block Edit Platform Trigger
        platformDT.on('click', '.btn-edit', function (e) {
            let data = platformDT.row(e.target.closest('tr')).data();
            console.log(data);
            $('#form-edit-platform').attr('action', '/platform/'+data.id+'');
            $('#form-edit-platform').find("input[name='name']").val(data.name);
            $('#modal-edit-platform').modal('show');
        });
        //ENDBlock Edit Platform Trigger

        //Block Edit Platform
        $('#form-edit-platform').on('submit', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#form-edit-platform').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#form-edit-platform')[0].reset();
                        $('#modal-edit-platform').modal('hide');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        platformDT.ajax.reload();
                        $('#form-edit-platform').find("button[type='submit']").prop('disabled', false);
                    } else {
                        $('#form-edit-platform').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-edit-platform').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Edit Platform


    });

</script>
@endsection
