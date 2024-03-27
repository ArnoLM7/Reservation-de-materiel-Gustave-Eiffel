<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/login2.css"/>
    <link rel="stylesheet" href="Style/utile.css"/>
    <title>Inscription</title>
</head>
<body>
<?php
include_once('Includes/link.php');
include_once('Includes/function.php');
?>
<header>
    <div id="container_header_global">

        <div id="container_header">
            <img id="logo" src="Ressources/logo.png" alt="img">
            <div class="lien_header">
                <a class="lien" href="index.php">Accueil</a>
            </div>
            <div class="lien_header">
                <a class="lien" href="reservation_request.php">Réservation de matériel</a>
            </div>
            <div class="lien_header">
                <a class="lien" href="reservation_list.php">Toutes les réservations</a>
            </div>
            <div class="lien_header">
                <a class="lien" href="validation.php">En cours de validation</a>
            </div>
            <form action="index.php" method="post" id="recherche">
                <input type="text" placeholder="Recherche" id="recherche" name="recherche"><br>
            </form>
            <div class="lien_header">
                <a class="lien" href="logout.php">Déconnexion</a>
            </div>
        </div>
    </div>
</header>
<div>
<img id="univ" src="Ressources/univ.png" alt="img">
</div>
<div id="bloc">
    <h1 id="connexion">AJOUT DE MATERIEL</h1>
    <form action="register_material.php" method="post" id="form">
        <input type="text" placeholder="Nom" class="form-field" name="name"><br>
        <?php
        $error_name = valid_name();
        if (($error_name) != false){
            echo $error_name . '<br>';
        }
        ?>
        <input type="text" placeholder="Type" class="form-field" name="type"><br>
        <?php
        $error_type = valid_type();
        if (($error_type) != false){
            echo $error_type . '<br>';
        }
        ?>
        <input type="text" placeholder="Référence" class="form-field" name="reference"><br>
        <?php
        $error_reference = valid_reference();
        if (($error_reference) != false){
            echo $error_reference . '<br>';
        }
        ?>
        <input type="text" placeholder="Description" class="form-field" name="description"><br>
        <?php
        $error_description = valid_description();
        if (($error_description) != false){
            echo $error_description . '<br>';
        }
        ?>
        <input type="submit" id="sinscrire" value="Créer le magnifique matériel">
    </form>
</div>
<?php
/**
 * Nom
 * Type (Liste déroulante)
 * Référence
 * Description (Zone de texte)
 */
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
if (isset($_POST['reference'])) {
    $reference = $_POST['reference'];
}
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}

if (isset($name) && $name != "" &&
isset($type) && $type != "" &&
isset($reference) && $reference != "" &&
isset($description) && $description != ""
){
    $query = "INSERT INTO `material`(`name`, `type`, `reference`, `description`) VALUES ('$name','$type','$reference','$description');";
    $result = $database->query($query);
    if ($result == TRUE) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_sassoc();
            $row['id'] = $_SESSION['id'];
        }
        header('Location: index.php');
    } 
}

?>
</body>
</html>