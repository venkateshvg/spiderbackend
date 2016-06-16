<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {
public function __construct()
{   
	//Calls the Model Constructor
	parent::__construct();
}

function gettable()
{
	$query = $this->db->get('stud');
	return $query->result();
}
function getonerow($roll)
{
	$this->db->where('roll',$roll);
	$query = $this->db->get('stud');
	return $query->row();
}
}