<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 ">

  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="css/style.css">
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
      <div class="col-md-12 mt-4">
        <div class="container">
          <p class="h6 "> Total List are :4 </p>
          <p class="">
            <button class="btn btn-primary ">Create Paylist</button>
            <!-- <button class="btn btn-primary ">Create Paylist</button>
                    <button class="btn btn-primary ">Create Paylist</button> -->
          </p>
          <!-- <table
                    data-toggle="table"
                    data-url="data1.json"
                    data-pagination="true"
                    class="table text-center table-light table-sm border-table">
                    <thead>
                        <tr>
                        <th data-sortable="true" data-field="id">Item ID</th>
                        <th data-field="name">Item Name</th>
                        <th data-field="price">Item Price</th>
                        </tr>
                    </thead>
                    </table> -->
          <div class="table-wrapper">
            <div class="table-title">
              <div class="row">
                <div class="col-sm-6">
                  <h2>Manage <b>Employees</b></h2>
                </div>
                <div class="col-sm-6">
                  <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                      class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                  <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                      class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                </div>
              </div>
            </div>
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="selectAll">
                      <label for="selectAll"></label>
                    </span>
                  </th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox1" name="options[]" value="1">
                      <label for="checkbox1"></label>
                    </span>
                  </td>
                  <td>Thomas Hardy</td>
                  <td>thomashardy@mail.com</td>
                  <td>89 Chiaroscuro Rd, Portland, USA</td>
                  <td>(171) 555-2222</td>
                  <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox2" name="options[]" value="1">
                      <label for="checkbox2"></label>
                    </span>
                  </td>
                  <td>Dominique Perrier</td>
                  <td>dominiqueperrier@mail.com</td>
                  <td>Obere Str. 57, Berlin, Germany</td>
                  <td>(313) 555-5735</td>
                  <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox3" name="options[]" value="1">
                      <label for="checkbox3"></label>
                    </span>
                  </td>
                  <td>Maria Anders</td>
                  <td>mariaanders@mail.com</td>
                  <td>25, rue Lauriston, Paris, France</td>
                  <td>(503) 555-9931</td>
                  <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox4" name="options[]" value="1">
                      <label for="checkbox4"></label>
                    </span>
                  </td>
                  <td>Fran Wilson</td>
                  <td>franwilson@mail.com</td>
                  <td>C/ Araquil, 67, Madrid, Spain</td>
                  <td>(204) 619-5731</td>
                  <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox5" name="options[]" value="1">
                      <label for="checkbox5"></label>
                    </span>
                  </td>
                  <td>Martin Blank</td>
                  <td>martinblank@mail.com</td>
                  <td>Via Monte Bianco 34, Turin, Italy</td>
                  <td>(480) 631-2097</td>
                  <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons"
                        data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="clearfix">
              <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
              <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
              </ul>
            </div>
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
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

</body>

</html>