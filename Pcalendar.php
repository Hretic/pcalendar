<?php
namespace Pcalendar;

require_once('jdate.php');


class Pcalendar{

    private $start_year ;
    private $end_year ;
    private $year ;
    private $month ;

    function __construct()
    {
        $this->start_year = jdate(date('Y-m-d') , 'Y');
        $this->end_year   = $this->start_year - 10 ;
        $this->year = $this->start_year;
        $this->month = jdate(date('Y-m-d') , 'm');
    }


    function years(){
        $export = [];

        for($i=$this->start_year ; $i>= $this->end_year ; $i-- )
        {
            $export[] = $i;
        }
        return $export ;
    }

    function months( ){

        return monthArr($this->year);
    }

    function days_in_month(){
 
        $raw_date =  jmaketime( 11 , 11  , 11 , $this->month , 1 ,  $this->year  );
        $mdate = date( 'Y-m-d'  ,  $raw_date );
        $base_month  = jdate($mdate , 'm');
        $i = 1 ;
        $inside_range = $export = [];
        
        $day_in_week_convertor = [0=>1 , 1=>2 , 2=>3 , 3=>4 , 4=>5 , 5=>6 , 6=>0 ];
        $base_weekday = $day_in_week_convertor[date( 'w'  ,  $raw_date )];




        for($w=1 ; $w<=5;$w++)
        {
            foreach(weekdays() as $weekday_num =>$weekday_title )
            {
                if( $w ==1 && $weekday_num < $base_weekday)
                {
                    $export[] = [
                        'outofrange' => true  ,
                        'weekday_number' => $weekday_num ,
                        'weekday_title' => $weekday_title ,
                    ];
                    continue;
                }

                $mdate = date( 'Y-m-d'  ,  jmaketime( 0 , 0  , 0 , $this->month , $i ,  $this->year  ));
                $this_month  = jdate( $mdate , 'm' );
                if($this_month == $base_month )
                {
                    $export[] = [
                        'outofrange' => false  ,
                        'weekday_number' => $weekday_num ,
                        'weekday_title' => $weekday_title ,
                        'day'   => jdate( $mdate , 'd' ) ,
                        'month' => jdate( $mdate , 'm' ) ,
                        'year'  => jdate( $mdate , 'Y' ) ,
                        'date'  => jdate( $mdate , 'Y-m-d' ) ,
                        'mdate'  =>  $mdate  ,
                    ];
					$inside_range[] = $mdate;
                }
                else
                {
                    $export[] = [
                        'outofrange' => true  ,
                        'weekday_number' => $weekday_num ,
                        'weekday_title' => $weekday_title ,
                    ];
                }
                $i++;
            }
        }
		$start_date = $inside_range[0];
		$end_date   = end($inside_range);
		
		if($this->month - 1 < 1 )
		{
			$prev_date = ['date' => ($this->year - 1) . '/12'   , 'year' => $this->year - 1 , 'month'=>12 , 'month_name'=> monthname(12)];
		}
		else
		$prev_date = ['date' =>$this->year. '/' . ($this->month - 1 )   , 'year' => $this->year , 'month'=>$this->month - 1 , 'month_name'=> monthname($this->month - 1)]; 

		if($this->month +1 > 12  )
		{
			$next_date =   ['date' =>$this->year + 1 . '/1'  , 'year' => $this->year + 1 , 'month'=>1 , 'month_name'=> monthname(1)]  ;
		}
		else
			$next_date =   ['date' =>$this->year. '/' .( $this->month + 1 ) , 'year' => $this->year  , 'month'=>$this->month + 1  , 'month_name'=> monthname($this->month + 1 )]  ;  
		

		
        return  ['start_date'=> $start_date , 'end_date'=>$end_date , 'prev_date'=> $prev_date, 'next_date'=>$next_date ,  'calander'=> $export , 'current_month'=>monthname($this->month)];
    }

    function set_year_range( $start = 0 , $end = 0  ){

        if(!is_numeric($start) || !is_numeric($end))
            $this->error(" years should be numeric ! ");
        if($start <=  $end )
            $this->error(" starting year should be bigger than end year ");

        $this->start_year = $start;
        $this->end_year = $end;


    }

    function set_year( $year = 0 ){

        if(!is_numeric($year))
            $this->error(" year should be numeric ! ");
        $this->year = $year;

    }
    function set_month( $month = 0 ){

        if(!is_numeric($month))
            $this->error(" month should be numeric ! ");
        if($month > 12 || $month < 1 )
            $this->error("out of range month selected");
        $this->month = $month;
    }


    private function error($msg){
        exit($msg);
    }
}