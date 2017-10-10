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
 background: #2196f3;
 color: #fff;
 }

 .row {
    margin-right: -13px;
    margin-left: -15px;
}

  h4 {
    color: red;
  }

div {
  text-align: center;
}


 </style>



<?php 
 $title = array('name' => 'title', 'placeholder' => 'Type a title');
 $text = array('name' => 'text', 'placeholder' => 'Go ahead!', 'style' => 'width:800px');
 $submit = array('name' => 'submit', 'value' => 'Done', 'title' => 'Done');

 ?>
   <link rel="stylesheet" src="css/style.css">
 <div style="margin-left: 16%; margin-top:10%; width: 1000px" >
 <?=form_open(site_url('blogs/create_validation'))?>
 <label for="title">Title:</label>
 <?=form_input($title)?><h4><?=form_error('title')?></h4>
 <label for="sel1">Select a topic:</label>  
 <div>
  <select class="form-control" name="tag" style="width: 200px; margin-left: 40%">
    <option>Affirmations</option>
    <option>Concentration & Mind Power</option>
    <option>General</option>
    <option>Happiness & Joy</option>
    <option>Goals</option>
  </select>
  </div>
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
<h4><?=form_error('text')?></h4>
    <textarea rows=5 name="text">  
  
</textarea>
</body>
</html>

 <?=form_submit($submit)?>
 <?=form_close()?>
 </div>
 <script type="text/javascript">
   tinymce.init({
  selector: "textarea",  // change this value according to your html
  plugins: "paste",
  menubar: "edit",
  toolbar: "paste",
  paste_enable_default_filters: true
});
 </script>


