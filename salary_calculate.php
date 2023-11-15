<?php 

// dashbor then this file is get
$salary_year = date('Y', strtotime("first day of previous month"));
$salary_month = date('Y-n-j', strtotime("first day of previous month"));
$last_month_start = date("Y-n-j 00:00:00", strtotime("first day of previous month"));
$last_month_end = date("Y-n-j 23:59:00", strtotime("last day of previous month"));
$employee_details = db_select_query("SELECT * FROM users Where role = 'employee' And salary_calculate = '1' AND date_of_joining < '$last_month_end'");
// get this year total leave 
foreach($employee_details as $row){ 
     $user_id = $row['id'];   
     //if current month salary calculate then loop continue
        $salary_month_year = date('Y-m', strtotime("first day of previous month"));
        $currunt_month_calculate_salary = db_select_query("SELECT * FROM salary Where employee_id = '$user_id' AND (DATE_FORMAT(salary_month, '%Y-%m') = '$salary_month_year')");
        if(!empty($currunt_month_calculate_salary)){
            continue;
        }
     //if current month salary calculate then loop continue
      // check this month is curront month
      $joing_month_total_day = 0;
      $date_of_joining = date('Y-m',strtotime($row['date_of_joining']));
      $start_month_curront = date('Y-m',strtotime($last_month_start));
        if($date_of_joining == $start_month_curront){
            $joing_day =  strtotime($last_month_end) - strtotime($row['date_of_joining']);
            $joing_month_total_day = round($joing_day / (60 * 60 * 24));
            if($joing_month_total_day > 30){
                $joing_month_total_day = 30;
            }
        }
        // check this month is curront month
    // get pt salary
      //  $total_commission = db_select_query("select sum(employee_commission) from private_training where employee_id = '$user_id' and pt_start_date BETWEEN '$last_month_start' AND '$last_month_end'")[0]['sum(employee_commission)'];
      $total_commission = db_select_query("select sum(employee_commission) from private_training where employee_id = '$user_id' and  (DATE_FORMAT(pt_start_date, '%Y-%m') = '$salary_month_year')")[0]['sum(employee_commission)'];
      // get pt salary  

    $leave = db_select_query("select * from user_leaves where status = 'approved' and user_id = '$user_id' and (DATE_FORMAT(leave_from, '%Y') = '$salary_year' OR DATE_FORMAT(leave_to, '%Y') = '$salary_year')");
    //$leave = db_select_query("select * from user_leaves where status = 'approved' and user_id = $user_id and DATE_FORMAT(leave_from, '%Y') = '$salary_year'");
    $total_leaves = 0;
    if($leave){
        foreach($leave as $dates){
            $check_live_this_year = createDateRangeArray($dates['leave_from'],$dates['leave_to']);
            foreach($check_live_this_year as $row_leave){
                // get only current year
                if($salary_year == date('Y',strtotime($row_leave))){
                    // future approved leave date not count
                    if(strtotime($row_leave) <= strtotime($last_month_end)){
                        $total_leaves += 1;
                    }
                }
            }
            //$datediff = strtotime($dates['leave_to']) - strtotime($dates['leave_from']);
            // $total_leaves += round($datediff / (60 * 60 * 24)) + 1;
        }
    }  
    // get last months leave count (salary last month me deduct ho gyi hai)
    $employee_last_months_leave = db_select_query("SELECT sum(month_leave) FROM salary Where employee_id = '$user_id' AND (DATE_FORMAT(salary_month, '%Y') = '$salary_year')")[0]['sum(month_leave)'];
        if(!empty($employee_last_month_leave)){
            $total_leaves -= $employee_last_month_leave;
        }
    // get last months leave count (salary last month me deduct ho gyi hai)
    $leave_salary_deduct = $leave_deduction = 0;
    if($total_leaves > 15){        
        $leave_salary_deduct = $total_leaves - 15;
        $oneDaysalary = number_format(($row['salary']/30),2,'.','');        
        $leave_deduction = $oneDaysalary * ($total_leaves-15);
    }

    $salary = $row['salary'];
    $salary_deduction = $leave_deduction;
    if($joing_month_total_day > 0){
        $oneDaysalary = number_format(($row['salary']/30),2,'.','');  
        $salary = $oneDaysalary * $joing_month_total_day;
        $salary_deduction = $row['salary'] - ($salary+$leave_deduction);
    }
    $total_commission = $total_commission?$total_commission:0;
        $data['table']='salary';
        $insert_data['employee_id']=$user_id;
        $insert_data['salary']=    ($salary+$total_commission) - $leave_deduction;
        $insert_data['month_leave']= $leave_salary_deduct;
        $insert_data['pt_salary']= $total_commission;
        $insert_data['salary_month']= $salary_month;
        $insert_data['salary_deduction']= $salary_deduction;
        $data['values']=$insert_data;
        db_insert($data);
   }

   function createDateRangeArray($strDateFrom,$strDateTo)
   {
       // takes two dates formatted as YYYY-MM-DD and creates an
       // inclusive array of the dates between the from and to dates.   
       // could test validity of dates here but I'm already doing
       // that in the main script   
       $aryRange = [];   
       $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
       $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
    if ($iDateTo >= $iDateFrom) {
           array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
           while ($iDateFrom<$iDateTo) {
               $iDateFrom += 86400; // add 24 hours
               array_push($aryRange, date('Y-m-d', $iDateFrom));
           }
       }
       return $aryRange;
   }

// get this year total leave 



