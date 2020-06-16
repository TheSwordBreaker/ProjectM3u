<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1 " />

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   
    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Navbar -->
    <?php require('layout/navbar.php') ?>
    <!-- Navbar End -->
    <!-- <div class="col-9 mx-auto mt-3">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div> -->

    <main class="container">
      <div class="row">
        <div class="col-md-12 mt-4 pt-4" >
          <div class="text-center  ">
          <h1>M3u Project </h1>
          <p>
            Create, edit, sort m3u playlists online, EPG, and more!

Are you new to m3u4u? <a href="./signup.php"> Register here </a>
          </p>
         
            <a href="./login.php" class="btn btn-primary " role="button"> Login</a>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer  -->
    <footer class="fixed-bottom bg-primary text-light">
      <p>Copyright © 2020 M3u File Project, Inc. All rights reserved.</p>
    </footer>
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
     
    ></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
          $(this).width($originals.eq(index).width())
        });
        return $helper;
      },
        updateIndex = function(e, ui) {
          $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i+1);
          });
          /* $('input[type=text]', ui.item.parent()).each(function (i) {
            $(this).val(i + 1);
          }); -->*/
        };
    
       $("#playlistTable tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
      }).disableSelection();
      
        $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
          }); 

    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  </body>
</html>
