<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gen_table_model extends CI_Model {
    var $TableArray = array();
    var $Tabel;
    public $CountCol;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function Out($query)
	{
			$this->Tabel = $this->Selectbd->Tabel;
			if ($query->num_rows() > 0 && !$this->Tabel == '')
        	{                $this->_gen_head($query);
                $this->_get_inf();
                $this->CountCol = $query->num_fields();

        		 $this->table->add_row(array('data' => '', 'colspan' => $this->CountCol));

				foreach ($query->result_array() as $row)
				{
					foreach ($row as $key => $value)
					{

                    	switch ($key) {
						    case 'ID_'.$this->Tabel:
						        $TempArray[] = $this->_gen_button($value);
						        $ID_Table = $value;
						        break;
						    default:
						        $TempArray[] = $value;
						}

					}

						$this->table->add_row($TempArray);
						$TempArray = '';
						$this->table->add_row(array('data' => '<div id="FilterTabel" class="'.$this->Tabel.'_'.$ID_Table.'"></div>', 'colspan' => $this->CountCol));

				}
		        	 Return $this->table->generate();
            } Else   Return 'Нет данных';
	}

	function _gen_head($query = '')
	{		if (!$query == '')
		{			$row = $query->list_fields();

			foreach ($row as $value)
			{				$TempArray[] = $this->Selectbd->Description_Fields[$value];
			}

			$this->table->set_heading($TempArray);
		}
	}

	function _gen_button($id)
	{

		$Out = '<div class="btn-group "><a class="btn btn-primary btn-mini" href="#"><i class="icon-info-sign icon-white"></i></a><a class="btn btn-primary btn-mini dropdown-toggle " data-toggle="dropdown" href="#"><span class="caret "></span></a><ul class="dropdown-menu pull-right">';


		foreach ($this->TableArray as $key => $row)
		{
			if ($key != $this->Tabel)
			{
				$Out .= '<li><a href="#" onclick="'."ReceiveTabelFilterID(".$id.", '".$key."', '".$this->Tabel."', 'ID_".$this->Tabel."');return false".'">'.$row.'</a></li>';
			}
		}
          $Out .= '<li class="dropdown-submenu pull-left"><a tabindex="-1" href="#">привязка</a><ul class="dropdown-menu">';

          switch ($this->Tabel) {
			  case 'Dogovor':
				  $Out .= '<li><a href="#"> Организация</a></li>';
				  break;
			  case 'Org':
				  $Out .= '<li><a href="#"> Договор</a></li> <li><a href="#"> ТСТ</a></li>';
				  break;
		  }

		return $Out."</ul></ul></div>";
	}

	function _get_inf()
	{
		$this->db->select('Name_Table, Description_Table');
		$query = $this->db->get('table');

        if ($query->num_rows() > 0)
        {
			foreach ($query->result_array() as $row)
			{				$this->TableArray[$row['Name_Table']] = $row['Description_Table'];
			}
		}
	}
}
