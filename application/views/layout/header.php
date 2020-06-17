<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 " />

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    
   
    <title> <?= $title ?></title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-5 " >
        <a class="navbar-brand" href="<?= base_url() ?>">M3uProject</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto p-1">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('Home') ?>"> <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Contact') ?>"> Us</a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('/admin ') ?>">Admin</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('/logout ') ?>">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/playlist ') ?>">PlayList</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/signup') ?>">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/login') ?>">Login</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                UserProfile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">UserProfile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('/logout ') ?>">Logout</a>
                </div>
            </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    
<?php if($this->session->flashdata('message')):?>
    <div class="col-9 mx-auto mt-3">
        <div class="alert alert-<?= $this->session->flashdata('message')[0]?> alert-dismissible fade show"  data-dismiss="alert" role="alert">
        <?= $this->session->flashdata('message')[1]?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

 
<?php endif; $this->session->unset_userdata('error'); ?>
<div class="col-9 mx-auto mt-3 " >
        <div class="alert alert-warning alert-dismissible fade hide" id="alert" role="alert">
         <span id="msg"></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    


    <main class="container">
      <div class="row">
    
        