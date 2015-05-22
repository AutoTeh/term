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

	public $rows_always_visible = '';

 	public function __construct()
    {
    	parent::__construct();

    	$this->load->model('Selectbd_model', 'Selectbd');
    	$this->load->library('table');

  		$this->table->set_heading('Номер', 'Дата', 'Дисконт', 'Дата дисконта', 'Международные карты',
           						  'Дебетовые карты', 'Оборот', 'Доход', 'Спасибо', 'Дата расторжения',
								  'Настройки');
    }

	public function index()
	{
		$tmpl = array ( 'table_open'  => '<table id="head" cellspacing="0" >' );
		$this->table->set_template($tmpl);

  		$data = array ('Table' 			=> $this->_gen_tabel($this->Selectbd->dogovor()),
					   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
        			   'Page' 			=> 'table',
        			   'CountColTable' 	=> 10,
        			   'Title' 			=> 'Договоры',
        			   'IDTable'        => 'head');

		$this->load->view('main', $data);
	}

	public function FilterID()
	{
  		$this->form_validation->set_rules('search', 'ID', 'required|integer');
  		$this->form_validation->set_rules('searchfild', 'Поля поиска', 'callback_valid_post_filter_field');

	    if ($this->form_validation->run() == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'Dogovor_'.$this->Selectbd->Search;
	    	$tmpl = array ( 'table_open'  => '<table id="'.$ID.'" cellspacing="0">' );
			$this->table->set_template($tmpl);

			$data = array ('Table' 	=> $this->_gen_tabel($this->Selectbd->dogovor(TRUE), TRUE),
						   'CountColTable' 	=> 11,
						   'IDTable'        => $ID,
                           'js' 	=> '');
  			$this->load->view('table', $data);

        } Else {
        	$this->load->view('err');
        }
	}

	public function valid_post_filter_field($value)
	{
		if ($this->db->field_exists($value, 'Dogovor'))
		{
			$this->form_validation->set_message('valid_post_filter_field', 'Передано не верное имя {field}.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}


	function _gen_tabel($query, $FlagFilterID = FALSE)
	{
        	if ($query->num_rows() > 0)
        	{   if (!$FlagFilterID) { $this->table->add_row(array('data' => '', 'colspan' => 11));}
				foreach ($query->result_array() as $row)
				{
						$TempArray = Array( $row['Num_Dogovor'],
						       			    $row['Date_Dogovor'],
						       			    $row['Diskont_Dogovor'],
						       				$row['Date_Diskont_Dogovor'],
						       				$row['Internat_Card_Dogovor'],
						       				$row['Debet_Card_Dogovor'],
						       				$row['Money_Movement_Dogovor'],
						       				$row['Money_Income_Dogovor'],
						       				$row['Thank_Dogovor'],
						       				$row['Date_Dissolution_Dogovor'],
						       				$this->_gen_button($row['ID_Dogovor'], 'disabled'));

						$this->table->add_row($TempArray);
						if (!$FlagFilterID) $this->table->add_row(array('data' => '<div id="FilterTabel" class="dogovor_'.$row['ID_Dogovor'].'"></div>', 'colspan' => 11));

				}
		        	 Return $this->table->generate();
            } Else   Return 'Нет данных';
	}

	function _gen_button($id, $DisableFlag = '')
	{
		$Org 		= "ReceiveTabelFilterID(".$id.", 'org', 'dogovor', 'ID_Dogovor');return false";
		$TCT 		= "ReceiveTabelFilterID(".$id.", 'tct', 'dogovor', 'ID_Dogovor');return false";
		$TID 		= "ReceiveTabelFilterID(".$id.", 'tid', 'dogovor', 'ID_Dogovor');return false";
		$Terminal 	= "ReceiveTabelFilterID(".$id.", 'terminal', 'dogovor', 'ID_Dogovor');return false";
		$Pinpad 	= "ReceiveTabelFilterID(".$id.", 'pinpad', 'dogovor', 'ID_Dogovor');return false";
		$sim 		= "ReceiveTabelFilterID(".$id.", 'sim', 'dogovor', 'ID_Dogovor');return false";

		return  '<div class="btn-group">
		  <a class="btn btn-primary btn-mini" href="#"><i class="icon-info-sign icon-white"></i></a>
		  <a class="btn btn-primary btn-mini dropdown-toggle '.$DisableFlag.'" data-toggle="dropdown" href="#"><span class="caret"></span></a>
		  <ul class="dropdown-menu">
		  	<li><a href="#" onclick="'.$Org.'"> Организация</a></li>
		    <li><a href="#" onclick="'.$TCT.'"> ТСТ</a></li>
		    <li><a href="#" onclick="'.$TID.'"> TID</a></li>
		    <li><a href="#" onclick="'.$Terminal.'"> Терминал</a></li>
		    <li><a href="#" onclick="'.$Pinpad.'"> Пинпад</a></li>
		    <li><a href="#" onclick="'.$sim.'"> SIM-карты</a></li>
		  </ul>
		</div>';
	}


}
