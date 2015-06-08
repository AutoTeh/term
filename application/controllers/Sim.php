<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sim extends CI_Controller {

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

 	public function __construct()
    {
    	parent::__construct();
        $this->Account->is_auth();
        $this->Selectbd->Tabel = 'SIM';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->sim()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'Sim',
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
	    	$ID = 'SIM_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->sim(TRUE)),
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
	  	$this->form_validation->set_rules('ID_Type_Operator_SIM', 'Оператор', 'required');
	  	$this->form_validation->set_rules('SN_Num_SIM', 'Серийный номер', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 	=> 'formsuccess',
  							'backpage' 	=> 'sim/add',
	        			   	'Title'  => 'SIM-карта успешно добавлена');
            $this->Add_edit->addsim();

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array (	'Page' 		=> 'simadd',
        					'UrlPage' 	=> 'sim/add',
        					'ID_Type_Operator_SIM' 	=>  form_dropdown('ID_Type_Operator_SIM', $this->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), set_value('ID_Type_Operator_SIM')),
	        			   	'Title'  	=> 'Добавление SIM-карты');

        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
     		$this->db->select('SN_Num_SIM, ID_Type_Operator_SIM');
        	$this->db->from('sim');
        	$this->db->where('ID_SIM', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();

			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
				$data['Page'] = 'simedit';
				$data['UrlPage'] = 'sim/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение SIM-карты';
		       	$data['ID_Type_Operator_SIM'] = form_dropdown('ID_Type_Operator_SIM', $this->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), $data['ID_Type_Operator_SIM']);
	        	$this->load->view('main', $data);
            }
            else
            {
	  		$this->form_validation->set_rules('ID_Type_Operator_SIM', 'Оператор', 'required');
	  		$this->form_validation->set_rules('SN_Num_SIM', 'Серийный номер', 'required');

		    if ($this->form_validation->run() == TRUE)
		    {

	  			$data = array (	'Page' 		=> 'formsuccess',
	  							'backpage' 	=> 'sim/edit/'.$id,
		        			   	'Title'  	=> 'SIM-картf успешно изменена');
	            $this->Add_edit->editsim($id);

	  			$this->load->view('main', $data);
	        } else {
                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');

				$data['Page'] = 'simadd';
				$data['UrlPage'] = 'sim/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение SIM-карты';
		       	$data['ID_Type_Operator_SIM'] = form_dropdown('ID_Type_Operator_SIM', $this->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), set_value('ID_Type_Operator_SIM'));

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