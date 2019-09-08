<?php

namespace application\core;
use application\core\ConfigLoader;

interface DataBaseInt
{
    public static function connection();
}


final class DataBase implements DataBaseInt
{
    private static $instance;

    private function __construct()
    {
        $this->optionsPDO = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];
        $this->reviewResult = null;

        try{
            $this->link = new \PDO(
                'mysql:host=localhost;dbname=u0742966_default;charset=UTF8', 'u0742966_default', '7!RRuV0Y', $this->optionsPDO
            );
        }catch(\PDOException $exception){
            $this->link = new mysql('localhost', 'u0742966_default', '7!RRuV0Y', 'u0742966_default');
        }
    }

    public function query($query, $params, $return=NULL)
    {
        if( is_string($query) && is_array($params) && is_bool($return) ){
            $statement = $this->link->prepare($query);
            $statement->execute($params);

            if( $return == true ):
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            endif;
        }else{
            //TODO error
        }
    }

    public function select($query, $params)
    {
        if( is_string($query) && is_array($params) ){
            $statement = $this->link->prepare($query);
            $this->statement = $statement->execute($params);

            return $this;
        }else{
            //TODO errror
        }
    }

    public function insert($query, $params)
    {
        if( is_string($query) && is_array($params) && (($this->reviewResult == true) || (is_null($this->optionsPDO))) ){
            $statement = $this->link->prepare($query);
            $this->statement = $statement->execute($params);
        }else{
           //TODO errror
        }
    }

    public function update($query, $params)
    {
        if( is_string($query) && is_array($params) ){
            $statement = $this->link->prepare($query);
            $this->statement = $statement->execute($params);

            return $this;
        }else{
            //TODO errror
        }
    }

    public function delete($query, $params)
    {
        if( is_string($query) && is_array($params)  && ($this->reviewResult == false) ){
            $statement = $this->link->prepare($query);
            $this->statement = $statement->execute($params);

            return $this;
        }else{
            //TODO errror
        }
    }

    public function fetch($fetchMethod)
    {
        if( is_string($fetchMethod) ){
            switch ($fetchMethod):
                case 'assoc':
                    return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
                    break;
            endswitch;
        }else{
            //TODO error
        }
    }

    public function review($prepareType, $param)
    {
        if( is_string($prepareType) || is_array($param) ){
            $prepareQuery = ConfigLoader::prepare($prepareType) . $param;
            $statement = $this->link->query($prepareQuery);

            if( $statement->rowCount() === 0 ) {
                $this->reviewResult = true; //Future queres is opening.
            }else {
                $this->reviewResult = false; //Future queries is closed.
            }
            return $this;

        }else{
            //TODO error
        }
    }

    public static function connection()
    {
        if( self::$instance == NULL ):
            self::$instance = new self;
        endif;

        return self::$instance;
    }

    public function getInfo()
    {
        var_dump($this);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}

?>