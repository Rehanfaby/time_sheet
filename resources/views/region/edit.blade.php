@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('region.index')}}" class="btn btn-info"><i class="dripicons-list"></i> {{trans('file.Region List')}} </a>
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Edit Region')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => ['region.update', $data->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="name" required class="form-control" value="{{ $data->name }}">
                                </div>
                            </div>
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
    $("ul#regions").siblings('a').attr('aria-expanded','true');
    $("ul#regions").addClass("show");
    $("ul#regions #regions-menu").addClass("active");
</script>
@endsection
