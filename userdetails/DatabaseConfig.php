<?php
class DatabaseConfig
{
    public $servername;
    public $UserName;
    public $Password;
    public $databasename;

    public function __construct()
    {
        $this->servername = 'localhost';
        $this->UserName = 'root';
        $this->Password = '';
        $this->databasename = 'logininformation';
    }
}

?>