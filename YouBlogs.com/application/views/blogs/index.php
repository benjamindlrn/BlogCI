
   <div class='col-sm-9' id='divbutton'>
      <table class = 'table'>      
       	 <thead>
			 </tr>
		 </thead>
		 <tr>     

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
        $attributes = array('method' => 'get', 'action'=>site_url('blogs/loadBlog'));        
        $query = $this->db->query('select id,text,title,user_id,date, LOWER(DATE_FORMAT(time,"%l:%i %p")) "time", tag from posts order by date DESC, time DESC');

      foreach ($query->result_array() as $val) {
        $rest = substr($val['text'], 0, 500); 
        $submit = array('name' => 'post_id', 'value' => $val['id'], 'class' => 'btn btn-default', 'type'=>'submit');  
       echo '<h2>'.$val['title'].'</h2>
        <h5><span class="glyphicon glyphicon-time"></span> Post by '.$val['user_id'].', '.$val['date'].', '.$val['time'].'</h5>
        <h5><span class="label label-danger">'.$val['tag'].'</span></h5><br>
        <p>'.$rest.'</p>
        <p align="center">';                          
        echo form_open('blogs/loadBlog',$attributes);
        echo form_button($submit, 'See more');
        echo form_close();
        echo '</p>
        <hr>';       
      }      
      ?>
      </tr>
      </table>
      </div>
      

      
      
