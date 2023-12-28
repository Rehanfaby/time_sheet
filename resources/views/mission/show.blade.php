@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('mission.index')}}" class="btn btn-info"><i class="dripicons-list"></i> {{trans('file.Mission Order List')}} </a>
{{--                <a target="__blank" href="{{route('mission.print', ['id' => $data->id])}}" class="btn btn-warning"><i class="dripicons-print"></i> {{trans('file.Print')}} </a>--}}

                <a id="print-btn" class="btn btn-warning"><i class="dripicons-print"></i> {{trans('file.Print')}} </a>
                @php
                    $traveler_no = 1;
                    $travelers = explode(",", $data->traveler);
                    $d1 = new DateTime($data->to);
                    $d2 = new DateTime($data->from);
                    $interval = $d1->diff($d2);
                @endphp
                <div class="card" style="padding: 0 200px" id="mission-show">

                        <center><h1>{{trans('file.Mission Order')}}</h1></center>
                        <h2>Mission Order No: {{ $data->id }}</h2>
                        <center><h1>Staff Travelling</h1></center>
                    <table class="table">
                        @foreach($travelers as $key=>$traveler)
                            <tr>
                                <td><h4> {{ $traveler_no }}: {{ \App\User::where('id', $traveler)->first()->name }}</h4></td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="card-body">
                        <div class="row pt-4" >
                            <div class="col-md-3"><h3>Going To : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">{{ $data->going_to }}</h6></div>

                            <div class="col-md-3"><h3>Purpose Of : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->purpose }}</h6></div>

                            <div class="col-md-3"><h3>Means Of Transport : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->method }}</h6></div>

                            <div class="col-md-3"><h3>Date Of Return : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ $data->return }}</h6></div>

                            <div class="col-md-3"><h3>Deliverd By : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block"><h6>{{ @$data->user->name }}</h6></div>

                            <div class="col-md-4 pt-4">
                                <h3>From : <span>_____________</span></h3>
                                <h3>Date : <span style="text-decoration: underline">{{ date('d-M-Y', strtotime($data->from)) }}</span></h3>
                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->from)) }}</span></h3>
                                <h3 class="pt-4">Signature : <span>___________</span></h3>
                            </div>
                            <div class="col-md-4 pt-4">
                                <h3>To : <span>_____________</span></h3>
                                <h3>Date : <span style="text-decoration: underline">{{ date('d-M-Y', strtotime($data->to)) }}</span></h3>
                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->to)) }}</span></h3>
                                <h3 class="pt-4">Signature : <span>___________</span></h3>
                            </div>
                            <div class="col-md-4 pt-4">
                                <h3>|</h3>
                                <h3>|</h3>
                                <h3>|</h3>
                                <h3 class="pt-4">Signature & Stamp</h3>
                            </div>
                            __________________________________________________________________________________________________________________________________________________
                            <div class="col-md-12 pt-4"><h3 class = "text-center" style="text-decoration: underline">END OF TRIP</h3></div>
                            <div class="col-md-12">
                                {!! $data->description !!}
                            </div>
                        </div>
                        <div class="row pt-4">
                                <div class="col-md-12">
                                    @if($data->status == 1)
                                        <h3>
                                            Approve By : {{ $data->approve_by != null ? @$data->approver->name : 'NAN' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                            on the {{ $data->approve_on }}
                                        </h3>
                                    @endif

                                    @if($data->status == 2)
                                        <h3>
                                            Reject By : {{ $data->approve_by != null ? @$data->approver->name : 'NAN' }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                            on the {{ $data->approve_on }}
                                        </h3>
                                    @endif

                                    <h3>Function: _________________</h3>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#missions").siblings('a').attr('aria-expanded','true');
    $("ul#missions").addClass("show");
    $("ul#missions #missions-menu").addClass("active");

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
