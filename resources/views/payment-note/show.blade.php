@extends('adminlte::page')

@section('title', 'Payment Note :: '.$payment_note->code.'')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Payment Note Detail</h1>
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
                <li class="breadcrumb-item">
                    <a href="{{url('/payment-note/'.$payment_note->id.'')}}">
                        {{ $payment_note->code }}
                    </a>
                </li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')

<div class="invoice p-3 mb-3">
    
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> PAYMENT NOTE
                <small class="float-right">Date: {{ $payment_note->created_at}}</small>
            </h4>
        </div>
    
    </div>
  
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>{{ env('APP_NAME') }}</strong><br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{ $payment_note->user->name }}</strong><br>
                Phone: {{$payment_note->user->phone_number }}<br>
                Email: {{$payment_note->user->email }}<br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Code: {{ $payment_note->code }}</b><br>
            <br>
        </div>
        <!-- /.col -->
    </div>

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th>Platform</th>
                      <th>Date</th>
                      <th>Total Hour</th>
                      <th style="text-align: right;">Rate Per Hour</th>
                      <th style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($payment_note->live_stream_activities))
                    @foreach($payment_note->live_stream_activities as $live_stream_activity)
                    <tr>
                        <td>
                            {{ $live_stream_activity->platform_account->platform->name}}<br>
                            {{ $live_stream_activity->platform_account->name}}
                        </td>
                        <td>{{ $live_stream_activity->live_stream_date}}</td>
                        <td>{{ $live_stream_activity->live_stream_activity_cost->total_hour }}</td>
                        <td style="text-align:right;">{{ $live_stream_activity->live_stream_activity_cost->streamer_rate }}</td>
                        <td style="text-align:right;">{{ $live_stream_activity->live_stream_activity_cost->total_cost }}</td>
                        
                    </tr>
                    @endforeach
                @endif
                    
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
  

    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    @if(count($payment_note->payment_note_amount_collectors))
                        @foreach($payment_note->payment_note_amount_collectors as $amount_collector)
                        <tr>
                            <td style="text-align: right;"><strong>{{ $amount_collector->name}}</strong></td>
                            <td style="text-align:left;">:</td>
                            <td style="text-align:right;">{{ $amount_collector->value }}</td>
                        </tr>
                        @endforeach
                    @endif
                        <tr>
                            <td style="text-align: right;"><strong>Total</strong></td>
                            <td style="text-align:left;">:</td>
                            <td style="text-align:right;">{{ $payment_note->amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
  

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default float-right">
                <i class="fas fa-print"></i> Print
            </a>
            
        </div>
    </div>
</div>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){


    });

</script>
@endsection
