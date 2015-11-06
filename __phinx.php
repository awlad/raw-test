<?php

$dbConfig = require_once "app/config/database.php";
$pdo = new \PDO('mysql:dbname='. $dbConfig['DB_NAME'].';host='. $dbConfig['DB_HOST'], $dbConfig['DB_USER'], $dbConfig['DB_PASS']);


return
    array(
        'paths' => array('migrations' => "app/config/migrations"),
        array(
            'environments' =>
                array(
                    'default_database' => 'abc',
                    'abc' => array(
                        'name' => $dbConfig['DB_NAME'],
                        'connection' => $pdo
                    )
            )
        )
    );
