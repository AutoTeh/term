<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tct extends CI_Controller {

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
	Public $ID_addressP;

 	public function __construct()
    {
    	parent::__construct();
        $this->Account->is_auth();
        $this->Selectbd->Tabel = 'TCT';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->tct()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'TCT',
        			   'IDTable'        => 'head');

		$this->load->view('main', $data);
	}

	public function FilterID()
	{
  		$this->form_validation->set_rules('search', 'ID', 'required|integer');
  		$this->form_validation->set_rules('searchfild', 'Поля поиска', 'required|callback_valid_fild');

	    if ($this->form_validation->run() == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'TCT_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->tct(TRUE)),
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
		$this->form_validation->set_rules('Name_TCT', 'Название ТСТ', 'required');
		$this->form_validation->set_rules('Phone_TCT', 'Телефон', 'required');
		$this->form_validation->set_rules('Contact_Name_TCT', 'Контактное лицо', 'required');
		$this->form_validation->set_rules('Num_Merchant_TCT', 'Номер мерчанта', 'required');
		$this->form_validation->set_rules('ID_Type_MCC_TCT', 'МСС', 'required');
		$this->form_validation->set_rules('Kind_Activity', 'Вид деятельности', 'required');
		$this->form_validation->set_rules('ID_Type_Kategoria_TCT', 'Категория ТСТ', 'required');
	    $this->form_validation->set_rules('Mode_TCT', 'Режим работы', 'required');

	    $this->form_validation->set_rules('errPost', 'Почтовый адрес', 'callback_valid_address_p');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 		=> 'formsuccess',
  							'backpage' 	=> 'tct/add',
	        			  	'Title'  	=> 'ТСТ успешно добавлена');
            $this->Add_edit->addtct($this->ID_addressP);

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array ('Page' 					=> 'tctadd',
	        			   'Title'  				=> 'Добавление ТСТ.',
           				   'UrlPage' 				=> 'tct/add',
						   'ID_Type_MCC_TCT' 		=>  form_dropdown('ID_Type_MCC_TCT', $this->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), set_value('ID_Type_MCC_TCT')),
						   'ID_Type_Kategoria_TCT' 	=>  form_dropdown('ID_Type_Kategoria_TCT', $this->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), set_value('ID_Type_Kategoria_TCT')));

            $data = $data + $this->Address->edit($this->ID_addressP, 'Post');
        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
            $this->db->select('Name_TCT, Phone_TCT, Contact_Name_TCT,
            				   Num_Merchant_TCT, ID_Type_MCC_TCT,
            				   ID_Type_Kategoria_TCT, Mode_TCT,
            				   ID_Address_TCT, Home_Address_TCT,
            				   Kind_Activity');
        	$this->db->from('tct');
        	$this->db->where('ID_TCT', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();
			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
                $data['Page'] = 'tctedit';
		        $data['Title'] = 'Изменение ТСТ';
		        $data['UrlPage'] = 'tct/edit/'.$id.'/1';
				$data['ID_Type_MCC_TCT'] =  form_dropdown('ID_Type_MCC_TCT', $this->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), $data['ID_Type_MCC_TCT']);
				$data['ID_Type_Kategoria_TCT'] =  form_dropdown('ID_Type_Kategoria_TCT', $this->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), $data['ID_Type_Kategoria_TCT']);

                $data = $data + $this->Address->edit($data['ID_Address_TCT'], 'Post');
            	$this->load->view('main', $data);
            }
            else
            {

				$this->form_validation->set_rules('Name_TCT', 'Название ТСТ', 'required');
				$this->form_validation->set_rules('Phone_TCT', 'Телефон', 'required');
				$this->form_validation->set_rules('Contact_Name_TCT', 'Контактное лицо', 'required');
				$this->form_validation->set_rules('Num_Merchant_TCT', 'Номер мерчанта', 'required');
				$this->form_validation->set_rules('ID_Type_MCC_TCT', 'МСС', 'required');
				$this->form_validation->set_rules('Kind_Activity', 'Вид деятельности', 'required');
				$this->form_validation->set_rules('ID_Type_Kategoria_TCT', 'Категория ТСТ', 'required');
			    $this->form_validation->set_rules('Mode_TCT', 'Режим работы', 'required');

			    $this->form_validation->set_rules('errPost', 'Почтовый адрес', 'callback_valid_address_p');

			    if ($this->form_validation->run() == TRUE)
			    {
		  			$data = array ('Page' 		=> 'formsuccess',
		  						   'backpage' 	=> 'tct/edit/'.$id,
			        			   'Title'  	=> 'В ТСТ успешно внесены изменения');
		            $this->Add_edit->edittct($id, $this->ID_addressP);

		  			$this->load->view('main', $data);
		        } else {

	                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
					$data['ID_Type_MCC_TCT'] =  form_dropdown('ID_Type_MCC_TCT', $this->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), set_value('ID_Type_MCC_TCT'));
					$data['ID_Type_Kategoria_TCT'] =  form_dropdown('ID_Type_Kategoria_TCT', $this->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), set_value('ID_Type_Kategoria_TCT'));

			        $data = $data + $this->Address->edit($this->ID_addressP, 'Post');
	                $data['Page'] = 'tctadd';
			        $data['Title'] = 'Изменение ТСТ';
			        $data['UrlPage'] = 'tct/edit/'.$id.'/1';
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

		if ($this->ID_addressP == '' || !$this->input->post('Home_Address_TCT') || $Count < 4)
		{
			$this->form_validation->set_message('valid_address_p', 'Ошибка');
			Return FALSE;
		}
		else
		{
			Return TRUE;
		}
	}

	function db_out_array($Head, $Table)
	{
		$this->db->select($Head, FALSE);
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
