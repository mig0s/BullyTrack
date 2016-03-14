<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

$stid = $_GET['stid'];

if (isset($_POST['st_name']) and isset($_POST['day']) and isset($_POST['month']) and isset($_POST['year']) and isset($_POST['st_gender']) and isset($_POST['st_nation'])) {
  $st_name = trim($_POST['st_name']);
  $day = trim($_POST['day']);
  $month = trim($_POST['month']);
  $year = trim($_POST['year']);
  $st_dob = ''.$year.'-'.$month.'-'.$day.'';

  $st_gender = trim($_POST['st_gender']);
  $st_nation = trim($_POST['st_nation']);
  $st_disability = trim($_POST['st_disability']);

  $addstudent = $mysqli->prepare("UPDATE `bullytrack`.`student_particular` SET `student_name`='$st_name', `student_dob`='$st_dob', `student_gender`='$st_gender', `student_nationality`='$st_nation', `student_disability`='$st_disability' WHERE `student_id`='$stid';");
  $addstudent->execute();
  $addstudent->close();
  $successes[] = lang("STUDENT_ADDED");
}

$getstudent = $mysqli->prepare("SELECT * from student_particular where student_id = '$stid'");
$getstudent->execute();
$getstudent->bind_result($id, $name, $dob, $gender, $nationality, $disability);
while ($getstudent->fetch()) {
  $student = array('id' => $id, 'name' => $name, 'dob' => $dob, 'gender' => $gender, 'nationality' => $nationality, 'disability' => $disability);
}

$getstudent->close();

$d = $student['dob'];
$d = new DateTime($d);
$d = $d->format('d');

$m = $student['dob'];
$m = new DateTime($m);
$m = $m->format('m');

$y = $student['dob'];
$y = new DateTime($y);
$y = $y->format('Y');


echo "
</div>
  <div id='main' class='col-md-10'><h2>Edit student:</h2>";

  echo resultBlock($errors,$successes);

echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?stid=$stid' method='post'>
<fieldset>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_name'>Name:</label>  
  <div class='col-md-4'>
  <input id='st_name' name='st_name' value='".$student['name']."' class='form-control input-md' required='' type='text'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_dob'>Date of birth:</label>  
  <div class='col-md-1'>
  <input id='st_dob' name='day' value='$d' class='form-control input-md' required='' type='text'>
    
  </div>
  <div class='col-md-1'>
  <input id='st_dob' name='month' value='$m' class='form-control input-md' required='' type='text'>
    
  </div>
  <div class='col-md-2'>
  <input id='st_dob' name='year' value='$y' class='form-control input-md' required='' type='text'>
    
  </div>
</div>

<!-- Select Basic -->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_gender'>Gender:</label>
  <div class='col-md-4'>
    <select id='st_gender' name='st_gender' class='form-control'>
      <option value=''>- select gender -</option>
      <option value='Male'>Male</option>
      <option value='Female'>Female</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_nation'>Nationality:</label>  
  <div class='col-md-4'>
  <input id='st_nation' name='st_nation' value='".$student['nationality']."' class='form-control input-md' required='' type='text'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_disability'>Disabilities:</label>  
  <div class='col-md-4'>
  <input id='st_disability' name='st_disability' value='".$student['disability']."' class='form-control input-md' type='text'>
    
  </div>
</div>
  <!-- Button -->
  <div class='form-group'>
    <label class='col-md-2 control-label' for='submit'></label>
    <div class='col-md-4'>
      <button id='submit' name='submit' class='btn btn-primary'>Submit</button>
    </div>
  </div>
  </fieldset>
</form>";

echo" </div>
  </div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";
?>