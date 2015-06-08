<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	Public $ID_addressJ;
	Public $ID_addressP;

 	public function __construct()
    {
    	parent::__construct();
        $this->Account->is_auth();
        $this->Selectbd->Tabel = 'Org';
    }

	public function index()
	{
		$this->table->set_template(array('table_open'  => '<table id="head" cellspacing="0" border="1">'));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->org()),
			   		   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
			   		   'Page' 			=> 'table',
			   		   'CountColTable' 	=> $this->Gen_table->CountCol-1,
			   		   'IDTable'        => 'head',
        			   'Title' 			=> 'Организации');

		$this->load->view('main', $data);
	}

	public function FilterID()
	{
  		$this->form_validation->set_rules('search', 'ID', 'required|integer');
  		$this->form_validation->set_rules('searchfild', 'поля поиска', 'required|callback_valid_fild');

	    if ($this->form_validation->run() == TRUE)
	    {
     		$this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
			$ID = 'Org_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->org(TRUE)),
						   'CountColTable' 	=> $this->Gen_table->CountCol-1,
						   'IDTable'        => $ID,
						   'js' 			=> '');

            $this->load->view('table', $data);

        } Else {
        	$this->load->view('err');
        }
	}

	public function add()
	{
		$this->form_validation->set_rules('Name_Org', 'Название организации', 'required');
		$this->form_validation->set_rules('INN_Org', 'ИНН', 'required');
		$this->form_validation->set_rules('FIO_Boss_Org', 'ФИО руководителя', 'required');
		$this->form_validation->set_rules('E_Mail_Org', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('Phone_Boss_Org', 'Телефон', 'required');
		$this->form_validation->set_rules('ID_Type_Org', 'Тип организации', 'required');
		$this->form_validation->set_rules('ID_Type_Rank_Org', 'Должность руководителя', 'required');
	    $this->form_validation->set_rules('errJuristical', 'Юр. адрес', 'callback_valid_address_j');
	    $this->form_validation->set_rules('errPost', 'Почтовый адрес', 'callback_valid_address_p');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 		=> 'formsuccess',
  							'backpage' 	=> 'org/add',
	        			  	'Title'  	=> 'Организация успешно добавлена');
            $this->Add_edit->addorg($this->ID_addressJ, $this->ID_addressP);

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array ('Page' 				=> 'orgadd',
	        			   'Title'  			=> 'Добавление нового договора.',
           				   'UrlPage' 			=> 'org/add',
						   'ID_Type_Org' 		=>  form_dropdown('ID_Type_Org', $this->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), set_value('ID_Type_Org')),
						   'ID_Type_Rank_Org' 	=>  form_dropdown('ID_Type_Rank_Org', $this->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), set_value('ID_Type_Rank_Org')));
	        $data = $data + $this->Address->edit($this->ID_addressJ, 'Juristical');
            $data = $data + $this->Address->edit($this->ID_addressP, 'Post');
        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
            $this->db->select('Name_Org, INN_Org, FIO_Boss_Org,
            				   E_Mail_Org, ID_Post_Address_Org,
            				   Home_Post_Address_Org, ID_Juristical_Address_Org,
            				   Home_Juristical_Address_Org, ID_Type_Org,
            				   ID_Type_Rank_Org, Phone_Boss_Org');
        	$this->db->from('org');
        	$this->db->where('ID_Org', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();
			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
                $data['Page'] = 'orgedit';
		        $data['Title'] = 'Изменение организации';
		        $data['UrlPage'] = 'org/edit/'.$id.'/1';
				$data['ID_Type_Org'] =  form_dropdown('ID_Type_Org', $this->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), $data['ID_Type_Org']);
				$data['ID_Type_Rank_Org'] =  form_dropdown('ID_Type_Rank_Org', $this->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), $data['ID_Type_Rank_Org']);

                $data = $data + $this->Address->edit($data['ID_Juristical_Address_Org'], 'Juristical');
                $data = $data + $this->Address->edit($data['ID_Post_Address_Org'], 'Post');
            	$this->load->view('main', $data);
            }
            else
            {

		  		$this->form_validation->set_rules('Name_Org', 'Название организации', 'required');
		  		$this->form_validation->set_rules('INN_Org', 'ИНН', 'required');
		  		$this->form_validation->set_rules('FIO_Boss_Org', 'ФИО руководителя', 'required');
		  		$this->form_validation->set_rules('E_Mail_Org', 'E-mail', 'required|valid_email');
		  		$this->form_validation->set_rules('Phone_Boss_Org', 'Телефон', 'required');
		  		$this->form_validation->set_rules('ID_Type_Org', 'Тип организации', 'required');
		  		$this->form_validation->set_rules('ID_Type_Rank_Org', 'Должность руководителя', 'required');
	            $this->form_validation->set_rules('errJuristical', 'Юр. адрес', 'callback_valid_address_j');
	            $this->form_validation->set_rules('errPost', 'Почтовый адрес', 'callback_valid_address_p');

			    if ($this->form_validation->run() == TRUE)
			    {
		  			$data = array ('Page' 		=> 'formsuccess',
		  						   'backpage' 	=> 'org/edit/'.$id,
			        			   'Title'  	=> 'В организацию успешно внесены изменения');
		            $this->Add_edit->editorg($id, $this->ID_addressJ, $this->ID_addressP);

		  			$this->load->view('main', $data);
		        } else {
	                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
					$data['ID_Type_Org'] =  form_dropdown('ID_Type_Org', $this->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), set_value('ID_Type_Org'));
					$data['ID_Type_Rank_Org'] =  form_dropdown('ID_Type_Rank_Org', $this->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), set_value('ID_Type_Rank_Org'));

	                $data = $data + $this->Address->edit($this->ID_addressJ, 'Juristical');
	                $data = $data + $this->Address->edit($this->ID_addressP, 'Post');
	                $data['Page'] = 'orgadd';
			        $data['Title'] = 'Изменение организации';
			        $data['UrlPage'] = 'org/edit/'.$id.'/1';
		        	$this->load->view('main', $data);
		        }
            }

        } Else {
        	redirect('/', 'refresh');
        }
	}

	function valid_fild($value)
	{
		if (!$this->db->field_exists($value, str_replace("ID_", "", $value)))
		{
			$this->form_validation->set_message('valid_fild', 'Передано не верное имя {field}.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function valid_address_j($value)
	{
		$this->ID_addressJ = '';
        $Count = 0;
		foreach ($this->input->post('Juristical') as $key => $val)
		{
			if (!$val == 0)
			{				$this->ID_addressJ = $val;
				$Count = $key;
			}
		}

		if ($this->ID_addressJ == '' || !$this->input->post('Home_Juristical_Address_Org') || $Count < 4)
		{
			$this->form_validation->set_message('valid_address_j', 'Ошибка');
			Return FALSE;
		}
		else
		{
			Return TRUE;
		}
	}

	function valid_address_p($value)
	{
		$this->ID_addressP = '';
        $Count = 0;
		foreach ($this->input->post('Post') as $key => $val)
		{
			if (!$val == 0)
			{
				$this->ID_addressP = $val;
				$Count = $key;
			}
		}

		if ($this->ID_addressP == '' || !$this->input->post('Home_Post_Address_Org') || $Count < 4)
		{
			$this->form_validation->set_message('valid_address_p', 'Ошибка');			Return FALSE;
		}
		else
		{
			Return TRUE;
		}
	}

	function db_out_array($Head, $Table)
	{
		$this->db->select($Head);
		$query = $this->db->get($Table);

		if ($query->num_rows() > 0)
	    {
	   	    foreach ($query->result_array() as $row)
			{
			        $TempArray[$row['ID']] = $row['Name'];
			}
			return $TempArray;
	    }
	}
}
