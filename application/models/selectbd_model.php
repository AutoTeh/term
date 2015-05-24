<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selectbd_model extends CI_Model {

    	public $Description_Fields = array();
        public $SearchFild;
        public $Search;
        public $Tabel;
        public $join = array();

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function search_ID($NameTable, $NameFild)
        {
	        		$this->db->select($NameTable.'.'.$NameFild);
	        		$this->db->from('Dogovor');
					$this->db->join('Org', 'Org.ID_Dogovor = Dogovor.ID_Dogovor', 'left');
	                $this->db->join('TCT', 'TCT.ID_Org = Org.ID_Org', 'left');
	                $this->db->join('TID', 'TID.ID_TCT = TCT.ID_TCT', 'left');
	                $this->db->join('Terminal', 'Terminal.ID_Terminal = TID.ID_Terminal', 'left');
	                $this->db->join('Pinpad', 'Pinpad.ID_Pinpad = TID.ID_Pinpad', 'left');
	                $this->db->join('Sim', 'Sim.ID_Sim = TID.ID_Sim', 'left');
	                $this->db->where(strtr($this->SearchFild, "ID_", "   ").'.'.$this->SearchFild,$this->Search);

	                $query = $this->db->get();

	                if ($query->num_rows() > 0)
	                {
		                foreach ($query->result_array() as $row)
						{
								$TempArr[] = $row[$NameFild];
						}

					} Else $TempArr = 'NULL';

                    return $TempArr;
        }

        public function dogovor($WhereOrIN = FALSE)
        {
        	$this->Tabel = 'Dogovor';
            return $this->_querying($WhereOrIN);
	    }

        public function org($WhereOrIN = FALSE)
        {
			$this->join = array(
				  		  array('Type_Rank_Org', 'Type_Rank_Org.ID_Type_Rank_Org = Org.ID_Org', 'left'),
   				  		  array('Type_Org', 'Type_Org.ID_Type_Org = Org.ID_Type_Org', 'left'));

            $this->Tabel = 'Org';
        	return $this->_querying($WhereOrIN);
        }

        public function address_out($Search = '', $CityTRUE = FALSE)
        {
        		$Out = TRUE;

        		$this->db->select('contact(SHORTNAME, " ", OFFNAME) as name, aoguid, parentaoguid');
	        	$this->db->from('addrobj');
	            $this->db->where('aoid', $Search);
	            $query = $this->db->get();

	          	if ($query->num_rows() > 0)
				{
					        $row = $query->row();
					        $OutString = ($CityTRUE) ? '' : $row->name;
					        ($row->parentaoguid == '') ? $Out = FALSE : $Search = $row->parentaoguid;

                while ($Out) {

	        		$this->db->select('contact(SHORTNAME, '. ', OFFNAME) as name, aoguid, parentaoguid');
	        		$this->db->from('addrobj');
	                $this->db->where('aoguid', $Search);
	                $this->db->where('currstatus', 0);
	                if ($CityTRUE) { $this->db->where('AOLEVEL', 4);}

	                $query = $this->db->get();

	          		if ($query->num_rows() > 0)
					{
					        $row = $query->row();
					        $OutString = $row->name.$OutString.' ';
					        ($row->parentaoguid == '') ? $Out = FALSE : $Search = $row->parentaoguid;
					        $Out = ($CityTRUE) ? FALSE : TRUE;
					}
                }

                	return TRIM($OutString);
                }

                	return FALSE;
        }

    	public function tct($WhereOrIN = FALSE)
        {
        	$this->join = array(
        		  		  array('Type_Kategoria_TCT', 'Type_Kategoria_TCT.ID_Type_Kategoria_TCT = TCT.ID_Type_Kategoria_TCT', 'inner'),
            	  		  array('Type_MCC_TCT', 'Type_MCC_TCT.ID_Type_MCC_TCT = TCT.ID_Type_MCC_TCT', 'inner'));

            $this->Tabel = 'TCT';
         	return $this->_querying($WhereOrIN);
        }

        public function tid($WhereOrIN = FALSE)
        {
        	$this->Tabel = 'TID';
            return $this->_querying($WhereOrIN);
        }

        public function terminal($WhereOrIN = FALSE)
        {
			$this->join = array(array('Type_Terminal', 'Type_Terminal.Id_Type_Terminal = Terminal.Id_Type_Terminal', 'inner'));

            $this->Tabel = 'Terminal';
   			return $this->_querying($WhereOrIN);
        }

        public function pinpad($WhereOrIN = FALSE)
        {
			$this->join = array(array('Type_PinPad', 'Type_PinPad.ID_Type_PinPad = PinPad.ID_Type_PinPad', 'inner'));

            $this->Tabel = 'PinPad';
   			return $this->_querying($WhereOrIN);
        }

        public function sim($WhereOrIN = FALSE)
        {
        	$this->join = array(array('Type_Operator_SIM', 'Type_Operator_SIM.ID_Type_Operator_SIM = SIM.ID_Type_Operator_SIM', 'nner'));

            $this->Tabel = 'SIM';
         	return $this->_querying($WhereOrIN);
        }

        function _querying($WhereOrIN = FALSE)
        {
                $Head = $this->_Head_String();
	        	if ($WhereOrIN)
	        	{
                    $this->db->where_in($this->Tabel.'.ID_'.$this->Tabel, $this->search_ID($this->Tabel, 'ID_'.$this->Tabel));
           		}

           		$this->db->select($Head);
        		$this->db->from($this->Tabel);

				foreach ($this->join as $row)
				{					$this->db->join($row[0], $row[1], $row[2]);
				}
                $this->db->limit(1);
	            return $this->db->get();
        }

        function _Head_String()
        {
			if (!$this->Tabel == '')
			{

	            $this->db->select('Data_Template_Fields');
	            $this->db->from('template_fields');
	            $this->db->join('table', 'table.ID_Table = template_fields.ID_Table');
	            $this->db->where('ID_Users', $this->session->ID_Users);
                $this->db->where('Name_Table', $this->Tabel);
				$query = $this->db->get();

        		if ($query->num_rows() > 0)
        		{
					$row = $query->row_array();
	                $ColumnArray = explode(', ', $row['Data_Template_Fields']);

					$this->db->select('ID_Fields_Table, Name_Fields_Table, Description_Fields_Table');
		            $this->db->from('Fields_Table');
		            $this->db->where_in('ID_Fields_Table', $ColumnArray);
                    $query = $this->db->get();

					foreach ($query->result_array() as $row)
					{
                        $TempArrayFields[$row['ID_Fields_Table']] = $row['Name_Fields_Table'];
                        $this->Description_Fields[$row['Name_Fields_Table']] = $row['Description_Fields_Table'];
					}

					$Out = '';

					foreach ($ColumnArray as $value)
					{						$Out .= $TempArrayFields[$value].', ';
					}

                    $this->db->reset_query();
					Return reduce_multiples($Out, ", ", TRUE);
				}
			}
        }
}
