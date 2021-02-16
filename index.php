<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP & Ajax CRUD</title>
  
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>PHP REST API CRUD</h1>

        <div id="search-bar">
          <label>Search :</label>
          <input type="text" id="search" autocomplete="off">
        </div>
      </td>
    </tr>
    <tr>
      <td id="table-form">
        <form id="addForm">
          Name : <input type="text" name="sname" id="sname">
          Age : <input type="number" name="sage" id="sage">
          City : <input type="text" name="scity" id="scity">
          <input type="submit" id="save-button" value="Save">
        </form>
      </td>
    </tr>
    <tr>
      <td id="table-data">
        <table width="100%" cellpadding="10px" border="1px" >
          <tr>
            <th width="40px">Id</th>
            <th>Name</th>
            <th width="50px">Age</th>
            <th width="150px">City</th>
            <th width="60px">Edit</th>
            <th width="70px">Delete</th>
          </tr>
          <tbody id="load-table" align='center'>
           
          </tbody>
        </table>
      </td>
    </tr>
  </table>

  <div id="error-message" class="messages"></div>
  <div id="success-message" class="messages"></div>

  <!-- Popup Modal Box for Update the Records -->
  <div id="modal">
    <div id="modal-form" >
      <h2>Edit Form</h2>
      <form action="" id="edit-form">
      <table cellpadding="10px" width="100%">
        <tr>
          <td width="90px">First Name</td>
          <td><input type="text" name="sname" id="edit-name">
              <input type="text" name="sid" id="edit-id" hidden="">
          </td>
        </tr>
        <tr>
          <td>Age</td>
          <td><input type="number" name="sage" id="edit-age"></td>
        </tr>
        <tr>
          <td>City</td>
          <td><input type="text" name="scity" id="edit-city"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="button" id="edit-submit" value="Update"></td>
        </tr>
      </table>
      </form>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  
  //Fetch All Records
function loadTable(){
  $.ajax({
    url:'http://localhost/restapi/api-fetch-all.php',
    type:"GET",
    success:function(data){
     
      if(data.status==false){
        $("#load-table").append("<tr><td colspan='4'><h2>"+data.massage+"</h2></td></tr>");
      }
      else{
        $.each(data,function(key,value){
          // console.log(data);
          $("#load-table").append("<tr>"
                                         +"<td>"+value.id+"</td>"
                                         +"<td>"+value.student_name+"</td>"
                                         +"<td>"+value.age+"</td>"
                                         +"<td>"+value.city+"</td>"
                                         +"<td><button class='edit-btn' data-eid='"+value.id+"'>Edit</button></td>"
                                         +"<td><button class='delete-btn' data-id='"+value.id+"'>Delete</button></td>"+
                                          "</tr>"
                                          
                                          );
        });
      }
    }

  });
}
loadTable();
//show succes error massage
function message(message,status){
  if(status==ture){
    $("#success-message").html(message).slideDown();
    $("#error-message").html(message).slideUp();
  }else if(status==false){
    $("#error-message").html(message).slideDown();
    $("#success-message").html(message).slideUp();
    setTimeout(function(){
      $("#success-message").slideUp();
    },4000);
  }
}
function jsonData(targetForm){
  var arr=$(targetForm).serialize();
    // console.log(arr);
    var obj={};
    for(var a=0;a<arr.length;a++)
    {
      obj[arr[a.name]]=arr[a].value;
     }
     var json_string=JSON.stringify(obj);
     return json_string;
}
  //Insert New Record
  $('#save-button').on("click",function(){
    e.priventDefault();
    
    var jsonObj=jsonData('#addForm');
    if(jsonObj==false){
      massage("all field is require",false);
    }else{
      $.ajax({
           url:'http://localhost/restapi/api-insert.php',
           type:"POST",
           data:myJSON,
           success:function(data){
            // console.log(data.massage);
            if(data.status==true){
              $('#addForm').trigger("reset");
            }
           }
      });
    }
  })
  //Delete Record

  //Fetch Single Record : Show in Modal Box
   $(document).on("click",".edit-btn",function(){
    //  $("#model").hide();
    var studentid=$(this).data("eid");
    // console.log(studentid);
    var obj={sid:studentid};
    var myJSON=JSON.stringify(obj);
    // console.log(myJSON);
    $.ajax({
           url:'http://localhost/restapi/api-fetch-single.php',
           type:"POST",
           data:myJSON,
           success:function(data){
           // console.log(data);
           $("#edit-id").val(data[0].id);
           $("#edit-name").val(data[0].student_name);
           $("#edit-age").val(data[0].age);
           $("#edit-city").val(data[0].city);
           }
    });
   });
  //Hide Modal Box

  //Update Record
  $('#edit-submit').on("click",function(){
    // e.priventDefault();
    
    var jsonObj=jsonData('#edit-form');
    if(jsonObj==false){
      massage("all field is require",false);
    }else{
      $.ajax({
           url:'http://localhost/restapi/api-update.php',
           type:"POST",
           data:myJSON,
           success:function(data){
            // console.log(data.massage);
            if(data.status==true){
             alert("form update");
            }
           }
      });
    }
  })

  //Live Search Record
});
</script>
</body>
</html>