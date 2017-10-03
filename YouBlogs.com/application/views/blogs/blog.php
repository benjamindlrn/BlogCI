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
 <script src="../../../lib/jquery.js"></script>
<script src="../../../dist/jquery.validate.js"></script>
<script>
  $.validator.setDefaults({
    submitHandler: function() {
      alert("submitted!");
    }
  });

  $().ready(function() {
    // validate the comment form when it is submitted
    $("textarea").validate();

    // validate signup form on keyup and submit
    $("textarea").validate({
      rules: {        
        text: 
        {
          required: true,
          maxlength: 700
        }       
      },
      messages: 
      {       
        email: "Please don't exceed the limit on the comment section (700)"
      }
    });     
  });
  </script>
  



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
				if (isset($this->session->username)){
				echo '	
	 			<h4 style="margin-left:10%">Leave a Comment:</h4>';	      		
	 			$hidden = array('post_idC' => $post_id );
	      		echo form_open('blogs/insert_comment',array('method'=>'get', 'style'=>'margin-left:10%',$hidden));	      			      		
	      		echo form_textarea(array('rows'=>'3', 'name'=>'text', 'class'=>'form-control', 'style'=>'width:80%;','maxlength'=>'750'));
	      		echo validation_errors();
	      		 $submit = array( 'value'=> $post_id, 'name'=>'post_id' ,'class' => 'btn btn-success', 'type'=>'submit');  
	      		echo form_button($submit,'Submit');	
	      			      		
	      	}
	      			else{
	      				echo '<h4> To leave a comment you need an account<a href="'.site_url("blogs/signup").'"> Sign up here!</a></h4><br><br>
	      				';
	      			}
	      			echo '<br><p><span class="badge" style="margin-left:5%">'.$num.'</span> Comments:</p><br>';
	      			$query = $this->db->query("select id,text,date,LOWER(DATE_FORMAT(time,'%l:%i %p')) 'time',user_id, post_id from comments where post_id = '".$post_id."'");	
              echo "<div class='row'><div class='col-sm-2 text-center'></div></div>";			
      		foreach ($query->result_array()  as $row)
			{       			
				$username = $this->db->query("select username FROM users where users.id = ".$row['user_id']);
				$img = $this->db->query("select img FROM users where users.id = ".$row['user_id']);          
	        	 echo "
	        	<div class='row'>
        			<div class='col-sm-2 text-center'>
          				<img src='".$img->result_array()['0']['img']."' class='img-circle' height='65' width='65' alt='Avatar'>
        			</div>
        			<div class='col-sm-10'>
          			<h4> ".$username->result_array()['0']['username']."<small>  ".$row['date'].", ".$row['time']."</small> </h4>
          			<p>".$row['text']."</p>
          			<br>
        			</div>
      			</div>
	        	 ";
				}	
			}
			echo form_hidden($hidden);
			echo form_close();
