
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
      <div class="card table-responsive">
          <div class="card-header">
              <h3 class="card-title">Program Umrah Anda</h3>
              <div class="card-tools">
                  <!-- <button type="button" class="btn btn-xs btn-primary" title="Daftar Program Umrah">
                    <i class="fas fa-search"></i> Daftar Program Umrah
                  </button> -->
              </div>
          </div>
          <div class="card-body">
              <table class="table table-bordered" id="table-umrah-manifest">
                  <thead>
                      <tr>
                          <th style="width:5%;">No</th>
                          <th style="width:15%;">Kode Program</th>
                          <th style="width:15%;">Tgl Berangkat</th>
                          <th style="width:15%;">Tgl Kembali</th>
                          <th style="width:15%">Pendaftar</th>
                          <th style="">Daftar Peserta</th>
                          <th style="width:10%;">Action</th>
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


@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        var dT = $('#table-umrah-manifest').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('umrah-manifest/datatables') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className:'text-center',
                    searchable:false,
                    orderable:false
                },
                {
                    data: 'umrah_batch.code_batch',
                    name: 'umrah_batch.code_batch',
                    render:function(data, type, row, meta){
                      let umrah_batch='';
                          umrah_batch+=data;
                      return umrah_batch
                    }
                },
                {
                    data: 'umrah_batch.departure_schedule',
                    name: 'umrah_batch.departure_schedule'
                },
                {
                    data: 'umrah_batch.return_schedule',
                    name: 'umrah_batch.return_schedule'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'participants',
                    name: 'participants.name',
                    orderable:false,
                    render:function(data, type, row, meta){
                      let participant_lists=''
                      if(row.participants.length >0){
                        $.each( row.participants, function( key, value ){
                            participant_lists+='<span class="badge bg-info">';
                            participant_lists+=    value.name;
                            participant_lists+='</span>&nbsp;';
                        });
                      }
                      return participant_lists;
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
                            action+='<a class="btn btn-default btn-xs btn-edit" title="Lihat" href="/umrah-manifest/'+row.id+'/">';
                            action+=    '<i class="fas fa-eye"></i>';
                            action+='</a>';
                        return action;
                    }
                },
            ],
            order: [
                [ 1, "desc" ],
            ],
        });
    });
</script>
@endsection
