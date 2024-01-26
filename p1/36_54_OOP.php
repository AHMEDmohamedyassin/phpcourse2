<?php
// require_once './Classes/Transaction.php';

//***** custom autoloader instead of require classess manually  ****/
// spl_autoload_register(function($class) {
//     $path = __DIR__ . '/' . str_replace('\\' , '/' , $class) . '.php';

//     if(file_exists($path))
//         require $path;
// });


//***** composer autoload  ****/
require __DIR__ . '/vendor/autoload.php';


//***** namespace  ****/
use Classes\Transaction as Trans;


//***** transaction class without shain  ****/

// $transaction = new Trans(100 , 'transaction 1');
// $transaction->addTax(10);
// $transaction->discount(8);
// echo $transaction->amount . '<br/>' . $transaction->getTransaction() . '<br/>';


//***** transaction class with shain  ****/

$transaction = (new Trans(100 , 'transaction 1'))->addTax(10)->discount(8);

echo $transaction->amount . '<br/>'
 . $transaction->getTransaction()
 . '<br/> the const PAID_STATUS : ' . Trans::PAID_STATUS . '<br/>' // --->> using scope operator :: to access [public const and public static] because it not associated with object it is associated with class it self
 . '<br/> the static properity :  ' . Trans::$count . '<br/>';

$id = new \Ramsey\Uuid\UuidFactory();
echo $id->uuid4() . '<br/>';



echo PHP_EOL; // makes new line in terminal
// echo 'ahmed'; 



/**
 * serialize : used to convert object to string with its methods and property state to be stored in database
 * unserialize : used to get serialized object from database to make object with its same property and method state 
 */
$serialized = serialize($transaction);
 echo '<br/> serialized object : ' . $serialized . '<br/>';

 $unserialize_object = unserialize($serialized);



 /**
  * @exception
  */

  try{
      $transA = new Trans('transaction' , 'tarsaction');
  }catch(\Exception $e){
    throw $e->getMessage() . $e->getLine();
  }finally{
    echo 'done';
  }