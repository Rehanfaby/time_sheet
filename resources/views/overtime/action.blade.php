<td>
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{trans('file.action')}}
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
            @if($report->is_sign == 0)
                @if(in_array("over_time_sign", $all_permission))
                    <li><a href="{{ route('timesheet.sign', $report->id) }}" class="btn btn-link" onclick="return confirmSign()"><i class="dripicons-pencil"></i> Sign</a></li>
                @endif
            @endif
            @if($report->is_approve == 0)
                @if(in_array("over_time_approve", $all_permission))
                    <li><a href="{{ route('timesheet.approve', $report->id) }}" class="btn btn-link" onclick="return confirmApprove()"><i class="dripicons-checkmark"></i>Approve</a></li>
                @endif
            @endif
            @if(in_array("over_time_delete", $all_permission))
                {{ Form::open(['route' => ['timesheet.destroy', $report->id], 'method' => 'DELETE'] ) }}
                <li>
                    <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> {{trans('file.delete')}}</button>
                </li>
                {{ Form::close() }}
            @endif
        </ul>
    </div>
</td>
