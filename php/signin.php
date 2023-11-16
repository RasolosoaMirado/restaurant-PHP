<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="shortcut icon" href="../images/market.png" type="image/x-icon">
    <title>Sign in</title>
</head>
<body>
    <form action="../php/signin.php" method="post">
        <h1>M-Restau</h1>
        <div class="signin">
            <label>username <i class="fa-solid fa-user"></i>: </label>  
            <input type="text" name="username"><br>
            <label>E-mail <i class="fa-solid fa-envelope"></i>:</label>
            <input type="email" name="email"><br>
            <label>password <i class="fa-solid fa-lock"></i>: </label>
            <input type="password" name="password"><br>
           <a href="../html/index.html">
            <button class="signin_button" name="signed">Submit</button>
           </a><br>
           <p>Don't have account?</p><br>
           <a href="../html/registration.html">Register</a>
        </div><br>
    </form>
</body>
</html>
<?php 
    include("database.php");
?>

<?php 
    if(isset($_POST["signed"])){
        $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
        $connexion = getConnexion();

        if(empty($username)){
            echo "No username, please retry <br>";
        }
        elseif(empty($password)){
            echo "No password, please retry <br>";
        }
        elseif(empty($email)){
            echo "No e-mail, retry <br>";
        }
        else{
            $sql = "SELECT * FROM users WHERE user = '$username'";
            $result = mysqli_query($connexion, $sql);

            if(mysqli_num_rows($result) == 1){//to check if the query result returned exactly one row from the database.
                $row = mysqli_fetch_assoc($result);// extraire le resultat sous forme de tableau associatif//mitady
                $hashedPassword = $row["password"];

                if(password_verify($password, $hashedPassword)){
                    echo "Sign in successful. Welcome, $username!";
                    header("Location: ../html/order.html");
                        exit();
                    // Additional code for session management or other actions after successful sign-in
                }
                else{
                    echo "Invalid password. Please retry.";
                }
            }
            else{
                echo "Username not found. Please retry.";
            }
        }
    }
    if (isset($connexion)) {
        mysqli_close($connexion);
    }
            
?>