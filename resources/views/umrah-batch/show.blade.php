@extends('adminlte::page')

@section('title', 'Detail Batch')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Detail Batch</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Detail Batch</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Batch</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Kode Batch</td>
                        <td>:</td>
                        <td>{{ $umrah_batch->code_batch }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Berangkat</td>
                        <td>:</td>
                        <td>{{ $umrah_batch->departure_schedule}}</td>
                    </tr>
                    <tr>
                        <td>Harga Dasar</td>
                        <td>:</td>
                        <td>{{ number_format($umrah_batch->basic_price)}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ $umrah_batch->availability }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Umrah Manifest</h3>
                <div class="card-tools">
                    <button type="button" id="btn-add-umrah-manifest" class="btn btn-xs btn-primary" title="Tambahkan peserta">
                      <i class="fas fa-plus"></i> Tambahkan Manifest
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table-umrah-manifest">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th>Nama Pendaftar</th>
                            <th>Jumlah Jamaah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($umrah_batch->umrah_manifests->count())
                            @foreach($umrah_batch->umrah_manifests as $umrah_manifest)
                            <tr>
                                <td></td>
                                <td>{{$umrah_manifest->user->name}}</td>
                                <td>{{$umrah_manifest->participants->count()}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

</div>


<!--Modal Add Manifest-->
<div class="modal fade" data-backdrop="static" id="modal-add-umrah-manifest">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-add-umrah-manifest" action="{{ url('/umrah-manifest') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambahkan Manifest</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label">Pilih Pendaftar</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="user_id" id="user_id" style="width:100%;"></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="add_user_as_participant" class="col-sm-3 col-form-label"></label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="add_user_as_participant" name="add_user_as_participant">
                            <label class="form-check-label" for="add_user_as_participant">Tambahkan Pendaftar Sebagai Jamaah</label>
                          </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" id="umrah_batch_id" name="umrah_batch_id" value="{{$umrah_batch->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Add Manifest-->


@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        $('#btn-add-umrah-manifest').on('click', function(event){
            event.preventDefault();
            $('#modal-add-umrah-manifest').modal('show');
        });


        //Block select User For Umrah Manifest
        $('#user_id').select2({
            placeholder: 'Pilih Pendafatar',
            ajax: {
                url: "{!! url('/user/selectFormUmrahManifest') !!}",
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
            templateResult : templateResultUserForManifest,
        });

        function templateResultUserForManifest(results){
          if(results.loading){
            return "Searching...";
          }
          var markup = '<span>';
              markup+=  results.text;
              markup+= '</span>';
          return $(markup);
        }
        //ENDBlock select User For Umrah Manifest


        //Block Form Add Umrah Manifest
        $('#form-add-umrah-manifest').on('submit', function(event){
            event.preventDefault();
            let url = $(this).attr('action');
            let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: url,
                //data: $(this).serialize(),
                data: formData,
                //dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                    $('#form-add-umrah-manifest').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data){
                    console.log(data);
                    if(data.status == true){
                        $('#form-add-umrah-manifest')[0].reset();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        $('#form-add-umrah-manifest').find("button[type='submit']").prop('disabled', false);
                        window.location.href = data.data.url;
                    }else{
                        $('#form-add-umrah-manifest').find("button[type='submit']").prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    let errors = jqXHR.responseJSON;
                    console.log(errors);
                    let error_template = "";
                    //console.log(textStatus);
                    $.each( errors.errors, function( key, value ){
                        console.log(value);
                        error_template += '<p>'+value+ '</p>'; //showing only the first error.
                    });
                    console.log(error_template);
                    $(document).Toasts('create',{
                        class: 'bg-danger',
                        position: 'bottomRight',
                        autohide: true,
                        delay: 5000,
                        icon: 'fas fa-exclamation-circle',
                        title: 'Error',
                        subtitle: ' Validation error',
                        body: error_template
                    });
                    $('#form-add-umrah-manifest').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Form Add Umrah Manifest


    });
</script>
@endsection
