<style type="text/css">
 label{
 display: block;
 font-size: 21px;
 color: #333333;
 font-weight: bold;
 color: black;
 }
 input[type=text]{
 padding: 10px 6px;
 width: 400px;
 }
 
 textarea {
 padding: 10px 6px;	
}

 input[type=submit]{
 padding: 5px 40px;
 background: #337ab7;
 color: #fff;
 }

 .row {
    margin-right: -13px;
    margin-left: -15px;
}
 </style>


<?php 
 $title = array('name' => 'title', 'placeholder' => 'Type a title');
 $text = array('name' => 'text', 'placeholder' => 'Go ahead!', 'style' => 'width:800px');
 $submit = array('name' => 'submit', 'value' => 'Done', 'title' => 'Done');

 ?>
 <div align="center" style="margin-top: 8%">
 <?=form_open(site_url('blogs/create_validation'))?>
 <label for="title">Title:</label>
 <?=form_input($title)?><p><?=form_error('title')?></p>
 <label for="sel1">Select a topic:</label>  
  <select class="form-control" name="tag" style="width: 200px">
    <option>Affirmations</option>
    <option>Concentration & Mind Power</option>
    <option>General</option>
    <option>Happiness & Joy</option>
    <option>Goals</option>
  </select>
 <label for="text">Text:</label>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload with PHP</title>
</head>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<style type="text/css">
	textarea {
		height: 500px;
	}
</style>
<body>
    <textarea name="text">  
  
</textarea><p><?=form_error('text')?></p>
</body>
</html>

 <?=form_submit($submit)?>
 <?=form_close()?>
 </div>


