<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 " />

    <!-- Bootstrap CSS -->
    <?php if(ENVIRONMENT == 'development'): ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <?php else: ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <?php endif ?>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/icon.css') ?>" />
  
    <?php if(ENVIRONMENT == 'development'): ?>
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
   <?php else: ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
  
    <?php endif ?>
    <script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>
    
    <script> var baseurl = '<?= base_url(); ?>'; const base = baseurl.slice(0,-1); </script>    

    
    <title>  <?= $title ?> </title>

   

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
            <?php if(!$this->session->userdata('username') || ($this->session->userdata('verified') == 0)): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/signup') ?>">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/login') ?>">Login</a>
            </li>
            <?php else: ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('/playlist ') ?>">PlayList</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('/editor ') ?>">Editor</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/playlist ') ?>">PlayList</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/editor ') ?>">Editor</a>
            </li>
           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $this->session->userdata('username') ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if($this->session->userdata('role')): ?>
                <a class="dropdown-item" href="<?= base_url('/admin ') ?>">Admin</a>
                <?php endif ?>
                <!-- <a class="dropdown-item" href="<?= base_url('/userprofile ') ?>">UserProfile</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('/logout ') ?>">Logout</a>
                </div>
            </li>
            <?php endif ?>
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

 
<?php endif; $this->session->unset_userdata('message'); ?>

    <div class="col-9 mx-auto mt-3 " id="alert-success" >
        <div class="alert alert-success alert-dismissible hide" id="alert" role="alert">
         <span id="msg">this is good news</span>
            <button type="button" class="close"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class="col-9 mx-auto mt-3 " id="alert-danger" >
        <div class="alert alert-danger alert-dismissible " id="alert" role="alert">
         <span id="msg">this is not good news</span>
            <button type="button" class="close"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="col-9 mx-auto mt-3 " >
        <div class="alert alert-success alert-dismissible fade hide" id="alert" role="alert">
         <span ></span>
            <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class="col-9 mx-auto mt-3 " >
        <div class="alert alert-danger alert-dismissible fade hide " id="alert" role="alert">
         <span ></span>
            <button type="button" class="close"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
   

    


    <main class="container">
      <div class="row">
      <div id="loadingDiv" >
        <img src="<?= base_url('assets/img/loading.gif')?>" alt="">
      </div>
      
    
        