<?php 

function getConnexion(){

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "restaurantdb";
    $connexion = null;

    try{
        $connexion = mysqli_connect($db_server,
                                $db_user,
                                $db_pass,
                                $db_name);
    }
    catch(mysqli_sql_exception $e){
        echo "Failed to connect! Retry"; 
    }
    return $connexion;
}

?>