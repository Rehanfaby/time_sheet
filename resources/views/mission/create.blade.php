@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(in_array("mission-order-index", $all_permission))
                <a href="{{route('mission.index')}}" class="btn btn-info"><i class="dripicons-list"></i> {{trans('file.Mission Order List')}} </a>
                @endif
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Mission Order Create')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'mission.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Title')}} <strong>*</strong> </label>
                                    <input type="text" name="title" required class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Going To <strong> *</strong> </label>
                                    <input type="text" name="going_to" required class="form-control" placeholder="going to">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purpose <strong> *</strong> </label>
                                    <input type="text" name="purpose" required class="form-control" placeholder="Purpose">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Means of Transportation')}} *</strong> </label>
                                    <select name="method" class="form-control selectpicker" data-live-search="true" >
                                        <option value="Private">Private</option>
                                        <option value="Official">Official</option>
                                        <option value="Personal">Personal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong>{{trans('file.Travelers')}}</strong></label>
                                    <select name="traveler[]" class="selectpicker form-control" data-live-search="true"   title="Select Project..." multiple>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.From')}} *</strong> </label>
                                    <input type="datetime-local" name="from" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.To')}} *</strong> </label>
                                    <input type="datetime-local" name="to" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Return')}} *</strong> </label>
                                    <input type="datetime-local" name="return" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>End Of Trip Description</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Description">
                                        <ol>
                                            <li>
                                            <h3><strong>Number of days spent out :</strong>&nbsp;&nbsp;<u>______________</u></h3>
                                            </li>
                                            <li>
                                            <h3><strong>Total Advance for Trip:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u>______________</u></h3>
                                            </li>
                                            <li>
                                            <h3>Spent on Food:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u>______________</u></h3>
                                            </li>
                                            <li>
                                            <h3>Spent on Transport:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<u>______________</u></h3>
                                            </li>
                                            <li>
                                            <h3>Others: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<u>______________</u></h3>
                                            </li>
                                            <li>
                                            <h3>Total Expense:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<u>_____________</u></h3>
                                            </li>
                                            <li>
                                            <h3><strong>Balance due/owing:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong><u>______________</u></h3>
                                            </li>
                                        </ol>
                                    </textarea>
                                </div>
                            </div>
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="is_approve" value="0">
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
    $("ul#missions #missions-create").addClass("active");


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
