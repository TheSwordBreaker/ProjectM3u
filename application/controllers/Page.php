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

	
	private function genratehash_url($email,$hash){
		$email = urlencode($email);
		$url = base_url('/activate/'.$email.'/'.$hash);
		return $url;
	}

	

	public function confirm()	{
		if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data['title'] = 'M3u Confirm Mail';

			// $id = $this->session->userdata('id');
			// $this->load->model('User_model','user');
			
            // $d = $this->user->deatail_by_id($id);

			// $email = $d->email;
			// $hash = $d->hash;
			

			// // $data['url'] = $user['hash'];
			// $data['url'] = $this->genratehash_url($email,$hash);

            $this->load->view('layout/header', $data);
			$this->load->view('public/confirm',$data);
			$this->load->view('layout/footer');
        }
        
	}
	public function confirm_p()	{
		if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data['title'] = 'M3u Confirm Mail';

			$id = $this->session->userdata('username');
			$this->load->model('User_model','user');
			
            $d = $this->user->deatail_by_username($id);

			$email = $d->email;
			$hash = $d->hash;
			

			// $data['url'] = $user['hash'];
			$data['url'] = $this->genratehash_url($email,$hash);

            $this->load->view('layout/header', $data);
			$this->load->view('public/confirm',$data);
			$this->load->view('layout/footer');
        }
        
	}

	public function activate($email,$hash){
		if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data = array(
				'email' => $email,
				'hash' => $hash,
			);
			$data = $this->security->xss_clean($data);


			$this->load->model('User_model','user');
			
            $d = $this->user->deatail_by_email(urldecode($data['email']));
			
			$hash = $d->hash;
			

			if($data['hash'] == $hash){
				
				$this->session->set_flashdata('message', ['success', 'User verified']);  
				$this->user->verify($d->id);
				$this->session->set_userdata('verified', 1);
				redirect('/playlist');             
			}else{
				$this->session->set_flashdata('message', ['danger', 'Url is Incorrect']);
				// redirect('/confirm');             
			}
        }
	}




	private function send_mail($user){

		$to      = $user['email']; 
		$subject = 'Signup | Verification'; // Give the email a subject 
		$url = $this->genratehash_url($user['email'],$user['hash']);

		$message = '

		<h2> Welcome '.$user['username'].'</h2>
		
		Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		
		
		
		Please click this link to activate your account:'
		.$url.'

		The m3u4u Team'.
		base_url().'
		
		'; // Our message above including the link
		$headers = 'from:m3uproject@gmail.com';
							
		mail($to, $subject, $message, $headers); // Send our email
		// $this->load->library('email');
		// $config['protocol'] = 'smtp';
		// $config['smtp_host'] = 'smtp.gmail.com';
		// $config['smtp_user'] = 'm3uproject@gmail.com';
		// $config['smtp_pass'] = 'playlistisworking';
		// $config['smtp_port'] = '465';

		// $this->email->initialize($config);

		// $this->email->from('m3uproject@gmail.com');
		// $this->email->to($to);
		

		// $this->email->subject($subject);
		// $this->email->message($message);

		// if( $this->email->send()){
		// 	echo "ok";
		// }else{
		// 	echo 'error';
		// }

	}

	public function signup(){   
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
			$this->load->model('User_model','user');
			
			$data = array(
				'username' => $this->input->post('user'),
				'email' => $this->input->post('email'),
				'hash' => md5(rand(0,1000)),
			);

			$this->send_mail($data);

            if ($this->user->create($data['hash'])) {
				$this->session->set_userdata('username', $data['username']);
                // $this->session->set_flashdata('message', ['success', 'User Created']);
				$data['status']=1;
				$data['msg']=' User Created';
				$data['type']= 'success';

				echo json_encode($data);
                
            
            } else {
                $data['status']=0;
				$data['msg']=' User Can not be Created';
				$data['type']= 'danger';

				echo json_encode($data);
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
            return $this->user->auth();
        }else if ($_SERVER['REQUEST_METHOD'] === "GET"){
			$data['title'] = 'M3u';

            $this->load->view('layout/header', $data);
			$this->load->view('public/login');
			$this->load->view('layout/footer');
        }
       
	}
	public function checkemail()   
    {   
       
			$this->load->model('User_model','user');
			// echo $this->input->post('inputEmail');
            return $this->user->unique('email',$this->input->post('inputEmail'));
       
       
	}
	public function checkusername()   
    {   
       
			$this->load->model('User_model','user');
			// echo $this->input->post('inputEmail');
            return $this->user->unique('username',$this->input->post('inputUser'));
       
       
	}

}
