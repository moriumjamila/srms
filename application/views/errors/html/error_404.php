<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$ci = new CI_Controller();
$ci = & get_instance();
$ci->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 != OK</title>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet"> 
        <link rel="shortcut icon" href="<?= base_url('/') ?>public/favicon.png">
        <link rel="stylesheet" href="<?= base_url('/') ?>public/css/animate.css">
        <link type="text/css" rel="stylesheet" href="<?= base_url('/') ?>public/css/notfound.css" />
        <style>
            .overlay{
                width: 100%;
                position: relative;
                z-index: 1;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: -ms-flexbox;
                display: flex;
                flex-wrap: wrap;
                flex-direction: column;
                align-items: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
            .overlay::before {
                content: "";
                display: block;
                position: absolute;
                z-index: -1;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: rgba(0,0,0,0.5);
            }
        </style>
    </head>
    <body>
        <div id="notfound" class="overlay" style="background:none;background-color:#0089cf;font-family: Montserrat">
            <div class="notfound animated zoomIn">
                <div class="notfound-404">
                    <h1>4<span>0</span>4</h1>
                </div>
                <p>Page Not Found</p>
                <a href="javascript:void(0)" onclick="window.history.back()">Back To Home</a>
            </div>
        </div>
    </body>
</html>
