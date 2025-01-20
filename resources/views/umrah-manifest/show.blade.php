@extends('adminlte::page')

@section('title', 'Detail Program Umrah')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Detail Program Umrah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">                
                <li class="breadcrumb-item">
                    <a href="{{url('home')}}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active">Detail Program Umrah</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
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
                        <td>{{ $umrah_manifest->umrah_batch->code_batch }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Berangkat</td>
                        <td>:</td>
                        <td>{{ $umrah_manifest->umrah_batch->departure_schedule}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kembali</td>
                        <td>:</td>
                        <td>{{ $umrah_manifest->umrah_batch->return_schedule}}</td>
                    </tr>
                    
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

    

</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Jamaah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table-umrah-manifest">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor KTP</th>
                            <th>Nomor Passport</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($umrah_manifest->participants->count())
                            @foreach($umrah_manifest->participants as $participant)
                            <tr>
                                <td></td>
                                <td>{{$participant->name}}</td>
                                <td>{{$participant->address}}</td>
                                <td>{{$participant->phone_number}}</td>
                                <td>{{$participant->gender}}</td>
                                <td>{{$participant->ktp_number}}</td>
                                <td>{{$participant->passport_number}}</td>
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Tabungan</h3>
                <div class="card-tools">
                    <button type="button" id="btn-create-saving-transaction" class="btn btn-xs btn-primary" title="Collapse">
                        <i class="fas fa-plus"></i> Upload Bukti Transfer
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table-saving-transaction">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bank Pengirim</th>
                            <th>Nama Pengirim</th>
                            <th>Bank Tujuan</th>
                            <th>Jumlah Uang</th>
                            <th>Tanggal Transfer</th>
                            <th>Bukti Transfer</th>
                            <th>Disetujui</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($umrah_manifest->saving_transactions->count())
                        @foreach($umrah_manifest->saving_transactions as $saving_transaction)
                        <tr>
                            <td></td>
                            <td>{{$saving_transaction->transaction_source}}</td>
                            <td>{{$saving_transaction->sender_name}}</td>
                            <td>{{$saving_transaction->bank_account_id}}</td>
                            <td>{{ number_format($saving_transaction->amount) }}</td>
                            <td>{{ $saving_transaction->transaction_date }}</td>
                            <td>{{ $saving_transaction->transaction_receipt }}</td>
                            <td>{{ $saving_transaction->is_confirmed }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal Create Saving Transaction-->
<div class="modal fade" data-backdrop="static" id="modal-create-saving-transaction">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form-create-saving-transaction" action="{{ url('/saving-transaction') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Upload Bukti Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="transaction_source" class="col-sm-3 col-form-label">Bank Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="transaction_source" placeholder="Bank Pengirim">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sender_name" class="col-sm-3 col-form-label">Nama Pengirim</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="sender_name" placeholder="Nama Pengirim Sesuai Bank Pengirim">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_account_id" class="col-sm-3 col-form-label">Bank Tujuan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="bank_account_id" id="bank_account_id"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Jumlah Uang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="amount" placeholder="Jumlah uang yang ditransfer">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="transaction_date" class="col-sm-3 col-form-label">Tanggal Transfer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="transaction_date" id="transaction_date" placeholder="Tanggal transfer">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="transaction_date" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                          <div class="col-sm-9 input-group datepick">
                            <input type="text" class="form-control" name="transaction_date" id="transaction_date" readonly>
                            <div class="input-group-addon">
                              <span class="fas fa-fw fa-calendar"></span>
                            </div>
                          </div>
                    </div>
                    <div class="form-group row">
                        <label for="transaction_receipt" class="col-sm-3 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="transaction_receipt">
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" id="umrah_manifest_id" name="umrah_manifest_id" value="{{$umrah_manifest->id}}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Create Saving Transaction-->

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        //Block Create Saving Transaction
        $('#btn-create-saving-transaction').on('click', function(event) {
            event.preventDefault();
            $('#modal-create-saving-transaction').modal('show');
        });
        //ENDBlock Create Saving Transaction

        //Block select Bank Account id
        $('#bank_account_id').select2({
            placeholder: 'Pilih Bank Tujuan',
            ajax: {
                url: "{!! url('/bank-account/select2') !!}",
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
            templateResult : templateResultBankAccount,
        });

        function templateResultBankAccount(results){
          if(results.loading){
            return "Searching...";
          }
          var markup = '<span>';
              markup+=  results.text;
              markup+= '</span>';
          return $(markup);
        }
        //ENDBlock select Bank Account id

        $('.datepick').datetimepicker({
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
          });

        //Block Form Create Saving Transaction Submission
        $('#form-create-saving-transaction').on('submit', function(event){
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
                    $('#form-create-saving-transaction').find("button[type='submit']").prop('disabled', true);
                },
                success: function(data){
                    console.log(data);
                    if(data.status == true){
                        $('#form-create-saving-transaction')[0].reset();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: data.message
                        });
                        $('#form-create-saving-transaction').find("button[type='submit']").prop('disabled', false);
                        window.location.href = data.data.url;
                    }else{
                        $('#form-create-saving-transaction').find("button[type='submit']").prop('disabled', false);
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
                    $('#form-create-saving-transaction').find("button[type='submit']").prop('disabled', false);
                }
            });
        });
        //ENDBlock Form Create Saving Transaction Submission

    });
</script>
@endsection
