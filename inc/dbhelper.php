<?php



class Database

{

    var $host="";

    var $user="";

    var $password="";

    var $database="";

    var $result="";

    var $con="";

    var $sql="";

    

    function Database()

    {

        $conf=new Config();

        

    

        $this->host=$conf->host;

        $this->user=$conf->user;

        $this->password=$conf->password;

        $this->database=$conf->database;

    }

    

    function open()

    {

        /*$this->con=@mysql_connect($this->host,$this->user,$this->password);

        if(!$this->con)

        {

        header("Location:error.html");

        return false;

        }

             

        if(!@mysql_select_db($this->database,$this->con))

        {

        header("Location:error.html");

        return false;

        }

        return true;*/

        

        $this->con=@mysqli_connect($this->host,$this->user,$this->password,$this->database); 

        

        if(@mysqli_connect_errno())

        {

            header("Location:error.html");

            return false;

        }

        return true;

    }

    

    function query($sql='')

    {

        /*$this->result=@mysql_query($sql,$this->con);

        return $this->result;*/

        

        $this->result=@mysqli_query($this->con,$sql);

        return $this->result;

    }

    

    function fetchobject($result)

    {

       //return @mysql_fetch_object($result);

       return @mysqli_fetch_object($result);

    }

    

    function fetcharray($result)

    {

        //return @mysql_fetch_array($result);

        return @mysqli_fetch_array($result,MYSQLI_BOTH); 

    }

    

    function fetchAssoc()

    {

        //return (@mysql_fetch_assoc($this->result));

        return (@mysqli_fetch_assoc($this->result));

    }

    

    function affectedRows()

    {

        //return (@mysql_affected_rows($this->con));

        return @mysqli_affected_rows($this->con);

    }
    
    function num_of_rows($result)
    {
        return @mysqli_num_rows($result);
    }
    
    
    function insertID()

    {

        //return (@mysql_insert_id());

        return @mysqli_insert_id($this->con);

    }
    

    function lastinsered()

    {

        //return (@mysql_insert_id());

        return @mysqli_insert_id($this->con);

    }

}



?>