

    <main class="container">
      <div class="row">
        <div class="col-md-12 mt-4" id="box">
          <div class="container" id="preTableContainer">
            <p class="h6">Total Users are :3</p>
            <p class="">
              <button class="btn btn-primary" id="btnAdd" data-toggle="modal" data-model="addEmployeeModal">Create User</button>
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
              class="table table-hover table-light border-table text-center" id="playlistTable"
              >
            
              <thead class="thead-light border-table">
                <tr>
                  
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="listUser">
                
                  
                  <tr>
                    <td colspan='3'> No Data Avaliable</td>
                  </tr>

                  
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </main>

<script>


        function listUser(){

        $.ajax({
            url: base + '/admin/listUser',
            method: "GET",
            dataType: "json",
            
            success: function(d) {
                
                if(d.length){
                    var i = 0;
                    var html ;
                    for(i=0;i < d.length ; i++){
                        html += '<tr><td >' + d[i].username +
                                '</td><td>' + d[i].email +
                                '</td><td><a href="#editEmployeeModal" class="btn btn-info btn-sm edit" data="'+ d[i].id +'" data-toggle="modal">Edit</a> \
                                <a href="#deleteEmployeeModal" class="btn btn-danger btn-sm delete" data="'+ d[i].id +'" data-toggle="modal">Delete</a>   \
                            </td>           </tr>' 
                    }
                    $('#listUser').html(html);
                }
            },
            error: function(d) {
                alert("Could not Fetch Data From Database");
            }
        });

        }
      $(document).ready(function() {
          listUser();
          //delete 
          $('#listUser').on('click','.delete',function(){
            var id = $(this).attr('data');
            $('#btnDelete').unbind().click(function(){
                $.ajax({
                  type: 'ajax',
                  url: base + '/admin/user/delete',
                  method: "POST",
                  dataType: 'json',
                  data:{id:id},
                  success: function(d) {
                    if (d.status) {
                        // $('.alert-success').html('User Deleted').fadeIn().delay(4000).fadeOut('slow');
                        $('#deleteEmployeeModal').modal('hide');
                        // alert('user delted');
                        listUser()


                    }else{
                      alert('error');
                    }
                },
                error: function(d) {
                    alert("something went wrong");
                }

                });
            });

          });
          $('#listUser').on('click','.edit',function(){
            $("#my-form").trigger("reset"); 
              var id = $(this).attr('data');
              $('#editEmployeeModal').modal('show');
            $('#editEmployeeModal').find('.modal-title').text('Edit User');
            $('#btnSubmit').text('Edit');
            $('#my-form').attr('action',base+'/admin/user/edit');
            $.ajax({
                  url: base+'/admin/user/deatail',
                  method: "GET",
                  dataType:'json',
                  data: {  id:id },
                  success: function(d) {
                    // var d = JSON.parse(d);
                    // console.log(d.username);
                    console.log(d);
                    $("#inputId").val(id);
                    $("#inputUser").attr('value',d.username);
                    $("#inputEmail").attr('value',d.email);
                    $("#inputPassword").attr('value',d.password);
                    $("#Role").attr('value',d.role);
                    
                      
                  },
                  error: function(d) {
                      alert("something went wrong");
                  }
              });


          });

          $('#btnAdd').on('click',function(){
            $("#my-form").trigger("reset"); 
            $('#editEmployeeModal').modal('show');
            $('#editEmployeeModal').find('.modal-title').text('Add new User');
            $('#btnSubmit').text('Add');
            $('#my-form').attr('action',base+'/admin/user/create')
          });

         
          
          $("#my-form").validate({
                    rules: {
                        inputEmail: {
                            required: true,
                            email: true
                        },
                        inputUser: {
                            required: true,
                            minlength: 5,
                            maxlength: 15
                        },
                        inputPassword: {
                            required: true,
                            minlength: 5
                        },
                        inputPassword2: {
                            required: true,
                            minlength: 5,
                            equalTo : "#inputPassword"
                        },Role : {
                            required: true
                        }
                    },
                    errorClass: "myError",
                    messages: {
                        inputEmail: "Please enter a valid email address",
                        inputUser: {
                            required: "**Please provide a Username",
                            minlength: "**Your Username must be at least 5 characters long",
                            maxlength: "**Your Username must be at most 15 characters long"
                        },
                        inputPassword: {
                            required: "**Please provide a password",
                            minlength: "**Your password must be at least 5 characters long"
                        },
                        inputPassword2: {
                            required: "**Please provide a password",
                            minlength: "**Your password must be at least 5 characters long",
                            equalTo : "**Your password must be same."
                        },
                    },
                    submitHandler: function(form) {
                        var user = $("#inputUser").val();
                        var email = $("#inputEmail").val();
                        var password = $("#inputPassword").val();
                        var id = $("#inputId").val();
                        var url = $('#my-form').attr('action');
                        var role = $("#Role").children("option:selected").val();
                
                        $.ajax({
                            url: url,
                            method: "POST",
                            dataType:'json',
                            data: {
                                "user": user,
                                "password": password,
                                "email": email,
                                "id":id,
                                "role":role,
                                
                            },
                            success: function(d) {
                              $('#editEmployeeModal').modal('hide');  
                              listUser();
                              $("#my-form").trigger("reset"); 

                                
                            },
                            error: function(d) {
                                alert("something went wrong");
                            }
                        });
                    }
                });




      });

    </script>


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
        <button type="button" class="btn btn-danger " id="btnDelete">Delete</button>
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
      <form  method="post" id="my-form" action="">
      <div class="modal-body">
          <input type="hidden" id="inputId"  >
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
              <label for="inputUser" class="col-lg-6 control-label">Role</label>
              <div class="col-lg-10">
              <select class="custom-select custom-select-md mb-2"  name="Role" id="Role"  >
                  <option selected>Select A Playlist </option>
                  
                  <option value="1">Admin</option>
                  <option value="0">Standard User</option>
                  
                </select>
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword" class="col-lg-6 control-label">Password</label>
              <div class="col-lg-10">
                  <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" autocomplete="off">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="showpassword" id="showpassword"> Show Password
                      </label>
                  </div>
              </div>
          </div>

      
      </div>
      <div class="modal-footer">
              <button type="reset"  data-dismiss="modal"  class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info" id="btnSubmit">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>

