<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditorC extends CI_Controller {

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
        $this->load->model('Playlist_model','playlist');
        $playlist = $this->playlist->list();
        
        $data['playlist'] = $playlist ;
        // $data['playlist']['id'] = array_column($playlist,'id') ;
        // $data['playlist']['name'] = array_column($playlist,'name') ;
        // $data_table 

        // $data1 = $this->M3uParser(2,'','./assets/files/M3UPlus-Playlist-20200614220819.m3u');
        
        // // $this->M3uGenrator($data1);
        // // $data = $this->M3uGenrator($data1);
        // // echo $data;

        // // echo $group;
        // // $group = array_unique($group);
        // $group = array_column($data1,'group-title');
        // echo '<pre>';
        // print_r(array_unique($group));
        // print_r($data);
        // echo '</pre>';

		$this->load->view('layout/header', $data);
		$this->load->view('private/editor',$data);
        $this->load->view('layout/footer');
        
    }
    public function editoras(){
        $data = $this->M3uParser(2,'','./assets/files/M3UPlus-Playlist-20200614220819.m3u');
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        // $this->load->view('layout/header', $data);
		// $this->load->view('private/editor');
        // $this->load->view('layout/footer');
    }

    public function save(){
        $this->load->model('Playlist_model','playlist');
        $array_json = $this->input->post('playlistdata');
        $id = $this->input->post('playlistdataid');


        // print_r($array_json);
        $playlist = $this->playlist->Deatail_All_byId($id);

        $this->M3uGenrator($playlist,$array_json);

        $data['status']=1;
        $data['msg']='Data Saved ';
        $data['type']= 'success';


        echo json_encode($data);
        
        
    }

    public function Deatail(){

        
        
        $this->load->model('Playlist_model','playlist');
        $playlist = $this->playlist->deatail_All();
        $dat = array('DATA'=>$this->M3uParser($playlist));
        
        echo json_encode($dat);

    }

    private function M3uParser($playlist){
        if($playlist->source == 1){
            // $handler = curl_init("link to m3u file");  
            // $response = curl_exec ($handler);  
            // curl_close($handler); 
            // echo $response;
               
                
        }else if($playlist->source ==2){
            $filepath = "./".$playlist->file;
            $f = fopen($filepath,'r');
            $string = fread($f,filesize($filepath));
            preg_match_all('/(?P<tag>#EXTINF:-1)|(?:(?P<prop_key>[-a-z]+)=\"(?P<prop_val>[^"]+)")|(?<something>,[^\r\n]+)|(?<url>http[^\s]+)/', $string, $match );

            $count = count( $match[0] );

            $result = [];
            $index = -1;

            for( $i =0; $i < $count; $i++ ){
                $item = $match[0][$i];

                if( !empty($match['tag'][$i])){
                    //is a tag increment the result index
                    ++$index;
                }elseif( !empty($match['prop_key'][$i])){
                    //is a prop - split item
                    $result[$index][$match['prop_key'][$i]] = $match['prop_val'][$i];
                }elseif( !empty($match['something'][$i])){
                    //is a prop - split item
                    $result[$index]['something'] = $item;
                }elseif( !empty($match['url'][$i])){
                    $result[$index]['url'] = $item ;
                }
            }
            // echo '<pre>';
            // print_r( $result );
            // echo '</pre>';
            return $result;
          
        }else if($playlist->source == 3){
          
         
        }

    }

    private function M3uGenrator($playlist ,$array_json){



        $filepath = "./".$playlist->file;
        $f = fopen($filepath,'w');
        
        $string = '#EXTM3U url-tvg=""'."\n";
        
        for($i = 0 ; $i < count($array_json) ; $i++) {
        // for($i = 0 ; $i < count($array_json) ; $i++) {
            //  print_r($array_json[$i]);
            
            $string .= '#EXTINF:-1 tvg-id="'.$array_json[$i]['tvg-id']
            .'" tvg-name="'.$array_json[$i]['tvg-name']
            .'" tvg-logo="" group-title="'.$array_json[$i]['group-title']
            .'"'.$array_json[$i]['something']
            ."\n".$array_json[$i]['url']."\n";
        }
        
        fwrite($f,$string);
        fclose($f);
        // echo $string;

        // return $string;

    }
    


	
}
