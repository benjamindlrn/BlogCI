<style type="text/css">
	#blog{
		max-width: 55%;		
		text-align: center;
		font-size: 18px;		
		margin-left: 22%;		
	}
	#comments {
		margin-left: 4%;
	}
.row {
    margin-right: -7px;
    margin-left: -15px;
}
</style>
 
<?php
			  $this->db->where('id',$post_id);                                                                  
              if($this->db->count_all_results('posts')===0)
              { 
                  $this->load->view('blogs/404');
              }
              else 
              {
                  
              
	$query = $this->db->query("Select * from posts where id = '".$post_id."'"); 		 		                
      foreach ($query->result_array()  as $row)
			{        
				$post_id=$this->input->get('post_id');
				$username = $this->db->query("select username FROM users where users.id = ".$row['user_id']);     
        		echo "
        		<br><hr>		
        		<div id='blog'>        		        	
      			<h2 align='center'>".$row['title']."</h2>
      			<h5><span class='label label-danger'>".$row['tag']."</span></h5>
      			<h5><span class='glyphicon glyphicon-time'></span> Post by ".$username->result_array()['0']['username'].", ".$row['date'].".</h5>      
      			<p>".$row['text']."</p>
      			<br></div>"; 
	}
				$num = $this->db->query("select COUNT(*) from comments where post_id ='".$post_id."'")->result_array()['0']['COUNT(*)'];
//				echo '<div id="comments">';
				if (isset($this->session->username)){
				echo '	
	 			<h4 style="margin-left:12%">Leave a Comment:</h4>';	      		
	      		echo form_open('blogs/insert_comment',array('method'=>'get', 'style'=>'margin-left:12%'));	      		
	      		echo form_textarea(array('rows'=>'3', 'name'=>'text', 'class'=>'form-control', 'style'=>'width:80%;'));
	      		 $submit = array('name' => 'post_id', 'value' => $post_id, 'class' => 'btn btn-success', 'type'=>'submit');  
	      		echo form_button($submit,'Submit');	       	
	      			      		
	      	}
	      			else{
	      				echo '<h4> To leave a comment you need an account<a href="'.site_url("blogs/signup").'"> Sign up here!</a></h4><br>
	      				';
	      			}
	      			echo '<p><span class="badge">'.$num.'</span> Comments:</p><br>';
	      			$query = $this->db->query("select id,text,date,LOWER(DATE_FORMAT(time,'%l:%i %p')) 'time',user_id, post_id from comments where post_id = '".$post_id."'");
				
      		foreach ($query->result_array()  as $row)
			{       			
				$username = $this->db->query("select username FROM users where users.id = ".$row['user_id']);
				$img = $this->db->query("select img FROM users where users.id = ".$row['user_id']);            
				
       		echo "
        		<div class='row'>
	        	<div class='col-sm-2 text-center'>
	          		<img src='".$img->result_array()['0']['img']."' class='img-circle' height='55' width='55' alt='Avatar'>
	        	</div>
	        	<div class='col-sm-8' text-center'>
	          	<h4>".print_r($username->result_array()['0']['username'])."<small>  ".$row['date'].", ".$row['time']."</small></h4>
	            	<p>".$row['text']."</p>
	          	<br>
	        	</div>       
	        	</div>"; 
				}	
			}

