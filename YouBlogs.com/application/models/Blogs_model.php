<?php
  //Cloudinary
  require 'src/Cloudinary.php';
  require 'src/Uploader.php';
  require 'src/Api.php';

   \Cloudinary::config(array( 
    "cloud_name" => "dr8r92oou", 
    "api_key" => "576724674741138", 
    "api_secret" => "oIwR8vYo97e8Jystj15O86lEiWE" 
  ));
   //Mailgun
   require 'vendor/autoload.php';
   use Mailgun\Mailgun;
   

class Blogs_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_blogs($slug = FALSE)
		{
        	if ($slug === FALSE)
        	{
               	$query = $this->db->get('posts');
               	return $query->result_array();
        	}

        	$query = $this->db->get_where('posts', array('slug' => $slug));
        	return $query->row_array();
		}

		 function can_login($username, $password)  
      {  
          
           $this->db->where('username', $username);  
           $this->db->where('password', $password);  
           $query = $this->db->get('users');  
           //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;       
           }  
      }  

   
 


     public function set_comment()
     {
          $postId = $this->input->get('post_id');
          $text=$this->input->get('text');
          $user=$this->db->query("Select id from users where username ='".$_SESSION['username']."'");
          $authorMail=$this->db->query("select email from users where id = (select user_id from posts where id = ".$postId." )");
          $authorMail= $authorMail->result_array()[0]['email'];
          $userMail=$this->db->query("select email from users where username = '".$_SESSION['username']."'");
          $userMail=$userMail->result_array()[0]['email'];
          $this->load->helper('url');                  
          $data = array(
             'text' => $text,             
             'date' => date('Y-m-d') ,             
             'time' => date("H:i:s"),
             'user_id' => $user->result_array()[0]['id'],
             'post_id' => $postId
         );            

          
          
          //Your credentials
          $mg = new Mailgun("key-00bbce2ade401740e797ca97e0b3e90d");
          
          $domain = "sandbox73aa8eb925f04b8b984628ad9b7d13f6.mailgun.org";
          
          $mg->sendMessage($domain, array(
          'from'=>$userMail,
          'to'=> 'benjamindlrn@gmail.com',
          'subject' => 'Someone has commented on your blog!!',
          'text' => $text
              )
          );
          
                    return $this->db->insert('comments', $data);
   


     }
    
         public function send_mail($mail) 
         {

          $query = $this->db->query("select username, password from users where email ='".$mail."'");
          $mg = new Mailgun("key-00bbce2ade401740e797ca97e0b3e90d");          
          $domain = "sandbox73aa8eb925f04b8b984628ad9b7d13f6.mailgun.org"; 

          $mg->sendMessage($domain, array(
          'from'=>$mail,
          'to'=> 'benjamindlrn@gmail.com',
          'subject' => 'Password recovery!!!',
          'text' => "USERNAME: ".$query->result_array()[0]['username']." PASSWORD: ".$query->result_array()[0]['password']
              )
          );
         }      


     public function set_blog()
     {
          $user=$this->db->query("Select id from users where username ='".$_SESSION['username']."'");
          $newstr = filter_var($this->input->post('text'), FILTER_SANITIZE_STRING);
          $this->load->helper('url');                
         $data = array(
             'title' => $this->input->post('title'),             
             'text' => $newstr,             
             'date' => date('Y-m-d') ,                  
             'time' => date("H:i:s"),
             'tag' => $this->input->post('tag'),
             'user_id' => $user->result_array()[0]['id']
         );         
         //INSERT INTO `comments` (`id`, `text`, `date`, `time`, `user_id`, `post_id`) VALUES (NULL, 'COMMENT 6', CURRENT_DATE(), CURRENT_TIME(), '4', '3');
         return $this->db->insert('posts', $data);
     }    


   public function local_upload()
      {

          $currentDir = getcwd();
          $uploadDirectory = "/uploads/";
          $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions          
          $fileSize = $_FILES['myfile']['size'];
          $fileTmpName  = $_FILES['myfile']['tmp_name'];
          $fileType = $_FILES['myfile']['type'];          
          $tmp = explode('.', $fileName);
          $fileExtension = end($tmp);
          $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
          $valid = false;
          if (isset($_POST['submit'])) {

              if (! in_array($fileExtension,$fileExtensions)) {
                  $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
              }

              if ($fileSize > 2000000) {
                  $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
              }

              if (empty($errors)) {
                  $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                  if ($didUpload) {
                    $str = explode('.',$fileName);
                    $name = $str[0];
                    $valid=true;
                      \Cloudinary\Uploader::upload($uploadPath,array("public_id" => $name));
                      //unlink($uploadPath);


                  } else {
                      echo "An error occurred somewhere. Try again or contact the admin";
                  }
              } else {
                  foreach ($errors as $error) {
                      echo $error . " These are the errors" . "\n";

                  }
 
                }
            }
            return $valid;
          }
          
      
 


          public function sign_up()
     {
         $this->load->helper('url');  
         $url="http://res.cloudinary.com/dr8r92oou/image/upload/v1505831287/";
         $imageId;
         $default="avatar.jpg";                  
         
         

               if (!$this->blogs_model->local_upload())
               {
                  $imageId="avatar.jpg";                  
               }
               else {
                  $imageId=$_FILES['myfile']['name'];                                          
               }
         
         $data = array(
             'username' => $this->input->post('username'),             
             'password' => $this->input->post('password'),
             'email' => $this->input->post('email'),
             'img' => $url.$imageId
         );

         //INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '', '')
         $this->db->insert('users', $data);

         
     }
     

     public function update_blog()
     {
          $user=$this->db->query("Select id from users where username ='".$_SESSION['username']."'");
          $this->load->helper('url');                
         $data = array(
             'title' => $this->input->post('title'),             
             'text' => $this->input->post('text'),             
             'date' => date('Y-m-d') ,                  
             'time' => date("H:i:s"),
             'tag' => $this->input->post('tag')
         );         
         //INSERT INTO `comments` (`id`, `text`, `date`, `time`, `user_id`, `post_id`) VALUES (NULL, 'COMMENT 6', CURRENT_DATE(), CURRENT_TIME(), '4', '3');         
          $this->db->where('id',$this->input->post('post_id'));
          $this->db->update('posts', $data);
         
     }   
}