<?php
include('Pcalendar.php');
 $PC  = new \Pcalendar\Pcalendar();
 
 // $PC->set_month ( 7 );  در صورتیکه ماه خاصی را بخاهیم داشته باشیم 
  // $PC->set_year ( 1395 );  

 $calendar = $PC->days_in_month()  ;
 
 var_dump($calendar);

?>