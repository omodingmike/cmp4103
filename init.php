<?php

    use CMP4103\Database\Database;

    require_once 'vendor/autoload.php';

    // Creating users table in database

    $database = new Database;
    $database->createUsersTable();