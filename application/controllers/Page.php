<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	
	public function index()
	{	
		$data['title'] = 'M3u';

		$this->load->view('layout/header', $data);
		$this->load->view('public/home');
        $this->load->view('layout/footer');
	}


	// public function view($page = 'index')
	// {
    //     if ( ! file_exists(APPPATH.'views/public/'.$page.'.php'))
    //     {
    //             // Whoops, we don't have a page for that!
    //             show_404();
    //     }

    //     $data['title'] = ucfirst($page); // Capitalize the first letter
	
	// 	$this->load->view('layout/header', $data);
	// 	$this->load->view('public/'.$page);
    //     $this->load->view('layout/footer');
	// }

	public function signup()   
    {   
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->create()) {
                
                // $this->session->set_flashdata('message', ['success', 'User Created']);
				$data['status']=1;
				$data['msg']=' User Created';
				$data['type']= 'success';

				echo json_encode($data);
                
            
            } else {
                $this->session->set_flashdata('message', 'CAN\'T INSERT');
                redirect('signup');
                
            }
        }else if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data['title'] = 'M3u';

            $this->load->view('layout/header', $data);
			$this->load->view('public/signup');
			$this->load->view('layout/footer');
        }
       
	}
	
	public function login()   
    {   
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->auth()) {
                
                // $this->session->set_flashdata('message', ['success', 'User Created']);
				$data['status']=1;
				$data['msg']=' User Login';
				$data['type']= 'success';

				echo json_encode($data);
                
            
            } else {
                $data['status']=0;
				$data['msg']='Invalid Username/Password Entered';
				$data['type']= 'success';

				echo json_encode($data);
                
            }
        }else if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data['title'] = 'M3u';

            $this->load->view('layout/header', $data);
			$this->load->view('public/login');
			$this->load->view('layout/footer');
        }
       
	}
	public function logout(){
		
	}
}
