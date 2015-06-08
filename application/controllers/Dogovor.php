<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogovor extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Dogovor';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->dogovor()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'Договоры',
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
	    	$ID = 'Dogovor_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->dogovor(TRUE)),
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
	  	$this->form_validation->set_rules('Num_Dogovor', 'Номер договора', 'required');
	  	$this->form_validation->set_rules('Date_Dogovor', 'Дата договора', 'required');
	  	$this->form_validation->set_rules('Diskont_Dogovor', 'Дисконт', 'required');
	  	$this->form_validation->set_rules('Date_Diskont_Dogovor', 'Дата дисконта', 'required');
	  	$this->form_validation->set_rules('Internat_Card_Dogovor', 'Международные карты', 'required');
	  	$this->form_validation->set_rules('Debet_Card_Dogovor', 'Дебетовые карты', 'required');
	  	$this->form_validation->set_rules('Thank_Dogovor', 'Спасибо', 'required');
	  	$this->form_validation->set_rules('Money_Movement_Dogovor', 'Оборот', 'required');
	  	$this->form_validation->set_rules('Money_Income_Dogovor', 'Доход', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 	=> 'formsuccess',
  							'backpage' 	=> 'dogovor/add',
	        			   	'Title'  => 'Договор успешно добавлен');
            $this->Add_edit->adddogovor();

  			$this->load->view('main', $data);

        } Else {            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');        	$data = array (	'Page' 		=> 'dogovoradd',
        					'UrlPage' 	=> 'dogovor/add',
	        			   	'Title'  	=> 'Добавление нового договора.');

        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
     		$this->db->select('Num_Dogovor, Date_Dogovor, Diskont_Dogovor,
            				   Date_Diskont_Dogovor, Internat_Card_Dogovor,
            				   Debet_Card_Dogovor, Thank_Dogovor,
            				   Money_Movement_Dogovor, Money_Income_Dogovor,
            				   Date_Dissolution_Dogovor');
        	$this->db->from('dogovor');
        	$this->db->where('ID_Dogovor', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();

			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {				$data['Page'] = 'dogovoredit';
				$data['UrlPage'] = 'dogovor/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение договора';
	        	$this->load->view('main', $data);
            }
            else
            {
	  		$this->form_validation->set_rules('Num_Dogovor', 'Номер договора', 'required');
	  		$this->form_validation->set_rules('Date_Dogovor', 'Дата договора', 'required');
	  		$this->form_validation->set_rules('Diskont_Dogovor', 'Дисконт', 'required');
	  		$this->form_validation->set_rules('Date_Diskont_Dogovor', 'Дата дисконта', 'required');
	  		$this->form_validation->set_rules('Internat_Card_Dogovor', 'Международные карты', 'required');
	  		$this->form_validation->set_rules('Debet_Card_Dogovor', 'Дебетовые карты', 'required');
	  		$this->form_validation->set_rules('Thank_Dogovor', 'Спасибо', 'required');
	  		$this->form_validation->set_rules('Money_Movement_Dogovor', 'Оборот', 'required');
	  		$this->form_validation->set_rules('Money_Income_Dogovor', 'Доход', 'required');

		    if ($this->form_validation->run() == TRUE)
		    {

	  			$data = array (	'Page' 		=> 'formsuccess',
	  							'backpage' 	=> 'dogovor/edit/'.$id,
		        			   	'Title'  	=> 'Договор успешно изменен');
	            $this->Add_edit->editdogovor($id);

	  			$this->load->view('main', $data);
	        } else {
                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');

				$data['Page'] = 'dogovoradd';
				$data['UrlPage'] = 'dogovor/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение договора';

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
