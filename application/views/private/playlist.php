

    <main class="container">
      <div class="row">
        <div class="col-md-12 mt-4" id="box">
          <div class="container" id="preTableContainer">
            <p class="h6">Total List are :4</p>
            <p class="">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadPlaylist" id="btnAdd">Create Paylist</button>

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
                  
                  <th scope="col"></th>
                  <th scope="col" class="text-left">Name</th>
                  <th scope="col">Source</th>
                  <th scope="col">Group</th>
                  <th scope="col">Channel</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id='listPlaylist'>
                
                
                  <tr>
                    <td colspan='5'> No Data Avaliable</td>
                  </tr>
               
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>


function listPlaylist(){

$.ajax({
    url: base + '/playlist/listPlaylist',
    method: "GET",
    dataType: "json",
    
    success: function(d) {
        
        if(d.length){
            var i = 0;
            var html ;
            for(i=0;i < d.length ; i++){
              html +='<tr> \
                    <td style="width:15px"><span class="material-icons " style="top:3px"> list </span></td> \
                    <td class="text-left">' +  d[i].name + '</td> \
                    <td>' +  d[i].source + '</td> \
                    <td>' +  d[i].name + '</td> \
                    <td>' +  d[i].name + '</td>  \
                    <td> \
                      <a  data="'+ d[i].id +'"  href="#editPaylistModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>\
                      <a  data="'+ d[i].id +'"  href="#deletePaylistModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>\
                      <a  data="'+ d[i].id +'"  href="#downloadPaylistModal" class="download" data-toggle="modal"> <i class="material-icons" data-toggle="tooltip"  >get_app  </i></a>\
                  </td>\
                  </tr>'
            }
            $('#listPlaylist').html(html);
        }
    },
    error: function(d) {
        alert("Could not Fetch Data From Database");
    }
});

}
$(document).ready(function() {
  listPlaylist();
  //delete 
  $('#listPlaylist').on('click','.delete',function(){
    var id = $(this).attr('data');
    $('#btnDelete').unbind().click(function(){
        $.ajax({
          type: 'ajax',
          url: base + '/playlist/delete',
          method: "POST",
          dataType: 'json',
          data:{id:id},
          success: function(d) {
            if (d.status) {
                // $('.alert-success').html('User Deleted').fadeIn().delay(4000).fadeOut('slow');
                $('#deletePaylistModal').modal('hide');
                // alert('user delted');
                listPlaylist();


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
  $('#listPlaylist').on('click','.edit',function(){
    $("#uploadPlaylist-form").trigger("reset"); 
      var id = $(this).attr('data');
      $('#uploadPlaylist').modal('show');
    $('#uploadPlaylist').find('.modal-title').text('Edit Playlist');
    $('#btnSubmit').text('Edit');
    $('#uploadPlaylist-form').attr('action',base+'/playlist/edit');
    $.ajax({
          url: base+'/playlist/deatail',
          method: "GET",
          dataType:'json',
          data: {  id:id },
          success: function(d) {
            // var d = JSON.parse(d);
            // console.log(d.username);
            console.log(d);
            $("#playlistid").val(id);
            $("#playlistName").attr('value',d.name);
            $("#playlistSource").attr('value',d.source);
           
            
              
          },
          error: function(d) {
              alert("something went wrong");
          }
      });


  });

  $('#btnAdd').on('click',function(){
    $("#uploadPlaylist-form").trigger("reset"); 
    $('#uploadPlaylist').modal('show');
    $('#uploadPlaylist').find('.modal-title').text('Add new User');
    $('#btnSubmit').text('Add');
    $('#uploadPlaylist-form').attr('action',base+'/playlist/create')
  });

 
  
  $("#uploadPlaylist-form").validate({
    rules: {
            
            playlistSource: {
                required: true,
                
            },
            playlistName: {
                required: true,
                maxlength: 60
            },
            playlistUrl:{
                required: true,
                maxlength: 600,
            },
            playlistFile:{
                required:true,
            },

            
        },
        errorClass: "myError",
            
        });




});

</script>

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
      
        $("#playlistTable tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {
          alert('hii')
        }
          }); 

    </script>

    <!-- Button trigger modal -->


<!-- Create Playlist Modal -->
<div class="modal fade" id="uploadPlaylist" tabindex="-1" role="dialog" aria-labelledby="uploadPlaylist" aria-hidden="true">
  <div class="modal-dialog " role="document">
  <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadPlaylist">Create Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('/playlist/create',['id'=>"uploadPlaylist-form"]);?>
      <!-- <form  method="post" action='<?= base_url()?>' id="uploadPlaylist-form"> -->
      <div class="modal-body">
      <input type="hidden" name='id' id="playlistid">
     

            <div class="form-group">
                  <label for="playlistName" class="col-lg-6 control-label">Select A Source :</label>
                  <div class="col-lg-10">
                    <select class="custom-select custom-select-md mb-2" name='playlistSource' id='playlistSource'>
                      <option >Select A Source :</option>
                      <option value="1">M3u Url</option>
                      <option selected value="2">File Upload</option>
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
                  <div class="col-lg-6">

                      <div class="custom-file">
                  <input type="file" class="custom-file-input" name="playlistFile" id="playlistFile">
                  <label class="custom-file-label" for="playlistFile">Choose file</label>
                </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
         <button type="reset"  data-dismiss="modal"  class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary" id="btnSumbit">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
      $('#url').hide();
         
          $('#playlistFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
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
          <button type="button" class="btn btn-danger"id="btnDelete">Delete</button>
        </div>
      </div>
    </div>
</div>


