<?php
        //database and user configuration
        $db['server'] = 'localhost';
        $db['username'] = 'root';
        $db['password'] = 'root';
        $db['database'] = 'cms';

        //converting each key from array db to CONSTANT
        foreach($db as $key => $value){
            define(strtoupper($key), $value);
        }


        //database connection using mysqli_connet
        $conn =  mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);


        //stops the program and throw an error is not connected
        if(!$conn){
            die("not conncted".mysqli_error());
        }

       



















?>