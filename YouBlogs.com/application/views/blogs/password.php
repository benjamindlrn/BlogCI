<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<style type="text/css">
input[type=text],input[type=password]{
 padding: 10px 6px;
 width: 400px;
 }
  label{
 display: block;
 font-size: 21px;
 color: #333333;
 font-weight: bold;
 color: black;
 }
 input[type=submit]{
 padding: 5px 40px;
 background: #2196f3;
 color: #fff;
 }
 h4 {
 	color: red;
 }
 </style>
<div align="center" style="margin-top: 8%">
<?=form_open('blogs/send_recovery')?>
<label for="name">Enter your recovery email</label>
<?=form_input(array('placeholder'=>'Type your email','name'=>'mail'))?><h4><?=form_error('mail')?></h4>
<?=form_submit(array('value'=>'Send','name'=>'emailConf'))?>
<?=form_close()?>
</div>
</body>
</html>