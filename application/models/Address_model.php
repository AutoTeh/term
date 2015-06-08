<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {	protected $Arrayregion = array();
	protected $Arrayarea = array();
	protected $Arraycity = array();
	protected $Arraycity_area = array();
	protected $Arraylocality = array();
	protected $Arraystreet = array();
	protected $Arrayadd_area = array();
	protected $Arraystreet__add_area = array();

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function edit($id = '', $NameField = '')
 	{ 		if (!$id == '')
 		{
			$query = $this->db->query("SELECT `get_array_id`('".$id."') AS `arr_id`");

			foreach ($query->result() as $row)
			{
				$Temparr = explode(",", $row->arr_id);
			}

			foreach ($Temparr as $value)
			{
					$Temparr2 = explode("*", $value);
                    $ID_search = $Temparr2[0];

					switch ($Temparr2[1])
					{						case 1:
							$this->out($ID_search, 'region');
							break;
						case 3:
							$this->out($ID_search, 'area');
							break;
						case 4:
							$this->out($ID_search, 'city');
							break;
						case 5:
							$this->out($ID_search, 'city_area');
							break;
						case 6:
							$this->out($ID_search, 'locality');
							break;
						case 7:
							$this->out($ID_search, 'street');
							break;
						case 90:
							$this->out($ID_search, 'add_area');
							break;
						case 91:
							$this->out($ID_search, 'street_add_area');
							break;
					}


			}

			$region = "'region','".$NameField."'";
			$area = "'area','".$NameField."'";
			$city = "'city','".$NameField."'";
			$city_area = "'city_area','".$NameField."'";
			$locality = "'locality','".$NameField."'";
			$street = "'street','".$NameField."'";
			$add_area = "'add_area','".$NameField."'";
			$street_add_area = "'street_add_area','".$NameField."'";

			$Data = array (	$NameField.'_region' 		 	=> form_dropdown($NameField.'[]', $this->Arrayregion, $this->id_select(1, $Temparr), 'onChange="get_address(this.value,'.$region.')"'),
						  	$NameField.'_area' 				=> form_dropdown($NameField.'[]', $this->Arrayarea, $this->id_select(3, $Temparr), 'onChange="get_address(this.value,'.$area.')"'),
						  	$NameField.'_city' 			 	=> form_dropdown($NameField.'[]', $this->Arraycity, $this->id_select(4, $Temparr), 'onChange="get_address(this.value,'.$city.')"'),
							$NameField.'_city_area' 	 	=> form_dropdown($NameField.'[]', $this->Arraycity_area, $this->id_select(5, $Temparr), 'onChange="get_address(this.value,'.$city_area.')"'),
							$NameField.'_locality' 		 	=> form_dropdown($NameField.'[]', $this->Arraylocality, $this->id_select(6, $Temparr), 'onChange="get_address(this.value,'.$locality.')"'),
							$NameField.'_street' 		 	=> form_dropdown($NameField.'[]', $this->Arraystreet, $this->id_select(7, $Temparr), 'onChange="get_address(this.value,'.$street.')"'),
							$NameField.'_add_area' 		 	=> form_dropdown($NameField.'[]', $this->Arrayadd_area, $this->id_select(90, $Temparr), 'onChange="get_address(this.value,'.$add_area.')"'),
							$NameField.'_street_add_area'	=> form_dropdown($NameField.'[]', $this->Arraystreet__add_area, $this->id_select(91, $Temparr)));

       		Return $Data;
 		} else {
            $this->out('', 'region');
 			$region = "'region','".$NameField."'";

			$Data = array (	$NameField.'_region' 		 	=> form_dropdown($NameField.'[]', $this->Arrayregion, '', 'onChange="get_address(this.value,'.$region.')"'),
						  	$NameField.'_area' 				=> '<select name="'.$NameField.'[]"></select>',
						  	$NameField.'_city' 			 	=> '<select name="'.$NameField.'[]"></select>',
							$NameField.'_city_area' 	 	=> '<select name="'.$NameField.'[]"></select>',
							$NameField.'_locality' 		 	=> '<select name="'.$NameField.'[]"></select>',
							$NameField.'_street' 		 	=> '<select name="'.$NameField.'[]"></select>',
							$NameField.'_add_area' 		 	=> '<select name="'.$NameField.'[]"></select>',
							$NameField.'_street_add_area'	=> '<select name="'.$NameField.'[]"></select>');

       		Return $Data;
 		}
 	}

	 public function add($NameField, $Search, $Page)
 	{
            $this->out($Search, $Page);
			$region = "'region','".$NameField."'";
			$area = "'area','".$NameField."'";
			$city = "'city','".$NameField."'";
			$city_area = "'city_area','".$NameField."'";
			$locality = "'locality','".$NameField."'";
			$street = "'street','".$NameField."'";
			$add_area = "'add_area','".$NameField."'";
			$street_add_area = "'street_add_area','".$NameField."'";
            $Data = array();
            $arr = array('region', 'area', 'city', 'city_area', 'locality', 'street', 'add_area', 'street_add_area');
		  	$FlagPage = FALSE;

		  	foreach ($arr as $val)
			{
				if ($Page == $val) $FlagPage = TRUE;
				if ($FlagPage)
				{
					switch ($val)
					{
							case 'region':
								if (empty($this->Arrayregion)) $Data['region'] = form_dropdown($NameField.'[]', $this->Arrayregion, '', 'onChange="get_address(this.value,'.$region.')"');
								continue;
								break;
							case 'area':
								$Data['area'] = form_dropdown($NameField.'[]', $this->Arrayarea, '', 'onChange="get_address(this.value,'.$area.')"');
								break;
							case 'city':
								$Data['city'] = form_dropdown($NameField.'[]', $this->Arraycity, '', 'onChange="get_address(this.value,'.$city.')"');
								break;
							case 'city_area':
								$Data['city_area'] = form_dropdown($NameField.'[]', $this->Arraycity_area, '', 'onChange="get_address(this.value,'.$city_area.')"');
								break;
							case 'locality':
								$Data['locality'] = form_dropdown($NameField.'[]', $this->Arraylocality, '', 'onChange="get_address(this.value,'.$locality.')"');
								break;
							case 'street':
								$Data['street'] = form_dropdown($NameField.'[]', $this->Arraystreet, '', 'onChange="get_address(this.value,'.$street.')"');
								break;
							case 'add_area':
								$Data['add_area'] = form_dropdown($NameField.'[]', $this->Arrayadd_area, '', 'onChange="get_address(this.value,'.$add_area.')"');
								break;
							case 'street_add_area':
								$Data['street_add_area'] = form_dropdown($NameField.'[]', $this->Arraystreet__add_area, '');
								break;
					}
	            }
			}

			return $Data;
 	}

	 public function out($Search, $Page)
 	{
		$this->db->select("CONCAT(formalname, ' ', SHORTNAME) as adr, AOLEVEL, aoguid", FALSE);
		$this->db->from('d_fias_addrobj');
		$this->db->where('parentguid', $Search);
	    if ($Page == 'region') $this->db->or_where('AOLEVEL', 1);
	    $this->db->where('currstatus', 0);
	    $this->db->order_by("adr", "ASC");

	    $query = $this->db->get();

        $Flagregion = TRUE;
        $Flagarea = TRUE;
        $Flagcity = TRUE;
        $Flagcity_area = TRUE;
        $Flaglocality = TRUE;
        $Flagstreet = TRUE;
        $Flagadd_area = TRUE;
        $Flagstreet__add_area = TRUE;
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				switch ($row['AOLEVEL']) {					case 1:
						if ($Flagregion) { $this->Arrayregion = array(); $Flagregion = FALSE;}
						$this->Arrayregion[$row['aoguid']] = $row['adr'];
						break;					case 3:
						if ($Flagarea) { $this->Arrayarea = array(''); $Flagarea = FALSE;}
						$this->Arrayarea[$row['aoguid']] = $row['adr'];
						break;
					case 4:
						if ($Flagcity) { $this->Arraycity = array(''); $Flagcity = FALSE;}
						$this->Arraycity[$row['aoguid']] = $row['adr'];
						break;
					case 5:
						if ($Flagcity_area) { $this->Arraycity_area = array(''); $Flagcity_area = FALSE;}
						$this->Arraycity_area[$row['aoguid']] = $row['adr'];
						break;
					case 6:
						if ($Flaglocality) { $this->Arraylocality = array(''); $Flaglocality = FALSE;}
						$this->Arraylocality[$row['aoguid']] = $row['adr'];
						break;
					case 7:
						if ($Flagstreet) { $this->Arraystreet = array(''); $Flagstreet = FALSE;}
						$this->Arraystreet[$row['aoguid']] = $row['adr'];
						break;
					case 90:
						if ($Flagadd_area) { $this->Arrayadd_area = array(''); $Flagadd_area = FALSE;}
						$this->Arrayadd_area[$row['aoguid']] = $row['adr'];
						break;
					case 91:
						if ($Flagstreet__add_area) { $this->Arraystreet__add_area = array(''); $Flagstreet__add_area = FALSE;}
						$this->Arraystreet__add_area[$row['aoguid']] = $row['adr'];
						break;
					}
			}
		}

 	}

	public function id_select($type, $array2)
 	{
 		if (is_array($array2))
 		{
 			foreach ($array2 as $value)
			{
				$Temparr2 = explode("*", $value);
	        	if ($type == $Temparr2[1])
	        	{
	        		return $Temparr2[0];
	        	}
     		}
        }
 	}
}
