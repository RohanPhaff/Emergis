<?php

namespace App;

class CategoryHoursBudget
{
    public static function categoryBudget($manHours)
    {
        $manHours = explode(";", $manHours);
        $htmlManHoursDetails = "";
        if (!empty($manHours)) {
            foreach ($manHours as $manHour) {
                $htmlManHoursDetails .= (explode(":", $manHour)[0] . ": " . (int) explode(":", $manHour)[1] . " uur <i>(" . explode(":", $manHour)[2] . ")</i><br>");
            }
        }
        
        return ['htmlManHoursDetails' => $htmlManHoursDetails];
    }
}