<?php
function valid_mail(){
    if (empty($_POST['email'])){
        $valid_mail = 'Entrer votre e-mail';
        return $valid_mail;
    }
    else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $valid_mail = 'E-mail non valide';
            return $valid_mail;
        }
        else{
            return false;
        }
    }   
}
function valid_last_name(){
    if (empty($_POST['last_name'])){
        $valid_last_name = 'Entrer votre nom';
        return $valid_last_name;
    }
    else{
        $last_name = $_POST['last_name'];
        if(strlen($last_name) < 2){
            $valid_last_name = 'Nom trop court';
            return $valid_last_name;
        } elseif(strlen($last_name) > 30){
            $valid_first_name = 'Nom trop long';
            return $valid_first_name;
        }
        else{
            return false;
        }
    }   
}
function valid_first_name(){
    if (empty($_POST['first_name'])){
        $valid_first_name = 'Entrer votre prénom';
        return $valid_first_name;
    }
    else{
        $first_name = $_POST['first_name'];
        if(strlen($first_name) < 2){
            $valid_first_name = 'Prénom trop court';
            return $valid_first_name;
        }
        elseif(strlen($first_name) > 30){
            $valid_first_name = 'Prénom trop long';
            return $valid_first_name;
        }
        else{
            return false;
        }
    }   
}
function valid_birth(){
    if (empty($_POST['birth'])){
        $valid_birth = 'Veuillez entrer votre date de naissance';
        return $valid_birth;
    }
    else{
        $birth = $_POST['birth'];
        if (strtotime($birth) === false) {
            $valid_birth = 'Veuillez entrer une date de naissance valide';
            return $valid_birth;
        }
        else{
            return false;
        }
    }   
}

function valid_password(){
    if (empty($_POST['password'])){
        $valid_password = 'Veuillez entrer votre mot de passe';
        return $valid_password;
    }
    else{
        $password = $_POST['password'];
        if(strlen($password) <= 6){
            $valid_password = 'Votre mot de passe doit contenir au moins 6 caractères';
            return $valid_password;
        }
        else{
            return false;
        }
    }   
}

function valid_name(){
    if (empty($_POST['name'])) {
        $material = 'Veuillez entrer le nom du matériel';
        return $material;
    }
    else{
        return false;
    }
}

function valid_type(){
    if (empty($_POST['type'])) {
        $type = 'Veuillez entrer le type du matériel';
        return $type;
    }
    else{
        return false;
    }
}
function valid_reference(){
    if (empty($_POST['reference'])) {
        $reference = 'Veuillez entrer la référence du matériel';
        return $reference;
    }
    else{
        return false;
    }
}

function valid_description(){
    if (empty($_POST['description'])) {
        $description = 'Veuillez entrer la description du matériel';
        return $description;
    }
    else{
        return false;
    }
}

?>