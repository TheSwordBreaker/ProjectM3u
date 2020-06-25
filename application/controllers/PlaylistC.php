<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaylistC extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username') ) {
            redirect('login');
        }
        if($this->session->userdata('verified') == 0) {
            redirect('confirm');
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
    private function M3uGenrator($playlist ,$array_json){

        $filepath = "./".$playlist->file;
        //$f = fopen($filepath,'w');
        
        $string = '#EXTM3U url-tvg=""'."\n";
        
        $array_json = $array_json['DATA'];
        //print_r($array_json);
        // echo $array_json['DATA'][0];
        for($i = 0 ; $i < count($array_json) ; $i++) {
            if($array_json[$i]['show']){
            $string .= '#EXTINF:-1 tvg-id="'.(array_key_exists('tvg-id',$array_json[$i])? $array_json[$i]['tvg-id']:"")
            .'" tvg-name="'.(array_key_exists('tvg-name',$array_json[$i])? $array_json[$i]['tvg-name']:"")
            .'" tvg-logo="'.(array_key_exists('tvg-logo',$array_json[$i])? $array_json[$i]['tvg-logo']:"")
            .'" group-title="'.(array_key_exists('group-title',$array_json[$i])? $array_json[$i]['group-title']:"")
            .'" '.(array_key_exists('something',$array_json[$i])? $array_json[$i]['something']:"")
            ."\n".(array_key_exists('url',$array_json[$i])? $array_json[$i]['url']:"")."\n";
            }
        }
        
       // fwrite($f,$string);
        //fclose($f);
        return $string;
    }
    
    public function download( $id ){
        header("Content-type: text/plain");
       
        $this->load->model('Playlist_model','playlist');
        $playlist = $this->playlist->Deatail_All_byId($id);
        $filenamedisplay = explode('/',$playlist->file)[2];
        header("Content-Disposition: attachment; filename=$filenamedisplay");

        $filename = explode('.',$filenamedisplay)[0];
        $filename = './assets/json/'.$filename.'.json';
        $arrayjson = [];
        if(file_exists($filename)){
            $f = fopen($filename,"r");
            
            $arrayjson = json_decode(fread($f,filesize($filename)),true);
            fclose($f);
            echo $this->M3uGenrator($playlist,$arrayjson);
        }else{
            $f = fopen($playlist->file,"r");
            
            $arrayjson = json_decode(fread($f,filesize($playlist->file)),true);
            fclose($f);
            echo $arrayjson;
        }
        
 
    }
    
    private function remove_json($id){
        $this->load->model('Playlist_model','playlist');
        $playlist = $this->playlist->Deatail_All_byId($id);
        $filename = explode('.',explode('/',$playlist->file)[2])[0];
        unlink('./assets/json/'.$filename.'.json');
    }
    private function create_json($file){
       
        $filename = explode('.',explode('/',$file)[2])[0];
        $filepath = './assets/json/'.$filename.'.json';
        $f = fopen($filepath,'w');
        fwrite($f,'');
        fclose($f);
    }

    
    public function PlaylistCreate(){
        if ($_SERVER['REQUEST_METHOD'] === "POST"){

            $form_data['source'] = $this->input->post('playlistSource');
            $form_data['name'] = $this->input->post('playlistName');
            $form_data['createdby'] = $this->session->userdata('id');
            $form_data['url'] = $this->input->post('playlistUrl');
            $form_data['file'] = 'assets/files/'.$form_data['name'].'-'.$form_data['createdby'].date("Y-m-d-h-i-s")."M3u-Playlist.m3u";
            $select = $form_data['source'] ;
            //  $FileName = $_FILES['playlistFile']['name'];
            
             $this->load->model('Playlist_model','playlist');

            if($select == 1){
                // $handler = curl_init($form_data['url']);  
                $headers = @get_headers($form_data['url']); 
                
                if($headers && strpos( $headers[0], '200')) { 
                    $response = file_get_contents($form_data['url'])  ;
                } 
                else { 
                    $this->session->set_flashdata('message', ['danger', "Url Not exist"]);
                    redirect('/playlist');
                } 
                // curl_close($handler); 
                
                
                $filepath = "./".$form_data['file'];
                $f = fopen($filepath,'w');
                fwrite($f,$response);
                fclose($f);
                if($response == ''){
                    $this->session->set_flashdata('message', ['danger', "Url data Could not be fetched Plz repeat the process File"]);
                    redirect('/playlist');
                }else{
                    $this->session->set_flashdata('message', ['success', 'Data Collected Successfully.']);
                }
                
            }else if($select ==2){

                $config['upload_path']          = './assets/files/';
                $config['file_name']             = $form_data['name'].'-'.$form_data['createdby'].date("Y-m-d-h-i-s")."M3u-Playlist.m3u";
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

                $filepath = "./".$form_data['file'];
                $f = fopen($filepath,'w');
                fwrite($f,'');
                fclose($f);
                $this->create_json($form_data['file']);
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
            $playlist = $this->playlist->Deatail_All_byId($this->input->post('id'));
            //echo "./".$playlist->file;
            unlink("./".$playlist->file);
            $this->remove_json($this->input->post('id'));

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
            $form_data['url'] = $this->input->post('playlistUrl');
            $form_data['file'] = 'assets/files/'.$form_data['name'].'-'.$form_data['createdby'].date("Y-m-d-h-i-s")."M3u-Playlist.m3u";
            $select = $form_data['source'] ;
            
            //  $FileName = $_FILES['playlistFile']['name'];
            
            $this->load->model('Playlist_model','playlist');
            $list = $this->playlist->Deatail_All_byId($id);
            

            if($select == 1){
                $headers = @get_headers($form_data['url']); 
                
                if($headers && strpos( $headers[0], '200')) { 
                    $response = file_get_contents($form_data['url'])  ;
                } 
                else { 
                    $this->session->set_flashdata('message', ['danger', "Url Not exist"]);
                    redirect('/playlist');
                } 
                // curl_close($handler); 
                
                
                $filepath = "./".$form_data['file'];
                $f = fopen($filepath,'w');
                fwrite($f,$response);
                fclose($f);
                if($response == ''){
                    $this->session->set_flashdata('message', ['danger', "Url data Could not be fetched Plz repeat the process File"]);
                    redirect('/playlist');
                }else{
                    $this->session->set_flashdata('message', ['success', 'Data Collected Successfully.']);
                }
            }else if($select ==2){

                $filename = 'assets/files/'.$list->file;
                
                if( ! isset($_FILES['playlistFile']) || $_FILES['playlistFile']['name'] == '' || ($_FILES['playlistFile']['name'])  == $filename){
                    $form_data['file'] = $filename ;
                }
                else{

                    $config['upload_path']          = './assets/files/';
                    $config['file_name']             = $form_data['name'].'-'.$form_data['createdby'].date("Y-m-d-h-i-s")."M3u-Playlist.m3u";
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

                $filepath = "./".$form_data['file'];
                $f = fopen($filepath,'w');
                fwrite($f,'');
                fclose($f);
             
            }

            $this->remove_json($id);
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
