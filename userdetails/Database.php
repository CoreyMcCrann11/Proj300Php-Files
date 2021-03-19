<?php
require "DatabaseConfig.php";

class Database
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $UserName;
    protected $Password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DatabaseConfig();
        $this->servername = $dbc->servername;
        $this->UserName = $dbc->UserName;
        $this->Password = $dbc->Password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->UserName, $this->Password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripcslashes(htmlspecialchars($data)));
    }

    function logIn($table, $UserName, $Password)
    {
        $username = $this->prepareData($UserName);
        $password = $this->prepareData($Password);
        $this->sql = "select * from " . $table . " where UserName = '" . $UserName . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['UserName'];
            $dbpassword = $row['Password'];

            if ($dbusername == $UserName && password_verify($Password, $dbpassword)) {
                $login = true;
            }else $login = false;
        }else $login = false;
        return $login;
    }
    function signUp($table, $UserName, $EmailAdd, $Password, $PreferedMartialArt, $FirstName, $LastName, $AddressOne, $AddressTwo, $AddressThree, $PhoneNumber)
    {
        $UserName = $this->prepareData($UserName);
        $EmailAdd = $this->prepareData($EmailAdd);
        $Password = $this->prepareData($Password);
        $Password = password_hash($Password, PASSWORD_DEFAULT);
        $PreferedMartialArt = $this->prepareData($PreferedMartialArt);
        $FirstName = $this->prepareData($FirstName);
        $LastName = $this->prepareData($LastName);
        $AddressOne = $this->prepareData($AddressOne);
        $AddressTwo = $this->prepareData($AddressTwo);
        $AddressThree = $this->prepareData($AddressThree);
        $PhoneNumber = $this->prepareData($PhoneNumber);



        $this->sql =
            "INSERT INTO " . $table . " (UserName, EmailAdd, Password, PreferedMartialArt, FirstName, LastName, AddressOne, AddressTwo, AddressThree, PhoneNumber) VALUES ('" . $UserName . "','" . $EmailAdd . "','" . $Password . "','" . $PreferedMartialArt . "','" . $FirstName . "','" . $LastName . "','" . $AddressOne . "','" . $AddressTwo . "','" . $AddressThree . "','" . $PhoneNumber . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        }else return false;
    }
}

?>