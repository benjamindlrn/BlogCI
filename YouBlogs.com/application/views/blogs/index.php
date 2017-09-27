
   <div class='col-sm-9' id='divbutton'>
      <table class = 'table'>      
       	 <thead>
			 </tr>
		 </thead>
		 <tr>     
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="/application/views/blogs/css/style.css">
<script type="text/javascript" src="/application/views/blogs/js/script.js"></script>
     <?php if (isset($this->session->username)){
       echo '<p><a href="'.site_url("blogs/create").'">
          <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-plus"></span> Make your own blog!
          </button></a>
        </p>';
        }
        else {
            echo '<h4> To make a blog you need an account<a href="'.site_url("blogs/signup").'"> Sign up here!</a></h4><br>';
        }
      ?>
      <h4><small>RECENT POSTS</small></h4>
      <hr>      
      <?php
        $query = $this->db->query('select id,text,title,user_id,date, LOWER(DATE_FORMAT(time,"%l:%i %p")) "time", tag from posts order by date DESC, time DESC');

      foreach ($query->result_array() as $val) {
        $username = $this->db->query("select username FROM users where users.id = ".$val['user_id']);
        $rest = substr($val['text'], 0, 700); 
        $submitLoad = array('name' => 'post_id', 'value' => $val['id'], 'class' => 'btn btn-default', 'type'=>'submit');  
          
       echo '<h2>'.$val['title'].'</h2>
        <h5><span class="glyphicon glyphicon-time"></span> Posted by '.$username->result_array()['0']['username'].', '.$val['date'].', '.$val['time'].'</h5>
        <h5><span class="label label-danger">'.$val['tag'].'</span></h5><br>
        <p>'.$rest.'</p>
        <p align="center"><br>';                          
        echo form_open(site_url("blogs/loadBlog"),array('method' => 'get'));
        echo form_button($submitLoad, 'See more');
        echo form_close();
        if (isset($_SESSION['username']))
        {
            $query = $this->db->query("select id from users where username='".$_SESSION['username']."'");
            if($query->result_array()[0]['id']===$val['user_id'])
            {
              $submitEdit = array('name' => 'post_id', 'value' => $val['id'], 'class' => 'btn btn-default', 'type'=>'submit');  
             $submitDelete = array('name' => 'post_id', 'value' => $val['id'], 'class' => 'btn btn-default', 'type'=>'submit', 'onclick'=>'myFunction()');
              echo form_open('blogs/editBlog',array('method' => 'get','style'=>'float:right'));
              echo form_button($submitEdit, 'Edit');  
              echo form_close();
              echo form_open('blogs/deleteBlog',array('method' => 'post','style'=>'float:right', 'class'=>'target'));
              echo form_button($submitDelete, 'Delete'); 
              echo form_close();                         
            }                      
        }       
        echo '</p>
        <hr>';       
      }      
      ?>
      </tr>
      </table>
      </div>
<script>
function myFunction() {
    var txt;
    var r = confirm("Are you sure?");
    if (r == true) {
    } else {
        $( ".target" ).submit(function( event ) {
        event.preventDefault();
        }); 
        location.reload();
    }
}
</script>
      
      
