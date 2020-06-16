<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 ">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Navbar -->
        <?php require('layout/navbar.php') ?>
    <!-- Navbar End -->

    <main class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-7 col-lg-5">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title"> Sign Up </h3>
                    
                        <form  method="post" id="signup-form">
                            <div class="form-group">
                               
                                <label for="inputEmail" class="col-lg-6 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputUser" class="col-lg-6 control-label">Username</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="inputUser" name="inputUser" placeholder="Username"  autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-6 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" autocomplete="off">
                                        
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-6 control-label">Confirm Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="Password" autocomplete="off">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="showpassword" id="showpassword"> Show Password
                                            </label>
                                        </div>
                                    </div>
                                </div>
    
    
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
    
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer  -->
    <footer class="fixed-bottom bg-primary text-light">
       <p> Copyright © 2020 M3u File Project, Inc. All rights reserved. </p>
    </footer>
    <!-- Footer End -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>