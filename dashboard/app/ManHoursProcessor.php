<?php

namespace App;

class ManHoursProcessor
{
    public static function processManHours($manHours)
    {
        $manHours = explode(";", $manHours);
        $htmlManHoursDetails = "";
        $totalManHours = 0;

        if (!empty($manHours)) {
            foreach ($manHours as $manHour) {
                $parts = explode(":", $manHour);
                $totalManHours += (int) $parts[1];
                $htmlManHoursDetails .= $parts[0] . ": " . (int) $parts[1] . " uur <i>(" . $parts[2] . ")</i><br>";
            }
        }

        return ['htmlManHoursDetails' => $htmlManHoursDetails, 'totalManHours' => $totalManHours];
    }
}