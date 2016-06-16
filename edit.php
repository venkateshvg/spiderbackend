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
$name = $email = $dept = $physicaladdress =$submit= "";
$roll =NULL;
$passcode=NULL;


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
   if (empty($_POST["passcode"])) {
    $passcodeErr = "Passcode is required";
  } else {
    $passcode = test_input($_POST["passcode"]);
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<?php  echo $nameErr;echo $rollErr;echo $emailErr;echo $physicaladdressErr;echo $deptErr;?>

<h2>Student record database</h2>
<p><span class="error">* required field.</span></p>

<form method="post" action="<?php ?>"> 
  
  Roll No:<input readonly="readonly" type="text" name="roll" value="<?php echo $r->roll; ?>">
  <span class="error">* <?php echo $rollErr;?></span>
  <br><br>
  <?php //if(isset($_POST['submit'])==1) echo $name; else echo $r->name; ?>
  Name: <input type="text" name="name" value="<?php if(isset($_POST['submit'])==1) echo $name; else echo $r->name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php if(isset($_POST['submit'])==1) echo $email; else echo $r->email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  
  Physical address: <textarea name="physicaladdress" rows="3" cols="40"><?php if(isset($_POST['submit'])==1) echo $physicaladdress; else echo $r->physicaladdress;?></textarea>
  <span class="error">* <?php echo $physicaladdressErr;?></span>

  <br><br>
  Dept:

  <input type="radio" name="dept" <?php if (isset($r->dept) && $r->dept=="cse") echo "checked";?> value="cse">cse
  <input type="radio" name="dept" <?php if (isset($r->dept) && $r->dept=="ece") echo "checked";?> value="ece">ece
  <input type="radio" name="dept" <?php if (isset($r->dept) && $r->dept=="eee") echo "checked";?> value="eee">eee
  <input type="radio" name="dept" <?php if (isset($r->dept) && $r->dept=="ice") echo "checked";?> value="ice">ice
  <span class="error">* <?php echo $deptErr;?></span>
  <br><br>
  <?php $dbpasscode=$r->Passcode;
  
  ?>
  Enter Passcode for update: <input type="text" name="passcode"  >
  

  <input type="submit" name="submit" value="Validate">  

   

</form>




<br>

<a href="http://[::1]/ci_intro/index.php/Student/update?roll=<?php echo $roll ?>&name=<?php echo $name?>&email=<?php echo $email?>&physicaladdress=<?php echo $physicaladdress?>&dept=<?php echo $dept?>&passcode=<?php echo $passcode?>&dbpasscode=<?php echo $dbpasscode?>">Update</a>



<?php
//echo "<h2>Your Input:</h2>";
//echo $name;
//echo "<br>";
//echo $email;
//echo "<br>";
//echo $roll;
//echo "<br>";
//echo $physicaladdress;
//echo "<br>";
//echo $dept;
//echo "<br>";
//echo $passcode;
?>

</body>
</html>
