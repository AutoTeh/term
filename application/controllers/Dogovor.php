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

    	$this->load->model('selectbd');
    	$this->load->library('table');
    }

	public function index()
	{

		foreach ($this->selectbd->dogovor() as $row)
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
        $TempTable = $this->table->generate();

        $this->table->clear();

		$this->table->set_heading('Номер', 'Дата', 'Дисконт',
								  'Дата дисконта', 'Международные карты', 'Дебетовые карты',
								  'Оборот', 'Спасибо', 'Дата расторжения');

		$cell = array('data' => $TempArray, 'colspan' => 10);
		$this->table->add_row($cell);

	    $data['table'] = $this->table->generate();
        $this->load->view('main',$data);
	}

	public function Filter()
	{
		$WhereFild = $this->input->post('where');

		if ($this->input->post('WhereOrIN') == TRUE) {

	  		$Config = array('field' => 'Search',
		  					'rules' => 'integer',
		  					'errors' => array('required' => 'Передан не верный ИД.')
	  				  );
	  		$this->form_validation->set_rules($Config);
  		}

	    if ($this->form_validation->run() == TRUE)
	    {
			foreach ($this->selectbd->dogovor() as $row)
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
	        	Echo $this->table->generate();

        } Else: Echo validation_errors();


	}


}
