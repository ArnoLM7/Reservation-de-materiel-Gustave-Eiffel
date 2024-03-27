<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/reservation.css"/>
    <link rel="stylesheet" href="Style/utile.css"/>
    <title>Demande de réservation</title>
</head>
<body>

<?php
include_once('Includes/link.php');
include_once('Includes/function.php');
@session_start();
if (!$_SESSION['connected_user']) {
    header('Location: login.php');
}else{
    echo'
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
                <div class="lien_logout">
                <a class="lien" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </header>
    <div>
        <img id="univ" src="Ressources/univ.png" alt="img">
    </div>
    <div id="bloc">
        <h1 id="connexion">Réservation de matériel</h1>
        <form action="reservation_request.php" method="post" id="form">
        <select id="selection" class="champs_info" name="wanted_material" required="required">';
    //option
        $query_material = "SELECT name, id FROM `material`";
        $result = $database->query($query_material);
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $name = $row['name'];
            echo '<option value="' . $id .'">' .  $name . ':' . $id .'</option>';
        }
        echo'</select>
            <span id="datedf">Début</span>
            <input id="password" type="date" placeholder="Date de début" class="form-field" name="begin_date"><br>
            <span id="datedf">Fin</span>
            <input id="password" type="date" placeholder="Date de fin" class="form-field" name="end_date"><br>
            <input id="reserver" type="submit" value="Réserver le magnifique matériel">
        </form>
    </div>';
    
    if (isset($_POST['wanted_material'])) {
        $wanted_material = $_POST['wanted_material'];
    }
    if (isset($_POST['begin_date'])) {
        $begin_date = $_POST['begin_date'];
    }
    if (isset($_POST['end_date'])) {
        $end_date = $_POST['end_date'];
    }
    
    if (isset($wanted_material) && $wanted_material != "" &&
    isset($begin_date) && $begin_date != "" &&
    isset($end_date) && $end_date != "") {
        $query = "SELECT id FROM `material` WHERE id LIKE '$wanted_material' LIMIT 1;";
        $result = $database->query($query);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row['id'] == $wanted_material){
                $email = $_SESSION['connected_user'];
                $query = "INSERT INTO reservation(id_material, begin_date, end_date, email) VALUES ('$wanted_material','$begin_date', '$end_date', '$email')";
                $result = $database->query($query);
                echo $wanted_material;
                header('Location: reservation_list.php');
            }
        } 
    }
}
    ?>
</body>
</html>