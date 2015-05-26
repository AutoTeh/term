<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function out($PostName)
 	{
		$this->db->select("CONCAT(formalname, ' ', SHORTNAME) as adr, AOLEVEL, aoguid", FALSE);
		$this->db->from('d_fias_addrobj');
	    $this->db->where('parentguid', $PostName);
	    $this->db->where('currstatus', 0);
	    $this->db->order_by("adr", "ASC");

	    return $this->db->get();
 	}

 	public function outregion()
 	{
		$this->db->select("CONCAT(formalname, ' ', SHORTNAME) as adr, aoguid", FALSE);
		$this->db->from('d_fias_addrobj');
	    $this->db->where('AOLEVEL', 1);
	    $this->db->where('currstatus', 0);
        $this->db->order_by("adr", "ASC");
	    return $this->db->get();
 	}

}
