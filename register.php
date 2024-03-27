<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/register2.css" />
    <title>Inscription</title>
</head>
<body>
<?php
    include_once('Includes/link.php');
    include_once('Includes/function.php');
    ?>
<header>
    <nav>
        <img id="logo" src="Ressources/logo.png" alt="img">
    </nav>
</header>
<div>
    <img id="univ" src="Ressources/univ.png" alt="img">
</div>
<div id="bloc">
    <h1 id="inscription">INSCRIPTION</h1>
    <form action="register.php" method="post" id="form">
        <div>
            <?php
            $error_mail = valid_mail();
            if (($error_mail) != false){
                echo $error_mail . '<br>';
            }
            ?>
            </div>
            <input type="email" placeholder="E-mail" id="e-mail" name="email"><br>
            <div id="nom">
                <div>
                    <?php
                    $error_last_name = valid_last_name();
                    if (($error_last_name) != false){
                        echo $error_last_name . '<br>';
                    }
                    ?> 
                </div>
                <input type="text" placeholder="Nom" id="name" name="last_name">  
                <div>
                    <?php
                    $error_first_name = valid_first_name();
                    if (($error_first_name) != false){
                        echo $error_first_name . '<br>';
                    }
                    ?> 
                </div>
                <input type="text" placeholder="Prénom" id="first_name" name="first_name">  
            </div>
            <div>
                <?php
                $error_birth = valid_birth();
                if (($error_birth) != false){
                    echo $error_birth . '<br>';
                }
                ?>
            </div>
            <div>
                <input type="date" placeholder="Date de naissance" id="date" name="birth"><br>
            </div>
            <?php
                $error_password = valid_password();
                if (($error_password) != false){
                    echo  $error_password . '<br>';
                }
            ?>
                <input type="password" placeholder="Mot de passe" id="password" name="password"><br> 
            <div>
                <a id="dejinscrit" href="login.php">Déjà inscrit ?</a> 
                <input type="submit" value="S'incrire" id="sinscrire">
            </div>
        </div>
    </form>
</div>
<?php

    if((!valid_mail()) && (!valid_last_name()) && (!valid_first_name()) && (!valid_birth()) && (!valid_password())){
        $email = $_POST['email'];
        $last_name = $_POST["last_name"];
        $first_name = $_POST["first_name"];
        $birth = $_POST["birth"];
        $hashed_password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
        $query = "SELECT email FROM `user` WHERE email = '$email' LIMIT 1;";
        $result = $database->query($query);
        if ($result && $result->num_rows > 0) {
            echo "Cet e-mail est déjà utilisé. Veuillez en choisir un autre.<br>";
        }
        $query = "INSERT INTO user(email, first_name, last_name, birth_date, password) VALUES ('$email', '$first_name', '$last_name', '$birth', '$hashed_password')";
        if ($database->query($query) === TRUE) {
            session_start();
            $_SESSION['connected_user'] = $email;
            header('Location: index.php');
        }
    }

    ?>
</body>
</html>