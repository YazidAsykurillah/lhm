@extends('adminlte::page')

@section('title', 'Payment Note :: Index')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Payment Note</h1>
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
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payment Note List</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
        </div>
    </div>
    <div class="card-body">
        
        <table class="table table-bordered nowrap" id="table-payment-note" style="width:100%">
            <thead>
                <tr>
                    <th style="width:5%;">No</th>
                    <th style="width: 20%;">Streamer</th>
                    <th style="width: 10%;">Start Date</th>
                    <th style="width: 10%;">End Date</th>
                    <th style="width: 15%;">Amount</th>
                    <th style="">Description</th>
                    <th style="width:10%;">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
    </div>
    <div class="card-footer clearfix" style="display: block;">
        <a href="{{ url('payment-note/create') }}" class="btn btn-sm btn-primary" title="Create new Payment Note">
            Add New
        </a>
    </div>
</div>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        var liveStreamActivityDT = $('#table-payment-note').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('payment-note-datatables') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className:'text-center', searchable:false, orderable:false},
                {
                    data: 'user',
                    name: 'user.name',
                    render:function(data, type, row, meta){
                        let streamer_template='';
                            streamer_template+=data.name;
                        return streamer_template;
                    }
                    
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                    render:function(data, type, row, meta){
                        let start_date_template='';
                            start_date_template+=data;
                        return start_date_template;
                    }
                    
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    render:function(data, type, row, meta){
                        let end_date_template='';
                            end_date_template+=data;
                        return end_date_template;
                    }
                    
                },
                {
                    data: 'amount',
                    name: 'amount',
                    render:function(data, type, row, meta){
                        let amount_template='';
                            amount_template+=data;
                        return amount_template;
                    }
                    
                },
                {
                    data: 'title',
                    name: 'title',
                    render:function(data, type, row, meta){
                        let title_template='';
                            title_template+=data;
                        return title_template;
                    }
                    
                },
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center', render:function(data, type, row, meta){
                    let action ='';
                        action+='<a href="/payment-note/'+row.id+'" class="btn btn-xs btn-default" title="Detail">';
                        action+=    '<i class="fa fa-eye"></i>';
                        action+='</a>';
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
