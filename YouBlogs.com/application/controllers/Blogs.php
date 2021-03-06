<?php

class Blogs extends CI_Controller {


        public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->model('blogs_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {                   
                $data['blogs'] = $this->blogs_model->get_blogs();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/side');
                $this->load->view('blogs/index', $data);
                $this->load->view('templates/footer');
        }

        public function loadBlog(){                    
                $data['post_id'] = $this->input->get('post_id');                              
                $this->load->view('templates/header');
                $this->load->view('blogs/blog',$data);
                $this->load->view('templates/footer');                
        }
        public function notfound(){                                        
                $this->load->view('templates/header');
                $this->load->view('blogs/404');
                $this->load->view('templates/footer');                
        }
        public function deleteBlog()
        {
          $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
            $post_id = $this->input->get('post_id');
            $this->db->where('post_id',$_POST['post_id']);
            $this->db->delete('comments');                              
            $this->db->where('id',$_POST['post_id']);
            $this->db->delete('posts');
            redirect('blogs');               
        }
   public function create()
        {                        
                $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
                $this->load->view('templates/header');                
                $this->load->view('blogs/create');
                $this->load->view('templates/footer');
        }


        public function editBlog()
        {
          $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
            //select * from posts where id=17 and user_id=60
            $post_id = $this->input->get('post_id'); 
            $user_id=$this->db->query("select id from users where username='".$_SESSION['username']."'");  
            $this->db->where('id',$post_id);
            $this->db->where('user_id',$user_id->result_array()[0]['id']);
            if($this->db->count_all_results('posts')>0)
            {
                                       
            $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }         
            $query=$this->db->query("Select * from posts where id='".$post_id."'");
            
                $data = array(
              'title' => $query->result_array()[0]['title'],
              'tag' => $query->result_array()[0]['tag'],              
              'text' => $query->result_array()[0]['text'],
              'post_id'=>$post_id);  
            
            
            $this->load->view('templates/header');                
            $this->load->view('blogs/update',$data);
            $this->load->view('templates/footer');
            }
            else
            {
              redirect('blogs');
            }
            }
        
        
        public function insert_comment()
        {
          $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }                     
                    if ($this->input->get('post_id')===$this->input->get('post_idC')) {
                    $this->load->model('blogs_model'); 
                    $this->blogs_model->set_comment();
                    redirect('blogs/loadBlog?post_id='.$this->input->get('post_id'));
                  }
                    
                 else{
                  
                    redirect('blogs/loadBlog?post_id='.$this->input->get('post_idC'));            
                }                              
          
        }      


     
        public function results()
        {
                $data['search']= $this->input->get('search');
                $this->load->view('templates/header');
                $this->load->view('templates/side');
                $this->load->view('blogs/search',$data);
                $this->load->view('templates/footer');
        }

        public function own_blogs()
        {
         $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
                $query=$this->db->query("Select id from users where username = '".$this->session->userdata('username')."'");
                $data= array(
                  'user_id' => $query->result_array()[0]['id']);
                $this->load->view('templates/header');
                $this->load->view('templates/side');
                $this->load->view('blogs/ownBlogs',$data);
                $this->load->view('templates/footer');
        }
        
        public function login()
        {          
           
                if (isset($this->session->username))
                {
                    redirect(site_url('blogs'));  
                }
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->view('templates/header');
            $this->load->view('blogs/login');
        }      

            function login_validation()  
          {  
             if (isset($this->session->username))
                {
                    redirect(site_url('blogs'));  
                }
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('username', 'Username', 'required');  
               $this->form_validation->set_rules('password', 'Password', 'required');                            
               if($this->form_validation->run())  
               {  
                    //true  
                    $username = $this->input->post('username');  
                    $password = $this->input->post('password');  
                    //model function  
                    $this->load->model('blogs_model');  
                    if($this->blogs_model->can_login($username, $password))  
                    {  
                         $session_data = array(  
                              'username'=>$username  
                         );  
                         $this->session->set_userdata($session_data);  
                         redirect(site_url('blogs/enter'));  
                    }  
                    else  
                    {       
                        $this->session->set_flashdata('Message','Wrong user or password, Try again!');         
                        redirect(site_url("blogs/login"));                            
                    }  
               }  
               else  
               {  
                    //false  
                    $this->login(); 

               }  
          }  


        public function signup()
        {
            if (isset($this->session->username))
                {
                    redirect(site_url('blogs'));  
                }
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->view('templates/header');
            $this->load->view('blogs/signup');
        }

          function signup_validation()  
          {  
               if (isset($this->session->username))
                {
                    redirect(site_url('blogs'));  
                }
               $this->load->library('form_validation');  
               $this->form_validation->set_message(array('is_unique'=>"That user name is already taken"));
               
               $this->form_validation->set_rules('username', 'Username' ,'required|max_length[30]|is_unique[users.username]');  

               $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[30]');  
               $this->form_validation->set_rules('passwordC', 'Password Confirmation', 'matches[password]');
               $this->form_validation->set_message(array('is_unique'=>"That email is already associated"));
               $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|is_unique[users.email]');               

               if($this->form_validation->run())  
               {  
                 $this->load->model('blogs_model'); 
                 $username = $this->input->post('username');                  
                 $this->blogs_model->sign_up();
                  $session_data = array(  
                              'username'=>$username  
                         );                    
                  $this->session->set_userdata($session_data);      
                  redirect(site_url('blogs/enter'));  
               } 
               else  
               {  
                    //false  
                   $this->signup();
               }                  
          }  


          function create_validation()  
          {  
              $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('title', 'Title', 'required|max_length[60]');  
               $this->form_validation->set_rules('text', 'Text', 'required');  
               if($this->form_validation->run())  
               {  
                    $this->load->model('blogs_model');                      
                    $this->blogs_model->set_blog();
                    $this->session->set_flashdata('Message','Blog created!');
                    redirect(site_url('blogs'));  
               }     
               else{
                 $this->create();
               }             
          }  

          

          function enter(){  
               if($this->session->userdata('username') != '')  
               {                  
                    $this->load->view('templates/header');
                    $data['username'] = $this->session->userdata('username');
                    $this->load->view('templates/side',$data);
                    $this->load->view('blogs/index');
                    $this->load->view('templates/footer');                                        
               }  
               else  
               {  
                    $this->load->view('blogs/404');      
               }  
          }  
          function logout()  
          {  
               $this->session->unset_userdata('username');  
               redirect(site_url('blogs/login'));  
          }  
          function enterPassword()
          {
            $this->load->helper('session');
            if (!is_logged_in())
            {
                redirect(site_url('blogs'));  
            }
            $this->load->view('templates/header');
            $this->load->view('blogs/setting_password');
            $this->load->view('templates/footer');
          }

          function enterPassword_validation()
          {
            $this->load->helper('session');
            if (!is_logged_in())
            {
                redirect(site_url('blogs'));  
            }    
               $this->load->library('form_validation');  
               $this->load->model('blogs_model');               
               
                  $this->form_validation->set_rules('password', 'Password','required');                  
                 if($this->form_validation->run())  
                 {  
                      if ($this->blogs_model->can_login($this->session->username,$this->input->post('password')))
                      {
                        redirect('blogs/update_password');
                        }  
                       else
                       {
                           $this->session->set_flashdata('login_check','Wrong password, try again');      
                           redirect('blogs/enterPassword');
                       }
                 }     
                 else{
                   $this->enterPassword();
                 }                                                    
          }

          function update_password()
          {
            $this->load->view('templates/header');
            $this->load->view('blogs/update_password');
            $this->load->view('templates/footer');
          }

          function update_password_validation()
          {
            $this->load->helper('session');
            if (!is_logged_in())
            {
                redirect(site_url('blogs'));  
            }    
               $this->load->library('form_validation');  
            $this->form_validation->set_rules('password','Password','required|min_length[8]|max_length[30]');  
               $this->form_validation->set_rules('passwordC', 'Password Confirmation', 'matches[password]');                         
               if($this->form_validation->run())  
               {  
                    $this->db->where('username',$this->session->username)
                             ->set('password',$this->input->post('password'))
                             ->update('users');
                    $this->session->set_flashdata('Message','Password changed');
                    redirect('blogs/usersettings');
               }     
               else{
                 $this->update_password();
               } 
          }

          function usersettings()
          {
            $this->load->helper('session');
            if (!is_logged_in())
            {
                redirect(site_url('blogs'));  
            }
            $query=$this->db->query("Select * from users where username = '".$_SESSION['username']."'");
            $data = array(
              'username' =>  $query->result_array()[0]['username'],
              'img' =>  $query->result_array()[0]['img'],
              'email' =>  $query->result_array()[0]['email']
              );
            $this->load->view('templates/header');
            $this->load->view('blogs/usersettings',$data);
            $this->load->view('templates/footer');   
          }

          function usersettings_validation()
          {
               $this->load->helper('session');
               if (!is_logged_in())
               {
                   redirect(site_url('blogs'));  
               }
               $this->load->library('form_validation');  
               $this->load->library('form_validation');  
               $username =$this->session->username;
               $email=$this->db->where('username',$username)->get('users')->result_array()[0]['email'];
               if ($username!==$this->input->post('username'))
               {
                 $this->form_validation->set_message(array('is_unique'=>"That user name is already taken"));

                $this->form_validation->set_rules('username', 'Username' ,'required|max_length[30]|is_unique[users.username]');
                

               }      
               else{
                $this->form_validation->set_rules('username', 'Username' ,'required|max_length[30]');

               }    
                
               if ($email!==$this->input->post('email'))
               {
                  $this->form_validation->set_message(array('is_unique'=>"That email is already taken"));   
               $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]|is_unique[users.email]');
               }
               else {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]');
               }


               if($this->form_validation->run())  
               {  
                    $this->update_user();  
               }     
               else{
                    $this->usersettings();
               }
          }

          public function recover_password() 
          {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->view('templates/header');
            $this->load->view('blogs/password');
            $this->load->view('templates/footer');   
          }

          public function send_recovery() 
          {
            if ($this->input->post('mail')===null)
            {
               redirect(site_url('blogs'));  
            }
            $this->db->where('email',$this->input->post('mail'));
            $this->load->library('form_validation');  
            $this->form_validation->set_rules('mail', 'Email', 'required|valid_email');  
            if($this->form_validation->run())
            {
              if($this->db->count_all_results('users')===0)
              {          
                echo "That email is not associated";              }
              else 
              {
                $mail=$this->input->post('mail');
                $this->load->model('blogs_model');
                $this->blogs_model->send_mail($mail);
                echo "Check your email!!!!";
              }
            }
            else {
                $this->recover_password();
            }            
          }

          public function update_user()
          {           
              $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
              $this->load->helper('url');  
               $url="http://res.cloudinary.com/dr8r92oou/image/upload/v1505831287/";
               $imageId=$this->input->post('myfile');                                          
               
              $this->load->model('blogs_model');              
              $username=$this->session->userdata('username');
              $newUsername=$this->input->post('username');  
              $email =$this->input->post('email');  
              $id= $this->db->query("select id from users where username='".$username."'")->result_array()[0]['id'];  
              $data = array(
              'username' => $newUsername,
              'email' => $email,
              'img' => $url.$imageId
              );              
              var_dump($data);
              $this->db->where('id', $id);
              $this->db->update('users', $data);
              $session_data = array(  
                              'username'=>$newUsername  
                         );  
                         $this->session->set_userdata($session_data); 
              $this->session->set_flashdata('Message','Changes saved');
              redirect('blogs/usersettings');
          }

          function update_validation()  
          {  
              $this->load->helper('session');
                if (!is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('title', 'Title', 'required');  
               $this->form_validation->set_rules('text', 'Text', 'required');  
               if($this->form_validation->run())  
               {  
                    $this->load->model('blogs_model');                      
                    $this->blogs_model->update_blog();
                    redirect(site_url('blogs'));  
               }     
               else{
                 $this->editBlog();
               }             
          }  
}