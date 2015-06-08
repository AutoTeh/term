<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tid extends CI_Controller {

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
        $this->Selectbd->Tabel = 'TID';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->tid()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'TID',
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
	    	$ID = 'TID_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->tid(TRUE)),
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
	  	$this->form_validation->set_rules('Num_TID', 'TID', 'required');
	  	$this->form_validation->set_rules('Kod_TID', 'Код активации', 'required');
	  	$this->form_validation->set_rules('Date_Reg_CA_TID', 'Дата регистрации ЦА', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 	=> 'formsuccess',
  							'backpage' 	=> 'tid/add',
	        			   	'Title'  => 'TID успешно добавлен');
            $this->Add_edit->addtid();

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array (	'Page' 		=> 'tidadd',
        					'UrlPage' 	=> 'tid/add',
	        			   	'Title'  	=> 'TID.');

        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
     		$this->db->select('Num_TID, Kod_TID, Date_Reg_CA_TID');
        	$this->db->from('tid');
        	$this->db->where('ID_TID', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();

			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
				$data['Page'] = 'tidedit';
				$data['UrlPage'] = 'tid/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение TID';
	        	$this->load->view('main', $data);
            }
            else
            {
	  		$this->form_validation->set_rules('Num_TID', 'TID', 'required');
	  		$this->form_validation->set_rules('Kod_TID', 'Код активации', 'required');
	  		$this->form_validation->set_rules('Date_Reg_CA_TID', 'Дата регистрации ЦА', 'required');

		    if ($this->form_validation->run() == TRUE)
		    {

	  			$data = array (	'Page' 		=> 'formsuccess',
	  							'backpage' 	=> 'tid/edit/'.$id,
		        			   	'Title'  	=> 'TID успешно изменен');
	            $this->Add_edit->edittid($id);

	  			$this->load->view('main', $data);
	        } else {
                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');

				$data['Page'] = 'tidadd';
				$data['UrlPage'] = 'tid/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение TID';

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
}