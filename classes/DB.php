<?php

/**
 * Created by PhpStorm.
 * User: mehedi
 * Date: 1/2/17
 * Time: 6:54 PM
 */
class DB
{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;


    private function __construct()
    {
        try{
            $this->_pdo = new PDO('mysql:host = ' . Config::get('mysql/host') . ';dbname = ' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));

        }catch (PDOException $e){
            die($e->getMessage());
        }
    }


    public function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new DB();
        }

        return self::$_instance;
    }


    public function query($sql, $parms = array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;

            if (count($parms)){
                foreach ($parms as $parm){
                    $this->_query->bindValue($x, $parm);
                    $x++;
                }
            }
            var_dump($this->_query);
            echo "<br> $x";

            if ($this->_query->execute()){
                echo "success.";
            }

        }
    }
}