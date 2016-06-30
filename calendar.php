<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 27.06.2016
 * Time: 04:47
 */
$now_time = time ();
if (! empty ($_GET['q'])){ $now_time = $_GET['q']; }

function kalendar ($now_time){
    $td = "<td align='right' class='color_body'>";
    $day = @date ('j', $now_time);
    $month = @date ('n', $now_time);
    $year = @date ('Y', $now_time);

    $time = time ();
    $month_abs = @date ('n', $time);
    $year_abs = @date ('Y', $time);
    if ($month_abs==$month and $year_abs==$year){
        $now_time = $time;
        $day = @date ('j', $now_time);
        $month = @date ('n', $now_time);
        $year = @date ('Y', $now_time);
    }

    $end_day = @date ('t', $now_time);
    $one_day = @date ('w', @mktime (1,0,0,$month,1,$year))-1;

    $metka_zero = @mktime (0,0,1,$month,1,$year);
    $metka_end = @mktime (23,59,59,$month,$end_day,$year);
    if ($one_day=='-1'){ $one_day=6; }

    if ($month==1){$month_s='Январь';}
    elseif ($month==2){$month_s='Февраль';}
    elseif ($month==3){$month_s='Март';}
    elseif ($month==4){$month_s='Апрель';}
    elseif ($month==5){$month_s='Май';}
    elseif ($month==6){$month_s='Июнь';}
    elseif ($month==7){$month_s='Июль';}
    elseif ($month==8){$month_s='Август';}
    elseif ($month==9){$month_s='Сентябрь';}
    elseif ($month==10){$month_s='Октябрь';}
    elseif ($month==11){$month_s='Ноябрь';}
    else {$month_s='Декабрь';}

    $kalend = "<table align='center' border='0' cellpadding='0' cellspacing='0' class='color_table'>
<tr><td>
<table border='0' cellspacing='1' cellpadding='4' width='100%'>
<tr>
<td align='center' colspan='7' class='color_td'>
<a href='?q=".($metka_zero-60)."'>&lt;&lt;</a>
<font class='forum'><b>".$month_s." ".$year."</b></font>
<a href='?q=".($metka_end+60)."'>&gt;&gt;</a>
</td>
</tr><tr>
<td align='center' class='color_body'>Пн</td>
<td align='center' class='color_body'>Вт</td>
<td align='center' class='color_body'>Ср</td>
<td align='center' class='color_body'>Чт</td>
<td align='center' class='color_body'>Пт</td>
<td align='center' class='color_body'>Сб</td>
<td align='center' class='color_body'>Вс</td>
</tr><tr>\n";
    $x=0;
    for ( $i = 1; $i <= $end_day+$one_day; $i++){
        if ($x==0){$x=7;}
        $x--;
        $a = $i - $one_day;
        $BBB = $a;
        if ($one_day > $i or $a < 1){ $kalend .= $td."&nbsp;</td>\n"; }
        elseif ($i==6 or $i==13 or $i==20 or $i==27 or $i==34){
            if ($i==$day+$one_day){ $a = "<font class='forums'><u>".$a."</u></font>";}
            $kalend .= $td."<b>".$a."</b></td>\n";
        }
        elseif ($i==7 or $i==14 or $i==21 or $i==28 or $i==35){
            if ($i==$day+$one_day){ $a = "<font class='forums'><u>".$a."</u></font>"; }
            $kalend .= $td."<b>".$a."</b></td>\n";
            if ($i!=35){
                $kalend .= "</tr><tr>\n";
            }
            elseif (@ checkdate ( $month , $BBB+1 , $year )){
                $kalend .= "</tr><tr>\n";
            }
        }
        elseif ($i==$day+$one_day){ $kalend .= "<td align='right' class='color_body_svet'><font class='forums'><b><u>".$a."</b></u></font></td>\n";}
        else { $kalend .= $td.$a."</td>\n"; }
    }

    if ($x!=0){
        for ( $i = 0; $i < $x; $i++){ $kalend .= $td."&nbsp;</td>\n"; }
    }
    $kalend .= "</tr>\n</table>\n</td>\n</tr>\n</table>\n";
    return $kalend;
}

print kalendar ($now_time);

?>
</body>
</html>
