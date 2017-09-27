

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="/application/views/blogs/css/style.css">
<script type="text/javascript" src="/application/views/blogs/js/script.js"></script>
<script src="lib/jquery.js"></script>
<script src="dist/jquery.validate.js"></script>
<div class="w3-card-4" id="card" style="margin-top: 8%">
<style type="text/css">
  form, input {
    text-align: center;
  }
   label{
 display: block;
 font-size: 21px;
 color: #333333;
 font-weight: bold;
 color: black;
 }
 input[type=text],input[type=password],input[type=email]{
 padding: 10px 6px;
 width: 400px;
 }
 input[type=submit]{
 padding: 5px 40px;
 background: #337ab7;
 color: #fff;
 }
 p{
 font-weight: bold;
 }
</style>
<header class="w3-container w3-blue">
  <h3>User Profile</h3>
</header>
<div class="w3-container">
  <p><img src="<?=$img?>" class="img-circle" height="100" width="100" alt="Avatar"></p><br><p><?=$username?></p>
   <p><a class="btn" data-popup-open="popup-1" href="#"><button type="button" class="btn btn-default btn-circle" style="outline:none"><span class="glyphicon glyphicon-pencil"></span></button></a></p>
</div>

<div class="w3-container w3-blue">
  <h5>Email</h5>
</div>
<div class="w3-container"><br>
  <p><?=$email?></p>  
</div>
</div>
<?php

      $usernameInput = array('name' => 'username', 'placeholder' => 'Type your new username', 'value' => $username,'minlength'=>3);
      $emailInput = array('name' => 'email', 'placeholder' => 'Type your new email', 'type'=>'email', 'value' => $email,'required'=>true);
       $submit = array('name' => 'submit', 'value' => 'Confirm', 'title' => 'Confirm');
       $inputUpload = array('id' => 'fileToUpload', 'type' => 'file', 'name' => 'myfile', 'onchange'=>"previewFile()", 'accept' => 'image/*','required'=>true);
?>
<div class="popup" data-popup="popup-1">
    <div class="popup-inner">   
      <?=form_open_multipart('blogs/update_user',array('id'=>'commentForm'))?>
    <table>
    <tr>
    <td rowspan="2"><div align="center">
    <div class="fileinput fileinput-new" data-provides="fileinput">
    
        <p><img id="newimage" src="<?=$img?>" class="img-circle" height="100" width="100" alt="Avatar"></p>

    
    <div class="file-tab panel-body" id="file">
    <?=form_input($inputUpload)?> 
    </div></td>
    <td><label for="username">Username:</label>
    <?=form_input($usernameInput)?></td>
    </tr>
    <tr>
    <td><label for="email">Email:</label>
    <?=form_input($emailInput)?> <br><br>  </td>
    </tr>
    <tr><td colspan="2"><?=form_submit($submit)?></td></tr>
    </table>       
    <?=form_close()?>    
        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
    </div>
</div>
<script>
     function previewFile(){
         var preview = document.querySelector('#newimage'); //selects the query named img
         var file    = document.querySelector('input[type=file]').files[0]; //sames as here
         var reader  = new FileReader();

         reader.onloadend = function () {
             preview.src = reader.result;
         }

         if (file) {
             reader.readAsDataURL(file); //reads the data as a URL
         } else {
             preview.src = "";
         }
    }

    previewFile();  //calls the function named previewFile()
  </script>
<script>
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $().ready(function() {
    // validate the comment form when it is submitted
    $("#commentForm").validate();

    // validate signup form on keyup and submit
    $("#signupForm").validate({
      rules: {        
        username: 
        {
          required: true,
          minlength: 2
        },
        email: 
        {
          required: true,
          email: true
        }       
      },
      messages: 
      {       
        email: "Please enter a valid email address",
      }
    });     
  });
  </script>
  








