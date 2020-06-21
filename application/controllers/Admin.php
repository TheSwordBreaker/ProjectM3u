<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }
	public function index()
	{	
        if($this->session->userdata('role')){        
        $data['title'] = 'M3u';
		$this->load->view('layout/header', $data);
		$this->load->view('private/index');
        $this->load->view('layout/footer');
        }else {
            redirect('/editor');
        }
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
     $this->session->unset_userdata('id');
        redirect('/');
    }
    public function UserCreate()   
    {   if($this->session->userdata('role')){  
            if ($_SERVER['REQUEST_METHOD'] === "POST"){
                $this->load->model('User_model','user');
                if ($this->user->create()) {
                    
                    // $this->session->set_flashdata('message', ['success', 'User Created']);
                    $data['status']=1;
                    $data['msg']=' User Created';
                    

                    echo json_encode($data);
                    
                
                } else {
                    $data['status']=0;
                    $data['msg']=' User Can not be Created';
                    

                    echo json_encode($data);               
                }
            }else{
                echo "No Acces";
            }
        }else{
            echo "No Acces";
        }
       
	}

    public function UserDelete(){
        if($this->session->userdata('role')){  
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('User_model','user');
            if ($this->user->delete()) {
                
                // $this->session->set_flashdata('message', ['success', 'User Created']);
				$data['status']=1;
				$data['msg']=' User Deleted';
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
        else{
            echo "No Acces";
        }
    }
    public function UserEdit()
    {
        if($this->session->userdata('role')){  
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
    else{
        echo "No Acces";
    }

    }

    public function Users(){

        if($this->session->userdata('role')){  
            if ($_SERVER['REQUEST_METHOD'] === "GET"){
                $this->load->model('User_model','user');
                $data = $this->user->list();
                
                echo json_encode($data);
            }
        }
        else{
            echo "No Acces";
        }

    }

    public function User(){
        if($this->session->userdata('role')){  
            if ($_SERVER['REQUEST_METHOD'] === "GET"){
                $this->load->model('User_model','user');
                $data = $this->user->deatail();
                echo json_encode($data[0]);
            }
        
        }else{
        echo "No Acces";
    }
	
}
