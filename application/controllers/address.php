<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {

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

	/*
				$data = array ('region' 		 => form_dropdown('region', $Arrayregion, '', 'onChange="submitformRegion(this.value)"'),
						   'area' 			 => form_dropdown('area', $Arrayarea, '', 'onChange="get_address(this.value, '."'area'".'")"'),
						   'city' 			 => form_dropdown('city', $Arraycity, '', 'onChange="get_address(this.value, '."'citi'".'")"'),
						   'city_area' 		 => form_dropdown('city_area', $Arraycity_area, '', 'onChange="get_address(this.value, '."'citi_area'".'")"'),
						   'locality' 		 => form_dropdown('locality', $Arraylocality, '','onChange="get_address(this.value, '."'locality'".'")"'),
						   'street' 		 => form_dropdown('street', $Arraystreet, '', 'onChange="get_address(this.value, '."'street'".'")"'),
						   'add_area' 		 => form_dropdown('add_area', $Arrayadd_area, '', 'onChange="get_address(this.value, '."'add_area'".'")"'),
						   'street_add_area' => form_dropdown('street_add_area', $Arraystreet__add_area, ''));
					switch ($row['AOLEVEL']) {
						case 1:
							$Arrayregion[$row['aoguid']] = $row['adr'];
							break;
						case 3:
							$Arrayarea[$row['aoguid']] = $row['adr'];
							break;
						case 4:
							$Arraycity[$row['aoguid']] = $row['adr'];
							break;
						case 5:
							$Arraycity_area[$row['aoguid']] = $row['adr'];
							break;
						case 6:
							$Arraylocality[$row['aoguid']] = $row['adr'];
							break;
						case 7:
							$Arraystreet[$row['aoguid']] = $row['adr'];
							break;
						case 90:
							$Arrayadd_area[$row['aoguid']] = $row['adr'];
							break;
						case 91:
							$Arraystreet__add_area[$row['aoguid']] = $row['adr'];
							break;
						}
	*/

 	public function __construct()
    {
    	parent::__construct();
        $this->Account->is_auth();
    }

	public function index()
	{

  		$this->form_validation->set_rules('search', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {

        } Else {
			redirect('/address', 'refresh');
        }
            $query = $this->Address->outregion();

            if ($query->num_rows() > 0)
			{
			  	foreach ($query->result_array() as $row)
				{
					$Arrayregion[$row['aoguid']] = $row['adr'];
				}

			}

			$data = array ('region' 		 => form_dropdown('region', $Arrayregion, '', 'onChange="get_address(this.value, '."'region'".'")"'),
						   'area' 			 => '<select name="area"></select>',
						   'city' 			 => '<select name="city"></select>',
						   'city_area' 		 => '<select name="city_area"></select>',
						   'locality' 		 => '<select name="locality"></select>',
						   'street' 		 => '<select name="street"></select>',
						   'add_area' 		 => '<select name="add_area"></select>',
						   'street_add_area' => '<select name="street_add_area"></select>',
						   'Page' 			 => 'address',
						   'House'			 => '');

        	$this->load->view('main', $data);
	}

	public function region()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'area'));
        }
	}

	public function area()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'city'));
        }
	}

	public function city()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'city_area'));
        }
	}

	public function city_area()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'locality'));
        }
	}

	public function locality()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'street'));
        }
	}

	public function street()
	{
  		$this->form_validation->set_rules('search', '', 'required');
        $this->form_validation->set_rules('NameField', '', 'required');

	    if ($this->form_validation->run() == TRUE)
	    {
	    	$Search = $this->input->post('search');
			$NameField = $this->input->post('NameField');


           echo json_encode($this->Address->add($NameField, $Search, 'add_area'));
        }
	}

 	function valid_fild_search($value)
	{
		if ($value == 't')
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}