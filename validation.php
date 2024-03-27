<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/login2.css"/>
    <link rel="stylesheet" href="Style/utile.css"/>
    <title>Liste des réservations</title>
</head>
<body>
<?php
include_once('Includes/link.php');
include_once('Includes/function.php');

// session active
session_start();

if (!$_SESSION['connected_user']) {
    header('Location: login.php');
}else{
    $query = "SELECT * FROM `reservation` WHERE status LIKE '0';";
    $result = $database->query($query);
}

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
<h1 id="connexion">BONJOUR <?= $_SESSION['connected_user'] ?></h1>

<table class="styled-table">
    <thead>
    <th>Nom</th>
    <th>Date de début de réservation</th>
    <th>Date de fin de réservation</th>
    <th>Status</th>
    </thead>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $row['id_material'] ?></td>
                <td><?= $row['begin_date'] ?></td>
                <td><?= $row['end_date'] ?></td>
                <td><?php if($row['status'] == 0){
                    echo "En attente";
                }elseif($row['status'] == 1){
                    echo "Validée";
                }elseif($row['status'] == 2){
                    echo "Refusée";
                } ?></td>
            </tr>
        <?php
        }
    } else {
        echo "0 results";
    }
    ?>
</table>
</body>
</html>