

    <main class="container">
      <div class="row">
        <div class="col-md-12 mt-4" id="box">
          <div class="container" id="preTableContainer">
            <p class="h6">Total Users are :3</p>
            <p class="">
              <button class="btn btn-primary">Create User</button>
              <!-- <button class="btn btn-primary ">Create Paylist</button>
                    <button class="btn btn-primary ">Create Paylist</button> -->
            </p>
          </div>
            <!-- <div class="container-fluid my-3">
              <div class="row">
                <div class="hint-text">
                  Showing <b>5</b> out of <b>25</b> entries
                </div>
                <div class="mr-auto">
                  <ul class="pagination">
                    <li class="page-item"><a href="#">Previous</a></li>
                    <li class="page-item active">
                      <a href="#" class="page-link ">1</a>
                    </li>
                    <li class="page-item">
                      <a href="#" class="page-link">2</a>
                    </li>
                    <li class="page-item ">
                      <a href="#" class="page-link">3</a>
                    
                    <li class="page-item">
                      <a href="#" class="page-link">Next</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div> -->
          <div class="container" >
            <table
              class="table table-hover table-light table-sm border-table text-center" id="playlistTable"
              >
            
              <thead class="thead-light border-table">
                <tr>
                  
                  <th scope="col">Name</th>
                  <th scope="col">Source</th>
                  <th scope="col">Group</th>
                  <th scope="col">Channel</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                
                  <tr>
                    <td >
                     
                       
                      <!-- <i class="material-icons " style="top:3px">
                        list
                      </i>  -->
                       <span>Marks</span>
                        
                    </td>
                    
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>
                      <a href="#editEmployeeModal" class="btn btn-info btn-sm edit" data-toggle="modal">Edit</a>
                      <a href="#deleteEmployeeModal" class="btn btn-danger btn-sm delete" data-toggle="modal">Delete</a>
                     
                     
                  </td>
                  </tr>
                  <tr>
                    <td>
                    <!-- <span class="material-icons " style="top:3px">  list</span> -->
                     Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Thornton</td>
                    <td>
                    <a href="#editEmployeeModal" class="btn btn-info btn-sm edit" data-toggle="modal">Edit</a>
                      <a href="#deleteEmployeeModal" class="btn btn-danger btn-sm delete" data-toggle="modal">Delete</a>
                  </td>
                  </tr>
                  <tr>
                    <td>
                    <!-- <span class="material-icons " style="top:3px"> list     </span> -->
                       Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>the Bird</td>
                    <td>
                    <a href="#editEmployeeModal" class="btn btn-info btn-sm edit" data-toggle="modal">Edit</a>
                      <a href="#deleteEmployeeModal" class="btn btn-danger btn-sm delete" data-toggle="modal">Delete</a>
                  </td>
                  </tr>

                  
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </main>


  <!-- Delete Modal -->
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEmployeeModal">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Delete User. ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

  <!-- Edit Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmployeeModal">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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

      </form>
      </div>
      <div class="modal-footer">
              <button type="reset"  data-dismiss="modal"  class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info">Edit</button>
      </div>
    </div>
  </div>
</div>