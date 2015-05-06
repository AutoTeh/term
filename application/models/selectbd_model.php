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

        public function dogovor()
        {
        		if ($this->search_field($this->input->post('SearchFild'), TRUE))
        		{
	        		$this->db->select('ID_Dogovor, Num_Dogovor, Date_Dogovor,
	        						   Diskont, Date_Diskont, Internat_Card,
	        						   Sber_Card, Money_Movement, Income_Money,
	        						   Date_Dissolution, thank');
	        		$this->db->from('Dogovor');

	        		if ($this->input->post('WhereOrIN') == TRUE)
	        		{
	        			$this->db->where_in('ID_Dogovor', $this->search_ID('Dogovor.ID_Dogovor',
	        											  $this->search_field($this->input->post('SearchFild')),
	        											  $this->input->post('Search')));

                    } elseif($this->input->post('WhereOrIN') == FALSE)  {                    	$TempArray = array('Num_Dogovor', 'Date_Dogovor',
	        						   'Diskont', 'Date_Diskont', 'Internat_Card',
	        						   'Sber_Card', 'Money_Movement', 'Income_Money',
	        						   'Date_Dissolution', 'thank');

	        	        foreach ( $TempArray as $value ) {
                        	if (!$this->input->post($value) == '') ? $this->db->where($value, $this->input->post($value)); ;
						}
                    }

	                $query = $this->db->get();
	                return ($query->num_rows() > 0) ? $query->result() : FALSE;

        		} Else: return FALSE;
        }

        public function org($Search = NULL)
        {
        		$this->db->select('ID_Org, INN, Name_Org,
        						   ID_FromS_Org, FromH, ID_PostS_Org,
        						   PostH, FIO_LPR, Phone_LPR,
        						   E_mail, OKPO, OGRN, Bank_Name,
        						   Current_Account, Correspondent_Account,
        						   Name_Rank_Users, Name_Type_Org');

        		$this->db->from('Org');
				$this->db->join('Rank', 'Rank.ID_Rank = Org.ID_Org', 'inner');
                $this->db->join('Type_Org', 'Type_Org.ID_Type_Org = Org.ID_Type_Org', 'inner');

    			if ($Search  == NULL) ? $this->db->where_in('ID_Org', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? $query->result() : FALSE;
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

    	public function tct($Search = NULL)
        {
        		$this->db->select('ID_TCT, Num_Merchant, Name_TCT,
        						   From_TCT, ID_From_TCT, Kind_Activity,
        						   Mode, Contact_Name, Rank_Contact_Name,
        						   Phone_TCT, Name_Status_TCT,
        						   Name_Kategoria_TCT, Name_MCC');
        		$this->db->from('TCT');
				$this->db->join('Status_TCT', 'Status_TCT.ID_Status_TCT = TCT.ID_Status_TCT', 'inner');
                $this->db->join('Kategoria_TCT', 'Kategoria_TCT.ID_Kategoria_TCT = TCT.ID_Kategoria_TCT', 'inner');
                $this->db->join('MCC', 'MCC.ID_MCC = TCT.ID_MCC', 'inner');

                if ($Search == NULL) ? $this->db->where_in('ID_TCT', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? $query->result() : FALSE;
        }

        public function tid($Search = NULL)
        {
        		$this->db->select('ID_TID, TPC, GPC,
        						   Kod_Activ, Date_Reg_CA,
        						   Num_TCTID');
        		$this->db->from('TID');

                if ($Search  == NULL) ? $this->db->where_in('ID_TID', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? $query->result() : FALSE;
        }

        public function terminal($Search = NULL)
        {
        		$this->db->select('ID_Terminal, SN, In_Num, Price, Date, Name_Type_Terminal');
        		$this->db->from('Terminal');
				$this->db->join('Type_Terminal', 'Type_Terminal.Id_Type_Terminal = Terminal.Id_Type_Terminal', 'inner');

                if ($Search == NULL) ? $this->db->where_in('ID_Terminal', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? $query->result() : FALSE;
        }

        public function sim($Search = NULL)
        {
        		$this->db->select('ID_Sim, Num_Sim, Name_Operator');
        		$this->db->from('Sim');
				$this->db->join('Operator_Sim', 'Operator_Sim.ID_Operator_Sim = Sim.ID_Operator_Sim', 'inner');

                if ($Search == NULL) ? $this->db->where_in('ID_Sim', $Search);

                $query = $this->db->get();
                return ($query->num_rows() > 0) ? $query->result() : FALSE;
        }

}
