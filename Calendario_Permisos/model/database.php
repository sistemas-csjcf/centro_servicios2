<?php
class Database
{
    public static function StartUp(){
        $pdo = new PDO('mysql:host=localhost;dbname=centro_servicios2;charset=utf8', 'root', 'servicios2017');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        $pdo->query("SET NAMES 'utf8'");
        return $pdo;
    }
}