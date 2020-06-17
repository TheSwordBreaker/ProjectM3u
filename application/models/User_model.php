<?php
class User_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function create()
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email')
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

        public function auth()
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        
                );
                $data = $this->security->xss_clean($data);

                $query = $this->db->where(['username' => $data['username']])->get('user');
                $d = $query->result();
                if ($query->num_rows()) {
                        if ($data['password'] == $d[0]->password) {
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
                        
                if ($this->db->where('id', $id)->delete('user')) {
                        return true;
                        } else {
                        return false;
                        }

        }

        public function edit()
        {
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email')
                );
                $this->db->where('id', $id);

                if ($this->db->update('user', $data)) {
                        return true;
                } else {
                        return false;
                }
        }

        public function list()
        {
                $query = $this->db->get('user');
                // $query = $this->db->limit($limit, $offest)->get('user');
                $result = $query->result();
                return $result;
        }
        public function Deatail()
        {
                $id = $this->input->post('id');
                $query = $this->db->where('id',$id)->get('user');
                $result = $query->result();
                return $result;
        }

        


}