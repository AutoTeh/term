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

 	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('table');

	    //$this->table->set_heading('ИНН', 'Название организации', 'Юр. адрес',
	    //   						  'Почтовый адрес', 'ФИО руководителя', 'Должность',
		//						  'Телефон руководителя', 'E-mail', 'Настройки');

	    $this->table->set_heading('ИНН', 'Название организации', 'ФИО руководителя',
								  'Телефон руководителя', 'E-mail', 'Настройки');
    }

	public function index()
	{
		$tmpl = array ( 'table_open'  => '<table id="head" cellspacing="0" >' );
		$this->table->set_template($tmpl);

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->org(), 'Org'),
			   		   'js' 			=> 'var tf2 = setFilterGrid("head", table_Props_head);',
			   		   'Page' 			=> 'table',
			   		   'CountColTable' 	=> $this->Gen_table->CountCol-1,
			   		   'IDTable'        => 'head',
        			   'Title' 			=> 'Организации');

		$this->load->view('main', $data);
	}

	public function FilterID()
	{
	  	$this->form_validation->set_rules(array('field' => 'Search',
		  										'rules' => 'integer',
		  										'errors' => array('required' => 'Передан не верный ИД.')
	  				  							));

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$ID = 'Org_'.$this->input->post('Search');

	    	$tmpl = array ( 'table_open'  => '<table id="'.$ID.'" cellspacing="0" >' );
			$this->table->set_template($tmpl);

			$data = array ('table' 			=> $this->Gen_table->Out($this->Selectbd->org(TRUE), 'Org', TRUE),
						   'CountColTable' 	=> $this->Gen_table->CountCol-1,
						   'IDTable'        => $ID,
						   'js' 			=> 'var tf2_'.$ID.' = setFilterGrid("'.$ID.'",table_Props_'.$ID.');'
						   );

            $this->load->view('table', $data);

        } Else Echo validation_errors();
	}

	function _gen_tabel($query)
	{
        	if ($query->num_rows() > 0)
        	{
        		$this->table->add_row(array('data' => '', 'colspan' => 6));
				foreach ($query->result_array() as $row)
				{
						$TempArray = Array( $row['INN_Org'],
						       			    $row['Name_Org'],
						       			    //$this->Selectbd->address_out($row['ID_Juristical_Address_Org']),
						       				//$this->Selectbd->address_out($row['ID_Post_Address_Org']),
						       				$row['FIO_Boss_Org'],
						       				//$row['Name_Type_Rank_Org'],
						       				$row['Phone_Boss_Org'],
						       				$row['E_Mail_Org'],
						       				array('data' => $this->_gen_button($row['ID_Org']), 'align' => 'center'));

						$this->table->add_row($TempArray);
						$this->table->add_row(array('data' => '<div id="FilterTabel" class="Org_'.$row['ID_Org'].'"></div>', 'colspan' => 6));
				}
                    Return $this->table->generate();
            } Else  Return 'Нет данных';
	}

	function _gen_button($id)
	{
		$Dogovor 	= "ReceiveTabelFilterID(".$id.", 'dogovor', 'Org', 'ID_Org');return false";
		$TCT 		= "ReceiveTabelFilterID(".$id.", 'tct', 'Org', 'ID_Org');return false";
		$TID 		= "ReceiveTabelFilterID(".$id.", 'tid', 'Org', 'ID_Org');return false";
		$Terminal 	= "ReceiveTabelFilterID(".$id.", 'terminal', 'Org', 'ID_Org');return false";
		$Pinpad 	= "ReceiveTabelFilterID(".$id.", 'pinpad', 'Org', 'ID_Org');return false";
		$sim 		= "ReceiveTabelFilterID(".$id.", 'sim', 'Org', 'ID_Org');return false";

		return  '
			<div class="btn-group">
		  <a class="btn btn-primary btn-mini" href="#"><i class="icon-info-sign icon-white"></i> </a>
		  <a class="btn btn-primary btn-mini dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
		  <ul align ="left" class="dropdown-menu">
		  	<li><a href="#" onclick="'.$Dogovor.'"> Договор</a></li>
		    <li><a href="#" onclick="'.$TCT.'"> ТСТ</a></li>
		    <li><a href="#" onclick="'.$TID.'"> TID</a></li>
		    <li><a href="#" onclick="'.$Terminal.'"> Терминал</a></li>
		    <li><a href="#" onclick="'.$Pinpad.'"> Пинпад</a></li>
		    <li><a href="#" onclick="'.$sim.'"> SIM-карты</a></li>
		  </ul>
		</div>';
	}


}
