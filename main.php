<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/31/16
 * Time: 6:53 PM
 */
require_once('AcademicYear.php');
require 'vendor/autoload.php';
$sessionCache = [];
$configData = parse_ini_file("data.ini",true);

foreach($configData as $k => $v){
    $sessionCache[$k] = new AcademicYear($configData[$k]);
}
// var_dump($sessionCache);
//
//$ac = array(
//    '2016/17' => array(
//        'start' => 'September 1',
//        "First trimester" =>"September 1 : October 28",
//        "Second trimester"=>"November 1 : January 20",
//        "Third trimester" =>"January 28 : April 19"
//    )
//);
//
//$a = new AcademicYear($ac);
//echo $a->getSession()."\n";
//echo $a->getStartDate()."\n";
//var_dump($a->getTerms());

//echo normalizeDate('12-06-2006');
/**
 * @param $date e.g dd-mm-yyyy
 */

if($argv[1]){
    $targetSession = null;
    foreach($sessionCache as $ac){
        if($ac->isWithin(normalizeDate($argv[1]))){
            $targetSession = $ac;
            break;
        }
    }
    if($targetSession){
      var_dump($targetSession);
    }else{
      echo "No session could be matched from the date supplied";
    }
}

/**
 * @param $date e.g dd-mm-yyyy
 * Change date from this format to e.g Semptember 23, 2016
 */

function normalizeDate($date){
    $dateSegment = explode('-',$date);
    if(checkdate($dateSegment[1],$dateSegment[0],$dateSegment[2])){
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
        return $months[(int)$dateSegment[1]]." ".$dateSegment[0].",".$dateSegment[2];
    }else{
        echo "Incorrect date, enter date in this format dd-mm-yyyy";
        exit;
    }


}
