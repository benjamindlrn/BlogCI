
<style type="text/css">

 label{
 display: block;
 font-size: 21px;
 color: #333333;
 font-weight: bold;
 color: black;
 }
 input[type=text],input[type=password]{
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
    h4 {
    	color: red;
    }
 </style>
<?php
 $username = array('name' => 'username', 'placeholder' => 'Type your username');
 $password = array('name' => 'password', 'placeholder' => 'Type your password', 'type'=>'password');
 $submit = array('name' => 'submit', 'value' => 'Log In', 'title' => 'Log In');
 ?>
 <div align="center" style="margin-top: 8%">
  <label><?=$this->session->flashdata('Message');?></label>
 <?=form_open(site_url('blogs/login_validation'))?>
 <label for="username">Username:</label>
 <?=form_input($username)?><h4><?=form_error('username')?></h4>
 <label for="password">Password:</label>
 <?=form_input($password)?><h4><?=form_error('password')?></h4>
 <?=form_submit($submit)?><br><br>
 <a href="<?=site_url('blogs/recover_password')?>" >I forgot my password</a>
 <?=form_close()?>
</div>