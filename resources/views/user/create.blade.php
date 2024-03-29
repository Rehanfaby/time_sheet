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
                        <h4>{{trans('file.Add User')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.UserName')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control">
                                        @if($errors->has('name'))
                                       <span>
                                           <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Password')}} *</strong> </label>
                                        <div class="input-group">
                                            <input type="password" name="password" required class="form-control">
                                            <div class="input-group-append">
                                                <button id="genbutton" type="button" class="btn btn-default">{{trans('file.Generate')}}</button>
                                            </div>
                                            @if($errors->has('password'))
                                            <span>
                                               <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Email')}} *</strong></label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control">
                                        @if($errors->has('email'))
                                       <span>
                                           <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Phone Number')}} *</strong></label>
                                        <input type="text" name="phone_number" required class="form-control">
                                        @if($errors->has('phone_number'))
                                            <span>
                                               <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="customer-section">
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Address')}} *</strong></label>
                                            <input type="text" name="address" class="form-control customer-input">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.State')}}</strong></label>
                                            <input type="text" name="state" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>{{trans('file.Country')}}</strong></label>
                                            <input type="text" name="country" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Company Name')}}</strong></label>
                                        <input type="text" name="company_name" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><strong>Working Days *</strong></label>
                                                <select name="weak_start[]" class="selectpicker form-control" data-live-search="true" title="Select Working Days..." multiple>
                                                    @foreach($weak_days as $day)
                                                        <option value="{{$day}}">{{$day}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label><strong>{{trans('file.End Weak')}} *</strong></label>--}}
{{--                                                <select name="weak_end" class="selectpicker form-control" data-live-search="true"   title="Select Weak End...">--}}
{{--                                                    @foreach($weak_days as $day)--}}
{{--                                                        <option value="{{$day}}">{{$day}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="form-group">
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" checked>
                                        <label class="mt-2"><strong>{{trans('file.Active')}}</strong></label>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Role')}} *</strong></label>
                                        <select name="role_id" required class="selectpicker form-control" data-live-search="true"   title="Select Role...">
                                            @foreach($lims_role_list as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{trans('file.Projects')}}</strong></label>
                                        <select name="project_id[]" class="selectpicker form-control" data-live-search="true"   title="Select Project..." multiple>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}" >{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{trans('file.Region')}}</strong></label>
                                        <select name="region_id" class="selectpicker form-control" data-live-search="true"   title="Select Region...">
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}" >{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group superviser">
                                        <label><strong>superviser Name</strong></label>
                                        <select name="superviser_id" class="selectpicker form-control" data-live-search="true"   title="Select superviser...">
                                            @foreach($supervisers as $superviser)
                                                <option value="{{$superviser->id}}" >{{$superviser->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="sign">
                                        <label><strong>{{trans('file.Sign')}} *</strong></label>
                                        <input type="file" class="form-control" name="sign">
                                    </div>
                                    <div class="form-group" id="stemp">
                                        <label><strong>{{trans('file.Stemp')}} *</strong></label>
                                        <input type="file" class="form-control" name="stemp">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #user-create-menu").addClass("active");

    $('.superviser').hide();
    $('.customer-section').hide();

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });

    $('#genbutton').on("click", function(){
      $.get('genpass', function(data){
        $("input[name='password']").val(data);
      });
    });

    $('select[name="role_id"]').on('change', function() {
        if($(this).val() == 2) {
            $('.superviser').show(300);
        }
        else {
            $('.superviser').hide(300);
        }
    });
</script>
@endsection
