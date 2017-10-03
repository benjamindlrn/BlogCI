<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="/application/views/blogs/css/style.css">
<script type="text/javascript" src="/application/views/blogs/js/script.js"></script>
<script src="lib/jquery.js"></script>
<script src="dist/jquery.validate.js"></script>
<style type="text/css">
	input[type=text],input[type=password],input[type=email]{
	 padding: 6px 2px;
	 width: 330px;
 	}
 	div {
 		text-align: center;
 	}
 	 input[type=submit]{
	 padding: 5px 40px;
	 background: #2196f3;
	 color: #fff;
	 }
</style>
<body>
<?=form_open('blogs/enterPassword_validation')?>
<div class="w3-card-4" id="card" style="margin-top: 8%">
<header class="w3-container w3-blue">
  <h3>To continue, first verify it's you</h3>
</header>
<div class="w3-container"><br>
<?=form_input(array('placeholder'=>'Type your password','name'=>'password'))?><br><br>
<?=form_error('password')?>
<p><?=$this->session->flashdata('login_check')?></p>
<?=form_submit(array('type'=>'submit' ,'class'=>'btn btn-default'),'Submit')?>
</div>
</div>
<?=form_close()?>
</body>
</html>