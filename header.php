<?php

require_once("database.php");

$baseUrl = "http://localhost/rehome-a-bun/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehome a Bun</title>
    <link rel="stylesheet" href="styles/splide.min.css" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Montserrat:wght@300;400;500;600;700;800;900&family=Raleway:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>

<div class="header">
    <div class="header-content">
        <nav>
            <a class="nav-link" href="<?php echo $baseUrl; ?>">Home</a>
            <a class="nav-link" href="<?php echo $baseUrl. 'bunnies.php'; ?>">Our bunnies</a>
            <a class="nav-link" href="<?php echo $baseUrl. 'bunnysearch.php'; ?>">Search for a bunny</a>
            <a class="nav-link" href="<?php echo $baseUrl. 'about.php'; ?>">About us</a>
            <a class="nav-link" href="<?php echo $baseUrl. 'contact.php'; ?>">Contact</a>
        </nav>
    </div>
</div>

<div class="hero">
    <div class="overlay"></div>
    <div class="hero-text">
        <h1>Rehome a Bun</h1>
        <p>Your new fluffy friend might be waiting for you here.</p>
    </div>
</div>
