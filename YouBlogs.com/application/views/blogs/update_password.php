<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="/application/views/blogs/css/style.css">
<script type="text/javascript" src="/application/views/blogs/js/script.js"></script>
<body>
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
	<?=form_open('blogs/update_password_validation')?>
		<div class="w3-card-4" id="card" style="margin-top: 8%">
		<header class="w3-container w3-blue">
  			<h3>Type your new password</h3>
		</header>
		<div class="w3-container"><br>
		<?=form_input(array('placeholder'=>'Type your password','name'=>'password'))?><br><br>
		<?=form_error('password')?>
		<?=form_input(array('placeholder'=>'Type your password','name'=>'passwordC'))?><br><br>
		<?=form_error('passwordC')?>
		<?=form_submit(array('type'=>'submit' ,'class'=>'btn btn-default'),'Set new password')?>
		</div>
		</div>
	<?=form_close()?>
</body>
</html>