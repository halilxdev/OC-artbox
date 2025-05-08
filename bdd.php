<?php

function connexion() {
    return new PDO('mysql:dbname=OC-artbox;host=localhost', 'root', '');
}