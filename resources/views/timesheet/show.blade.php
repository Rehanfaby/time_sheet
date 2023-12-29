@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('timesheet.report')}}" class="btn btn-info"><i class="dripicons-list"></i> Time Sheer Report </a>
                <a id="print-btn" class="btn btn-warning"><i class="dripicons-print"></i> {{trans('file.Print')}} </a>
                <div class="card" style="padding: 0 200px" id="mission-show">
                    <center><h1>{{trans('file.Time Sheet Report')}}</h1></center>
                    <h2>Time Sheet Report No: {{ $data->id }}</h2>
                    <div class="card-body">
                        <div class="row pt-4" >
                            <div class="col-md-3"><h3>Name : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->user->name }}</h6></div>

                            <div class="col-md-3"><h3>Expected Hours : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->expected_hours }} hours</h6></div>

                            <div class="col-md-3"><h3>Total Hours : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->total_hours }} hours</h6></div>

                            <div class="col-md-3"><h3>Over Time : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->over_time }} hours</h6></div>

                            <div class="col-md-3"><h3>Deliverd By : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ @$data->user->name }}</h6></div>

                            <div class="col-md-4 pt-4">
                                <h3>From : <span>_____________</span></h3>
                                <h3>Date : <span style="text-decoration: underline">{{ date('d-M-Y', strtotime($data->from)) }}</span></h3>
                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->from)) }}</span></h3>
                                <h3 class="pt-4">Signer : <span>
                                            @if($data->is_sign == 1)
                                                @php
                                                    $approve = \App\User::find($data->signed_by);
                                                @endphp
                                                <img class="approve" src="{{url('public/images/user',$approve->sign)}}" height="50vw">
                                            @endif
                                    </span></h3>
                            </div>
                            <div class="col-md-4 pt-4">
                                <h3>To : <span>_____________</span></h3>
                                <h3>Date : <span style="text-decoration: underline">{{ date('d-M-Y', strtotime($data->to)) }}</span></h3>
                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->to)) }}</span></h3>
                                <h3 class="pt-4">Approve : <span>
                                        @if($data->is_approve == 1)
                                            @php
                                                $approve = \App\User::find($data->approved_by);
                                            @endphp
                                            <img class="approve" src="{{url('public/images/user',$approve->stemp)}}" height="50vw">
                                        @endif
                                    </span></h3>
                            </div>
                            <div class="col-md-4 pt-4">
                                <h3>|</h3>
                                <h3>|</h3>
                                <h3>|</h3>
                                <h3 class="pt-4">Signature & Stamp</h3>
                            </div>
                            __________________________________________________________________________________________________________________________________________________
                            <div class="col-md-12 pt-4"><h3 class = "text-center" style="text-decoration: underline">Description</h3></div>
                            <div class="col-md-12">
                                {{$data->description}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#timeSheet").siblings('a').attr('aria-expanded','true');
    $("ul#timeSheet").addClass("show");
    $("ul#timeSheet #timeSheet-menu-report").addClass("active");

    $("#print-btn").on("click", function(){
        var divToPrint=document.getElementById('mission-show');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css"><style type="text/css">@media print {.modal-dialog { min-width: 1800px;} }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},30);
    });
</script>
@endsection
