@extends('layout.main') @section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mt-2">
                <h3 class="text-center">Work Sheet</h3>
            </div>
            {!! Form::open(['route' => 'timesheet.report', 'method' => 'get']) !!}
            <div class="row mb-3">
                <div class="col-md-4 offset-md-2 mt-3">
                    <div class="form-group row">
                        <label class="d-tc mt-2"><strong>{{trans('file.Choose Your Date')}}</strong> &nbsp;</label>
                        <div class="d-tc">
                            <div class="input-group">
                                <input type="text" class="daterangepicker-field form-control" value="{{$start_date}} To {{$end_date}}" required />
                                <input type="hidden" name="start_date" value="{{$start_date}}" />
                                <input type="hidden" name="end_date" value="{{$end_date}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{trans('file.submit')}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="table-responsive">
        <table id="employee-table" class="table">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.name')}}</th>
                    <th>Expected Hours</th>
                    <th>Total Hours</th>
                    <th>Over Time</th>
                    <th>Is Sign</th>
                    <th>Is Approve</th>
                    <th>Created At</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $key=>$report)
                <tr data-id="{{$report->id}}" class="clickable-row" style="cursor: pointer" data-href="{{ route('timesheet.show', $report->id) }}">
                    <td>{{$key}}</td>
                    <td>{{ $report->name}}</td>
                    <td>{{ $report->expected_hours}}</td>
                    <td>{{ $report->total_hours}}</td>
                    <td>{{ $report->over_time}}</td>
                    <td><span class="badge badge-{{ $report->is_sign == 0 ? 'warning' : 'success'}}">{{ $report->is_sign == 0 ? 'Pending' : 'Signed'}}</span></td>
                    <td><span class="badge badge-{{ $report->is_approve == 0 ? 'warning' : 'success'}}">{{ $report->is_approve == 0 ? 'Pending' : 'Approved'}}</span></td>
                    <td>{{ $report->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                @if($report->is_sign == 0)
                                    @if(in_array("timesheet_sign", $all_permission))
                                        <li><a href="{{ route('timesheet.sign', $report->id) }}" class="btn btn-link" onclick="return confirmSign()"><i class="dripicons-pencil"></i> Sign</a></li>
                                    @endif
                                @endif
                                @if($report->is_approve == 0)
                                    @if(in_array("timesheet_approve", $all_permission))
                                        <li><a href="{{ route('timesheet.approve', $report->id) }}" class="btn btn-link" onclick="return confirmApprove()"><i class="dripicons-checkmark"></i>Approve</a></li>
                                    @endif
                                @endif
                                @if(in_array("timesheet_delete", $all_permission))
                                {{ Form::open(['route' => ['timesheet.destroy', $report->id], 'method' => 'DELETE'] ) }}
                                <li>
                                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                                </li>
                                {{ Form::close() }}
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">

    $("ul#timeSheet").siblings('a').attr('aria-expanded','true');
    $("ul#timeSheet").addClass("show");
    $("ul#timeSheet #timeSheet-menu-report").addClass("active");

    $(document).ready(function($) {
        $('.clickable-row td:not(:first-child):not(:last-child)').click(function () {
            window.location = $(this).closest('tr').data("href");
        });
    });

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

    var employee_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }

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

    $('#employee-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0, 1, 5]
            },
            {
                'render': function(data, type, row, meta){
                    if(type === 'display'){
                        data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                    }

                   return data;
                },
                'checkboxes': {
                   'selectRow': true,
                   'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function(doc) {
                    for (var i = 1; i < doc.content[1].table.body.length; i++) {
                        if (doc.content[1].table.body[i][0].text.indexOf('<img src=') !== -1) {
                            var imagehtml = doc.content[1].table.body[i][0].text;
                            var regex = /<img.*?src=['"](.*?)['"]/;
                            var src = regex.exec(imagehtml)[1];
                            var tempImage = new Image();
                            tempImage.src = src;
                            var canvas = document.createElement("canvas");
                            canvas.width = tempImage.width;
                            canvas.height = tempImage.height;
                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(tempImage, 0, 0);
                            var imagedata = canvas.toDataURL("image/png");
                            delete doc.content[1].table.body[i][0].text;
                            doc.content[1].table.body[i][0].image = imagedata;
                            doc.content[1].table.body[i][0].fit = [30, 30];
                        }
                    }
                },
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    format: {
                        body: function ( data, row, column, node ) {
                            if (column === 0 && (data.indexOf('<img src=') != -1)) {
                                var regex = /<img.*?src=['"](.*?)['"]/;
                                data = regex.exec(data)[1];
                            }
                            return data;
                        }
                    }
                },
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
            },
            {
                text: '<i title="Approve" class="fa fa-check"></i>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    employee_id.length = 0;
                    $(':checkbox:checked').each(function(i){
                        if(i){
                            employee_id[i-1] = $(this).closest('tr').data('id');
                        }
                    });
                    if(employee_id.length && confirm("Are you sure want to Approve?")) {
                        $.ajax({
                            type:'POST',
                            url:'/timesheet/report/approve',
                            data:{
                                employeeIdArray: employee_id
                            },
                            success:function(data){
                                alert(data);
                                location.reload()
                            }
                        });
                    } else {
                        alert('No Data is selected!');
                    }
                }
            },
            {
                text: '<i title="Sign" class="fa fa-pencil"></i>',

                action: function ( e, dt, node, config ) {
                    employee_id.length = 0;
                    $(':checkbox:checked').each(function(i){
                        if(i){
                            employee_id[i-1] = $(this).closest('tr').data('id');
                        }
                    });
                    if(employee_id.length && confirm("Are you sure want to Sign?")) {
                        $.ajax({
                            type:'POST',
                            url:'/timesheet/report/sign',
                            data:{
                                employeeIdArray: employee_id
                            },
                            success:function(data){
                                alert(data);
                                location.reload()
                            }
                        });
                    } else {
                        alert('No Data is selected!');
                    }
                }
            },
            {
                text: '<i title="Sign" class="dripicons-cross"></i>',
                className: 'buttons-delete',
                action: function ( e, dt, node, config ) {
                    employee_id.length = 0;
                    $(':checkbox:checked').each(function(i){
                        if(i){
                            employee_id[i-1] = $(this).closest('tr').data('id');
                        }
                    });
                    if(employee_id.length && confirm("Are you sure want to Delete?")) {
                        $.ajax({
                            type:'POST',
                            url:'/timesheet/report/remove',
                            data:{
                                employeeIdArray: employee_id
                            },
                            success:function(data){
                                alert(data);
                                location.reload()
                            }
                        });
                    } else {
                        alert('No Data is selected!');
                    }
                }
            },
            {
                extend: 'colvis',
                text: '<i title="column visibility" class="fa fa-eye"></i>',
                columns: ':gt(0)'
            },
        ],
    } );
</script>
@endsection
