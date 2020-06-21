<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaylistC extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
    }
	public function index()
	{	
        $data['title'] = 'M3u Playlist';
        // $data_table 

		$this->load->view('layout/header', $data);
		$this->load->view('private/playlist');
        $this->load->view('layout/footer');

        
    }
    

    
    public function PlaylistCreate(){
        if ($_SERVER['REQUEST_METHOD'] === "POST"){



            $form_data['source'] = $this->input->post('playlistSource');
            $form_data['name'] = $this->input->post('playlistName');
            $form_data['createdby'] = $this->session->userdata('id');
            $form_data['file'] = "";
            $form_data['url']="";
            $select = $form_data['source'] ;
            //  $FileName = $_FILES['playlistFile']['name'];
            
             $this->load->model('Playlist_model','playlist');

            if($select == 1){
                
               
                
            }else if($select ==2){

                $config['upload_path']          = './assets/files/';
                $config['file_name']             = $form_data['createdby'].date("Y-m-d-h-i-s")."M3u-Playlist.m3u";
                $config['allowed_types']        = 'm3u';
                $config['max_size']             = 3000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('playlistFile'))
                {
                    //Not Upload
                        $error = array('error' => $this->upload->display_errors());
                        // print_r($error);
                        $this->session->set_flashdata('message', ['danger', $error['error']]);
                        redirect('/playlist'); 
                }
                else
                {
                        // $file = array('upload_data' => $this->upload->data());
                        $file = $this->upload->data('file_name');

                        $form_data['file'] = 'assets/files/'.$file;
                        $this->session->set_flashdata('message', ['success', 'File Uploaded.']);
                        
                }
                
            }else if($select == 3){
              
             
            }

            
            if ($this->playlist->create($form_data)) {
                
                $this->session->set_flashdata('message', ['success', 'Playlist Created']);
                redirect('/editor');
            
            } else {
                $data['status']=0;
				$data['msg']='Invalid Username/Password Entered';
				$data['type']= 'success';

				echo json_encode($data);
                
            }
        }
    }
    

    public function PlaylistDelete(){
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            $this->load->model('Playlist_model','playlist');
            if ($this->playlist->delete()) {
                
                // $this->session->set_flashdata('message', ['success', 'User Created']);
				$data['status']=1;
				$data['msg']=' playlist Deleted';
				$data['type']= 'success';

				echo json_encode($data);
                
            
            } else {
                $data['status']=0;
				$data['msg']='playlist could not be Deleted';
				$data['type']= 'danger';

				echo json_encode($data);
                
            }
        }
    }
    public function PlaylistEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST"){



            $id = $this->input->post('id');
            $form_data['source'] = $this->input->post('playlistSource');
            $form_data['name'] = $this->input->post('playlistName');
            $form_data['createdby'] = $this->session->userdata('id');
            $form_data['file'] = "";
            $form_data['url']="";
            $select = $form_data['source'] ;

            //  $FileName = $_FILES['playlistFile']['name'];
            
            $this->load->model('Playlist_model','playlist');
            

            if($select == 1){
               
                
            }else if($select ==2){

                $filename = $this->playlist->Deatail_All_byId($id);
                $filename = 'assets/files/'.$filename->file;
                
                if( ! isset($_FILES['playlistFile']) || $_FILES['playlistFile']['name'] == '' || ($_FILES['playlistFile']['name'])  == $filename){
                    $form_data['file'] = $filename ;
                }
                else{

                    $config['upload_path']          = './assets/files/';
                    $config['file_name']             = $form_data['createdby'].date("Y-m-d-h-i-sa")."M3u-Playlist.m3u";
                    $config['allowed_types']        = 'm3u';
                    $config['max_size']             = 3000;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('playlistFile'))
                    {
                        //Not Upload
                            $error = array('error' => $this->upload->display_errors());
                            // print_r($error);
                            $this->session->set_flashdata('message', ['danger', $error['error']]);
                            redirect('/playlist'); 
                    }
                    else
                    {
                            // $file = array('upload_data' => $this->upload->data());
                            $file =  (string) $this->upload->data('file_name');

                            $form_data['file'] = 'assets/files/'.$file;
                            $this->session->set_flashdata('message', ['success', 'File Uploaded.']);
                            
                    }
                }
                
            }else if($select == 3){
              
             
            }

            
            if ($this->playlist->edit($form_data,$id)) {
                
                $this->session->set_flashdata('message', ['success', 'Playlist Updated']);
                redirect('/editor');
                // echo json_encode($form_data);
            } else {
                $data['status']=0;
				$data['msg']='Invalid Username/Password Entered';
				$data['type']= 'success';

				echo json_encode($data);
				
                
            }
            
        }

    }

    public function Playlists(){
        if ($_SERVER['REQUEST_METHOD'] === "GET"){
            $this->load->model('Playlist_model','playlist');
            $data = $this->playlist->list();
            echo json_encode($data);
        }

    }

    public function Playlist(){
        if ($_SERVER['REQUEST_METHOD'] === "GET"){
            $this->load->model('Playlist_model','playlist');
            $data = $this->playlist->Deatail();
            echo json_encode($data);
        }

    }
    


	
}
