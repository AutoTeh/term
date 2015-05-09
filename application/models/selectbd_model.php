<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selectbd_model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function search_ID($NameFild, $NameFildWHERE, $Search)
        {
        		$this->db->select($NameFild);
        		$this->db->from('Dogovor');
				$this->db->join('Org', 'Org.ID_Org = Dogovor.ID_Dogovor', 'inner');
                $this->db->join('TCT', 'TCT.ID_TCT = Org.ID_Org', 'inner');
                $this->db->join('TID', 'TID.ID_TID = TCT.ID_TCT', 'inner');
                $this->db->join('Terminal', 'Terminal.ID_Terminal = TID.ID_TID', 'inner');
                $this->db->join('Pinpad', 'Pinpad.ID_Pinpad = TID.ID_TID', 'inner');
                $this->db->join('Sim', 'Sim.ID_Sim = TID.ID_TID', 'inner');
                $this->db->where($NameFildWHERE, $Search);
                $query = $this->db->get();

                if ($query->num_rows() > 0)
                {
	                foreach ($query->result() as $row)
					{
							$TempArray[] = $row[$NameFild];
					}

				} Else: return FALSE;

                return $TempArray;
        }

        public function search_field($Search = NULL, $BoolOut = FALSE)
        {
        		$this->db->select('Name_FieldsBD');
        		$this->db->from('FieldsBD');
				$this->db->where('ID_FieldsBD', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? if ($BoolOut) ? TRUE : $query->result() : FALSE;
        }

        public function dogovor($WhereOrIN = '')
        {
	    	$this->db->select('ID_Dogovor, Num_Dogovor, Date_Dogovor,
	        				   Diskont_Dogovor, Date_Diskont_Dogovor, Internat_Card_Dogovor,
	        				   Debet_Card_Dogovor, Money_Movement_Dogovor, Income_Money_Dogovor,
	        				   Date_Dissolution_Dogovor, Thank_Dogovor');
	        $this->db->from('Dogovor');

            $TempArray = array('Num_Dogovor', 'Date_Dogovor',
	        				   'Diskont_Dogovor', 'Date_Diskont_Dogovor', 'Internat_Card_Dogovor',
	        				   'Debet_Card_Dogovor', 'Money_Movement_Dogovor', 'Income_Money_Dogovor',
	        				   'Date_Dissolution_Dogovor', 'Thank_Dogovor');

            return $this->_querying($WhereOrIN, $TempArray, 'Dogovor', 'ID_Dogovor');

	    }

        public function org($WhereOrIN = '')
        {
        		$this->db->select('ID_Org, INN_Org, Name_Org,
        						   ID_Post_Address_Org, ID_Juristical_Address_Org,
        						   FIO_Boss_Org, Name_Type_Rank_Org, E_Mail_Org, Phone_Boss_Org');

        		$this->db->from('Org');
				$this->db->join('Type_Rank_Org', 'Type_Rank_Org.ID_Type_Rank_Org = Org.ID_Org', 'inner');
                $this->db->join('Type_Org', 'Type_Org.ID_Type_Org = Org.ID_Type_Org', 'inner');

                $TempArray = array('INN_Org', 'Name_Type_Org', 'Name_Org', 'ID_Post_Address_Org',
                				   'ID_Juristical_Address_Org', 'FIO_Boss_Org',
                				   'Name_Type_Rank_Org', 'E_Mail_Org', 'Phone_Boss_Org');

                return $this->_querying($WhereOrIN, $TempArray, 'Org', 'ID_Org');
        }

        public function address_out($Search = '', $CityTRUE = FALSE)
        {
        		$Out = TRUE;

        		$this->db->select('contact(SHORTNAME, ' ', OFFNAME) as name, aoguid, parentaoguid');
	        	$this->db->from('addrobj');
	            $this->db->where('aoid', $Search);
	            $query = $this->db->get();

	          	if ($query->num_rows() > 0)
				{
					        $row = $query->row();
					        $OutString = (!$CityTRUE) ? $row->name;
					        if ($row->parentaoguid == '') ? $Out = FALSE : $Search = $row->parentaoguid;

                while ($Out) {

	        		$this->db->select('contact(SHORTNAME, '. ', OFFNAME) as name, aoguid, parentaoguid');
	        		$this->db->from('addrobj');
	                $this->db->where('aoguid', $Search);
	                $this->db->where('currstatus', 0);
	                if ($CityTRUE) ? $this->db->where('AOLEVEL', 4);

	                $query = $this->db->get();

	          		if ($query->num_rows() > 0)
					{
					        $row = $query->row();
					        $OutString = $row->name.$OutString.' ';
					        if ($row->parentaoguid == '') ? $Out = FALSE : $Search = $row->parentaoguid;
					        if ($CityTRUE) ? $Out = FALSE;
					}
                }

                	return TRIM($OutString);
                }

                	return FALSE;
        }

    	public function tct($WhereOrIN = '')
        {

        		$this->db->select('ID_TCT, Num_Merchant_TCT, Name_TCT,
        						   Phone_TCT, Contact_Name_TCT, ID_Address_TCT,
        						   Name_Type_Kategoria_TCT, Name_Type_MCC_TCT,
        						   Mode_TCT');
        		$this->db->from('TCT');
                $this->db->join('Type_Kategoria_TCT', 'Type_Kategoria_TCT.ID_Type_Kategoria_TCT = TCT.ID_Type_Kategoria_TCT', 'inner');
                $this->db->join('Type_MCC_TCT', 'Type_MCC_TCT.ID_Type_MCC_TCT = TCT.ID_Type_MCC_TCT', 'inner');

                $TempArray = array('Num_Merchant_TCT', 'Name_TCT',
        						   'Phone_TCT', 'Contact_Name_TCT', 'ID_Address_TCT',
        						   'Name_Type_Kategoria_TCT', 'Name_Type_MCC_TCT',
        						   'Mode_TCT');

                return $this->_querying($WhereOrIN, $TempArray, 'TCT', 'ID_TCT');
        }

        public function tid($WhereOrIN = '')
        {
        		$this->db->select('ID_TID, Num_TID,
        						   Kod_Activ_TID, Date_Reg_CA_TID');
        		$this->db->from('TID');
          		$TempArray = array('Num_TID', 'Kod_Activ_TID', 'Date_Reg_CA_TID');

                return $this->_querying($WhereOrIN, $TempArray, 'TID', 'ID_TID');
        }

        public function terminal($WhereOrIN = '')
        {

        		$this->db->select('ID_Terminal, SN_Num_Terminal, Inv_Num_Terminal, Price_Terminal, Date_Terminal, Name_Type_Terminal');
        		$this->db->from('Terminal');
				$this->db->join('Type_Terminal', 'Type_Terminal.Id_Type_Terminal = Terminal.Id_Type_Terminal', 'inner');

    			$TempArray = array('SN_Num_Terminal', 'Inv_Num_Terminal',
    							   'Price_Terminal', 'Date_Terminal',
    							   'Name_Type_Terminal');

                return $this->_querying($WhereOrIN, $TempArray, 'Terminal', 'ID_Terminal');
        }

        public function pinpad($WhereOrIN = '')
        {
        		$this->db->select('ID_PinPad, Name_Type_PinPad, SN_Num_PinPad');
        		$this->db->from('PinPad');
				$this->db->join('Type_PinPad', 'Type_PinPad.ID_Type_PinPad = PinPad.ID_Type_PinPad', 'inner');

                $TempArray = array('Name_Type_PinPad', 'SN_Num_PinPad');
                return $this->_querying($WhereOrIN, $TempArray, 'PinPad', 'ID_PinPad');
        }

        public function sim($WhereOrIN = '')
        {
        		$this->db->select('ID_Sim, SN_Num_Sim, Name_Type_Operator_Sim');
        		$this->db->from('Sim');
				$this->db->join('Type_Operator_Sim', 'Type_Operator_Sim.ID_Type_Operator_Sim = Sim.ID_Type_Operator_Sim', 'inner');

                $TempArray = array('SN_Num_Sim', 'Name_Type_Operator_Sim');

                return $this->_querying($WhereOrIN, $TempArray, 'Sim', 'ID_Sim');
        }

        function _querying($WhereOrIN = '', $ArrayFields = '', $Tabel = '', $IDFields = '')
        {
	        	if ($WhereOrIN)
	        	{
	        		$this->db->where_in($Tabel, $this->search_ID($Tabel.'.'.$IDFields,
	        									  $this->search_field($this->input->post('SearchFild')),
	        									  $this->input->post('Search')));

           		}
             		elseif(!$WhereOrIN)
                {

	        	    foreach ( $ArrayFields as $value ) {
	        	        $TempValue = $this->input->post($value);

	        	        if (!$TempValue == NULL && !$TempValue == '') ? $this->db->where($value, $TempValue);
					}
      			}

	                return $this->db->get();
        }

}
