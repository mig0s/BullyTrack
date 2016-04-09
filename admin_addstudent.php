<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

if (isset($_POST['st_name']) and isset($_POST['day']) and isset($_POST['month']) and isset($_POST['year']) and isset($_POST['st_gender']) and isset($_POST['st_nation'])) {
  $st_name = htmlspecialchars(stripcslashes(trim($_POST['st_name'])));
  $day = htmlspecialchars(stripcslashes(trim($_POST['day'])));
  $month = htmlspecialchars(stripcslashes(trim($_POST['month'])));
  $year = htmlspecialchars(stripcslashes(trim($_POST['year'])));

  $st_gender = htmlspecialchars(stripcslashes(trim($_POST['st_gender'])));
  $st_nation = htmlspecialchars(stripcslashes(trim($_POST['st_nation'])));
  $st_disability = htmlspecialchars(stripcslashes(trim($_POST['st_disability'])));

if (checkdate($month, $day, $year)) {

  $st_dob = ''.$year.'-'.$month.'-'.$day.'';

  $addstudent = $mysqli->prepare("INSERT INTO student_particular (`student_name`, `student_dob`, `student_gender`, `student_nationality`, `student_disability`) VALUES ('$st_name', '$st_dob', '$st_gender', '$st_nation', '$st_disability');");
  $addstudent->execute();
  $addstudent->close();
  $successes[] = lang("STUDENT_ADDED");
  } else {
    $errors[] = lang("WRONG_DATE");
  }
} elseif (!empty($_POST)) {
  $errors[] = lang("WRONG_DATA");
}

echo "
</div>
  <div id='main' class='col-md-10'><h2>Add new student:</h2>";

  echo resultBlock($errors,$successes);

echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."' method='post'>
<fieldset>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_name'>Name:</label>  
  <div class='col-md-4'>
  <input id='st_name' name='st_name' placeholder='John Doe' class='form-control input-md' required='' type='text'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_dob'>Date of birth:</label>  
  <div class='col-md-1'>
  <input id='st_dob' name='day' placeholder='dd' class='form-control input-md' required='' type='text'>
    
  </div>
  <div class='col-md-1'>
  <input id='st_dob' name='month' placeholder='mm' class='form-control input-md' required='' type='text'>
    
  </div>
  <div class='col-md-2'>
  <input id='st_dob' name='year' placeholder='yyyy' class='form-control input-md' required='' type='text'>
    
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
  <input id='st_nation' name='st_nation' placeholder='samplian' class='form-control input-md' required='' type='text'>
    
  </div>
</div>

<!-- Text input-->
<div class='form-group'>
  <label class='col-md-2 control-label' for='st_disability'>Disabilities:</label>  
  <div class='col-md-4'>
  <input id='st_disability' name='st_disability' placeholder='text' class='form-control input-md' type='text'>
    
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