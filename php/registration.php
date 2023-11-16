<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../images/market.png" type="image/x-icon">
    <title>M-restau registration</title>
</head>
<body>
    <form action="../php/registration.php" method="post">
        <h1>M-Restau</h1>
        <div class="registration">
            <label>username <i class="fa-solid fa-user"></i>: </label>  
            <input type="text" name="username"><br>
            <label>E-mail <i class="fa-solid fa-envelope"></i>:</label>
            <input type="email" name="email"><br>
            <label>password <i class="fa-solid fa-lock"></i>: </label>
            <input type="password" name="password"><br>
            <button class="registration_button" name="Registred">Register</button><br>
           <p>Already a member?</p><br>
           <a href="./signin.html">sign in</a>
        </div>
    </form>
</body>
</html>

<?php 
    include("database.php");

    if(isset($_POST["Registred"])){ 

        $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
        $connexion = getConnexion();
        
        if(empty($username)){
            echo "No username, please retry";
        }
        elseif(empty($password)){
            echo "No password, please retry";
        }
        elseif(empty($email)){
            echo "No e-mail, please retry";
        }
        else{
            $hash = password_hash($password,PASSWORD_DEFAULT);
            //connexion a la base de donnee
            $sql = "INSERT INTO users(user,password)
                    VALUES ('$username', '$hash')";

                try{
                    if(mysqli_query($connexion, $sql)){
                        echo "You are now registered as $username";
                        header("Location:../html/order.html");
                        exit();
                    }
                    else{
                        echo "Error: " . mysqli_error($connexion);
                    }
                }
                catch(mysqli_sql_exception $e){
                    echo "Invalid because it's already taken";
                }
                finally{
                    mysqli_close($connexion);
                }
        }
        
    }
    
    ?>