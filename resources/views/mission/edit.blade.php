@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('mission.index')}}" class="btn btn-info"><i class="dripicons-list"></i> {{trans('file.Mission Order List')}} </a>
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Edit Mission Order')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['mission.update', $data->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Title')}} *</strong> </label>
                                    <input type="text" name="title" required class="form-control" placeholder="Title" value="{{ $data->title }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Means of Transportation')}} *</strong> </label>
                                    <select name="method" class="form-control selectpicker" data-live-search="true" >
                                        <option value="Private" {{ $data->method == "Private" ? "selected" : "" }}>Private</option>
                                        <option value="Official" {{ $data->method == "Official" ? "selected" : "" }}>Official</option>
                                        <option value="Personal" {{ $data->method == "Personal" ? "selected" : "" }}>Personal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>{{trans('file.Travelers')}} *</strong></label>
                                    <select name="traveler[]" class="selectpicker form-control" data-live-search="true"   title="Select Traveler..." multiple>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ in_array($user->id, explode(",", $data->traveler)) ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.From')}} *</strong> </label>
                                    <input type="datetime-local" name="from" required class="form-control" value="{{ $data->from }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.To')}} *</strong> </label>
                                    <input type="datetime-local" name="to" required class="form-control" value="{{ $data->to }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Return')}} *</strong> </label>
                                    <input type="datetime-local" name="return" required class="form-control" value="{{ $data->return }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{trans('file.Description')}} </label>
                                    <textarea class="form-control" name="description"  placeholder="Description" id="description">{{ $data->description }}</textarea>
                                </div>
                            </div>

{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{trans('file.Status')}} *</strong> </label>--}}
{{--                                    <select name="status" class="form-control selectpicker" data-live-search="true" >--}}
{{--                                        <option value="0" {{ $data->status == "0" ? "selected" : "" }}>Pending</option>--}}
{{--                                        <option value="1" {{ $data->status == "1" ? "selected" : "" }}>Approve</option>--}}
{{--                                        <option value="2" {{ $data->status == "2" ? "selected" : "" }}>Rejected</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <input type="hidden" name="is_approve" value="0">
                            <input type="hidden" name="created_by" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
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
    $("ul#missions").siblings('a').attr('aria-expanded','true');
    $("ul#missions").addClass("show");
    $("ul#missions #missions-menu").addClass("active");

    tinymce.init({
        selector: '#description',
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        branding:false
    });
</script>
@endsection
