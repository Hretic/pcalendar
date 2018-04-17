<?php

//d M Y - G:i:s
function jdate($maket="now", $type = 'Y/m/d H:i')
{
    $maket = (string)$maket;
        //set 1 if you want translate number to farsi or if you don't like set 0
        $transnumber=0;
        ///chosse your timezone
        $TZhours=0;
        $TZminute=0;

        if($maket=="now"){
                $year=date("Y");
                $month=date("m");
                $day=date("d");
                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                $maket=jmaketime(date("h")+$TZhours,date("i")+$TZminute,date("s"),$jmonth,$jday,$jyear);
        }else{
        		if (is_string($maket))
        			$maket=strtotime($maket);
                $maket+=$TZhours*3600+$TZminute*60;
                $date=date("Y-m-d",$maket);
                list( $year, $month, $day ) = preg_split ( '/-/', $date );

                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                }

        $need= $maket;
        $year=date("Y",$need);
        $month=date("m",$need);
        $day=date("d",$need);
        $i=0;
        $result = "";
        $result1 = "";
        while($i<strlen($type))
        {
                $subtype=substr($type,$i,1);
                switch ($subtype)
                {

                        case "A":
                                $result1=date("a",$need);
                                if($result1=="pm") $result.= "بعدازظهر";
                                else $result.="قبل‏ازظهر";
                                break;

                        case "a":
                                $result1=date("a",$need);
                                if($result1=="pm") $result.= "ب.ظ";
                                else $result.="ق.ظ";
                                break;
                        case "d":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                if($jday<10)$result1="0".$jday;
                                else         $result1=$jday;
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "D":
                                $result1=date("D",$need);
                                if($result1=="Thu") $result1="پ";
                                else if($result1=="Sat") $result1="ش";
                                else if($result1=="Sun") $result1="ى";
                                else if($result1=="Mon") $result1="د";
                                else if($result1=="Tue") $result1="س";
                                else if($result1=="Wed") $result1="چ";
                                else if($result1=="Thu") $result1="پ";
                                else if($result1=="Fri") $result1="ج";
                                $result.=$result1;
                                break;
                        case"F":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result.=monthname($jmonth);
                                break;
                        case "g":
                                $result1=date("g",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "G":
                                $result1=date("G",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "h":
                                $result1=date("h",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "H":
                                $result1=date("H",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "i":
                                $result1=date("i",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "j":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result1=$jday;
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "l":
                                $result1=date("l",$need);
                                if($result1=="Saturday") $result1="شنبه";
                                else if($result1=="Sunday") $result1="يكشنبه";
                                else if($result1=="Monday") $result1="دوشنبه";
                                else if($result1=="Tuesday") $result1="سه شنبه";
                                else if($result1=="Wednesday") $result1="چهارشنبه";
                                else if($result1=="Thursday") $result1="پنجشنبه";
                                else if($result1=="Friday") $result1="جمعه";
                                $result.=$result1;
                                break;
                        case "m":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                if($jmonth<10) $result1="0".$jmonth;
                                else        $result1=$jmonth;
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "M":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result.=monthname($jmonth);
                                break;
                        case "n":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result1=$jmonth;
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "s":
                                $result1=date("s",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "S":
                                $result.="ام";
                                break;
                        case "t":
                                $result.=lastday ($month,$day,$year);
                                break;
                        case "w":
                                $result1=date("w",$need);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "y":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result1=substr($jyear,2,4);
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        case "Y":
                                list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
                                $result1=$jyear;
                                if($transnumber==1) $result.=Convertnumber2farsi($result1);
                                else $result.=$result1;
                                break;
                        default:
                                $result.=$subtype;
                }
        $i++;
        }
        return $result;
}


function jmaketime($hour,$minute,$second,$jmonth,$jday,$jyear)
{
    if(!$hour && !$minute && !$second && !$jmonth && !$jmonth && !$jday && !$jyear)
        return mktime();

        list( $year, $month, $day ) = jalali_to_gregorian($jyear, $jmonth, $jday);
        $i=mktime($hour,$minute,$second,$month,$day,$year);
        return $i;
}


///Find Day Begining Of Month
function mstart($month,$day,$year)
{
        list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
        list( $year, $month, $day ) = jalali_to_gregorian($jyear, $jmonth, "1");
        $timestamp=mktime(0,0,0,$month,$day,$year);
        return date("w",$timestamp);
}

//Find Number Of Days In This Month
function lastday ($month,$day,$year)
{
        $lastdayen=date("d",mktime(0,0,0,$month+1,0,$year));
        list( $jyear, $jmonth, $jday ) = gregorian_to_jalali($year, $month, $day);
        $lastdatep=$jday;
        $jday=$jday2;
        while($jday2!="1")
        {
                if($day<$lastdayen)
                {
                        $day++;
                        list( $jyear, $jmonth, $jday2 ) = gregorian_to_jalali($year, $month, $day);
                        if($jdate2=="1") break;
                        if($jdate2!="1") $lastdatep++;
                }
                else
                {
                        $day=0;
                        $month++;
                        if($month==13)
                        {
                                        $month="1";
                                        $year++;
                        }
                }

        }
        return $lastdatep-1;
}

//translate number of month to name of month
function monthname($month)
{

    if($month=="01") return "فروردين";

    if($month=="02") return "ارديبهشت";

    if($month=="03") return "خرداد";

    if($month=="04") return  "تير";

    if($month=="05") return "مرداد";

    if($month=="06") return "شهريور";

    if($month=="07") return "مهر";

    if($month=="08") return "آبان";

    if($month=="09") return "آذر";

    if($month=="10") return "دي";

    if($month=="11") return "بهمن";

    if($month=="12") return "اسفند";
}
//translate number of month to name of month
function monthArr($year = 0 )
{

    return [
    "01"=> ['year'=>$year , 'month'=>"01" , 'title'=>"فروردين"],

    "02"=> ['year'=>$year , 'month'=>"02" , 'title'=>"ارديبهشت"],

    "03"=> ['year'=>$year , 'month'=>"03" , 'title'=>"خرداد"],

    "04"=>  ['year'=>$year , 'month'=>"04" , 'title'=>"تير"],

    "05"=> ['year'=>$year , 'month'=>"05" , 'title'=>"مرداد"],

    "06"=> ['year'=>$year , 'month'=>"06" , 'title'=>"شهريور"],

    "07"=> ['year'=>$year , 'month'=>"07" , 'title'=>"مهر"],

    "08"=> ['year'=>$year , 'month'=>"08" , 'title'=>"آبان"],

    "09"=> ['year'=>$year , 'month'=>"09" , 'title'=>"آذر"],

    "10"=> ['year'=>$year , 'month'=>"10" , 'title'=>"دي"],

    "11"=> ['year'=>$year , 'month'=>"11" , 'title'=>"بهمن"],

    "12"=> ['year'=>$year , 'month'=>"12" , 'title'=>"اسفند"],
    ];
}

function weekDays(){

    return array(

        0=>'شنبه' ,
        1=>'يكشنبه' ,
        2=>'دوشنبه' ,
        3=>'سه شنبه' ,
        4=>'چهارشنبه' ,
        5=>'پنجشنبه' ,
        6=>'جمعه' ,

    );

}
////here convert to  number in persian
function Convertnumber2farsi($srting)
{
        $num0="۰";
        $num1="۱";
        $num2="۲";
        $num3="۳";
        $num4="۴";
        $num5="۵";
        $num6="۶";
        $num7="۷";
        $num8="۸";
        $num9="۹";

        $stringtemp="";
        $len=strlen($srting);
        for($sub=0;$sub<$len;$sub++)
        {
         if(substr($srting,$sub,1)=="0")$stringtemp.=$num0;
         elseif(substr($srting,$sub,1)=="1")$stringtemp.=$num1;
         elseif(substr($srting,$sub,1)=="2")$stringtemp.=$num2;
         elseif(substr($srting,$sub,1)=="3")$stringtemp.=$num3;
         elseif(substr($srting,$sub,1)=="4")$stringtemp.=$num4;
         elseif(substr($srting,$sub,1)=="5")$stringtemp.=$num5;
         elseif(substr($srting,$sub,1)=="6")$stringtemp.=$num6;
         elseif(substr($srting,$sub,1)=="7")$stringtemp.=$num7;
         elseif(substr($srting,$sub,1)=="8")$stringtemp.=$num8;
         elseif(substr($srting,$sub,1)=="9")$stringtemp.=$num9;
         else $stringtemp.=substr($srting,$sub,1);

        }
return   $stringtemp;

}///end conver to number in persian





// "jalali.php" is convertor to and from Gregorian and Jalali calendars.
// Copyright (C) 2000  Roozbeh Pournader and Mohammad Toossi
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// A copy of the GNU General Public License is available from:
//
//    <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">http://www.gnu.org/copyleft/gpl.html</a>
//



function div($a,$b) {
    return (int) ($a / $b);
}

function gregorian_to_jalali ($g_y, $g_m, $g_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);





   $gy = $g_y-1600;
   $gm = $g_m-1;
   $gd = $g_d-1;

   $g_day_no = 365*$gy+div($gy+3,4)-div($gy+99,100)+div($gy+399,400);

   for ($i=0; $i < $gm; ++$i)
      $g_day_no += $g_days_in_month[$i];
   if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
      /* leap and after Feb */
      $g_day_no++;
   $g_day_no += $gd;

   $j_day_no = $g_day_no-79;

   $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
   $j_day_no = $j_day_no % 12053;

   $jy = 979+33*$j_np+4*div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

   $j_day_no %= 1461;

   if ($j_day_no >= 366) {
      $jy += div($j_day_no-1, 365);
      $j_day_no = ($j_day_no-1)%365;
   }

   for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
      $j_day_no -= $j_days_in_month[$i];
   $jm = $i+1;
   $jd = $j_day_no+1;

   return array($jy, $jm, $jd);
}

function jalali_to_gregorian($j_y, $j_m, $j_d)
{
    $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);



   $jy = $j_y-979;
   $jm = $j_m-1;
   $jd = $j_d-1;

   $j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4);
   for ($i=0; $i < $jm; ++$i)
      $j_day_no += $j_days_in_month[$i];

   $j_day_no += $jd;

   $g_day_no = $j_day_no+79;

   $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
   $g_day_no = $g_day_no % 146097;

   $leap = true;
   if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
   {
      $g_day_no--;
      $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
      $g_day_no = $g_day_no % 36524;

      if ($g_day_no >= 365)
         $g_day_no++;
      else
         $leap = false;
   }

   $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
   $g_day_no %= 1461;

   if ($g_day_no >= 366) {
      $leap = false;

      $g_day_no--;
      $gy += div($g_day_no, 365);
      $g_day_no = $g_day_no % 365;
   }

   for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
      $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
   $gm = $i+1;
   $gd = $g_day_no+1;

   return array($gy, $gm, $gd);
}

function get_monthes($lang='fa')
{
	$output = array();
	
	if ($lang=='fa')
	{
		for ($i=1;$i<=12;$i++)
		{
			$output[$i] = monthname($i);
		}
	}
	else 
	{
		for ($i=1;$i<=12;$i++)
		{
			$output[$i] = date('M',strtotime("2010-$i-15"));
		}
	}
	
	return $output;
}



function date_to_shamsi($type,$maket="now")
{
	return jdate($type,$maket);
}

function shamsi_to_date($type,$maket)
{
	$maket = str_replace('/','-',$maket);
	list( $jyear, $jmonth, $jday ) = preg_split ( '/-/', $maket );

	if (is_array($maket))
	{
		$jday=$maket['day'];
		$jmonth=$maket['month'];
		$jyear=$maket['year'];
	}
	
	
	list ( $year, $month, $day ) = jalali_to_gregorian($jyear, $jmonth, $jday);
	
	
	$date=mktime(0,0,0,$month,$day,$year);
	$date=date($type,$date);
	return $date;
}

/*
$today = date("F j, Y, g:i a");                 // March 10, 2001, 5:16 pm
$today = date("m.d.y");                         // 03.10.01
$today = date("j, n, Y");                       // 10, 3, 2001
$today = date("Ymd");                           // 20010310
$today = date('h-i-s, j-m-y, it is w Day z ');  // 05-16-17, 10-03-01, 1631 1618 6 Fripm01
$today = date('\i\t \i\s \t\h\e jS \d\a\y.');   // It is the 10th day.
$today = date("D M j G:i:s T Y");               // Sat Mar 10 15:16:08 MST 2001
$today = date('H:m:s \m \i\s\ \m\o\n\t\h');     // 17:03:17 m is month
$today = date("H:i:s");                         // 17:16:17
*/