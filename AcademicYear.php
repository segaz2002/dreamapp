<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 5/31/16
 * Time: 8:14 PM
 */

class AcademicYear {
    private $session;
    private $terms = array();
    private $startDay;

    public function __construct($sessionData){
        $this->session = array_keys($sessionData)[0];
        foreach($sessionData as $k => $v){
            if($k == 'start'):
                $this->startDay = $v;
            else:
                $this->terms[$k] = $v;
            endif;
        }
    }

    public function getSession(){
        return $this->session;
    }

    public function getTerms(){
        return $this->terms;
    }

    public function getStartDate(){
        return $this->startDay;
    }

    public function getSessionFromDate($date){
        $date = new ExpressiveDate;
    }

    /**
     * Check wether a date fall between the terms of this academic year
     * @param $date
     * @return bool
     */
    public function isWithin($date){
        // echo $date."\n";
        $queryDate = new ExpressiveDate($date);
        // echo "--------------------------------";
        // echo $queryDate."\n";
        // echo "--------------------------------";
        foreach($this->terms as $term ){
            $termPeriod = explode(':',$term);
            $beginDate = new ExpressiveDate($termPeriod[0]);
            $endDate = new ExpressiveDate($termPeriod[1]);
            // echo $beginDate ."\n";
            // echo $endDate ."\n";
            // var_dump($queryDate->greaterOrEqualTo($beginDate) && $queryDate->lessOrEqualTo($endDate));
            if($queryDate->greaterOrEqualTo($beginDate) && $queryDate->lessOrEqualTo($endDate)){
                return true;
                break;
            }
        }
    }

}
