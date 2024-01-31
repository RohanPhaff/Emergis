<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\CategoryHoursBudget;

class CategoryHoursBudgetTest extends TestCase
{
    
    public function testCategoryHoursBudget()
    {
        $inputManHours = "Afdeling1:33:ProjectA;Afdeling2:24:ProjectB;Afdeling3:46:ProjectA";
        $class = new CategoryHoursBudget();

        $result = $class::categoryBudget($inputManHours);

        echo $result['htmlManHoursDetails'];
        
        // Check if htmlManHoursDetails is generated correctly
        $expectedHtmlDetails =
            "Afdeling1: 33 uur <i>(ProjectA)</i><br>" .
            "Afdeling2: 24 uur <i>(ProjectB)</i><br>" .
            "Afdeling3: 46 uur <i>(ProjectA)</i><br>";

        $this->assertEquals($expectedHtmlDetails, $result['htmlManHoursDetails']);
    }
}