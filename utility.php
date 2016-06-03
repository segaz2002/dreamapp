<?php
Class Util{

  /**
   * Change date from this format to e.g Semptember 23, 2016
   * @param string $date e.g yyyy-mm-dd
   * @return string
   */

  static function normalizeDate($date){
      $dateSegment = explode('-',$date);
      if(checkdate($dateSegment[1],$dateSegment[2],$dateSegment[0])){
          $months = array(
              1 => "January",
              2 => "Febuary",
              3 => "March",
              4 => "April",
              5 => "May",
              6 => "June",
              7 => "July",
              8 => "August",
              9 => "September",
              10 => "October",
              11 => "November",
              12 => "December");
          return $months[(int)$dateSegment[1]]." ".$dateSegment[2].",".$dateSegment[0];
      }else{
          echo "Incorrect date, enter date in this format dd-mm-yyyy";
          exit;
      }
  }

  /**
   * @param string $academicYear e.g 2015/16
   * @return string e.g 2015/2016
   */

  static function normalizeAcademicYear($academicYear){
    $yearSegment = explode("/",$academicYear);
    $normalizedYear = '';
    foreach ($yearSegment as $year) {
      $normalizedYear .= date('Y',strtotime($year.'-01-01')).'/';
    }
    return substr($normalizedYear,0,strlen($normalizedYear)-1);
  }
}


?>
