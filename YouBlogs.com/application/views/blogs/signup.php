<style type="text/css">
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
 background: #2196f3;
 color: #fff;
 }
 footer {
      background-color: #555;
      color: white;
      padding: 15px;
      width: 100%;
      bottom: 0px;      
      position: absolute;
    }
h4{
  color: red;
}

 </style>
<script>
	   function previewFile(){
	       var preview = document.querySelector('img'); //selects the query named img
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
 <div align="center" style="margin-top: 5%">
 <div class="fileinput fileinput-new" data-provides="fileinput">
    <img src="http://res.cloudinary.com/dr8r92oou/image/upload/v1505831697/avatar.jp0" class="img-circle" height="100" width="100" alt="Avatar">

<?php
 $username = array('name' => 'username', 'placeholder' => 'Type your username');
 $password = array( 'id'=> 'password' , 'name' => 'password', 'placeholder' => 'Type your password', 'type'=>'password');
 $passwordConfirm = array( 'id'=>'passwordC','name' => 'passwordC', 'placeholder' => 'Confirm your password', 'type'=>'password');
 $email = array('name' => 'email', 'placeholder' => 'Type your email');
 $submit = array('name' => 'submit', 'value' => 'Sign Up', 'title' => 'Sign Up');
 $inputUpload = array('id' => 'fileToUpload', 'type' => 'file', 'name' => 'myfile', 'onchange'=>"previewFile()", 'accept' => 'image/*');?>
 <?=form_open_multipart(site_url("blogs/signup_validation"))?>
 <div class="imageupload panel panel-default" style="width: 20em">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Upload Image</h3>
                    <div class="btn-group pull-right">
                    </div>
                </div>
                <div class="file-tab panel-body" id="file">
                        <?=form_input($inputUpload)?> 
                </div>                                
 </div>
 </div>
 <label for="username">Username:</label>
 <?=form_input($username)?><h4><?=form_error('username')?></h4>
 <label for="password">Password:</label>
 <?=form_input($password)?><h4><?=form_error('password')?></h4>
 <?=form_input($passwordConfirm)?><h4><?=form_error('passwordC')?></h4>
 <label for="email">Email:</label>
 <?=form_input($email)?><h4><?=form_error('email')?></h4>
 <?=form_submit($submit)?>
 <?=form_close()?>
</div>

