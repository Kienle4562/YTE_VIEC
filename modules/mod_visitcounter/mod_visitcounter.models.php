<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_mod_visitcounter extends modules_models
    {
        public function get_data($sql)
        {
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            return $result;
        }

        public function set_data($sql)
        {
            if($this->dbObj->SqlQueryInputResult($sql, array(0)) <> FALSE){
                return true;
            }
        }

        function render($check_today, $check_yesterday, $check_thisweek, $check_thismonth, $check_all, $check_online, $lang_text)
        {
            $myprocess = new process_mod_visitcounter();						

            // Read our Parameters
            $today      = '<span class="text2translate" alt="today">' . $lang_text['today'] . '</span>';
            $yesterday  = '<span class="text2translate" alt="yesterday">' . $lang_text['yesterday'] . '</span>';
            $x_month    = '<span class="text2translate" alt="thismonth">' . $lang_text['thismonth'] . '</span>';
            $x_week     = '<span class="text2translate" alt="thisweek">' . $lang_text['thisweek'] . '</span>';
            $all        = '<span class="text2translate" alt="all">' . $lang_text['all'] . '</span>';
            $online     = '<span class="text2translate" alt="online">' . $lang_text['online'] . '</span>';

            $locktime       = 60;
            $initialvalue   = 0;
            $records        = 1000000;

            $s_today        = 1;
            $s_yesterday    = 1;
            $s_all          = 1;
            $s_week         = 1;
            $s_month        = 1;
            $s_online       = 1;

            $s_digit        = 1;
            $disp_type      = "blue";
            $disp_ext       = ".gif";

            $widthtable        =    "100";
            $pretext          =     "";
            $posttext          =     "";

            // From minutes to seconds
            $locktime        =    $locktime * 60;

            // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable.
            $day             =    date('d');
            $month             =    date('n');
            $year             =    date('Y');
            $daystart         =    mktime(0,0,0,$month,$day,$year);
            $monthstart         =  mktime(0,0,0,$month,1,$year);

            // weekstart
            $weekday         =    date('w');
            $weekday--;
            if ($weekday < 0)$weekday = 7;
            $weekday         =    $weekday * 24*60*60;
            $weekstart         =    $daystart - $weekday;

            $yesterdaystart     =    $daystart - (24*60*60);
            $now             =    time();
            $ip                 =    $_SERVER['REMOTE_ADDR'];

            $result = $myprocess->get_data("SELECT MAX(id) as `all_visitors` FROM visitcounter");
            if($row = $result->fetch()){
                $all_visitors = $row["all_visitors"];
            }

            if ($all_visitors == NULL) {
                $all_visitors = $initialvalue;
            } else {
                $all_visitors += $initialvalue;
            }

            // Delete old records
            $temp=$all_visitors-$records;

            if ($records>0){
                if($myprocess->set_data("DELETE FROM visitcounter WHERE id<'$temp'") <> TRUE){
                    print("Statement Delete old records failed");
                }
            }

            $result = $myprocess->get_data("SELECT COUNT(*) as `items` FROM visitcounter WHERE ip='$ip' AND (tm+'$locktime')>'$now'");
            if($row = $result->fetch()){
                $items = $row["items"];
            }

            if (empty($items))
            {
                if($myprocess->set_data("INSERT INTO visitcounter (id, tm, ip) VALUES ('', '$now', '$ip')") <> TRUE){
                    print("Statement INSERT INTO visitcounter failed");
                }
            }

            $n = $all_visitors;
            $div = 100000;

            while ($n > $div) {
                $div *= 10;
            }

            $result = $myprocess->get_data("SELECT COUNT(*) as `today_visitors` FROM visitcounter WHERE tm>'$daystart'");
            if($row = $result->fetch()){
                $today_visitors = $row["today_visitors"];
            }

            $result = $myprocess->get_data("SELECT COUNT(*) as `yesterday_visitors` FROM visitcounter WHERE tm>'$yesterdaystart' and tm<'$daystart'");
            if($row = $result->fetch()){
                $yesterday_visitors = $row["yesterday_visitors"];
            }

            $result = $myprocess->get_data("SELECT COUNT(*) as `week_visitors` FROM visitcounter WHERE tm>='$weekstart'");
            if($row = $result->fetch()){
                $week_visitors = $row["week_visitors"];
            }

            $result = $myprocess->get_data("SELECT COUNT(*) as `month_visitors` FROM visitcounter WHERE tm>='$monthstart'");
            if($row = $result->fetch()){
                $month_visitors = $row["month_visitors"];
            }

            // Count Online in 20 minutes
            $online_time    =    1*60;

            $result = $myprocess->get_data("SELECT COUNT(*) as `online_visitors` FROM visitcounter WHERE tm>'$daystart' AND (tm+$locktime)>'$now'");

            if ($row = $result->fetch()) {
                $online_visitors = $row["online_visitors"];
            }

            $content = '<div>';

            if ($pretext != "") {
                $content .= '<div>' . $pretext . '</div>';
            }            
			
            $content         .=    '<ul class="visit_items_list">';
			
			// Show digit counter
            if($s_digit)
            {        
                $content .= '<li class="visit_number effect10 col-lg-12 col-md-12 col-sm-12">';

                while ($div >= 1) {
                    $digit = $n / $div % 10;
                    /*$content .= '<img src="images/visit_counter/' . $disp_type . '/' . $digit . $disp_ext . '" alt="số người truy cập" />';*/
					$content .= '<span>'.$digit.'</span>';
                    $n -= $digit * $div;
                    $div /= 10;
                }

                $content .= '</li>';
            }
			
            // Show today, yestoday, week, month, all statistic

			if($check_today == "on"){
            	if($s_today)        $content        .=    process_mod_visitcounter::spaceer("vtoday.gif", $today, $today_visitors);
			}
			if($check_yesterday == "on"){
            	if($s_yesterday)    $content        .=    process_mod_visitcounter::spaceer("vyesterday.gif", $yesterday, $yesterday_visitors);
			}
			if($check_thisweek == "on"){
            	if($s_week)         $content        .=    process_mod_visitcounter::spaceer("vweek.gif", $x_week, $week_visitors);
			}
			if($check_thismonth == "on"){
            	if($s_month)        $content        .=    process_mod_visitcounter::spaceer("vmonth.gif", $x_month, $month_visitors);
			}
			if($check_all == "on"){
            	if($s_all)          $content        .=    process_mod_visitcounter::spaceer("vall.gif", $all, $all_visitors);
			}
			if($check_online == "on"){					
            	if($s_online)       $content        .=    process_mod_visitcounter::spaceer("vall.gif", $online, $online_visitors);
			}

            //$content .= '<ul class="visit_items_list">';
            if ($posttext != "") $content        .= '<div>' . $posttext . '</div>';
			
            $content .= "</ul>";
            echo $content;
        }
        
        function spaceer($a1,$a2,$a3)
        {
            $ret  = '<tr>';
            $ret .= '<li class="col-lg-8 col-md-8 col-sm-8">'.$a2.'</li>';
            $ret .= '<li class="col-lg-4 col-md-4 col-sm-4">'.$a3.'</li>';
            $ret .= '</tr>';			
            return $ret;
        }
}