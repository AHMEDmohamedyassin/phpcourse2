<?php

namespace Classes;

use Classes\interfaces\{interfaceC , interfaceB};

// class Transaction extends Abstracting{
class Transaction implements interfaceB , interfaceC{
    public float $amount ;
    private $transaction;    // can only accessed inside class
    public const PAID_STATUS = 'paid';
    public static $count = 0; 

    public function __construct(float $amount , string $transaction){
        $this->amount = $amount;
        $this->transaction = $transaction;
        self::$count = self::$count + 1;

        echo '<br/> const PAID_STATUS : ' . self::PAID_STATUS . '<br/>';     // self is refering to the class
        echo 'the class has ' . self::$count . ' instances <br/>';
    }

    public function addTax($rate){
        $this->amount *= 1 + $rate / 100;
        return $this;                       // أنا هنا برجعله ال "كلاس" تاني بدل ما يرجع للتغير اللي متسجل ال "كلاس" بيه
    }
    
    public function discount($rate){
        $this->amount *= 1 - $rate / 100;
        return $this; 
    }
    
    public function getTransaction(){
        return $this->transaction;
    }

    public function __destruct()
    {
        // echo '<br/> class closed <br/>';
    }
}