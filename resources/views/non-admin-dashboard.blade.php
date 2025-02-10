
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
                            <th style="width: 15%;">Platform</th>
                            <th style="width: 15%;">Date</th>
                            <th style="width: 15%;">Started Time</th>
                            <th style="width: 15%;">Current Time</th>
                            <th style="">Duration</th>
                            <th style="width:10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>


@section('js')
<script type="text/javascript">
    $(document).ready(function(){

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
                    data: 'current_time',
                    name: 'current_time',
                    searchable:false,
                    orderable:false,
                    render:function(data, type, row, meta){
                        let current_time_template ='';
                            current_time_template+= data;
                        return current_time_template;
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
        

    });
</script>
@endsection
