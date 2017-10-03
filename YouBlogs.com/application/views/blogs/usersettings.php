

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="/application/views/blogs/css/style.css">
<script type="text/javascript" src="/application/views/blogs/js/script.js"></script>
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
 padding: 6px 2px;
 width: 330px;
 }
 input[type=submit]{
 padding: 5px 40px;
 background: #2196f3;
 color: #fff;
 }
 p{
 font-weight: bold;
 }
 div{
  text-align: center;
 }
</style>
<?php
      $usernameInput = array('name' => 'username', 'placeholder' => 'Type your new username', 'value' => $username,'minlength'=>3);
      $emailInput = array('name' => 'email', 'placeholder' => 'Type your new email', 'value' => $email,'required'=>true);
       $confirm = array('name'=>'confirm', 'type'=>'submit',  'class'=>'btn btn-default');
       $password= array('name'=>'password', 'type'=>'submit', 'class'=>'btn btn-default');
       $inputUpload = array('id' => 'fileToUpload', 'type' => 'file', 'name' => 'myfile', 'onchange'=>"previewFile()", 'accept' => 'image/*');

?>
<header class="w3-container w3-blue">
  <h3>User Profile</h3>
</header>
<div class="w3-container">
  <p><img src="<?=$img?>" class="img-circle" height="100" width="100" alt="Avatar"></p><br> 
  <?=form_open('blogs/usersettings_validation')?>
  <?=form_input($inputUpload)?> <br>
  <p><?=form_input($usernameInput)?></p></td>
</p>  
<?=form_error('username')?>
</div>
<div class="w3-container w3-blue">
  <h5>Email</h5>
</div>
<div class="w3-container"><br>
  <p><?=form_input($emailInput)?></p> 
  <?=form_error('email')?><br>
 <?=form_submit($confirm,"Confirm changes")?> 
  <?=form_close()?>
  <label><?=$this->session->flashdata('Message');?></label>
  <br>
</div>
<div class="w3-container w3-blue">
  <h5>Password</h5>
  </div>
  <div class="w3-container"><br>
  <?=form_open('blogs/enterPassword')?>
  <p><?=form_button($password,'Set new password')?></p> 
  <?=form_close()?>
  </div>
</div>
  








