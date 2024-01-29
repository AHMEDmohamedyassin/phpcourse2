<?php

namespace App\Controllers;

use Generator;

class GeneratorController{

    /**
     * generator used to loop very large array and saving memory use
     */
    
    public function index()
    {
        // $numbers = range(0 , 300); // this makes memory cashes
        $numbers = $this->lazyRange(0 , 3);

        echo $numbers->current();
        $numbers->next();

        echo $numbers->current();
        $numbers->next();
        
        echo $numbers->current();
        $numbers->next();

        echo $numbers->getReturn();      // getting the return value if the itterator not ended it will return error
        
        // foreach($numbers as $key => $val){
        //     echo 'key : ' . $key . ' , value : ' . $val + 1 . ' <br/>';
        // }
        
    }

    public function lazyRange(int $start , int $end) : Generator {

        echo '<br/> starting <br/>';

        for($i = $start ; $i < $end ; $i++){
            yield $i;
        }

        return '<br /> end';
    }
}