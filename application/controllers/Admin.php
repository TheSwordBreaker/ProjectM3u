<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();
    //     if (!$this->session->userdata('username')) {
    //         redirect('Page');
    //     }
    // }
	public function index()
	{	
        $data['title'] = 'M3u';

		$this->load->view('layout/header', $data);
		$this->load->view('private/index');
        $this->load->view('layout/footer');
    }
	public function playlist()
	{	
		$data['title'] = 'M3u';

		$this->load->view('layout/header', $data);
		$this->load->view('private/playlist');
        $this->load->view('layout/footer');
    }
    

    public function logout(){
     $this->session->unset_userdata('username');
        redirect('/');
    }

    public function UserDelete(){
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->delete()) {
                
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
        }
    }
    public function UserEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->edit()) {
                
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
        }

    }

    public function Users(){
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->list()) {
                
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
        }

    }

    public function User(){
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
        }

    }
    


	
}
