   <div class='col-sm-9' id='divbutton'>
      <table class = 'table'>      
       	 <thead>
			 </tr>
		 </thead>
		 <tr>  
		 <h4><small>RECENT POSTS</small></h4>

<?php
        $attributes = array('method' => 'get', 'action'=>site_url('blogs/loadBlog'));        
        $query = $this->db->query("select * from posts where tag Like '".$search."%' order by date DESC, time DESC");
      foreach ($query->result_array() as $val) {
         $username = $this->db->query("select username FROM users where users.id = ".$val['user_id']);
            $rest = substr($val['text'], 0, 500); 
        $submit = array('name' => 'post_id', 'value' => $val['id'], 'class' => 'btn btn-default', 'type'=>'submit');  
       echo '<h2>'.$val['title'].'</h2>
        <h5><span class="glyphicon glyphicon-time"></span> Post by '.$username->result_array()['0']['username'].', '.$val['date'].', '.$val['time'].'</h5>
        <h5><span class="label label-danger">'.$val['tag'].'</span></h5><br>
        <p>'.$val['text'].'</p>
        <p align="center">';                          
        echo form_open('blogs/loadBlog',$attributes);
        echo form_button($submit, 'See more');
        echo form_close();
        echo '</p>
        <hr>';       
      }      
      ?></tr>
      </table>
    </div>


            