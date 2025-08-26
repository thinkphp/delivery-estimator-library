<?php
// Add this RIGHT AFTER your database connection code in item-detail.php

function generateDeliveryInterval($minDays = 1, $maxDays = 14, $skipWeekends = true) {
    $start = new DateTime();
    
    // Calculate minimum delivery date (starting tomorrow)
    $minDate = clone $start;
    $minDate->add(new DateInterval('P1D')); // Start from tomorrow
    
    // Calculate maximum delivery date 
    $maxDate = clone $start;
    if ($skipWeekends) {
        // Add business days only
        $daysAdded = 0;
        while ($daysAdded < $maxDays) {
            $maxDate->add(new DateInterval('P1D'));
            
            if ($maxDate->format('N') < 6) { // Monday = 1, Sunday = 7
            
                $daysAdded++;
            }
        }
    } else {
        $maxDate->add(new DateInterval('P' . $maxDays . 'D'));
    }
    
    // Format dates - show day and date
    $minFormatted = $minDate->format('D, j'); // Thu, 27
    
    $maxFormatted = $maxDate->format('D, M j'); // Thu, Sep 9
    
    return "Est. delivery " . $minFormatted . " - " . $maxFormatted;
}

// Test the function (you can remove this after testing)
 echo generateDeliveryInterval(); // Will show: "Est. delivery Tue, 27 - Thu, Sep 12"
?>
