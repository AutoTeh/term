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

    	$this->load->model('selectbd');
    	$this->load->library('table');
    }

	public function index()
	{
        $cell = array('data' => $this->_gen_tabel($this->selectbd->terminal()), 'colspan' => 10);
	    $this->table->clear();

		$this->table->set_heading('ИНН', 'Название организации', 'Юр. адрес', 'Почтовый адрес',
								  'ФИО руководителя', 'Телефон руководителя', 'E-mail', 'ОКПО', 'ОГРН'
								  'Название банка');

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
	        $cell = array('data' => $this->_gen_tabel($this->selectbd->terminal(TRUE)), 'colspan' => 10, 'cellpadding' => '0');
		    $this->table->clear();

		$this->table->set_heading('Модель', 'Сирийный номер',
								  'Инвентарный номер', 'Цена',
								  'Дата получения');

			$this->table->add_row($cell);
	  		$data['table'] = $this->table->generate();
        } Else: Echo validation_errors();
	}

	public function Filter()
	{
		Echo $this->_gen_tabel($this->selectbd->terminal(FALSE));
	}

	function _gen_tabel($query)
	{
        	if ($query->num_rows() > 0)
        	{
				foreach ($query->result() as $row)
				{
						$TempArray = Array( $row['Name_Type_Terminal'],
						       			    $row['SN_Num_Terminal'],
						       			    $row['Inv_Num_Terminal'],
						       				$row['Price_Terminal'],
						       				$row['Date_Terminal']
					    );

						$this->table->add_row($TempArray);
				}
		        	 Return $this->table->generate();
            } Else : Return 'Нет данных';
	}


}
