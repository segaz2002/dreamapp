<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/31/16
 * Time: 6:53 PM
 */
require 'vendor/autoload.php';
require_once('AcademicYear.php');
require 'utility.php';
$sessionCache = [];
$configData = parse_ini_file("data.ini",true);

foreach($configData as $k => $v){
    $sessionCache[$k] = new AcademicYear($configData[$k]);
}
 //var_dump($sessionCache);

if(isset($argv[1])){
  var_dump(determineAcademicYear($argv[1]));
}

/**
* 4.1. Given a date (D), return the academic year object (AY) that this date lies on.
**/
function determineAcademicYear($date){
  global $sessionCache;
  $date = Util::normalizeDate($date);
  $matchedSession = null; //4.1.1
  foreach($sessionCache as $ac){
      if($ac->isWithin($date)){
          $matchedSession = $ac;
          break;
      }
  }
  return $matchedSession;
}

/**
* 4.3. Given the academic year (AY), return all the academic terms (AT) that belong to it.
**/
function getTerms($academicYear){
  global $sessionCache;
  $ay = $sessionCache[Util::normalizeAcademicYear($academicYear)];
  return $ay->getAcademicTerms();
}
//e.g
var_dump(getTerms('2015/16'));

/**
* 4.4. Given the academic term (AT), print it's name, e.g "Spring 2015/16"
* example input term will be --->  September 1, 2015 - December 8, 2015
**/
function describeTerm($term){

}
