<?php

// unix time
echo time() . "<br/>";

// formating date of 5 days later
echo date('d/m/y g:ia' , time() + 5 * 24 * 60 * 60 ) . '<br/>';

// get time zone
echo date_default_timezone_get() . '<br/>';

// setting time zone
date_default_timezone_set('UTC');


// making unix time
echo date('d/m/Y g:ia' , mktime(0 , 0 , 0 , 3 , 24 , 2002)) . '<br/>';


// make time from string
echo strtotime('2002-1-3 02:00:01') . '<br/>';