<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
public function __construct()
{
	parent::__construct();
	//call Model
	$this->load->model("StudentModel","m");
}

function index()
{

	$this->load->view("index");
}


function savedata()
{
	function passcode()  
{
	$length = 5;
	$chars = "0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
	//echo "inside savedata";
    $name = $_GET['name'];
    $email= $_GET['email'];
    $roll= $_GET['roll'];
    $physicaladdress= $_GET['physicaladdress'];
    $dept= $_GET['dept'];
    $passcode=passcode();

   
	$data = array
	(
		
		//'name'=> $this->input->post('name'),
		//'email'=> $this->input->post('email'),
		//'roll'=> $this->input->post('roll'),
		//'physicaladdress'=> $this->input->post('physicaladdress'),
		//'dept'=> $this->input->post('dept')
        'name'=> $name,
		'email'=> $email,
		'roll'=> $roll,
		'physicaladdress'=> $physicaladdress,
		'dept'=> $dept,
		'passcode'=> $passcode
         
	);
	$errflag=0;
    
	if ((!preg_match("/^[a-zA-Z ]*$/",$name)) || ($name==NULL))
	{
		$errflag=1;
	}
	$c="@nitt.edu";
  function endsWith($email, $c)
{
    $length = strlen($c);
    if ($length == 0) {
        return true;
    }

    return (substr($email, -$length) === $c);
}

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)||((endsWith($email, '@nitt.edu') == FALSE))) 
    
	 	$errflag=1;
	 
	 //$roll=0;
	 function count_digit($roll) 
	 {
    return strlen((string) $roll);
     }
$number_of_digits=count_digit($roll);

if((!is_numeric($roll))||($number_of_digits!=9))
{
	$errflag=1;
	
}
if($physicaladdress==NULL)
{
	$errflag=1;
}
if($dept==NULL)
{
	$errflag=1;
}
    if($errflag==0)
	{
    $addition= $this->db->insert('stud',$data);
    if ($addition)
    {
    	echo "Added record successfully and the passcode for update is   ";
    	echo $passcode;
    }
	}//Return to index page after insertion
	//redirect("Student/index");

}


    


function edit($roll)
{
	//echo "Inside studentedit";
	$row = $this->m->getonerow($roll);

	
	$data['r'] = $row;

	if($row)
	$this->load->view('edit',$data);
    else echo " Record Not Found";
}

function update()
{
	//echo "inside update";
	$passcode=$_GET['passcode'];
	$dbpasscode=$_GET['dbpasscode'];
	$name = $_GET['name'];
    $email= $_GET['email'];
    $roll= $_GET['roll'];
    $physicaladdress= $_GET['physicaladdress'];
    $dept= $_GET['dept'];
    
	$data = array
	(
		
		//'name'=> $this->input->post('name'),
		//'email'=> $this->input->post('email'),
		//'roll'=> $this->input->post('roll'),
		//'physicaladdress'=> $this->input->post('physicaladdress'),
		//'dept'=> $this->input->post('dept')
        'name'=> $name,
		'email'=> $email,
		'roll'=> $roll,
		'physicaladdress'=> $physicaladdress,
		'dept'=> $dept
 
	);
	$errflag=0;
    
	if ((!preg_match("/^[a-zA-Z ]*$/",$name)) || ($name==NULL))
	{
		$errflag=1;
	}
	 $c="@nitt.edu";
  function endsWith($email, $c)
{
    $length = strlen($c);
    if ($length == 0) {
        return true;
    }

    return (substr($email, -$length) === $c);
}

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)||((endsWith($email, '@nitt.edu') == FALSE))) 
    
	 	$errflag=1;
	 //$roll=0;
	 function count_digit($roll) {
    return strlen((string) $roll);
}
$number_of_digits=count_digit($roll);

if((!is_numeric($roll))||($number_of_digits!=9))
{
	$errflag=1;
	
}
if($physicaladdress==NULL)
{
	$errflag=1;
}
if($dept==NULL)
{
	$errflag=1;
}

	//$roll= $this->input->post('roll');
	if($errflag==0 )
	{
		if($passcode==$dbpasscode)
	     {
	$this->db->where('roll',$roll);
	$this->db->update('stud',$data);
	echo " Updated successfully";
         }
    else
    {
    	echo "invalid passcode";
    }
    	
	
   	//redirect("Student/index");
    }

}
}?>