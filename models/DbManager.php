<?php

class DbManager
{
    protected function dbConnect()
    {

        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'dbuser', '');
        return $db;
    }
}

