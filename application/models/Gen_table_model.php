<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gen_table_model extends CI_Model {
    public $TableArray = array();
    public $CountCol;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function Out($query, $Tabel = '',$FlagFilterID = FALSE)
	{
        	if ($query->num_rows() > 0 && !$Tabel == '')
        	{                $this->_gen_head($query);
                $this->_get_inf();

        		if (!$FlagFilterID) { $this->$CountCol = $query->num_fields(); $this->table->add_row(array('data' => '', 'colspan' => $this->$CountCol));}

				foreach ($query->result_array() as $row)
				{
					foreach ($row as $key => $value)
					{

                    	switch (substr($key, 0, 2)) {
						    case 'ID':
						        $TempArray[] = $this->_gen_button($value, ($FlagFilterID) ? 'disabled' : '', $Tabel, $key);
						        $ID_Table = $value;
						        break;
						    default:
						        $TempArray[] = $value;
						}
					}

						$this->table->add_row($TempArray);
						if (!$FlagFilterID) $this->table->add_row(array('data' => '<div id="FilterTabel" class="dogovor_'.$ID_Table.'"></div>', 'colspan' => $this->$CountCol));

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

	function _gen_button($id, $DisableFlag = '', $Table = '', $ID_Field = '')
	{
		$Out = '<div class="btn-group"><a class="btn btn-primary btn-mini" href="#"><i class="icon-info-sign icon-white"></i></a><a class="btn btn-primary btn-mini dropdown-toggle '.$DisableFlag.'" data-toggle="dropdown" href="#"><span class="caret"></span></a><ul class="dropdown-menu">';

		foreach ($this->TableArray as $key => $row)
		{
			if (!$Table == $key) $Out .= '<li><a href="#" onclick="'."ReceiveTabelFilterID(".$id.", '".$key."', '".$Table."', '".$ID_Field."');return false".'">'.$row.'</a></li>';
		}

		return $Out."</ul></div>";
	}

	function _get_inf()
	{
		$this->db->select('Name_Table, Description_Table');
		$query = $this->db->get('table');

        if ($query->num_rows() > 0)
        {
			foreach ($query->result_array() as $row)
			{				$this->TableArray[$row['title']] = $row['Description_Table'];
			}
		}
	}
}
