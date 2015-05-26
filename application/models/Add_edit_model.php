<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_edit_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function adddogovor()
 	{
		$data = array(
        'Num_Dogovor' 				=> $this->input->post('num_dogovor'),
        'Date_Dogovor' 				=> $this->input->post('date_dogovor'),
        'Diskont_Dogovor' 			=> $this->input->post('diskont'),
        'Date_Diskont_Dogovor' 		=> $this->input->post('date_diskont'),
        'Internat_Card_Dogovor' 	=> $this->input->post('inter_card'),
        'Debet_Card_Dogovor' 		=> $this->input->post('debet_card'),
        'Thank_Dogovor' 			=> $this->input->post('thank'),
        'Money_Movement_Dogovor' 	=> $this->input->post('money_movement'),
        'Money_Income_Dogovor' 		=> $this->input->post('money_income'),
        'Date_Dissolution_Dogovor' 	=> $this->input->post('date_dissolution')
		);

		$this->db->insert('dogovor', $data);
 	}

 	public function addorg()
 	{
		$data = array(
        'Name_Org' 						=> $this->input->post('num_dogovor'),
        'INN_Org' 						=> $this->input->post('date_dogovor'),
        'ID_Post_Address_Org' 			=> $this->input->post('diskont'),
        'Home_Post_Address_Org' 		=> $this->input->post('date_diskont'),
        'ID_Juristical_Address_Org' 	=> $this->input->post('inter_card'),
        'Home_Juristical_Address_Org'	=> $this->input->post('debet_card'),
        'FIO_Boss_Org' 					=> $this->input->post('thank'),
        'ID_Type_Org' 					=> $this->input->post('money_movement'),
        'E_Mail_Org' 					=> $this->input->post('money_income'),
        'Phone_Boss_Org' 				=> $this->input->post('money_income'),
        'ID_Type_Rank_Org' 				=> $this->input->post('date_dissolution')
		);

		$this->db->insert('org', $data);
 	}

 	public function addtct()
 	{
		$data = array(
        'Name_TCT' 				=> $this->input->post('num_dogovor'),
        'ID_Type_MCC_TCT' 		=> $this->input->post('date_dogovor'),
        'Phone_TCT' 			=> $this->input->post('diskont'),
        'Contact_Name_TCT' 		=> $this->input->post('date_diskont'),
        'Num_Merchant_TCT' 		=> $this->input->post('inter_card'),
        'ID_Address_TCT'		=> $this->input->post('debet_card'),
        'ID_Type_Kategoria_TCT' => $this->input->post('thank'),
        'Mode_Start_TCT' 		=> $this->input->post('money_movement'),
        'Mode_lunch_TCT' 		=> $this->input->post('money_income'),
        'Mode_End_TCT' 			=> $this->input->post('money_income')
		);

		$this->db->insert('tct', $data);
 	}

 	public function addterminal()
 	{
		$data = array(
        'ID_Type_Terminal' 				=> $this->input->post('num_dogovor'),
        'SN_Num_Terminal' 		=> $this->input->post('date_dogovor'),
        'Inv_Num_Terminal' 			=> $this->input->post('diskont'),
        'Price_Terminal' 		=> $this->input->post('date_diskont'),
        'Date_Terminal' 		=> $this->input->post('inter_card')
		);

		$this->db->insert('terminal', $data);
 	}

 	public function addpinpad()
 	{
		$data = array(
		'ID_Type_PinPad' 		=> $this->input->post('date_dogovor'),
        'SN_Num_PinPad' 			=> $this->input->post('diskont')
        );

		$this->db->insert('pinpad', $data);
 	}

 	public function addsim()
 	{
		$data = array(
        'SN_Num_SIM' 				=> $this->input->post('num_dogovor'),
        'ID_Type_Operator_SIM' 		=> $this->input->post('date_dogovor')
        );

		$this->db->insert('sim', $data);
 	}

 	public function addtid()
 	{
		$data = array(
        'Num_TID' 		  => $this->input->post('num_dogovor'),
        'Kod_TID' 		  => $this->input->post('date_dogovor'),
        'Date_Reg_CA_TID' => $this->input->post('diskont')
        );

		$this->db->insert('tid', $data);
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
