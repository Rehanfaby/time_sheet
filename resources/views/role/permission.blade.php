@extends('layout.main')
@section('content')
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Group Permission')}}</h4>
                    </div>
                    {!! Form::open(['route' => 'role.setPermission', 'method' => 'post']) !!}
                    <div class="card-body">
                    	<input type="hidden" name="role_id" value="{{$lims_role_data->id}}" />
						<div class="table-responsive">
						    <table class="table table-bordered permission-table">
						        <thead>
						        <tr>
						            <th colspan="5" class="text-center">{{$lims_role_data->name}} {{trans('file.Group Permission')}}</th>
						        </tr>
						        <tr>
						            <th rowspan="2" class="text-center">Module Name</th>
						            <th colspan="4" class="text-center">
						            	<div class="checkbox">
						            		<input type="checkbox" id="select_all">
						            		<label for="select_all">{{trans('file.Permissions')}}</label>
						            	</div>
						            </th>
						        </tr>
						        <tr>
						            <th class="text-center">{{trans('file.View')}}</th>
						            <th class="text-center">{{trans('file.add')}}</th>
						            <th class="text-center">{{trans('file.edit')}}</th>
						            <th class="text-center">{{trans('file.delete')}}</th>
						        </tr>
						        </thead>
						        <tbody>

                                <tr>
                                    <td>Task</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("task-index", $all_permission))
                                                    <input type="checkbox" value="1" id="task-index" name="task-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="task-index" name="task-index">
                                                @endif
                                                <label for="task-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("task-add", $all_permission))
                                                    <input type="checkbox" value="1" id="task-add" name="task-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="task-add" name="task-add">
                                                @endif
                                                <label for="task-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("task-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="task-edit" name="task-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="task-edit" name="task-edit">
                                                @endif
                                                <label for="task-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("task-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="task-delete" name="task-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="task-delete" name="task-delete">
                                                @endif
                                                <label for="task-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Time Sheet</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("time-sheet-index", $all_permission))
                                                    <input type="checkbox" value="1" id="time-sheet-index" name="time-sheet-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="time-sheet-index" name="time-sheet-index">
                                                @endif
                                                <label for="time-sheet-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("time-sheet-add", $all_permission))
                                                    <input type="checkbox" value="1" id="time-sheet-add" name="time-sheet-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="time-sheet-add" name="time-sheet-add">
                                                @endif
                                                <label for="time-sheet-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("time-sheet-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="time-sheet-edit" name="time-sheet-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="time-sheet-edit" name="time-sheet-edit">
                                                @endif
                                                <label for="time-sheet-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("time-sheet-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="time-sheet-delete" name="time-sheet-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="time-sheet-delete" name="time-sheet-delete">
                                                @endif
                                                <label for="time-sheet-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Mission Order</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("mission-order-index", $all_permission))
                                                    <input type="checkbox" value="1" id="mission-order-index" name="mission-order-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="mission-order-index" name="mission-order-index">
                                                @endif
                                                <label for="mission-order-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("mission-order-add", $all_permission))
                                                    <input type="checkbox" value="1" id="mission-order-add" name="mission-order-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="mission-order-add" name="mission-order-add">
                                                @endif
                                                <label for="mission-order-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("mission-order-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="mission-order-edit" name="mission-order-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="mission-order-edit" name="mission-order-edit">
                                                @endif
                                                <label for="mission-order-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("mission-order-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="mission-order-delete" name="mission-order-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="mission-order-delete" name="mission-order-delete">
                                                @endif
                                                <label for="mission-order-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Project</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("projects-index", $all_permission))
                                                    <input type="checkbox" value="1" id="projects-index" name="projects-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="projects-index" name="projects-index">
                                                @endif
                                                <label for="projects-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("projects-add", $all_permission))
                                                    <input type="checkbox" value="1" id="projects-add" name="projects-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="projects-add" name="projects-add">
                                                @endif
                                                <label for="projects-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("projects-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="projects-edit" name="projects-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="projects-edit" name="projects-edit">
                                                @endif
                                                <label for="projects-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("projects-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="projects-delete" name="projects-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="projects-delete" name="projects-delete">
                                                @endif
                                                <label for="projects-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Region</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("regions-index", $all_permission))
                                                    <input type="checkbox" value="1" id="regions-index" name="regions-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="regions-index" name="regions-index">
                                                @endif
                                                <label for="regions-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("regions-add", $all_permission))
                                                    <input type="checkbox" value="1" id="regions-add" name="regions-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="regions-add" name="regions-add">
                                                @endif
                                                <label for="regions-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("regions-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="regions-edit" name="regions-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="regions-edit" name="regions-edit">
                                                @endif
                                                <label for="regions-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("regions-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="regions-delete" name="regions-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="regions-delete" name="regions-delete">
                                                @endif
                                                <label for="regions-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Donation</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("votes-index", $all_permission))
                                                    <input type="checkbox" value="1" id="votes-index" name="votes-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="votes-index" name="votes-index">
                                                @endif
                                                <label for="votes-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("votes-add", $all_permission))
                                                    <input type="checkbox" value="1" id="votes-add" name="votes-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="votes-add" name="votes-add">
                                                @endif
                                                <label for="votes-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("votes-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="votes-edit" name="votes-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="votes-edit" name="votes-edit">
                                                @endif
                                                <label for="votes-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("votes-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="votes-delete" name="votes-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="votes-delete" name="votes-delete">
                                                @endif
                                                <label for="votes-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Beyond Coin</td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("coins-index", $all_permission))
                                                    <input type="checkbox" value="1" id="coins-index" name="coins-index" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="coins-index" name="coins-index">
                                                @endif
                                                <label for="coins-index"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("coins-add", $all_permission))
                                                    <input type="checkbox" value="1" id="coins-add" name="coins-add" checked />
                                                @else
                                                    <input type="checkbox" value="1" id="coins-add" name="coins-add">
                                                @endif
                                                <label for="coins-add"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("coins-edit", $all_permission))
                                                    <input type="checkbox" value="1" id="coins-edit" name="coins-edit" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="coins-edit" name="coins-edit">
                                                @endif
                                                <label for="coins-edit"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
                                            <div class="checkbox">
                                                @if(in_array("coins-delete", $all_permission))
                                                    <input type="checkbox" value="1" id="coins-delete" name="coins-delete" checked>
                                                @else
                                                    <input type="checkbox" value="1" id="coins-delete" name="coins-delete">
                                                @endif
                                                <label for="coins-delete"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
						            <td>{{trans('file.Expense')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-index", $all_permission))
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index" checked />
								                @else
								                <input type="checkbox" value="1" id="expenses-index" name="expenses-index">
								                @endif
								                <label for="expenses-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-add", $all_permission))
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add" checked />
								                @else
								                <input type="checkbox" value="1" id="expenses-add" name="expenses-add">
								                @endif
								                <label for="expenses-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-edit", $all_permission))
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="expenses-edit" name="expenses-edit">
								                @endif
								                <label for="expenses-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("expenses-delete", $all_permission))
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="expenses-delete" name="expenses-delete">
								                @endif
								                <label for="expenses-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>

						        <tr>
						            <td>Donee</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-index", $all_permission))
								                <input type="checkbox" value="1" id="employees-index" name="employees-index" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-index" name="employees-index">
								                @endif
								                <label for="employees-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-add", $all_permission))
								                <input type="checkbox" value="1" id="employees-add" name="employees-add" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-add" name="employees-add">
								                @endif
								                <label for="employees-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-edit", $all_permission))
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-edit" name="employees-edit">
								                @endif
								                <label for="employees-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("employees-delete", $all_permission))
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="employees-delete" name="employees-delete">
								                @endif
								                <label for="employees-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
						        <tr>
						            <td>{{trans('file.User')}}</td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("users-index", $all_permission))
								                <input type="checkbox" value="1" id="users-index" name="users-index" checked>
								                @else
								                <input type="checkbox" value="1" id="users-index" name="users-index">
								                @endif
								                <label for="users-index"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("users-add", $all_permission))
								                <input type="checkbox" value="1" id="users-add" name="users-add" checked>
								                @else
								                <input type="checkbox" value="1" id="users-add" name="users-add">
								                @endif
								                <label for="users-add"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("users-edit", $all_permission))
								                <input type="checkbox" value="1" id="users-edit" name="users-edit" checked>
								                @else
								                <input type="checkbox" value="1" id="users-edit" name="users-edit">
								                @endif
								                <label for="users-edit"></label>
								            </div>
						            	</div>
						            </td>
						            <td class="text-center">
						                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false">
							                <div class="checkbox">
								                @if(in_array("users-delete", $all_permission))
								                <input type="checkbox" value="1" id="users-delete" name="users-delete" checked>
								                @else
								                <input type="checkbox" value="1" id="users-delete" name="users-delete">
								                @endif
								                <label for="users-delete"></label>
								            </div>
						            	</div>
						            </td>
						        </tr>
                                <tr>
                                    <td>Time Sheet Report</td>
                                    <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("timesheet_generate", $all_permission))
                                                        <input type="checkbox" value="1" id="timesheet_generate" name="timesheet_generate" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="timesheet_generate" name="timesheet_generate">
                                                    @endif
								                    <label for="timesheet_generate" class="padding05">Timesheet Generate &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("timesheet_report", $all_permission))
                                                        <input type="checkbox" value="1" id="timesheet_report" name="timesheet_report" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="timesheet_report" name="timesheet_report">
                                                    @endif
								                    <label for="timesheet_report" class="padding05"> Report &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("timesheet_approve", $all_permission))
                                                        <input type="checkbox" value="1" id="timesheet_approve" name="timesheet_approve" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="timesheet_approve" name="timesheet_approve">
                                                    @endif
								                    <label for="timesheet_approve" class="padding05"> Approve &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("timesheet_sign", $all_permission))
                                                        <input type="checkbox" value="1" id="timesheet_sign" name="timesheet_sign" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="timesheet_sign" name="timesheet_sign">
                                                    @endif
								                    <label for="timesheet_sign" class="padding05"> Sign &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("timesheet_delete", $all_permission))
                                                        <input type="checkbox" value="1" id="timesheet_delete" name="timesheet_delete" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="timesheet_delete" name="timesheet_delete">
                                                    @endif
								                    <label for="timesheet_delete" class="padding05"> Delete &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Over Time Report</td>
                                    <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("over_time_generate", $all_permission))
                                                        <input type="checkbox" value="1" id="over_time_generate" name="over_time_generate" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="over_time_generate" name="over_time_generate">
                                                    @endif
								                    <label for="over_time_generate" class="padding05">Over Time Generate &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("over_time_report", $all_permission))
                                                        <input type="checkbox" value="1" id="over_time_report" name="over_time_report" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="over_time_report" name="over_time_report">
                                                    @endif
								                    <label for="over_time_report" class="padding05"> OT Report &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("over_time_approve", $all_permission))
                                                        <input type="checkbox" value="1" id="over_time_approve" name="over_time_approve" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="over_time_approve" name="over_time_approve">
                                                    @endif
								                    <label for="over_time_approve" class="padding05"> Approve &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("over_time_sign", $all_permission))
                                                        <input type="checkbox" value="1" id="over_time_sign" name="over_time_sign" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="over_time_sign" name="over_time_sign">
                                                    @endif
								                    <label for="over_time_sign" class="padding05"> Sign &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("over_time_delete", $all_permission))
                                                        <input type="checkbox" value="1" id="over_time_delete" name="over_time_delete" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="over_time_delete" name="over_time_delete">
                                                    @endif
								                    <label for="over_time_delete" class="padding05"> Delete &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                    </td>
                                </tr>

						        <tr>
						            <td>Others</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("account-index", $all_permission))
							                    	<input type="checkbox" value="1" id="account-index" name="account-index" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="account-index" name="account-index">
							                    	@endif
								                    <label for="account-index" class="padding05">{{trans('file.Account')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("one_time_otp", $all_permission))
                                                        <input type="checkbox" value="1" id="one_time_otp" name="one_time_otp" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="one_time_otp" name="one_time_otp">
                                                    @endif
								                    <label for="one_time_otp" class="padding05">OTP At Login &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("department", $all_permission))
                                                        <input type="checkbox" value="1" id="department" name="department" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="department" name="department">
                                                    @endif
								                    <label for="department" class="padding05">{{trans('file.Department')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
{{--                                        <span>--}}
{{--						                    <div aria-checked="false" aria-disabled="false">--}}
{{--								                <div class="checkbox">--}}
{{--							                    	@if(in_array("mission-order-sign", $all_permission))--}}
{{--                                                        <input type="checkbox" value="1" id="mission-order-sign" name="mission-order-sign" checked>--}}
{{--                                                    @else--}}
{{--                                                        <input type="checkbox" value="1" id="mission-order-sign" name="mission-order-sign">--}}
{{--                                                    @endif--}}
{{--								                    <label for="mission-order-sign" class="padding05">Mission Order Sign &nbsp;&nbsp;</label>--}}
{{--								                </div>--}}
{{--								            </div>--}}
{{--						                </span>--}}
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("mission-order-approve", $all_permission))
                                                        <input type="checkbox" value="1" id="mission-order-approve" name="mission-order-approve" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="mission-order-approve" name="mission-order-approve">
                                                    @endif
								                    <label for="mission-order-approve" class="padding05">Mission Order Approve &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            </td>
						        </tr>
{{--						        <tr>--}}
{{--						            <td>{{trans('file.Reports')}}</td>--}}
{{--						            <td class="report-permissions" colspan="5">--}}
{{--						            	<span>--}}
{{--						                    <div aria-checked="false" aria-disabled="false">--}}
{{--								                <div class="checkbox">--}}
{{--							                    	@if(in_array("vote-report", $all_permission))--}}
{{--							                    	<input type="checkbox" value="1" id="vote-report" name="vote-report" checked>--}}
{{--							                    	@else--}}
{{--							                    	<input type="checkbox" value="1" id="vote-report" name="vote-report">--}}
{{--							                    	@endif--}}
{{--								                    <label for="vote-report" class="padding05">Voting Rport &nbsp;&nbsp;</label>--}}
{{--								                </div>--}}
{{--								            </div>--}}
{{--						                </span>--}}

{{--						            </td>--}}
{{--						        </tr>--}}
						        <tr>
						            <td>{{trans('file.settings')}}</td>
						            <td class="report-permissions" colspan="5">
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("dashboard", $all_permission))
                                                        <input type="checkbox" value="1" id="dashboard" name="dashboard" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="dashboard" name="dashboard">
                                                    @endif
								                    <label for="dashboard" class="padding05">{{trans('file.dashboard')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("send_notification", $all_permission))
							                    	<input type="checkbox" value="1" id="send_notification" name="send_notification" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="send_notification" name="send_notification">
							                    	@endif
								                    <label for="send_notification" class="padding05">{{trans('file.Send Notification')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
								            <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("currency", $all_permission))
							                    	<input type="checkbox" value="1" id="currency" name="currency" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="currency" name="currency">
							                    	@endif
								                    <label for="currency" class="padding05">{{trans('file.Currency')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
						            	<span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("general_setting", $all_permission))
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting" checked>
							                    	@else
							                    	<input type="checkbox" value="1" id="general_setting" name="general_setting">
							                    	@endif
								                    <label for="general_setting" class="padding05">{{trans('file.General Setting')}} &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
                                        <span>
						                    <div aria-checked="false" aria-disabled="false">
								                <div class="checkbox">
							                    	@if(in_array("see-votes", $all_permission))
                                                        <input type="checkbox" value="1" id="see-votes" name="see-votes" checked>
                                                    @else
                                                        <input type="checkbox" value="1" id="see-votes" name="see-votes">
                                                    @endif
								                    <label for="see-votes" class="padding05">Anyone can See Votes &nbsp;&nbsp;</label>
								                </div>
								            </div>
						                </span>
{{--						                <span>--}}
{{--						                    <div aria-checked="false" aria-disabled="false">--}}
{{--								                <div class="checkbox">--}}
{{--							                    	@if(in_array("sms_setting", $all_permission))--}}
{{--							                    	<input type="checkbox" value="1" id="sms_setting" name="sms_setting" checked>--}}
{{--							                    	@else--}}
{{--							                    	<input type="checkbox" value="1" id="sms_setting" name="sms_setting">--}}
{{--							                    	@endif--}}
{{--								                    <label for="sms_setting" class="padding05">{{trans('file.SMS Setting')}} &nbsp;&nbsp;</label>--}}
{{--								                </div>--}}
{{--								            </div>--}}
{{--						                </span>--}}
{{--						                <span>--}}
{{--						                    <div aria-checked="false" aria-disabled="false">--}}
{{--								                <div class="checkbox">--}}
{{--							                    	@if(in_array("create_sms", $all_permission))--}}
{{--							                    	<input type="checkbox" value="1" id="create_sms" name="create_sms" checked>--}}
{{--							                    	@else--}}
{{--							                    	<input type="checkbox" value="1" id="create_sms" name="create_sms">--}}
{{--							                    	@endif--}}
{{--								                    <label for="create_sms" class="padding05">{{trans('file.Create SMS')}} &nbsp;&nbsp;</label>--}}
{{--								                </div>--}}
{{--								            </div>--}}
{{--						                </span>--}}
						            </td>
						        </tr>
						        </tbody>
						    </table>
						</div>
						<div class="form-group">
	                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
	                    </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

	$("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #role-menu").addClass("active");

	$("#select_all").on( "change", function() {
	    if ($(this).is(':checked')) {
	        $("tbody input[type='checkbox']").prop('checked', true);
	    }
	    else {
	        $("tbody input[type='checkbox']").prop('checked', false);
	    }
	});
</script>
@endsection
