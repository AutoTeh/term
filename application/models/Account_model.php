<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function reg()
 	{
		$data = array(
        'Login_Users' 	=> $this->input->post('login'),
        'Pass_Users' 	=> do_hash($this->input->post('pass')),
        'FIO_Users' 	=> $this->input->post('fio'),
        'E_Mail_Users' 	=> $this->input->post('e_mail'),
        'ID_Group' 		=> 0
		);

		$this->db->insert('users', $data);
 	}

 	public function edit($id = '')
 	{
		$data = array(
        'Login_Users' 	=> $this->input->post('login'),
        'FIO_Users' 	=> $this->input->post('fio'),
        'E_Mail_Users' 	=> $this->input->post('E_Mail'),
		);

        if ($this->input->post('pass'))  $data['Pass_Users'] = do_hash($this->input->post('pass'));

        $this->db->where('id', $id);
		$this->db->update('users', $data);
 	}

 	public function auth()
 	{
		$this->db->select('ID_Users, Login_Users, FIO_Users, ID_Group');
		$this->db->from('users');
		$this->db->where('Login_Users', $this->input->post('login'));
		$this->db->where('Pass_Users', do_hash($this->input->post('pass')));
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$row = $query->row();

			$newdata = array(
					'ID_Users'  => $row->ID_Users,
			        'Login'  	=> $row->Login_Users,
			        'FIO'     	=> $row->FIO_Users,
			        'ID_Group'  => $row->ID_Group,
			        'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);

			return TRUE;
		}   return FALSE;
 	}

 	public function is_auth()
 	{
		 if ($this->session->logged_in)
		 {		 	return TRUE;
		 }
		 	Else
		 {		 	redirect('/auth', 'refresh');		 	return FALSE;
	     }
 	}

 	public function is_auth_and_group($ID_Group)
 	{
		if ($ID_Group == $this->session->ID_Group)
		{			return TRUE;
		}
		Else
		{
			redirect('/auth', 'refresh');			return FALSE;
		}
 	}
}
