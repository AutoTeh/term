<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Terminal';
    }

	public function index()
	{
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->terminal()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> $this->Gen_table->CountCol-1,
        			   'Title' 			=> 'Терминалы',
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
	    	$ID = 'Terminal_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0">'));

			$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->terminal(TRUE)),
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
	  	$this->form_validation->set_rules('ID_Type_Terminal', 'Номер договора', 'required');
	  	$this->form_validation->set_rules('SN_Num_Terminal', 'Дата договора', 'required');
	  	$this->form_validation->set_rules('Inv_Num_Terminal', 'Дисконт', 'required');
	  	$this->form_validation->set_rules('Price_Terminal', 'Дата дисконта', 'required');
	  	$this->form_validation->set_rules('Date_Terminal', 'Международные карты', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

  			$data = array (	'Page' 	=> 'formsuccess',
  							'backpage' 	=> 'terminal/add',
	        			   	'Title'  => 'Терминал успешно добавлен');
            $this->Add_edit->addterminal();

  			$this->load->view('main', $data);

        } Else {
            $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');
        	$data = array (	'Page' 				=> 'terminaladd',
        					'UrlPage' 			=> 'terminal/add',
        					'ID_Type_Terminal' 	=>  form_dropdown('ID_Type_Terminal', $this->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), set_value('ID_Type_Terminal')),
	        			   	'Title'  			=> 'Добавление нового терминала.');

        	$this->load->view('main', $data);
        }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->form_validation->integer($id))
	    {
     		$this->db->select('ID_Type_Terminal, SN_Num_Terminal, Inv_Num_Terminal,
            				   Price_Terminal, Date_Terminal');
        	$this->db->from('terminal');
        	$this->db->where('ID_Terminal', $id);
        	$query = $this->db->get();

        	if ($query->num_rows() > 0)
        	{
				$data = $query->row_array();

			} else {
				redirect('/', 'refresh');
			}

            if (!$FlagNext)
            {
				$data['Page'] = 'terminaledit';
				$data['UrlPage'] = 'terminal/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение Терминала';
		       	$data['ID_Type_Terminal'] = form_dropdown('ID_Type_Terminal', $this->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), $data['ID_Type_Terminal']);
	        	$this->load->view('main', $data);
            }
            else
            {
	  		$this->form_validation->set_rules('ID_Type_Terminal', 'Номер договора', 'required');
	  		$this->form_validation->set_rules('SN_Num_Terminal', 'Дата договора', 'required');
	  		$this->form_validation->set_rules('Inv_Num_Terminal', 'Дисконт', 'required');
	  		$this->form_validation->set_rules('Price_Terminal', 'Дата дисконта', 'required');
	  		$this->form_validation->set_rules('Date_Terminal', 'Международные карты', 'required');

		    if ($this->form_validation->run() == TRUE)
		    {

	  			$data = array (	'Page' 		=> 'formsuccess',
	  							'backpage' 	=> 'terminal/edit/'.$id,
		        			   	'Title'  	=> 'Терминал успешно изменен');
	            $this->Add_edit->editterminal($id);

	  			$this->load->view('main', $data);
	        } else {
                $this->form_validation->set_error_delimiters('<span class="label label-important">', '</span>');

				$data['Page'] = 'terminaladd';
				$data['UrlPage'] = 'terminal/edit/'.$id.'/1';
		       	$data['Title'] = 'Изменение терминала';
                $data['ID_Type_Terminal'] = form_dropdown('ID_Type_Terminal', $this->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), set_value('ID_Type_Terminal'));
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