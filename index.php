<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php

// define variables and set to empty values
$nameErr = $emailErr = $deptErr = $rollErr =  $physicaladdressErr="";
$name = $email = $dept = $physicaladdress = "";
$roll =NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
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
  
 if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    $emailErr = "Invalid email format"; 

    else if((endsWith($email, '@nitt.edu') == FALSE))
    $emailErr = "Email id should end with @nitt.edu"; 
  
  
}    
  if (empty($_POST["roll"])) {
    $roll = NULL;
  } else {
    $roll = test_input($_POST["roll"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    function count_digit($roll) {
    return strlen((string) $roll);
}

if(!is_numeric($roll))
$rollErr = " Roll number should be numeric";
else{
$number_of_digits = count_digit($roll); 
if($number_of_digits!==9)
$rollErr = " Invalid Roll No.( Pls enter a 9 digit number)";
}
  }

  if (empty($_POST["physicaladdress"])) {
    $physicaladdressErr = "Address is required";
  } else {
    $physicaladdress = test_input($_POST["physicaladdress"]);
  }

  if (empty($_POST["dept"])) {
    $deptErr = "dept is required";
  } else {
    $dept = test_input($_POST["dept"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Student record database</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php  ?>"> 
  
  Roll No.: <input type="text" name="roll" value="<?php echo $roll;?>">
  <span class="error">* <a href="http://[::1]/ci_intro/index.php/Student/edit/<?php echo $roll?>?roll=<?php echo $roll?>">Search(Validate before clicking)</a><?php echo $rollErr;?></span>
  <br><br>
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Physical address: <textarea name="physicaladdress" rows="3" cols="40"><?php echo $physicaladdress;?></textarea>
  <span class="error">* <?php echo $physicaladdressErr;?></span>

  <br><br>
  Dept:
  <input type="radio" name="dept" <?php if (isset($dept) && $dept=="cse") echo "checked";?> value="cse">cse
  <input type="radio" name="dept" <?php if (isset($dept) && $dept=="ece") echo "checked";?> value="ece">ece
  <input type="radio" name="dept" <?php if (isset($dept) && $dept=="eee") echo "checked";?> value="eee">eee
  <input type="radio" name="dept" <?php if (isset($dept) && $dept=="ice") echo "checked";?> value="ice">ice
  <span class="error">* <?php echo $deptErr;?></span>
  <br><br>
  

  <input type="submit" name="submit" value="Validate">  
  
  

</form>
<input type="button" value="Add" onClick="window.location='Student/savedata?roll=<?php echo $roll ?>&name=<?php echo $name?>&email=<?php echo $email?>&physicaladdress=<?php echo $physicaladdress?>&dept=<?php echo $dept?>'">



<table border="1">
  <thead>
      <th>Roll</th>
      <th>name</th>
      <th>email</th>
      <th>physicaladdress</th>
      <th>dept</th>
      <th>Action</th>
  </thead>
  <tbody>
  <?php
  foreach ($this->m->gettable() as $row)
  {
    echo "<tr>
            <td>$row->roll</td>
            <td>$row->name</td>
            <td>$row->email</td>
            <td>$row->physicaladdress</td>
            <td>$row->dept</td>
            <td> <a href='".site_url('Student/edit/'.$row->roll)."'>Edit</a></td>
           </tr>";

    


  }

  
  ?>
  
  </tbody>
</table>


</body>
</html>