<?php
 
class Db
{
    private static $db;
     
    public static function init()
    {
        if (!self::$db)
        {
            try {
               
                self::$db = new PDO('mysql:dbname=commerce;host=localhost','root', '');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Connection error: ' . $e->getMessage());
            }
        }
        return self::$db;
    }
}