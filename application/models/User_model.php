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
                        'email' => $this->input->post('email'),
                        'role' => $this->input->post('role'),
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
                                $this->session->set_userdata('username', $d[0]->username);
                                $this->session->set_userdata('id', $d[0]->id);
                                $this->session->set_userdata('role', $d[0]->role);
                                
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
                $id = $this->input->post('id');
                $data = array(
                        'username' => $this->input->post('user'),
                        'password' => $this->input->post('password'),
                        'email' => $this->input->post('email'),
                        'role' => $this->input->post('role'),
                        'updateAt'=>date('Y-m-d H:i:s')
                );
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
                $query = $this->db->where('id',$id)->get('user');
                $result = $query->result();
                return $result;
        }

        


}