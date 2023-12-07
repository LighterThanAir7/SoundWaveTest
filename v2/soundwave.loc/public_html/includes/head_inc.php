<?php

require_once 'admin/inc/Songs.class.php';
require_once 'admin/inc/MysqlDB.class.php';
$songs = New Songs();
$song_information = $songs->List();

$phpArrayJson = json_encode(array_values($song_information));

echo '<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="hr"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>' . ($page_title ?? "") . '</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="author" content="Benjamin Babić">

    <link rel="icon" href="'.SITE_URL.'favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="'.SITE_URL.'css/style.css?"> 
    <!-- css/style.min.css?"> use for production --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.47/dist/vue.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.2/tinycolor.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.4.0/color-thief.min.js" integrity="sha512-r2yd2GP87iHAsf2K+ARvu01VtR7Bs04la0geDLbFlB/38AruUbA5qfmtXwXx6FZBQGJRogiPtEqtfk/fnQfaYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
<div id="app">
<main class="main">
';

?>