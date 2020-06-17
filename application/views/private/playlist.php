

    <main class="container">
      <div class="row">
        <div class="col-md-12 mt-4" id="box">
          <div class="container" id="preTableContainer">
            <p class="h6">Total List are :4</p>
            <p class="">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPlaylist" >Create Paylist</button>

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
                     
                       
                      <i class="material-icons " style="top:3px">
                        list
                      </i> 
                       <span>Marks</span>
                        
                    </td>
                    
                    
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>
                      <a href="#editPaylistModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">create</i></a>
                      <a href="#deletePaylistModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">delete</i></a>
                      <a href="#downloadPaylistModal" class="download" data-toggle="modal"> <i class="material-icons" data-toggle="tooltip"  >get_app  </i></a>
                     
                     
                  </td>
                  </tr>
                  <tr>
                    <td><span class="material-icons " style="top:3px">
                      list
                      </span> Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Thornton</td>
                    <td>
                      <a href="#editPaylistModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                      <a href="#deletePaylistModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                      <a href="#downloadPaylistModal" class="download" data-toggle="modal"> <i class="material-icons" data-toggle="tooltip"  >get_app  </i></a>
                  </td>
                  </tr>
                  <tr>
                    <td><span class="material-icons " style="top:3px">
                      list
                      </span> Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>the Bird</td>
                    <td>
                      <a href="#editPaylistModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                      <a href="#deletePaylistModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                      <a href="#downloadPaylistModal" class="download" data-toggle="modal"> <i class="material-icons" data-toggle="tooltip"  >get_app  </i></a>
                  </td>
                  </tr>
                  
               
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Button trigger modal -->


<!-- Create Playlist Modal -->
<div class="modal fade" id="uploadPlaylist" tabindex="-1" role="dialog" aria-labelledby="uploadPlaylist" aria-hidden="true">
  <div class="modal-dialog " role="document">
  <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadPlaylist">Upload Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post" id="uploadPlaylist-form">
      <div class="modal-body">
     

      <div class="form-group">
            <label for="playlistName" class="col-lg-6 control-label">Select A Source :</label>
            <div class="col-lg-10">
              <select class="custom-select custom-select-md mb-2" name='playlistSource' id='playlistSource'>
                <option selected>Select A Source :</option>
                <option value="1">M3u Url</option>
                <option value="2">File Upload</option>
                <option value="3">Empty Playlist</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="playlistName" class="col-lg-6 control-label">Name :</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="playlistName" name="playlistName" placeholder="Name">
            </div>
          </div>
          

          <div class="form-group " id="url">
            <label for="playlistName" class="col-lg-6 control-label">M3u Url :</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="playlistUrl" name="playlistUrl" placeholder="Url">
            </div>
          </div>



          <div class="form-group " id="upload">
            <label for="playlistName" class="col-lg-6 control-label">Upload Your M3u File :</label>
            <div class="col-lg-3">
                <label class="btn-bs-file btn btn-primary">
                    Browse
                    <input type="file" class='file-upload' name="playlistFile" id="playlistFile"/>
                </label>
            <!-- <label for="playlistName" class="col-lg-6 control-label">Upload Your M3u File :</label>
            <div class="col-lg-3">
                <label class="btn-bs-file btn btn-primary">
                    Browse
                    <input type="file" class='file-upload' name="playlistFile" id="playlistFile"/>
                </label> -->

                
                
              </div>
          </div>


         

      
      </div>
      <div class="modal-footer">
         <button type="reset"  data-dismiss="modal"  class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
      $('#url').hide();
          $('#upload').hide();
    $('#playlistSource').on('change',function(){
        var select = $(this).children("option:selected").val();
        if(select == 1){
          $('#url').show();
          $('#upload').hide();
          
        }else if(select ==2){
          $('#url').hide();
          $('#upload').show();
          
        }else if(select == 3){
          
          $('#url').hide();
          $('#upload').hide();
        }
    })
</script>


  <!-- Delete Modal -->
  <div class="modal fade" id="deletePaylistModal" tabindex="-1" role="dialog" aria-labelledby="deletePaylistModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePaylistModal">Delete Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Delete Playlist. ?
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



    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>



