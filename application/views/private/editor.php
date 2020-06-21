<div class="col-sm-12">
  <div class="row">
    <p class="h3 ml-4">Select Playlist</p>
  </div>
  <p class="col-6">
    <select
      class="custom-select custom-select-md mb-2"
      name="playlistSource"
      id="playlistSource"
    >
      <option selected>Select A Playlist </option>
      <?php foreach($playlist as $i): ?>
      <option value="<?=$i->id  ?>"><?= $i->name ?></option>
      <?php endforeach ?>
    </select>
  </p>
</div>
<div class="col-sm-12">
  <div class="row">
    <div class="col-md-6 mt-4" id="box">
      <div class="container" id="preTableContainer">
        <p class="">
          <button class="btn btn-primary" id="createGroup">Create Group</button>
          <button class="btn btn-deafult mx-2" id="groupBtnCancel">
            Cancel
          </button>
          <button class="btn btn-success" id="groupBtnSave">Save</button>
        </p>
        <p class="h6">Total Groups are : <span id="Grouplength"> 4 </span></p>
      </div>
      <div class="container">
        <table
          class="table table-hover table-light table-sm border-table text-center"
          id="groupTableID"
        >
          <thead class="thead-light border-table">
            <tr>
              <th colspan="1" class="text-left"></th>
              <th scope="col" colspan="3" class="text-left">Name</th>
              <th scope="col" colspan="1" class="text-right pr-3">Channels</th>
              <th scope="col" colspan="2" class="text-right pr-3">Actions</th>
            </tr>
          </thead>
          <tbody id="groupTable">
            <tr>
              <td colspan="7">No Data Avaliable</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-6 mt-4" id="box">
      <div class="container" id="preTableContainer">
        <p class="">
          <button class="btn btn-primary" id="createChannel">Create Channel</button>
          <button class="btn btn-deafult mx-2" id="channelBtnCancel">
            Cancel
          </button>
          <button class="btn btn-success" id="channelBtnSave">Save</button>
        </p>
        <p class="h6">Total List are :<span id="Channellength"> 4 </span></p>
      </div>
      <div class="container">
        <table
          class="table table-hover table-light table-sm border-table text-center"
          id="channelTableID"
        >
          <thead class="thead-light border-table">
            <tr>
              <th colspan="1"></th>
              <th scope="col" colspan="4" class="text-left">Name</th>
              <th scope="col" colspan="2" class="text-right pr-3">Actions</th>
            </tr>
          </thead>
          <tbody id="channelTable">
            <tr>
              <td colspan="7">No Data Avaliable</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  function getplaylist() {
    return JSON.parse(localStorage.getItem("playlistdata"));
  }
  function setplaylist(d) {
    localStorage.setItem("playlistdata", JSON.stringify(d));
  }
  function getGroupData() {
    return JSON.parse(localStorage.getItem("groupdata"));
  }
  function setGroupData(d) {
    localStorage.setItem("groupdata", JSON.stringify(d));
  } 
  function getplaylistFromUrl(id) {
    $.ajax({
      url: base + "/editor/deatail",
      method: "GET",
      dataType: "JSON",
      data: { id: id },
      success: function (d) {
        localStorage.removeItem("playlistdata");
        localStorage.removeItem("reservePlaylistdata");
        localStorage.removeItem("groupdata");

        localStorage.setItem("playlistdata", JSON.stringify(d.DATA));
        localStorage.setItem("reservePlaylistdata", JSON.stringify(d.DATA));
        playlistdata = d.DATA;
        var groupData = {} , e;
       // groupData = playlistdata.map(function(e){    });
        for (var i = 0; i < playlistdata.length; i++) {
          e = playlistdata[i];
          if (e["group-title"] in groupData) {
            
            groupData[e["group-title"]] += 1;
          } else {
            groupData[e["group-title"]] = 1;
          }
        }
        
        console.log(groupData);
        groupData = Object.entries(groupData)
        var sum = 0;
        console.log(sum);
        for(var e in groupData){
          groupData[e].push(sum);
          sum = sum + groupData[e][1];
          console.log(sum);
        }
        
        
        setGroupData(groupData);
      //  console.log(Object.entries(groupData),playlistdata);
        console.log(groupData);
        var groupData = [] , e;
      
        listgroups();
        $("#createGroup").prop("disabled",false);
        $("#createChannel").prop("disabled",false);
      },
      error: function (d) {
        alert("something went wrong");
      },
    });
  }
  //list groups
  function listgroups() {
    var groupTable;
    var playlistdata = getplaylist();
    var groupData = getGroupData(),  e;
    
    for (e in groupData) {
      groupTable +=
        '<tr class="text-left" data="'+groupData[e][2]+'" data-length="'+ groupData[e][1] +'"> \
          <td ><span class="material-icons pl-2" style="top:3px">list</span> </td>\
          <td colspan="3" class="group">' +
        groupData[e][0]  +
        ' </td>   \
          <td colspan="1" class="text-right pr-3" > ' +
        groupData[e][1] +
        ' </td> \
            <td colspan="2" class="text-right pr-3" >  \
            <a data-group="'+ groupData[e][0] +'" data="'+ e +'" href="#editorModel" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a> \
            <a data-group="'+ groupData[e][0] +'" data="'+ e +'" href="#deleteModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a> \
        </td> \
        </tr>';
    }
    $("#groupTable").html(groupTable);
    
    
    $("#Grouplength").html(groupData.length);
    //onsole.log( Object.keys(groupData)[0])
    listchannels(groupData[0][0]);
  }

  function listchannels(group) {
    var channelTable;
    var playlistdata = getplaylist();
    var count = 0;
    var offest = 0;
    $('#channelTable').html('');
    for(items in playlistdata){
      if(playlistdata[items]["group-title"] == group){
        channelRow =$(
        '<tr class="text-left" data="'+items+'" > \
        <td style="width:15px" class="handle"><span class="material-icons pl-2" style="top:3px">list</span></td><td colspan="5">' +
          playlistdata[items]["tvg-name"] +
        
        '</td><td colspan="2" class="text-right pr-3" > \
          <a data="'+items+'" data-group="'+playlistdata[items]["group-title"] + '"href="#editorModel" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">create</i></a> \
          <a data="'+items+'" data-group="'+playlistdata[items]["group-title"] +'" href="#deleteModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">delete</i></a> \
          </td></tr>');

          count++;
          if(count == 1 ){
            offest = items;
          }
          channelRow.data('d', playlistdata[items])
          $('#channelTable').append(channelRow);

          //channelTable += channelRow;
      }

    }
    if(count == 0){
      $("#channelTable").html('<tr><td colspan="7">No Data Avaliable</td></tr>');
    }else{
     // $("#channelTable").html(channelTable);
    }
    
    $('#channelTable').attr('group',group);
    $('#channelTable').attr('offset',offest);
    $("#Channellength").html(count);
  }

  function groupDataChaned() {
    $("#groupBtnCancel").show();
    $("#groupBtnSave").show();
  }
  function channelDataChaned() {
    $("#channelBtnCancel").show();
    $("#channelBtnSave").show();
  }

  $(document).ready(function () {
    //DropDown Handler
    $("#groupBtnCancel").hide();
      $("#groupBtnSave").hide();
      $("#channelBtnCancel").hide();
      $("#channelBtnSave").hide();
      $("#createGroup").prop("disabled",true);
      $("#createChannel").prop("disabled",true);
      
      $("#playlistSource").on("change", function () {
        var select = $(this).children("option:selected").val();
        getplaylistFromUrl(select);
      //list table
    });

    //Group table Handler
    $("#groupTable").on("click", ".group", function () {
      kunal = $(this).text();
      listchannels(kunal.trim());
    });

    //Group delete  Handler
    $("#groupTable").on("click", ".delete", function () {
      var id = parseInt($(this).attr("data"));

      var data_group = $(this).attr("data-group").trim();
      
      $("#deleteModal").modal("show");
      $("#deleteModal").find(".modal-title").text("Delete Group");
      $("#deleteModal")
        .find(".modal-body")
        .text("Do You Want To Delete Group. ?");

      $('#btnDelete').text('delete')
      $("#btnDelete").unbind().click(function () {
          var playlistdata = getplaylist();

          playlistdata = playlistdata.filter((x)=>{
             return  x["group-title"] != data_group
          });
          
          setplaylist(playlistdata)
          var groupData = getGroupData();
          groupData.pop(id);
          setGroupData(groupData);
          listgroups();
          groupDataChaned()
          $('#deleteModal').modal('hide');
        });
      });
    
    //Group add  Handler
    $('#createGroup').on('click',function(){
      $("#editor-form").trigger("reset"); 
      $('#editorModel').modal('show');
      $('#editorModel').find('.modal-title').text('Add new Group');
      $('#btnSubmit').text('Add');
      $("#urlId").hide();
      
      $("#btnSubmit").unbind().click(function () {
        if($("#editor-form").valid()){
          var group = $("#Name").val().trim();
          var groupData = getGroupData();
          groupData.push([group , 0]);
          
          setGroupData(groupData);
          //groupData 
          listgroups();
          groupDataChaned()
        }
        $('#editorModel').modal('hide');
      });
    });
    
    //Group edit Handler
    $('#groupTable').on('click','.edit',function(){
      var id = parseInt($(this).attr("data"));
      var data_group = $(this).attr("data-group").trim();
      
      $("#editor-form").trigger("reset"); 
      $('#editorModel').find('.modal-title').text('Edit Group');

      playlistdata = getplaylist()
  
      $('#btnSubmit').text('Edit');
      $("#urlId").hide();

      $("#Name").attr('value',data_group);
      $('#editorModel').modal('show');
      
      $("#btnSubmit").unbind().click(function () {
        if($("#editor-form").valid()){
          var group = $("#Name").val().trim();
          if(group != data_group){
              var playlistdata = getplaylist();
              playlistdata.map((x)=>{
                    if(x["group-title"] == data_group){
                       x["group-title"] = group;
                    }
              });
              setplaylist(playlistdata)
              groupData = getGroupData()
              //groupData 
              groupData[id][0] = data_group;

              setGroupData(groupData);
              listgroups();
              groupDataChaned()
            }
        }
        $('#editorModel').modal('hide');
      });  
     }); 

    //Channel delete  Handler
    $("#channelTable").on("click", ".delete", function () {
        var id = $(this).attr("data");
        
        var data_group = $(this).attr("data-group");
        //console.log(data_group, id);
        $('#btnDelete').text('delete')
        $("#deleteModal").find(".modal-title").text("Delete Channel");
        $("#deleteModal")
          .find(".modal-body")
          .text("Do You Want To Delete Channel. ?");
        $("#deleteModal").modal("show");
        $("#btnDelete").unbind().click(function () {
            var playlistdata = getplaylist();
            playlistdata.splice(id, 1);
            setplaylist(playlistdata)
            listgroups();
            listchannels(data_group);
            channelDataChaned()
            $('#deleteModal').modal('hide');
          });
    });
      
    //Channel add  Handler
    $('#createChannel').on('click',function(){
      $("#editor-form").trigger("reset"); 
      $('#editorModel').modal('show');
      $('#editorModel').find('.modal-title').text('Add new Channel');
      $('#btnSubmit').text('Add');
      $("#Name").val('');
      $("#StreamUrl").val('');
      $("#urlId").show();
      
      $("#btnSubmit").unbind().click(function () {
        if($("#editor-form").valid()){
          playlistdata = getplaylist()
          var name = $("#Name").val().trim();
          var url = $("#StreamUrl").val().trim();
          var id =  $('#channelTableID tr:last').attr('data');
          id = parseInt(id) + 1;
          var group = $('#channelTable').attr('group').trim();
          
          var item = {"tvg-id":"(no tvg-id)",
                      "tvg-name":name,
                      "group-title":group,
                      "url":url };
          playlistdata.splice(id, 0, item);
        }
        setplaylist(playlistdata)
        listgroups();
        listchannels(group);
        channelDataChaned() ;
        $('#editorModel').modal('hide');
      });
    });

    //Channel edit Handler
    $("#channelTable").on("click", ".edit", function () {
      var id = $(this).attr("data");
      var data_group = $(this).attr("data-group");
      //console.log(data_group, id);
      $("#editor-form").trigger("reset"); 
      
      $('#editorModel').find('.modal-title').text('Edit Channel');

      playlistdata = getplaylist()
  
      $('#btnSubmit').text('Edit');
      $("#urlId").show();

      $("#Name").attr('value',playlistdata[id]["tvg-name"]);
      $("#StreamUrl").attr('value',playlistdata[id]["url"]);
      $('#editorModel').modal('show');
      
      $("#btnSubmit").unbind().click(function () {
        if($("#editor-form").valid()){
          var name = $("#Name").val().trim();
          var url = $("#StreamUrl").val().trim();
          
          
          var group = $('#channelTable').attr('group').trim();


          console.log(name,id,group,url);
          playlistdata[id]["tvg-name"] = name
          playlistdata[id]["url"] = url
          playlistdata[id]["group-title"] = group;

          console.log(id)
          //playlistdata.splice(id, 0, item);
          setplaylist(playlistdata);
        }
        listgroups();
        listchannels(group);
        channelDataChaned() ;
        $('#editorModel').modal('hide');
      });  
     }); 


    

  $("#editor-form").validate({
    rules: {
      Name: {
          required: true,
          minlength: 5,
          maxlength: 30
        },
        StreamUrl: {
            required: true,
            minlength: 5,
            maxlength: 500
        },
    },
    errorClass: "myError",
    submitHandler: function(form, event) { 
      event.preventDefault();
      
   }
    
});
     
      //save changes
      function save(){
        playlistdata = getplaylist();
        playlistdataid = $("#playlistSource").children("option:selected").val();
        $.ajax({
          url: base + "/editor/save",
          method: "POST",
          dataType: "JSON",
          data: { playlistdata:playlistdata,
            playlistdataid:playlistdataid, },
          success: function (d) {
            localStorage.setItem("reservePlaylistdata",playlistdata);
            
            alert(d.msg);
            
          },
          error: function (d) {
            alert("something went wrong");
          },
        });
      }
    //save listerner
    $("#groupBtnSave").on("click", function groupDataSave() {
      save();
      listgroups();
      $("#groupBtnCancel").hide();
      $("#groupBtnSave").hide();
    });
    //save listerner
    $("#channelBtnSave").on("click", function channelDataSave() {

      save();
      var group = $("#channelTable").attr('group');
      listgroups();
      listchannels(group);
      $("#channelBtnCancel").hide();
      $("#channelBtnSave").hide();
    });

    //cancel changes
    function cancel(){
      playlistdata =  JSON.parse(localStorage.getItem("reservePlaylistdata"));
       
        
        setplaylist(playlistdata);
        alert("Changeds Have been Cancel");
    }
    $("#groupBtnCancel").on("click", function groupDataCancel() {
      cancel();
      listgroups();
      $("#groupBtnCancel").hide();
      $("#groupBtnSave").hide();
    });
    $("#channelBtnCancel").on("click", function channelDataCancel() {
        cancel();
        var group = $("#channelTable").attr('group');
        listchannels(group);
        $("#channelBtnCancel").hide();
        $("#channelBtnSave").hide();
      });

      //dectied changes
    
  });
</script>

<script>
  var fixHelperModified = function (e, tr) {
      var $originals = tr.children();
      var $helper = tr.clone();
      $helper.children().each(function (index) {
        $(this).width($originals.eq(index).width());
      });
      return $helper;
    },
    updateIndex = function (e, ui) {
      $("td.index", ui.item.parent()).each(function (i) {
        $(this).html(i + 1);
      });
      /* $('input[type=text]', ui.item.parent()).each(function (i) {
        $(this).val(i + 1);
      }); -->*/
    };

  $("#channelTableID tbody ")
    .sortable({
      helper: fixHelperModified,
      stop: updateIndex,
    })
    .disableSelection();

  $("#channelTableID tbody ").sortable({
    distance: 5,
    delay: 100,
    opacity: 0.6,
    cursor: "move",
    handle: '.handle',
    update: function () {
      channelDataChaned();
      new_locations = $(this).find('tr').map(function(i, el) {
        return $(el).data("d");
      }).get()
      
      
    },
    start: function(event, ui) {
      ui.item.startPos = ui.item.index();
    },
    stop: function(event, ui) {
      var offset = parseInt($('#channelTable').attr('offset'));
      console.log("Start position: " + (ui.item.startPos + offset ));
      console.log("New position: " + (ui.item.index() + offset));
      var a = reorderArray((ui.item.startPos + offset ),(ui.item.index() + offset),getplaylist());
      //console.log(getplaylist())
      //console.log(a)
      setplaylist(a)
    }
  });

  $("#groupTableID  tbody ")
    .sortable({
      helper: fixHelperModified,
      stop: updateIndex,
    })
    .disableSelection();

    const reorderArray = (oldIndex,newIndex, originalArray) => {
      const movedItem = originalArray.filter((item, index) => index === oldIndex);
      const remainingItems = originalArray.filter((item, index) => index !== oldIndex);
      console.log(movedItem[0]);
      const reorderedItems = [
        ...remainingItems.slice(0, newIndex),
        movedItem[0],
        ...remainingItems.slice(newIndex)
      ];
      
      return reorderedItems;
    }

    

  $("#groupTableID tbody ").sortable({
    distance: 5,
    delay: 100,
    opacity: 0.6,
    cursor: "move",
    update: function () {
      groupDataChaned(); 
      
    },
    start: function(event, ui) {
      ui.item.startPos = ui.item.index();
      offsets = $(this).find('tr').map(function(i, el) {
        return $(el).attr("data");
      }).get()
      length = $(this).find('tr').map(function(i, el) {
        return $(el).attr("data-length");
      }).get()
    },
    stop: function(event, ui) {
      
      console.log(offsets);
      console.log(length);
      var oldIndexStart = offsets[ui.item.startPos];
      var oldIndexEnd = length[ui.item.startPos];
      var newIndexStart = offsets[ui.item.index()];
      var newIndexEnd = length[ui.item.index()];

      oldIndex={low: parseInt(oldIndexStart),length:parseInt(oldIndexEnd)};
      newIndex={low: parseInt(newIndexStart),high:parseInt(newIndexEnd)+parseInt(newIndexStart)};
      
      console.log(oldIndex.low,oldIndex.high,newIndex)
     // console.log("Start position: " + oldIndex);
     // console.log("New position: " + newIndex );
      console.log("Start position: " + (ui.item.startPos ));
      console.log("New position: " + (ui.item.index()));
     var a = reorderArrayByGroup(oldIndex,newIndex,getplaylist());
     //console.log(getplaylist())
     console.log(a)
     setplaylist(a)
     setGroupData(reorderArray(ui.item.startPos,ui.item.index(),getGroupData()));
     
    }
  });
  const reorderArrayByGroup = (oldIndex,newIndex, originalArray) => {
    //console.log(oldIndex.low,oldIndex.high,newIndex.low)
    const movedItem = originalArray.splice(oldIndex.low,oldIndex.length);
    //console.log(movedItem);
    const reorderedItems = [
    ...originalArray.slice(0, newIndex.low),
    ...movedItem,
    ...originalArray.slice(newIndex.low)
    ]; 
    return reorderedItems;
}
</script>
<!-- delete Model -->
<div
  class="modal fade"
  id="deleteModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="deleteModal"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModal">Delete Playlist</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do You Want To Delete Playlist. ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-danger" id="btnDelete">
         
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Form Model -->
<div class="modal fade" id="editorModel" tabindex="-1" role="dialog" aria-labelledby="editorModel" aria-hidden="true">
  <div class="modal-dialog " role="document">
  <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editorModel">Create Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form  id="editor-form">
      <div class="modal-body">
      <input type="hidden" name='id' id="NameId">
          <div class="form-group">
            <label for="playlistName" class="col-lg-6 control-label">Name :</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="Name" name="Name" placeholder="Name">
            </div>
          </div>
          

          <div class="form-group " id="urlId">
            <label for="playlistName" class="col-lg-6 control-label">Stream Url :</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="StreamUrl" name="StreamUrl" placeholder="Url">
            </div>
          </div>
                
      </div>
      <div class="modal-footer">
         <button type="reset"  data-dismiss="modal"  class="btn btn-default">Cancel</button>
        <button  class="btn btn-primary" id="btnSubmit">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>