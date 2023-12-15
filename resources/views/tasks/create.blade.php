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
                        <h4>Fill Time Sheet</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'tasks.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">
                            <div class="col-md-3">
                                <label for="date">Choose Date <strong>*</strong></label>
                                <input id="parent-date" type="date" name="date" class="form-control date" required>
                            </div>
                            <div class="col-md-4">
                            <label class=""><strong>{{trans('file.Clone Time Sheet')}}</strong> &nbsp;</label>
                                <div class="input-group">
                                    <input type="text" class="daterangepicker-field form-control" value="{{@$start_date}} To {{@$end_date}}" required />
                                    <input type="hidden" name="start_date" value="{{@$start_date}}" />
                                    <input type="hidden" name="end_date" value="{{@$end_date}}" />
                                </div>
                            </div>
                            <div class="col-12 form" style="display: none">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Remove</th>
                                        <th>Task</th>
                                        <th>New Task</th>
                                        <th>Hours</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="record"></td>
                                        <td>
                                            <select class="selectpicker task-0 form-control" data-live-search="true" name="task[]" required onchange="newTask(this, 0)">
                                                <option value=""> -- choose -- </option>
                                                <option value="0"> Add New </option>
                                                @foreach($tasks as $task)
                                                    <option value="{{ $task->id }}"> {{ $task->name }} </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="new_task[]" class="form-control new-task-0" readonly></td>
                                        <td><input type="number" name="hour[]" class="form-control" required></td>
                                        <td><input type="date" name="date[]" class="form-control date-row" required></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><a class="btn btn-block btn-success add-row text-white"> + Add More</a></td>
                                        <td><span class="btn btn-danger fa fa-trash remove">  Remove Rows</span></td>
                                        <td colspan="2"></td>
                                    </tr>
                                    </tfoot>
                                </table>

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

    var tasks = {!! json_encode($tasks) !!};

    $(".daterangepicker-field").daterangepicker({
        callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('#account-statement-modal input[name="start_date"]').val(start_date);
            $('#account-statement-modal input[name="end_date"]').val(end_date);
            let lineNo = 0;

            if(start_date && end_date) {
                $.ajax({
                    url: "{{ route('clone') }}",
                    type: "GET",
                    data: {
                        // Additional data to send in the AJAX request if needed
                        start_date : start_date,
                        end_date : end_date
                    },
                    success: function (response) {
                        $("table tbody").empty();
                        $(".form").show(300);
                        $(response).each(function(index) {
                            row = $(this)[0];
                            var newRow = $("<tr>");
                            var cols = '';
                            var parentDate = $("#parent-date").val();
                            cols += '<td><input type="checkbox" name="record"></td>';
                            cols += '<td><select class="selectpicker task-' + lineNo + ' form-control" data-live-search="true" name="task[]" required onchange="newTask(this, ' + lineNo + ')"><option value=""> -- choose -- </option><option value="0"> Add New </option>';

                            $.each(tasks, function(index, task) {
                                cols += '<option value="' + task.id + '" ' + (task.id == row.task_id ? 'selected' : '') + '>' + task.name + '</option>';
                            });

                            cols += '</select></td>';
                            cols += '<td><input type="text" name="new_task[]" class="form-control new-task-'+lineNo+'" readonly></td>';
                            cols += '<td><input type="number" name="hour[]" value="'+row.hours+'" class="form-control" required></td>';
                            cols += '<td><input type="date" name="date[]" class="form-control date-row" value="'+row.date+'" required></td>';

                            newRow.append(cols);
                            $("table tbody").prepend(newRow);
                            lineNo++;

                            $('.selectpicker').selectpicker({
                                style: 'btn-link',
                            });

                        });
                    },
                    error: function (xhr, status, error) {
                        $('#preloader').hide();

                    }
                });
            }
        }
    });

    $("ul#timeSheet").siblings('a').attr('aria-expanded','true');
    $("ul#timeSheet").addClass("show");
    $("ul#timeSheet #timeSheet-menu-create").addClass("active");

    function newTask(selectObject, id) {
        if(selectObject.value == 0) {
            $('.new-task-'+id).prop("readonly", false);
        }
        if(selectObject.value != 0) {
            $('.new-task-'+id).prop("readonly", true);
        }
    }

    $(".date").on("change",function() {
        var parentDate = $("#parent-date").val();
        $(".date-row").val(parentDate);
        $(".form").show(300);
    });


    // new row
    let lineNo = 1;
    $(document).ready(function () {
        $(".add-row").click(function () {
            var newRow = $("<tr>");
            var cols = '';
            var parentDate = $("#parent-date").val();

            cols += '<td><input type="checkbox" name="record"></td>';
            cols += '<td><select class="selectpicker task-'+lineNo+' form-control" data-live-search="true" name="task[]" required  onchange="newTask(this, '+lineNo+')"><option value=""> -- choose -- </option><option value="0"> Add New </option> @foreach($tasks as $task) <option value="{{ $task->id }}"> {{ $task->name }} </option> @endforeach </select></td>';
            cols += '<td><input type="text" name="new_task[]" class="form-control new-task-'+lineNo+'" readonly></td>';
            cols += '<td><input type="number" name="hour[]" class="form-control" required></td>';
            cols += '<td><input type="date" name="date[]" class="form-control date-row" value="'+parentDate+'" required></td>';

            newRow.append(cols);
            $("table tbody").prepend(newRow);
            lineNo++;

            $('.selectpicker').selectpicker({
                style: 'btn-link',
            });
        });
    });

    // Find and remove selected table rows
    $(".remove").click(function(){
        $("table tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){
                $(this).parents("tr").remove();
            }
        });
    });
</script>
@endsection
