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
        
        public function insert_comment()
        {
          $this->load->model('blogs_model');
              if (!$this->blogs_model->is_logged_in())
              {
                  redirect(site_url('blogs'));  
              }                                      
          $this->load->model('blogs_model'); 
          $this->blogs_model->set_comment();
          redirect(site_url('blogs'));
             
          
        }      


        public function create()
        {                        
                $this->load->model('blogs_model');
                if (!$this->blogs_model->is_logged_in())
                {
                    redirect(site_url('blogs'));  
                }
                $this->load->view('templates/header');                
                $this->load->view('blogs/create');
                $this->load->view('templates/footer');
        }


        public function results()
        {
                $data['search']= $this->input->get('search');
                $this->load->view('templates/header');
                $this->load->view('templates/side');
                $this->load->view('blogs/search',$data);
                $this->load->view('templates/footer');
        }
        
        public function login()
        {          
            $this->load->model('blogs_model');
            if ($this->blogs_model->is_logged_in())
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
              $this->load->model('blogs_model');
              if ($this->blogs_model->is_logged_in())
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
                         $this->session->set_flashdata('error', 'Invalid Username and Password');  
                         redirect(site_url('blogs/login'));  
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
            $this->load->model('blogs_model');
            if ($this->blogs_model->is_logged_in())
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
               $this->load->model('blogs_model');
              if ($this->blogs_model->is_logged_in())
              {
                  redirect(site_url('blogs'));  
              }
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('username', 'Username', 'required');  
               $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');  
               $this->form_validation->set_rules('email', 'Email', 'required|valid_email');  

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
               $this->load->model('blogs_model');
              if (!$this->blogs_model->is_logged_in())
              {
                  redirect(site_url('blogs'));  
              }
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('title', 'Title', 'required');  
               $this->form_validation->set_rules('text', 'Text', 'required');  
               if($this->form_validation->run())  
               {  
                    $this->load->model('blogs_model');                      
                    $this->blogs_model->set_blog();
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
                    $this->load->view('blogs/fail');      
               }  
          }  
          function logout()  
          {  
               $this->session->unset_userdata('username');  
               redirect(site_url('blogs/login'));  
          }  

          function usersettings()
          {
            $this->load->model('blogs_model');
            if (!$this->blogs_model->is_logged_in())
            {
                redirect(site_url('blogs'));                  redirect(site_url('blogs'));              }
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
                echo "Please type a valid address";
              }
              else 
              {
                echo "EXISTE";
              }
            }
            else {
                $this->recover_password();
            }

            //$mail=$this->input->post('mail');
            //$this->load->model('blogs_model');
            //$this->blogs_model->send_mail($mail);
            //echo "Check your email!!!!";
          }
}