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
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Generate Time Sheet</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'timesheet.generate', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="date">Users <strong>*</strong></label>
                                <select name="users[]" required class="selectpicker form-control to-user" data-select="false" data-live-search="true" multiple>
                                    <option value="">-- Select All --</option>
                                    @foreach($users as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                            <label class="">{{trans('file.Date Range')}} <strong> *</strong> &nbsp;</label>
                                <div class="input-group">
                                    <input type="text" class="daterangepicker-field form-control" value="{{@$start_date}} To {{@$end_date}}" required readonly />
                                    <input type="hidden" name="start_date" value="{{@$start_date}}" />
                                    <input type="hidden" name="end_date" value="{{@$end_date}}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="date">Staff</label>
                                <select name="staffs[]" class="selectpicker form-control to-user" data-select="false" data-live-search="true" multiple>
                                    <option value="">-- Select All --</option>
                                    @foreach($staff as $u)
                                        <option value="{{$u->id}}">{{$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date">Select Report Type</label>
                                <select name="report_type" class="selectpicker form-control" data-select="false" data-live-search="true">
                                    <option value="0">Time Sheet Report</option>
                                    <option value="1" selected>Over Time Report</option>
                                    <option value="2">Both Reports</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date">Description</label>
                                <textarea name="description" class="form-control" placeholder="description"></textarea>
                            </div>
                            <div class="col-md-4 mt-4">
                                <input type="submit" value="Generate" class="btn btn-success">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $("ul#overtime").siblings('a').attr('aria-expanded','true');
    $("ul#overtime").addClass("show");
    $("ul#overtime #overtime-menu-generate").addClass("active");


    $(".daterangepicker-field").daterangepicker({
        callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('input[name="start_date"]').val(start_date);
            $('input[name="end_date"]').val(end_date);
        }
    });

    $("select").on("change", function(){
        if ($(this).find(":selected").val() == "") {
            if ($(this).attr("data-select") == "false") {
                $(this).selectpicker('selectAll');
                var firstOption = $(this).find('option:first');
                firstOption.prop('selected', false);
                $(this).selectpicker('refresh');
                $(this).attr("data-select", "true");
            } else {
                $(this).selectpicker('deselectAll');
                $(this).attr("data-select", "false");
            }
        }
    });
</script>
@endsection
