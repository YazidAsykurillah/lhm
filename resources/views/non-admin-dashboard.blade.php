
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-fw fa-money-bill"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Saldo Tabungan</span>
        <span class="info-box-number">{{ \Auth::user()->deposit->amount }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<!-- /.row -->

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">Daftar Riwayat Tabungan Umrah Anda</h3>
          <div class="card-tools">
              <button type="button" id="btn-create-saving-transaction" class="btn btn-xs btn-primary" title="Upload Bukti Transfer Tabungan">
                <i class="fas fa-upload"></i>&nbsp;&nbsp;Upload Bukti Transfer
              </button>
          </div>
      </div>
      <div class="card-body">
          <table class="table table-bordered table-responsive" id="table-saving-transaction">
              <thead>
                  <tr>
                      <th style="width:5%;">No</th>
                      <th>Program Umrah</th>
                      <th>Bank Pengirim</th>
                      <th>Nama Pengirim</th>
                      <th>Bank Tujuan</th>
                      <th>Jumlah Uang</th>
                      <th>Tanggal Transfer</th>
                      <th>Bukti Tranfer</th>
                      <th>Status</th>
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


<!--Modal Create Saving Transaction-->
<div class="modal fade" data-backdrop="static" id="modal-create-saving-transaction">
    <div class="modal-dialog">
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
                        <label for="umrah_manifest_id" class="col-sm-3 col-form-label">Program Umrah</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="umrah_manifest_id" id="umrah_manifest_id" style="width:100%;">
                              <option>---Pilih Program Umrah Anda</option>
                            @if(count($umrah_manifest_options))
                              @foreach($umrah_manifest_options as $umrah_manifest_option)
                              <option value="{{$umrah_manifest_option['umrah_manifest_id']}}">{{$umrah_manifest_option['umrah_batch_code']}}</option>
                              @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
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
                            <select class="form-control" name="bank_account_id" id="bank_account_id" style="width:100%;"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Jumlah Uang</label>
                        <div class="col-sm-9">
                            <input type="text" id="amount" class="form-control" name="amount" placeholder="Jumlah uang yang ditransfer">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ENDModal Create Saving Transaction-->


@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        var dT = $('#table-saving-transaction').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('saving-transaction/datatables') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className:'text-center',
                    searchable:false,
                    orderable:false
                },
                {
                    data: 'umrah_manifest.umrah_batch.code_batch',
                    name: 'umrah_manifest.umrah_batch.code_batch',
                    orderable:false,
                    searchable:false,
                },
                {
                    data: 'transaction_source',
                    name: 'transaction_source'
                },
                {
                    data: 'sender_name',
                    name: 'sender_name'
                },
                {
                    data: 'bank_account.name',
                    name: 'bank_account.name'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    render:function(data, type, row, meta){
                        return accounting.formatNumber(data,{
                            precision: 2,
                            thousand: ".",
                            decimal : ","
                        });
                    }
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date'
                },
                {
                    data: 'transaction_receipt',
                    name: 'transaction_receipt',
                    searchable:false,
                    orderable:false,
                    render:function(data, type, row, meta){
                      let img_source = "{{ asset(get_public_path().'/transaction-receipt') }}/"+data;
                      let transaction_receipt='';
                          transaction_receipt+='<img class="profile-user-img img-fluid" src="'+img_source+'">';
                      return transaction_receipt;
                    }
                },
                {
                    data: 'is_confirmed',
                    name: 'is_confirmed',
                    render:function(data, type, row, meta){
                        let is_confirmed='';
                        if(data == true){
                            is_confirmed = '<i class="fas fa-checked" title="Sudah Diverifikasi"></i>';
                        }else{
                            is_confirmed='<i class="fas fa-exclamation-circle" title="Proses Verifikasi"></i>';
                        }
                        return is_confirmed;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render:function(data, type, row, meta){
                        let action ='';
                            action+='</a>';
                        return action;
                    }
                },
            ],
            order: [
                [ 6, "desc" ],
            ],
        });


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

        //Autonumeric amount
        new AutoNumeric('#amount',{
            digitGroupSeparator:'.',
            decimalCharacter:',',
            decimalPlaces:'0',
            minimumValue:0,
            modifyValueOnWheel:false,
            watchExternalChanges:true,
        });

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
                        stack:false,
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
