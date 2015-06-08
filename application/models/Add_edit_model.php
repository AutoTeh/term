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
        'Num_Dogovor' 				=> $this->input->post('Num_Dogovor'),
        'Date_Dogovor' 				=> $this->input->post('Date_Dogovor'),
        'Diskont_Dogovor' 			=> $this->input->post('Diskont_Dogovor'),
        'Date_Diskont_Dogovor' 		=> $this->input->post('Date_Diskont_Dogovor'),
        'Internat_Card_Dogovor' 	=> $this->input->post('Internat_Card_Dogovor'),
        'Debet_Card_Dogovor' 		=> $this->input->post('Debet_Card_Dogovor'),
        'Thank_Dogovor' 			=> $this->input->post('Thank_Dogovor'),
        'Money_Movement_Dogovor' 	=> $this->input->post('Money_Movement_Dogovor'),
        'Money_Income_Dogovor' 		=> $this->input->post('Money_Income_Dogovor'),
        'Date_Dissolution_Dogovor' 	=> $this->input->post('Date_Dissolution_Dogovor')
		);

		$this->db->insert('dogovor', $data);
 	}

 	public function addorg($id_j = '', $id_p = '')
 	{
		$data = array(
        'Name_Org' 						=> $this->input->post('Name_Org'),
        'INN_Org' 						=> $this->input->post('INN_Org'),
        'ID_Post_Address_Org' 			=> $id_p,
        'Home_Post_Address_Org' 		=> $this->input->post('Home_Post_Address_Org'),
        'ID_Juristical_Address_Org' 	=> $id_j,
        'Home_Juristical_Address_Org'	=> $this->input->post('Home_Juristical_Address_Org'),
        'FIO_Boss_Org' 					=> $this->input->post('FIO_Boss_Org'),
        'ID_Type_Org' 					=> $this->input->post('ID_Type_Org'),
        'E_Mail_Org' 					=> $this->input->post('E_Mail_Org'),
        'Phone_Boss_Org' 				=> $this->input->post('Phone_Boss_Org'),
        'ID_Type_Rank_Org' 				=> $this->input->post('ID_Type_Rank_Org')
		);

		$this->db->insert('org', $data);
 	}

 	public function addtct($id_p = '')
 	{
		$data = array(
        'Name_TCT' 				=> $this->input->post('Name_TCT'),
        'ID_Type_MCC_TCT' 		=> $this->input->post('ID_Type_MCC_TCT'),
        'Phone_TCT' 			=> $this->input->post('Phone_TCT'),
        'Contact_Name_TCT' 		=> $this->input->post('Contact_Name_TCT'),
        'Num_Merchant_TCT' 		=> $this->input->post('Num_Merchant_TCT'),
        'ID_Address_TCT'		=> $id_p,
        'ID_Type_Kategoria_TCT' => $this->input->post('ID_Type_Kategoria_TCT'),
        'Mode_TCT' 				=> $this->input->post('Mode_TCT'),
        'Home_Address_TCT' 		=> $this->input->post('Home_Address_TCT')
		);

		$this->db->insert('tct', $data);
 	}

 	public function addterminal()
 	{
		$data = array(
        'ID_Type_Terminal' 		=> $this->input->post('ID_Type_Terminal'),
        'SN_Num_Terminal' 		=> $this->input->post('SN_Num_Terminal'),
        'Inv_Num_Terminal' 		=> $this->input->post('Inv_Num_Terminal'),
        'Price_Terminal' 		=> $this->input->post('Price_Terminal'),
        'Date_Terminal' 		=> $this->input->post('Date_Terminal')
		);

		$this->db->insert('terminal', $data);
 	}

 	public function addpinpad()
 	{
		$data = array(
		'ID_Type_PinPad' 		=> $this->input->post('ID_Type_PinPad'),
        'SN_Num_PinPad' 		=> $this->input->post('SN_Num_PinPad')
        );

		$this->db->insert('pinpad', $data);
 	}

 	public function addsim()
 	{
		$data = array(
        'SN_Num_SIM' 				=> $this->input->post('SN_Num_SIM'),
        'ID_Type_Operator_SIM' 		=> $this->input->post('ID_Type_Operator_SIM')
        );

		$this->db->insert('sim', $data);
 	}

 	public function addtid()
 	{
		$data = array(
        'Num_TID' 		  => $this->input->post('Num_TID'),
        'Kod_TID' 		  => $this->input->post('Kod_TID'),
        'Date_Reg_CA_TID' => $this->input->post('Date_Reg_CA_TID')
        );

		$this->db->insert('tid', $data);
 	}

 	public function editdogovor($id = '')
 	{
		$data = array(
        'Num_Dogovor' 				=> $this->input->post('Num_Dogovor'),
        'Date_Dogovor' 				=> $this->input->post('Date_Dogovor'),
        'Diskont_Dogovor' 			=> $this->input->post('Diskont_Dogovor'),
        'Date_Diskont_Dogovor' 		=> $this->input->post('Date_Diskont_Dogovor'),
        'Internat_Card_Dogovor' 	=> $this->input->post('Internat_Card_Dogovor'),
        'Debet_Card_Dogovor' 		=> $this->input->post('Debet_Card_Dogovor'),
        'Thank_Dogovor' 			=> $this->input->post('Thank_Dogovor'),
        'Money_Movement_Dogovor' 	=> $this->input->post('Money_Movement_Dogovor'),
        'Money_Income_Dogovor' 		=> $this->input->post('Money_Income_Dogovor'),
        'Date_Dissolution_Dogovor' 	=> $this->input->post('Date_Dissolution_Dogovor')
		);

        $this->db->where('ID_Dogovor', $id);
		$this->db->update('dogovor', $data);
 	}

 	public function editorg($id = '', $id_j = '', $id_p = '')
 	{
		$data = array(
        'Name_Org' 						=> $this->input->post('Name_Org'),
        'INN_Org' 						=> $this->input->post('INN_Org'),
        'ID_Post_Address_Org' 			=> $id_p,
        'Home_Post_Address_Org' 		=> $this->input->post('Home_Post_Address_Org'),
        'ID_Juristical_Address_Org' 	=> $id_j,
        'Home_Juristical_Address_Org'	=> $this->input->post('Home_Juristical_Address_Org'),
        'FIO_Boss_Org' 					=> $this->input->post('FIO_Boss_Org'),
        'ID_Type_Org' 					=> $this->input->post('ID_Type_Org'),
        'E_Mail_Org' 					=> $this->input->post('E_Mail_Org'),
        'Phone_Boss_Org' 				=> $this->input->post('Phone_Boss_Org'),
        'ID_Type_Rank_Org' 				=> $this->input->post('ID_Type_Rank_Org')
		);

		$this->db->where('ID_Org', $id);
		$this->db->update('org', $data);
 	}

 	public function edittct($id = '', $id_p = '')
 	{
		$data = array(
        'Name_TCT' 				=> $this->input->post('Name_TCT'),
        'ID_Type_MCC_TCT' 		=> $this->input->post('ID_Type_MCC_TCT'),
        'Phone_TCT' 			=> $this->input->post('Phone_TCT'),
        'Contact_Name_TCT' 		=> $this->input->post('Contact_Name_TCT'),
        'Num_Merchant_TCT' 		=> $this->input->post('Num_Merchant_TCT'),
        'ID_Address_TCT'		=> $id_p,
        'ID_Type_Kategoria_TCT' => $this->input->post('ID_Type_Kategoria_TCT'),
        'Mode_TCT' 				=> $this->input->post('Mode_TCT'),
        'Home_Address_TCT' 		=> $this->input->post('Home_Address_TCT')
		);

		$this->db->where('ID_TCT', $id);
		$this->db->update('tct', $data);
 	}

 	public function edittid($id = '')
 	{
		$data = array(
        'Num_TID' 		  => $this->input->post('Num_TID'),
        'Kod_TID' 		  => $this->input->post('Kod_TID'),
        'Date_Reg_CA_TID' => $this->input->post('Date_Reg_CA_TID')
        );

		$this->db->where('ID_TID', $id);
		$this->db->update('tid', $data);
 	}

 	public function editterminal($id = '')
 	{
		$data = array(
        'ID_Type_Terminal' 		=> $this->input->post('ID_Type_Terminal'),
        'SN_Num_Terminal' 		=> $this->input->post('SN_Num_Terminal'),
        'Inv_Num_Terminal' 		=> $this->input->post('Inv_Num_Terminal'),
        'Price_Terminal' 		=> $this->input->post('Price_Terminal'),
        'Date_Terminal' 		=> $this->input->post('Date_Terminal')
		);
		$this->db->where('ID_Terminal', $id);
		$this->db->update('terminal', $data);
 	}

 	public function editpinpad($id = '')
 	{
		$data = array(
		'ID_Type_PinPad' 		=> $this->input->post('ID_Type_PinPad'),
        'SN_Num_PinPad' 		=> $this->input->post('SN_Num_PinPad')
        );
		$this->db->where('ID_PinOad', $id);
		$this->db->update('pinpad', $data);

 	}

 	public function editsim($id = '')
 	{
		$data = array(
        'SN_Num_SIM' 				=> $this->input->post('SN_Num_SIM'),
        'ID_Type_Operator_SIM' 		=> $this->input->post('ID_Type_Operator_SIM')
        );
		$this->db->where('ID_SIM', $id);
		$this->db->update('sim', $data);
 	}
}
