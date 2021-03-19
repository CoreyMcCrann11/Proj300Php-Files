<?php
require "DataBaseConfig.php";

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

    function sendMessage($table, $Sendernumber, $message, $receivernumber)
    {
        $Sendernumber = $this->prepareData($Sendernumber);
        $message = $this->prepareData($message);
        $receivernumber = $this->prepareData($receivernumber);

        $this->sql =
            "INSERT INTO " . $table . " (Sendernumber, message, receivernumber) VALUES ('" . $Sendernumber . "','" . $message . "','" . $receivernumber . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        }else return false;
    }
}

?>
