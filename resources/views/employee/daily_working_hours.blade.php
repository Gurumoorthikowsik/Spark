@include('common.employee.inner_header')
@include('common.employee.sidebar')


<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/employees/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">View Daily Woking Hours</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">

            	<!-- Content Start -->

            		 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            	
                                <h4 class="card-title">View Daily Woking Hours</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Working Hours</th>
                                                <th>Status</th>
                                                <!-- <th></th> -->
                                                
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        	@if($get_month)
                                            @php $i = 1;  $leave_days =  get_leave_days(); @endphp
                                            @foreach (array_reverse($get_month) as $key => $values)
                                            <?php  $get_hours = get_working_hours($values); $value = json_decode($get_hours); ?>
                                            <tr class="item">
                                                <td class="id">{{$i}}</td>
                                                <td class="form_name">{{$values}}</td>
                                                <td class="currency_name"><?php echo ($value->totaltime == '') ? '--' : get_today_time($value->totaltime); ?>  </td>

                                                <td class="form_name">
                                                <?php  $work_hours =  (get_user($dec_user_id,'working_hrs') != '') ? get_user($dec_user_id,'working_hrs') : '08:00';
                                                ?> 

                                                @php $leave_find = in_array($values,$leave_days); @endphp 

                                                @if(strtotime(str_replace('Min', '', get_today_time($value->totaltime))) >=  strtotime($work_hours))
                                                   <span class="badge badge-success">Completed </span>

                                                @elseif($value->attendance == 'yes' && strtotime(str_replace('Min', '', get_today_time($value->totaltime))) <=  strtotime($work_hours))

                                                    <span class="badge badge-warning">Low Working Hours</span>

                                                @elseif($value->attendance == 'no' && $leave_find != 1)

                                                    <span class="badge badge-danger">Absent</span>

                                                @elseif($value->attendance == 'no' && $leave_find == 1)

                                                    <span class="badge badge-primary">Leave</span>
                                                    
                                                @endif
                                                </td>
                                                <!-- <td> -->
                                                    <!-- @if($value->attendance == 'yes' && strtotime(str_replace('Min', '', get_today_time($value->totaltime))) <=  strtotime($work_hours)) -->
                                                    <!-- <a href="javascript::void()"><i class="fa fa-solid fa-gear"></a></i> -->
                                                    <!-- @else -->
                                                    <!-- -- -->
                                                    <!-- @endif -->
                                                <!-- </td> -->
                                               
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            @endif
                                        </tbody>
                             
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            	<!-- Content End -->



            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



               

@include('common.employee.inner_footer')

