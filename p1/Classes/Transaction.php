<?php

namespace Classes;

use Classes\interfaces\{interfaceC , interfaceB};
use Classes\traits\traitA;

// class Transaction extends Abstracting{
class Transaction implements interfaceB , interfaceC{

    use traitA;
    // use traitB;
    // use traitC;

    public float $amount ;
    private $transaction;    // can only accessed inside class
    public const PAID_STATUS = 'paid';
    public static $count = 0; 

    public function __construct(float $amount , string $transaction){

        if(!in_array(gettype($amount) , ['float' , 'int' , 'double'])){
            throw new \Exception('error in object type type');
        }

        $this->amount = $amount;
        $this->transaction = $transaction;
        self::$count = self::$count + 1;

        echo '<br/> const PAID_STATUS : ' . self::PAID_STATUS . '<br/>';     // self is refering to the class
        echo 'the class has ' . self::$count . ' instances <br/>';
    }

    /**
     * @param float|int $rate
     * 
     * @return Transaction instance
     */
    public function addTax($rate){
        $this->amount *= 1 + $rate / 100;
        return $this;                       // أنا هنا برجعله ال "كلاس" تاني بدل ما يرجع للتغير اللي متسجل ال "كلاس" بيه
    }
    
    public function discount($rate){
        $this->amount *= 1 - $rate / 100;
        return $this; 
    }
    
    // ****** from trait *****//
    // public function getTransaction(){
    //     return $this->transaction;
    // }

    public function __destruct()
    {
        // echo '<br/> class closed <br/>';
    }


    /**
     * @method __sleep() return array contains name of properties needed to be serialize , if __sleep() not used all properties will be serialized
     * @method __serialize() return array contains name and value of properties needed to be serialize , if __serialize() not used all properties will be serialized
     * if __sleep() and __serialize() methods found in class the __serialize() method has the priority to launch
     * 
     * 
     * @method __unserialize() use array as an argument of properites that is unserialized
     * @method __wakeup() launched after the object is unserialize
     */
    public function __sleep()
    {
        return ['amount' , 'transaction'];
    }
    
    public function __wakeup()
    {
    }

    public function __serialize(): array
    {
        return [
            'transaction' => $this->transaction,
            'amount' => $this->amount,
        ];
    }

    public function __unserialize(array $data): void
    {
        echo '<br/>from __unserialize() method : <br/> <pre>';
        var_dump($data);
        echo '<pre/> <br/>';
    }
}