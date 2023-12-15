@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('mission.index')}}" class="btn btn-info"><i class="dripicons-list"></i> {{trans('file.Mission Order List')}} </a>
                <div class="card" style="padding: 0 200px">
                    <div class="card-header align-items-center">
                        <center><h1>{{trans('file.Mission Order')}}</h1></center>
                    </div>
                    <div class="card-body">
                        <h2>Mission Order No: {{ $data->id }}</h2>
                        <div class=" align-items-center">
                            <center><h1>Staff Travelling</h1></center>
                        </div>
                        @php
                            $travelers = explode(",", $data->traveler)
                        @endphp
                        <ol>
                        @foreach($travelers as $key=>$traveler)
                            <li><h4>{{ \App\User::where('id', $traveler)->first()->name }}</h4></li>
                        @endforeach
                        </ol>
                        <div class="row pt-4" >
                            <div class="col-md-3"><h3>Going To : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">dkhkj</div>

                            <div class="col-md-3"><h3>Perpose Of : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">dkhkj</div>

                            <div class="col-md-3"><h3>Means Of Transport : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">{{ $data->method }}</div>

                            <div class="col-md-3"><h3>Date Of Return : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">{{ $data->return }}</div>

                            <div class="col-md-3"><h3>Deliverd By : </h3></div>
                            <div class="col-md-9" style="text-decoration: underline; display: block">{{ @$data->user->name }}</div>

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
                            <div class="col-md-4 pt-4" style="margin-bottom: 100px">
                                <h3></h3>
                                <h3></h3>
                                <h3></h3>
                                <h3 class="pt-5 mt-5">Signature & Stamp : <span>___________</span></h3>
                            </div>
                            __________________________________________________________________________________________________________________________________________________

                        </div>
                        <div class="row pt-4">
                            @if($data->approve_by != null)
                                <div class="col-md-3"><h3>Approve By : </h3></div>
                                <div class="col-md-9" style="text-decoration: underline; display: block">{{ @$data->approver->name }}</div>
                            @endif
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
</script>
@endsection
