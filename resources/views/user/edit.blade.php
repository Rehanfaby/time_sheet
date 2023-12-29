@extends('layout.main') @section('content')

    @if(session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
    @endif
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{trans('file.Update User')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            {!! Form::open(['route' => ['user.update', $lims_user_data->id], 'method' => 'put', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control" value="{{$lims_user_data->name}}">
                                        @if($errors->has('name'))
                                            <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Change Password')}}</strong> </label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control">
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control" value="{{$lims_user_data->email}}">
                                        @if($errors->has('email'))
                                            <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" name="phone" required class="form-control" value="{{$lims_user_data->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Projects')}} *</strong></label>
                                        <select name="project_id[]" class="selectpicker form-control" data-live-search="true"   title="Select Project..." multiple>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}" {{ in_array($project->id, $user_projects) ? 'selected' : '' }}>{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Region')}} *</strong></label>
                                        <select name="region_id" class="selectpicker form-control" data-live-search="true"   title="Select Region...">
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}" {{ $lims_user_data->region_id == $region->id ? 'selected' : '' }}>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        @if($lims_user_data->is_active)
                                            <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        @else
                                            <input class="mt-2" type="checkbox" name="is_active" value="1">
                                        @endif
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control" value="{{$lims_user_data->company_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <input type="hidden" name="role_id_hidden" value="{{$lims_user_data->role_id}}">
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true"   title="Select Role...">
                                            @foreach($lims_role_list as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group superviser">
                                        <label><strong>superviser Name</strong></label>
                                        <select name="superviser_id" class="selectpicker form-control" data-live-search="true"   title="Select superviser...">
                                            @foreach($supervisers as $superviser)
                                                <option value="{{$superviser->id}}" {{ $superviser->id == $lims_user_data->superviser_id ? 'selected' : '' }}>{{$superviser->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="sign">
                                        <label><strong>{{trans('file.Sign')}} </strong></label>
                                        <input type="file" class="form-control" name="sign">
                                        @if($lims_user_data->sign)
                                            <img src="{{url('public/images/user',$lims_user_data->sign)}}" height="50vw">
                                        @else
                                            <span>No sign found</span>
                                        @endif
                                    </div>
                                    <div class="form-group" id="stemp">
                                        <label><strong>{{trans('file.Stemp')}} </strong></label>
                                        <input type="file" class="form-control" name="stemp">
                                        @if($lims_user_data->stemp)
                                            <img src="{{url('public/images/user',$lims_user_data->stemp)}}" height="50vw">
                                        @else
                                            <span>No Comment found</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Working Days *</strong></label>
                                                <select name="weak_start[]" class="selectpicker form-control" data-live-search="true" title="Select Working Days..." multiple>
                                                    @foreach($weak_days as $day)
                                                        <option value="{{$day}}" {{ in_array($day, $working_days) ? 'selected' : '' }}>{{$day}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label><strong>{{trans('file.End Weak')}} *</strong></label>--}}
{{--                                                <select name="weak_end" class="selectpicker form-control" data-live-search="true"   title="Select Weak End...">--}}
{{--                                                    @foreach($weak_days as $day)--}}
{{--                                                        <option value="{{$day}}" {{ $lims_user_data->weak_end == $day ? 'selected' : '' }}>{{$day}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
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
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");



    $('select[name=role_id]').val($("input[name='role_id_hidden']").val());
    if($('select[name=role_id]').val() != 2){
        $('.superviser').hide(300);
    }
    $('.selectpicker').selectpicker('refresh');


    $('select[name="role_id"]').on('change', function() {
        if($(this).val() == 2) {
            $('.superviser').show(300);
        }
        else {
            $('.superviser').hide(300);
        }
    });

    $('#genbutton').on("click", function(){
      $.get('../genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

</script>
@endsection
