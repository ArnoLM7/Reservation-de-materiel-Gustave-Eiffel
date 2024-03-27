<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Style/login2.css"/>
        <title>Connexion</title>
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
            <h1 id="connexion">CONNEXION</h1><br><br><br>
            <form action="login.php" method="post" id="form">
                <div>
                    <input type="text" placeholder="E-mail" id="e-mail" name="email"><br>
                </div>
                <input type="password" placeholder="Mot de passe" id="password" name="password"><br>
                <div>
                    <?php
                    $error_mail = valid_mail();
                    $error_password = valid_password();
                    if ($error_mail){
                        $error_login = 'Un des champs saisi est manquant ou incorrect';
                        echo $error_login . '<br>';
                    }
                    elseif($error_password){
                        $error_login = 'Un des champs saisi est manquant ou incorrect';
                        echo $error_login . '<br>';
                    }
                    ?>
                    <div>
                        <a href="register.php" id="sinscrire">S'inscrire</a>
                        <input type="submit" value="Se connecter" id="se-connecter">
                    </div>
                </div>
            </form>
        </div>
    <?php
        if(!valid_mail()){
            $email = $_POST['email'];
            $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $query = "SELECT email, password, is_admin FROM `user` WHERE email LIKE '$email' LIMIT 1;";
            $result = $database->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($_POST["password"], $row['password'])){
                    session_start();
                    $_SESSION['connected_user'] = $row['email'];
                    $_SESSION['admin'] = $row['is_admin'];
                    header('Location: index.php');
                }
            }
        }
    ?>
    </body>
</html>