<?php
/**
 * @version     $id: date.php
 * @package     Molajo
 * @subpackage  Helper
 * @copyright   Copyright (C) 2011 Amy Stephen. All rights reserved.
 * @license     GNU General Public License Version 2, or later http://www.gnu.org/licenses/gpl.html
 */
defined('MOLAJO') or die();

class MolajoHelperDate {

    /**
     * convertCCYYMMDD
     * @param date $date
     * @return string CCYY-MM-DD
     */
    function convertCCYYMMDD ($date)
    {
        return substr($date, 0, 4).'-'.substr($date, 5, 2).'-'.substr($date, 8, 2);
    }

    /**
     * datediff
     * @param $date1 string expressed as CCYY-MM-DD
     * @param $date2 string expressed as CCYY-MM-DD
     * returns integer difference in days
     */
    function differenceDays ($date1, $date2)
    {
       $day1mm = substr($date1, 5, 2);
       $day1dd = substr($date1, 8, 2);
       $day1ccyy = substr($date1, 0, 4);
       $gregdate1 = gregoriantojd ( $day1mm, $day1dd, $day1ccyy );

       $day2mm = substr($date2, 5, 2);
       $day2dd = substr($date2, 8, 2);
       $day2ccyy = substr($date2, 0, 4);
       $gregdate2 = gregoriantojd ( $day2mm, $day2dd, $day2ccyy );

       return $gregdate1 - $gregdate2;
    }

    /**
     * buildCalendar
     * @param string $month
     * @param string $year
     * @param string $year
     * @return string CCYY-MM-DD
     *
     * $dateComponents = getdate();
     * $month = $dateComponents['mon'];
     * $year = $dateComponents['year'];
     * echo MolajoHelperDate::buildCalendar ($month,$year,$dateArray);
     */
    function buildCalendar ($month, $year, $dateArray)
    {
        $daysOfWeek = array('S','M','T','W','T','F','S');
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
        $numberDays = date('t',$firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];

        $calendar = "<table class='calendar'>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";
        foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header'>$day</th>";
        }

        $currentDay = 1;
        $calendar .= "</tr><tr>";
        if ($dayOfWeek > 0) {
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
        }

        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
        while ($currentDay <= $numberDays) {
          if ($dayOfWeek == 7) {
               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";
          }
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          $calendar .= "<td class='day' rel='$date'>$currentDay</td>";
          $currentDay++;
          $dayOfWeek++;
        }

        if ($dayOfWeek != 7) {
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
        }

        $calendar .= "</tr>";
        $calendar .= "</table>";

        return $calendar;
    }
}