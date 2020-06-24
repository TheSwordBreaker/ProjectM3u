<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function create($hash)
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email'),
                        'role' => $this->input->post('role'),
                        'verified'=> 0,
                        'hash' => $hash,
                );
                $data = $this->security->xss_clean($data);
                return $this->db->insert('user', $data);

                

                

                
        }

        public function create_hash()
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email')
                );
                $data = $this->security->xss_clean($data);
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                return $this->db->insert('user', $data);
        }

        public function auth(){

        $form_data = array(
                'username' => $this->input->post('user'),
                'password' => $this->input->post('password'),
                
        );
        $form_data = $this->security->xss_clean($form_data);

        $query = $this->db->where(['username' => $form_data['username']])->get('user');
        $d = $query->result();
        $data = [];
        if ($query->num_rows()) {
                if ($form_data['password'] == $d[0]->password) {
                        

                        $this->session->set_userdata('username', $d[0]->username);
                        $this->session->set_userdata('id', $d[0]->id);
                        $this->session->set_userdata('role', $d[0]->role);
                        $this->session->set_userdata('verified', $d[0]->verified);
               
                        if($d[0]->verified){
                        $data['status']=1;
                        $data['msg']=' User Login';
                        $data['type']= 'success';

                        echo json_encode($data);

                        
                        }else{

                        $data['status']=0;
                        $data['type']= 'success';
                        $data['redirect']= '/confirm';
                        echo json_encode($data);

                        }
                        
                }else {
                        $data['status']=0;
                        $data['msg']='Invalid Username/Password Entered';
                        $data['type']= 'success';
                        echo json_encode($data);

                }
        } else {

                $data['status']=0;
                $data['msg']='Invalid Username/Password Entered';
                $data['type']= 'success';
                echo json_encode($data);

        }
                        
        }
        public function auth_hash()
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        
                );
                $data = $this->security->xss_clean($data);

                $query = $this->db->where(['username' => $data['username']])->get('user');
                $d = $query->result();
                if ($query->num_rows()) {
                        if (password_verify($pw,$d[0]->password)) {
                                $this->session->set_userdata('username', $d[0]->username, 'id', $d[0]->id);
                                return true;
                        } 
                        else 
                        {
                                return false;
                        }
                } else {
                        return false;
                }
                        
        }

        public function delete()
        {
                $id = $this->input->post('id');
                $id = $this->security->xss_clean($id);        
                if ($this->db->where('id', $id)->delete('user')) {
                        return true;
                        } else {
                        return false;
                        }

        }

        public function edit()
        {
                $id = $this->input->post('id');
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email'),
                        'role' => $this->input->post('role'),
                        'updateAt'=>date('Y-m-d H:i:s')
                );
                $data = $this->security->xss_clean($data);

                $this->db->where('id', $id);
                $this->db->update('user', $data);
                if ($this->db->affected_rows() > 0) {
                        return true;
                } else {
                        return false;
                }
        }

        public function list()
        {
                $query = $this->db->select('id ,username, email,')->get('user');
                // $query = $this->db->limit($limit, $offest)->get('user');
                $result = $query->result();
                return $result; 
        }
        public function deatail()
        {
                $id = $this->input->get('id');
                $id = $this->security->xss_clean($id);
                $query = $this->db->where('id',$id)->get('user');
                $result = $query->result();
                return $result;
        }
        public function deatail_by_id($id)
        {
                $id = $this->security->xss_clean($id);
                $query = $this->db->where('id',$id)->get('user');
                $result = $query->result();
                return $result[0];
        }
        public function deatail_by_email($email)
        {
                $email = $this->security->xss_clean($email);
                $query = $this->db->where('email',$email)->get('user');
                $result = $query->result();
                return $result[0];
        }
        
        public function deatail_by_username($username)
        {
                $username = $this->security->xss_clean($username);
                $query = $this->db->where('username',$username)->get('user');
                $result = $query->result();
                return $result[0];
        }

        public function unique($key,$value)
        {       
                $value = $this->security->xss_clean($value);
                $key = $this->security->xss_clean($key);

                $query = $this->db->where($key,$value)->get('user');
                if($query->num_rows() > 0){
                        echo 'false';
                }else{
                        echo 'true';
                }
        }

        public function verify($id){
                $data = array(
                        'verified'=> 1,
                );
                $id = $this->security->xss_clean($id);
                $this->db->update('user', $data);
                if ($this->db->affected_rows() > 0) {
                        return true;
                } else {
                        return false;
                }
        }

        


}