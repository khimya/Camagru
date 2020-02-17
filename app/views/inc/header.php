<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="">
    <link href="/camagru/public/img/ico/42.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/navbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/forms.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/posts.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/camera.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/error.css">
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <?php require APPROOT . '/views/inc/navbar.php'; ?>
    <?php Header("Set-Cookie", "HttpOnly;Secure;SameSite=Strict"); ?>