<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinpad extends CI_Controller {

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
        $this->Selectbd->Tabel = 'PinPad';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->pinpad()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'Pinpad',
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
	    	$ID = 'PinPad_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->pinpad(TRUE)),
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
	  	$this->form_validation->set_rules('ID_Type_PinPad', 'Модель', 'required');
	  	$this->form_validation->set_rules('SN_Num_PinPad', 'Серийный номер', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 	=> 'formsuccess',
  							'backpage' 	=> 'pinpad/add',
	        			   	'Title'  => 'pinpad успешно добавлен');
            $this->Add_edit->addpinpad();

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array (	'Page' 		=> 'pinpadadd',
        					'UrlPage' 	=> 'pinpad/add',
        					'ID_Type_PinPad' 	=>  form_dropdown('ID_Type_PinPad', $this->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), set_value('ID_Type_PinPad')),
	        			   	'Title'  	=> 'Добавление pinpad');

        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
     		$this->db->select('ID_Type_PinPad, SN_Num_PinPad');
        	$this->db->from('pinpad');
        	$this->db->where('ID_PinPad', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();

			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
				$data['Page'] = 'pinpadedit';
				$data['UrlPage'] = 'pinpad/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение pinpad';
		       	$data['ID_Type_PinPad'] = form_dropdown('ID_Type_PinPad', $this->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), $data['ID_Type_PinPad']);
	        	$this->load->view('main', $data);
            }
            else
            {
	  	$this->form_validation->set_rules('ID_Type_PinPad', 'Модель', 'required');
	  	$this->form_validation->set_rules('SN_Num_PinPad', 'Серийный номер', 'required');

		    if ($this->form_validation->run() == TRUE)
		    {

	  			$data = array (	'Page' 		=> 'formsuccess',
	  							'backpage' 	=> 'pinpad/edit/'.$id,
		        			   	'Title'  	=> 'pinpad успешно изменен');
	            $this->Add_edit->editpinpad($id);

	  			$this->load->view('main', $data);
	        } else {
                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');

				$data['Page'] = 'pinpadadd';
				$data['UrlPage'] = 'pinpad/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение pinpad';
		       	$data['ID_Type_PinPad'] = form_dropdown('ID_Type_PinPad', $this->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), set_value('ID_Type_PinPad'));

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
