@extends('layout.main') @section('content')

@if($errors->has('name'))
<div class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ $errors->first('name') }}</div>
@endif
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<section>
    <div class="container-fluid">
        @if(in_array("mission-order-add", $all_permission))
            <a href="{{route('mission.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{trans('file.Mission Order Create')}} </a>
        @endif
    </div>
    <div class="table-responsive">
        <table id="role-table" class="table">
            <thead>
            <tr>
                <th class="not-exported"></th>
                <th>{{trans('file.Title')}}</th>
                <th>{{trans('file.Means of Transportation')}}</th>
                <th>{{trans('file.From')}}</th>
                <th>{{trans('file.To')}}</th>
                <th>{{trans('file.Status')}}</th>
                <th>{{trans('file.Created By')}}</th>
                <th>{{trans('file.Date')}}</th>
                <th class="not-exported">{{trans('file.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key=>$item)
                <tr data-id="{{$item->id}}" class="clickable-row" style="cursor: pointer" data-href="{{ route('mission.show', $item->id) }}">
                    <td>{{$key}}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->from }}</td>
                    <td>{{ $item->to }}</td>
                    @if($item->status == 0)
                        <td><span class="badge badge-warning">Pending</span></td>
                    @elseif($item->status == 1)
                        <td><span class="badge badge-success">Approved</span></td>
                    @else
                        <td><span class="badge badge-danger">Rejected</span></td>
                    @endif
                    <td>{{ @$item->user->name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default">
                                <li>
                                    <a href="{{ route('mission.show', $item->id) }}" class="btn btn-link"><i class="fa fa-eye"></i> {{trans('file.View')}}</a>
                                </li>
                                @if(in_array("mission-order-edit", $all_permission))
                                <li>
                                    <a href="{{ route('mission.edit', $item->id) }}" class="btn btn-link"><i class="dripicons-document-edit"></i> {{trans('file.edit')}}</a>
                                </li>
                                @endif
                                @if(in_array("mission-order-approve", $all_permission))
                                    <li>
                                        <a onclick="return confirmApprove(1)" href="{{ route('mission.approve', ['id' => $item->id, 'status' => 1]) }}" class="btn btn-link"><i class="dripicons-checkmark"></i> Approve</a>
                                    </li>
                                    <li>
                                        <a onclick="return confirmApprove(2)" href="{{ route('mission.approve', ['id' => $item->id, 'status' => 2]) }}" class="btn btn-link"><i class="dripicons-cross"></i> Reject</a>
                                    </li>
                                @endif
                                @if(in_array("mission-order-delete", $all_permission))
                                <li class="divider"></li>

                                    {{ Form::open(['route' => ['mission.destroy', $item->id], 'method' => 'DELETE'] ) }}
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
    $("ul#missions").siblings('a').attr('aria-expanded','true');
    $("ul#missions").addClass("show");
    $("ul#missions #missions-menu").addClass("active");

    $(document).ready(function($) {
        $('.clickable-row td:not(:last-child, :first-child)').click(function () {
            window.location = $(this).closest('tr').data("href");
        });
    });

    function confirmApprove(status) {

        if (status === 1) {
            var msg = "Are you sure want to approve this mission order?";
        } else {
            var msg = "Are you sure want to reject this mission order?";
        }

        if (confirm(msg)) {
            return true;
        }
        return false;
    }

    $(document).ready(function() {

    var employee_id = [];

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#role-table').DataTable( {
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
                'targets': [0, 3]
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
                    rows: ':visible'
                },
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            },
            {
                text: '<i title="Approve" class="fa fa-check"></i>',
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
                            url:'/mission/approve',
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
                            url:'/mission/remove',
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
});
</script>

@endsection
