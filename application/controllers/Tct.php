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

 	public function __construct()
    {
    	parent::__construct();

    	$this->load->model('selectbd');
    	$this->load->library('table');
    }

	public function index()
	{
        $cell = array('data' => $this->_gen_tabel($this->selectbd->tct()), 'colspan' => 10);
	    $this->table->clear();

		$data = array('id' => 'Tabel',
					  'onkeypress'  => 'Javascript: if (event.keyCode==13) ReceiveTabelFilter("Dogovor");');

	    $this->table->set_heading('Номер мерчанта'.form_input_new($data, 'INN_Org'),
	       						  'Название'.form_input_new($data, 'Name_Org'),
	       						  'Контактное лицо'.form_input_new($data, 'ID_Juristical_Address_Org'),
	       						  'Телефон'.form_input_new($data, 'ID_Post_Address_Org'),
		  					      'Адрес'.form_input_new($data, 'FIO_Boss_Org'),
		   					      'Категория'.form_input_new($data, 'Name_Type_Rank_Org'),
								  'МСС'.form_input_new($data, 'Phone_Boss_Org'),
								  'Режим работы'.form_input_new($data, 'E_Mail_Org'),
								  'Настройки');

		//$this->table->set_heading('Номер мерчанта', 'Название', 'Контактное лицо',
		//						  'Телефон', 'Адрес', 'Категория', 'МСС', 'Режим работы');

		$this->table->add_row($cell);
  		$data['table'] = $this->table->generate();

		$this->load->view('main',$data);
	}

	public function FilterID()
	{

	  	$this->form_validation->set_rules(array('field' => 'Search',
		  										'rules' => 'integer',
		  										'errors' => array('required' => 'Передан не верный ИД.')
	  				  							));

	    if ($this->form_validation->run() == TRUE)
	    {
	        $cell = array('data' => $this->_gen_tabel($this->selectbd->tct(TRUE)), 'colspan' => 10, 'cellpadding' => '0');
		    $this->table->clear();

			$data = array('id' => 'Tabel',
						  'onkeypress'  => 'Javascript: if (event.keyCode==13) ReceiveTabelFilter("Dogovor");');

	    	$this->table->set_heading('Номер мерчанта'.form_input_new($data, 'Num_Merchant_TCT'),
	       							  'Название'.form_input_new($data, 'Name_TCT'),
	       							  'Контактное лицо'.form_input_new($data, 'Contact_Name_TCT'),
	       							  'Телефон'.form_input_new($data, 'Phone_TCT'),
		  						      'Адрес'.form_input_new($data, 'ID_Address_TCT'),
		   					    	  'Категория'.form_input_new($data, 'Name_Type_Kategoria_TCT'),
									  'МСС'.form_input_new($data, 'Name_Type_MCC_TCT'),
									  'Режим работы'.form_input_new($data, 'Mode_TCT'),
									  'Настройки');

			$this->table->add_row($cell);
	  		$data['table'] = $this->table->generate();
        } Else: Echo validation_errors();
	}

	public function Filter()
	{
		Echo $this->_gen_tabel($this->selectbd->tct(FALSE));
	}

	function _gen_tabel($query)
	{
        	if ($query->num_rows() > 0)
        	{
				foreach ($query->result() as $row)
				{
						$TempArray = Array( $row['Num_Merchant_TCT'],
						       			    $row['Name_TCT'],
						       			    $row['Contact_Name_TCT'],
						       				$row['Phone_TCT'],
						       				$row['ID_Address_TCT'],
						       				$row['Name_Type_Kategoria_TCT'],
						       				$row['Name_Type_MCC_TCT'],
						       				$row['Mode_TCT']
					    );

						$this->table->add_row($TempArray);
				}
		        	 Return $this->table->generate();
            } Else : Return 'Нет данных';
	}


}
