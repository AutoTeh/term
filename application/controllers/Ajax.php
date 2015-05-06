<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function dogovor()
	{
		$this->load->library('table');
		$id = $this->input->post('id');
		$WhereFild = $this->input->post('idwhere');

		$this->table->set_heading('Номер', 'Дата', 'Дисконт',
								  'Дата дисконта', 'Международные карты', 'Дебетовые карты',
								  'Оборот', 'Спасибо', 'Дата расторжения');
		if (!$id = NULL) {

	  		$Config =   array(
	  					array('field' => 'id',
	  						'rules' => 'integer',
	  						'errors' => array('required' => 'Передан не верный ИД.')),
	  					array('field' => 'idwhere',
	  						'rules' => 'integer',
	  						'errors' => array('required' => 'Передан не верный ИД.'))
	  					);
	  		$this->form_validation->set_rules($Config);
  		}

	    if ($this->form_validation->run() == TRUE)
	    {
			foreach ($this->selectbd->dogovor($id, $this->input->post('idwhere')) as $row)
			{
					$TempArray = Array( $row['Num_Dogovor'],
					       			    $row['Date_Dogovor'],
					       			    $row['Diskont'],
					       				$row['Date_Diskont'],
					       				$row['Internat_Card'],
					       				$row['Sber_Card'],
					       				$row['Money_Movement'],
					       				$row['Income_Money'],
					       				$row['Date_Dissolution'],
					       				$row['thank']
				       			      );

					$this->table->add_row($TempArray);
			}
	        	$data['table'] = $this->table->generate();

        } Else: $data['table'] = validation_errors();

        $this->load->view('main',$data);
	}


}
