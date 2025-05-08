<?php
include 'bdd.php';

if(
    empty($_POST['titre']) || // Vérifie si le titre est vide
    empty($_POST['description']) || // Vérifie si la desc est vide
    empty($_POST['artiste']) || // Vérifie si l'artiste est videe
    empty($_POST['image']) || // Vérifie si l'image est vide
    strlen($_POST['description']) < 3 || // Vérifie si la description fait au moins 3 caractères
    !filter_var($_POST['image'], FILTER_VALIDATE_URL) // Vérifie sur l'image a une url valide
    )
{
    header('Location: ajouter.php'); // Renvoie à la page du formulaire
}else{
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $artiste = htmlspecialchars($_POST['artiste']);
    $image = htmlspecialchars($_POST['image']);

    $bdd = connexion();
    $requete = $bdd->prepare('INSERT INTO oeuvres (titre, description, artist, image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}