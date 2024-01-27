<?php

namespace App\Controllers;

use PDO;

class DBController{ 
    protected $DB;
    
    public function __construct (){
        try{
            $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset=utf8mb4';
            $DB = new PDO(
                $dsn ,  
                $_ENV['DB_USERNAME'] , 
                $_ENV['DB_PASSWORD'] , 
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ] ); // array is optional parameters علشان تحسن المنظر 

            $DB->query("
                CREATE TABLE IF NOT EXISTS users(
                    email varchar(255) UNIQUE NOT NULL,
                    name varchar(255) NOT NULL,
                    is_active boolean DEFAULT 0 NOT NULL,
                    created_at datetime ,
                    KEY `is_active`(`is_active`)
                )
            ");

            $DB->query("
                    ALTER TABLE users ADD COLUMN IF NOT EXISTS id int UNSIGNED PRIMARY KEY AUTO_INCREMENT 
            ");

            $DB->query("
                CREATE TABLE IF NOT EXISTS invoices(
                    id int UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
                    amount decimal(10,4) NOT NULL,
                    user_id int UNSIGNED NOT NULL ,
                    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
                )
            ");
            /**
             * decimal(10 , 4)      -> means that we have 6 numbers before decimal and 4 numbers after decimal as : 123456.1234
             */

            $this->DB = $DB;
            
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }

    public function index () {

        $usersDescribe = $this->DB->query('describe users ');
        $invoicesDescribe = $this->DB->query('describe invoices ');

        echo 'users table : <pre>';
        print_r($usersDescribe->fetch());
        print_r($invoicesDescribe->fetch());
        echo '</pre>';
    }

    public function insert(){
        var_dump($_GET);
        $name = $_GET['name'];
        $email = $_GET['email'] . random_int(1 , 10000);
        $date = date('Y-m-d h:i:s' , time());

        $stmt = $this->DB->prepare('INSERT INTO users (name , email , created_at) VALUES (:name , :email , :created_at) ');

        // $stmt->execute([
        //     ':name' => $name,
        //     ':email' => $email,
        //     ':created_at' => $date,
        // ]);
        
        // this method can be used for looping
        $stmt->bindValue('name' , $name );
        $stmt->bindValue('email' , $email );
        $stmt->bindValue('created_at' , $date );
        $stmt->execute();

        $user_id = $this->DB->lastInsertId();
        
        $user_data = $this->DB->query('SELECT * FROM users where id = ' . $user_id)->fetch();
        
        echo '<pre>';
        print_r($user_data);
        echo '<pre/>';
    }

    public function get(){
        echo 'get <br/> <pre>';

        /**
         * method 1 problem : 
         *      is sql injection by applying this url in state of @var queryA : https://domain.com?email=ahmed@ahmed.com"+OR+1=1+--+
         *      +     sign is used as space مسافة
         *      --    is used to ignore the other query 
         * 
         * method 2 : is safe from sql injection
         */
        
        try{
            // // method 1
            $queryA = 'SELECT * FROM users WHERE email = "' . $_GET['search'] . '"';
            $queryB = 'SELECT * FROM users WHERE name NOT LIKE "%'.$_GET['search'].'%" ';
            $queryC = 'SELECT * FROM users WHERE name LIKE "'.$_GET['search'].'%" ';          // start with search text
            $queryD = 'SELECT * FROM users WHERE name LIKE "%'.$_GET['search'].'" ';          // end with search text
            $queryE = 'SELECT * FROM users WHERE name LIKE "%'.$_GET['search'].'%" LIMIT 2';            // start and end with search text
            // $stmt = $this->DB->query($queryE);
        
            
            // // method 2
            $queryF = 'SELECT * FROM users WHERE email = :email';
            $stmt = $this->DB->prepare($queryF);
            $stmt->execute([
                ':email' => $_GET['search']
            ]);
            $queryG = 'SELECT * FROM users WHERE email LIKE :search or name LIKE :search';
            $stmt = $this->DB->prepare($queryG);
            $stmt->execute([
                ':search' => '%'.$_GET['search'] . '%'
            ]);

            print_r($stmt->fetchAll());
        }catch(\Exception $e){}

        echo '<pre/> the query string : ' . $queryG;
    }
    

    public function update () {
        $stmt = $this->DB->prepare('UPDATE users SET email = :email WHERE id = :id');
        $stmt->execute([
            ':email' => $_GET['email'],
            ':id' => $_GET['id'],
        ]);
        
        print_r($this->DB->query('SELECT * FROM users WHERE id = ' . $_GET['id'])->fetch());
    }
    
    public function delete(){
        try{
            $stmt = $this->DB->prepare('DELETE FROM users WHERE id = :id');
            $stmt->execute([
                ':id' => $_GET['id'],
            ]);
    
            echo 'deleted';
        }catch(\Exception $e){
            echo 'error';
        }
    }

    public function relationInsert(){
        $stmt = $this->DB->query('insert into invoices (amount , user_id) values (25 , 1) , (100 , 1) , (300 , 19) ');
        $stmt->execute();
    }

    public function relationGet(){
        echo '<pre>';
        try{
            $stmt = $this->DB->query('SELECT invoices.id , name , email , amount  
            FROM invoices 
            INNER JOIN users ON users.id = user_id
            WHERE amount < 100 ');
            print_r($stmt->fetchAll());
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        echo '<pre/>';
    }

    public function droptable(){
        try{
            $stmt = $this->DB->query('DROP TABLE ' . $_GET['table'] )->execute();
            echo 'success'; 
        }catch(\Exception $e){
            echo 'error';
        }
    }

    /**
     * transaction means the all proccess done at same time if one process failed all processes will not executed
     */

    public function transaction(){
        $name = 'ahmed mohamed';
        $email = 'ahmed@gamidl.com';
        $amount = 100;

        try{
            $this->DB->beginTransaction();

            $this->DB->prepare('INSERT into users (name , email , created_at) VALUES (:name , :email , NOW()) ')->execute([':name' => $name , ':email' => $email]);
            $id = $this->DB->lastInsertId();

            // throw new \Exception('testing');
            
            $this->DB->prepare('INSERT into invoices (user_id , amount) VALUES (:user_id , :amount) ')->execute([':user_id' => $id , ':amount' => $amount]);
        
            $this->DB->commit();
        }catch(\Exception $e){
            echo $e->getMessage();
            if($this->DB->inTransaction()){
                $this->DB->rollBack();
            }
        }

    }
}