@extends('layout.main')
@section('content')
    <section>
        <style>
            *{ color-adjust: exact;  -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .red-green{
                background: linear-gradient(red , green);
                color: white;
            }
            .red{
                background: linear-gradient(red , red);
                color: white;
            }
            .green{
                background: linear-gradient(green , green);
                color: white;
            }
        </style>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['tasks.index.monthly', $year, $month], 'method' => 'get', 'id' => 'report-form']) }}
                    <input type="hidden" name="user_id_hidden" value="{{$user_id}}">
                    <h4 class="text-center">Monthly Time Sheet &nbsp;&nbsp;
                        <select class="selectpicker" id="user_id" name="user_id" data-live-search="true">
                            <option value="0">Choose User</option>
                            @foreach($lims_user_list as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-default pull-right" onclick="printCalender()">Print</button>
                    </h4>
                    {{ Form::close() }}

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                            <thead>
                            <tr>
                                <th><a class="hide" href="{{url('tasks/index/monthly/'.$prev_year.'/'.$prev_month)}}"><i class="fa fa-arrow-left"></i> {{trans('file.Previous')}}</a></th>
                                <th colspan="5" class="text-center">{{date("F", strtotime($year.'-'.$month.'-01')).' ' .$year}}</th>
                                <th><a class="hide" href="{{url('tasks/index/monthly/'.$next_year.'/'.$next_month)}}">{{trans('file.Next')}} <i class="fa fa-arrow-right"></i></a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><strong>Sunday</strong></td>
                                <td><strong>Monday</strong></td>
                                <td><strong>Tuesday</strong></td>
                                <td><strong>Wednesday</strong></td>
                                <td><strong>Thrusday</strong></td>
                                <td><strong>Friday</strong></td>
                                <td><strong>Saturday</strong></td>
                            </tr>
                            <?php
                            $i = 1;
                            $flag = 0;
                            while ($i <= $number_of_day) {
                                echo '<tr>';
                                for($j=1 ; $j<=7 ; $j++){
                                    if($i > $number_of_day)
                                        break;

                                    if($flag){
                                        if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                                            echo '<td class="'.@$color[$i].'"><p style="color:red"><strong>'.$i.'</strong></p>';
                                        else
                                            echo '<td  class="'.@$color[$i].'"><p><strong>'.$i.'</strong></p>';

                                        $task_names = '';
                                        if(isset($task_data_array[$i])){
                                            foreach ($task_data_array[$i] as $task) {
                                                $task_names .= $task . '<br>';
                                            }
                                            if($task_names != '') {
                                                echo '<strong>'. $task_names. '</strong><br>';
                                            }
                                        }

                                        echo '</td>';
                                        $i++;
                                    }
                                    elseif($j == $start_day){
                                        if($year.'-'.$month.'-'.$i == date('Y').'-'.date('m').'-'.(int)date('d'))
                                            echo '<td  class="'.@$color[$i].'"><p style="color:red"><strong>'.$i.'</strong></p>';
                                        else
                                            echo '<td  class="'.@$color[$i].'"><p><strong>'.$i.'</strong></p>';

                                        $task_names = '';
                                        if(isset($task_data_array[$i])){
                                            foreach ($task_data_array[$i] as $task) {
                                                $task_names .= $task . '<br>';
                                            }
                                            if($task_names != '') {
                                                echo '<strong>'. $task_names. '</strong><br>';
                                            }
                                        }

                                        echo '</td>';
                                        $flag = 1;
                                        $i++;
                                        continue;
                                    }
                                    else {
                                        echo '<td></td>';
                                    }
                                }
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Working</th>
                                <td><span class="green" style="padding: 10px 30px"></span></td>
                                <th>Non Working Day</th>
                                <td><span style="padding: 10px 30px"></span></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">

        function printCalender(){
            event.preventDefault();
            $(".side-navbar").hide();
            $("#report-form").hide();
            $(".hide").hide();
            print();
            $(".side-navbar").show();
            $("#report-form").show();
            $(".hide").show();
        }
        $("ul#timeSheet").siblings('a').attr('aria-expanded','true');
        $("ul#timeSheet").addClass("show");
        $("ul#timeSheet #timeSheet-menu-monthly").addClass("active");

        $('#user_id').val($('input[name="user_id_hidden"]').val());
        $('.selectpicker').selectpicker('refresh');

        $('#user_id').on("change", function(){
            $('#report-form').submit();
        });
    </script>
@endsection
