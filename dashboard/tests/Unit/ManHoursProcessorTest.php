<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\ManHoursProcessor;

class ManHoursProcessorTest extends TestCase
{
    public function testProcessManHours()
    {
        $inputManHours = "Task1:3:ProjectA;Task2:2:ProjectB;Task3:4:ProjectA";
        $class = new ManHoursProcessor();

        $result = $class::processManHours($inputManHours);

        // Check if totalManHours is calculated correctly
        $this->assertEquals(9, $result['totalManHours']);

        // Check if htmlManHoursDetails is generated correctly
        $expectedHtmlDetails =
            "Task1: 3 uur <i>(ProjectA)</i><br>" .
            "Task2: 2 uur <i>(ProjectB)</i><br>" .
            "Task3: 4 uur <i>(ProjectA)</i><br>";

        $this->assertEquals($expectedHtmlDetails, $result['htmlManHoursDetails']);
    }
}