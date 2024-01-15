@extends('layout.main') @section('content')
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
    @endif
    @if(session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('timesheet.report')}}" class="btn btn-info"><i class="dripicons-list"></i> Time Sheet Report </a>
                <a id="print-btn" class="btn btn-warning"><i class="dripicons-print"></i> {{trans('file.Print')}} </a>

                @if($data->is_approve == 0)
                    @if(in_array("timesheet_approve", $all_permission))
                        <a class="btn btn-success" onclick="return confirmApprove()" href="{{ route('timesheet.approve', $data->id) }}"><i class="dripicons-checkmark"></i> Approve </a>
                    @endif
                @endif
                @if($data->is_sign == 0)
                    @if(in_array("timesheet_sign", $all_permission))
                        <a class="btn btn-info" onclick="return confirmSign()" href="{{ route('timesheet.sign', $data->id) }}"><i class="fa fa-pencil"></i> Sign </a>
                    @endif
                @endif
                <div class="card" style="padding: 0 200px" id="mission-show">
                    <img src="{{url('public/logo', $general_setting->email_header)}}" style=" width: 100%;">
                    <center><h1>{{trans('file.Time Sheet Report')}}</h1></center>
                    <h2>Time Sheet Report No: {{ $data->id }}</h2>
                    <div class="card-body">
                        <div class="row pt-4" >
                            <div class="col-md-6"><h3>Name : </h3></div>
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>{{ $data->user->name }}</h4></div>

                            <div class="col-md-6"><h3>Expected Hours : </h3></div>
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>{{ $data->expected_hours }} hours</h4></div>

                            <div class="col-md-6"><h3>Total Hours : </h3></div>
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>{{ $data->total_hours }} hours</h4></div>

                            <div class="col-md-6"><h3>Over Time : </h3></div>
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>{{ $data->over_time }} hours</h4></div>

                            <div class="col-md-6"><h3>Superviser : </h3></div>
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>{{ @$data->user->superviser->name }}</h4></div>

                            <div class="col-md-6"><h3>Projects : </h3></div>
                            @php $projects_array = explode(',', $data->user->project_id) @endphp
                            <div class="col-md-6" style="text-decoration: underline; display: block"><h4>
                                    @foreach($projects_array as $projects_id)
                                        {{ \App\Project::find($projects_id)->name . ',' }}
                                    @endforeach
                                </h4></div>

                            <div class="col-md-12 pt-4">
                                <h1>Reporting Period <br> -------------------</h1>
                            </div>
                            <div class="col-md-6 pt-4">
                                <h3>From Date</h3>
                                <h4><span style="text-decoration: underline">{{ date('D M d-Y', strtotime($data->from)) }}</span></h4>
{{--                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->from)) }}</span></h3>--}}
                                <h3 class="pt-4">Signer : <span>
                                            @if($data->is_sign == 1)
                                                @php
                                                    $approve = \App\User::find($data->signed_by);
                                                @endphp
                                                <img class="approve" src="{{url('public/images/user',$approve->sign)}}" height="50vw">
                                            @endif
                                    </span></h3>
                            </div>
                            <div class="col-md-6 pt-4">
                                <h3>To Date</h3>
                                <h4><span style="text-decoration: underline">{{ date('D M d-Y', strtotime($data->to)) }}</span></h4>
{{--                                <h3>Time : <span style="text-decoration: underline">{{ date('H:i:s', strtotime($data->to)) }}</span></h3>--}}
                                <h3 class="pt-4">Approve : <span>
                                        @if($data->is_approve == 1)
                                            @php
                                                $approve = \App\User::find($data->approved_by);
                                            @endphp
                                            <img class="approve" src="{{url('public/images/user',$approve->stemp)}}" height="50vw">
                                        @endif
                                    </span></h3>
                            </div>
                            ______________________________________________________________________________________________________________________________________________
                            <div class="col-md-12 pt-4"><h3 class = "text-center" style="text-decoration: underline">Description</h3></div>
                            <div class="col-md-12">
                                {{$data->description}}
                            </div>
                        </div>
                    </div>
                    <img src="{{url('public/logo', $general_setting->email_footer)}}" style=" width: 100%;">
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#timeSheet").siblings('a').attr('aria-expanded','true');
    $("ul#timeSheet").addClass("show");
    $("ul#timeSheet #timeSheet-menu-report").addClass("active");



    function confirmSign() {
        if (confirm("Are you sure want to sign?")) {
            return true;
        }
        return false;
    }

    function confirmApprove() {
        if (confirm("Are you sure want to approve?")) {
            return true;
        }
        return false;
    }

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
