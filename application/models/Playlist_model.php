<?php
class Playlist_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                
        }
        public function create($data)
        {      
    
                // $data = array(
                //         'name' => $this->input->post('user'),
                //         'source' => $this->input->post('user'),
                //         'url' => $this->input->post('password'),
                //         'file' => $this->input->post('password'),
                //         'createdby' => $this->input->post('password'),
                        
                // );
                    
                
                $data = $this->security->xss_clean($data);
                return $this->db->insert('playlist', $data);
        }


        public function delete()
        {
                $id = $this->input->post('id');
                
                        
                if ($this->db->where('id', $id)->delete('playlist')) {
                        return true;
                        } else {
                        return false;
                        }

        }

        public function edit($data,$id)
        {
                $data = $this->security->xss_clean($data);
                
                $this->db->where('id', $id);

                if ($this->db->update('playlist', $data)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function list()
        {       
                $data = array(
                        1=>'M3u Url',
                        2=>'File',
                        3=>'Url',
                );
                $query = $this->db->select('id ,name, source')->where('createdby', $this->session->userdata('id'))->get('playlist');
                // $query = $this->db->limit($limit, $offest)->get('user');
                $result = $query->result();
                foreach($result as $i){
                        $i->source = $data[$i->source];
                }
                

                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                return $result;
        }
        public function Deatail()
        {
                $id = $this->input->get('id');
                $query = $this->db->select('id ,name, source')->where('id',$id)->get('playlist');
                $result = $query->result();
                return $result[0];
        }
        public function Deatail_All()
        {
                $id = $this->input->get('id');
                $query = $this->db->where('id',$id)->get('playlist');
                $result = $query->result();
                return $result[0];
        }
        public function Deatail_All_byId($id)
        {
                
                $query = $this->db->where('id',$id)->get('playlist');
                $result = $query->result();
                return $result[0];
        }

        


}