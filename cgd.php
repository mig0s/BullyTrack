<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$stid = $_GET['stid'];
$ccode = $_GET['ccode'];

$checkgrades = $mysqli->prepare("SELECT cw1,cw2,cw3,cw4,exam from gradestring where course_code = '$ccode' and student_id = '$stid'");
$checkgrades->execute();
$checkgrades->bind_result($cw1,$cw2,$cw3,$cw4,$exam);
while ($checkgrades->fetch()) {
	$grades = array($cw1,$cw2,$cw3,$cw4,$exam);
}
$checkgrades->close();

require_once("models/header.php");

if(!empty($_POST))
{

	if (isset($grades) && !is_null($grades)) {

		$cw1 = trim($_POST["cw1"]);
		$cw2 = trim($_POST["cw2"]);
		$cw3 = trim($_POST["cw3"]);
		$cw4 = trim($_POST["cw4"]);
		$exam = trim($_POST["exam"]);
		$ccode = trim($_POST["ccode"]);
		$stid = trim($_POST["stid"]);

		$today = date("Y-m-d");

		if (!is_numeric($cw1) or !is_numeric($cw2) or !is_numeric($cw3) or !is_numeric($cw4) or !is_numeric($exam)) {
			$errors[] = lang("WRONG_DATA");
		} else {

		$updaterecord = $mysqli->prepare("UPDATE `bullytrack`.`gradestring` SET `cw1`='$cw1', `cw2`='$cw2', `cw3`='$cw3', `cw4`='$cw4', `exam`='$exam', `timestamp`='$today' WHERE course_code = '$ccode' and student_id = '$stid';");
		$updaterecord->execute();
		$updaterecord->close();

		$successes[] = lang("GRADES_RECORDED");

		}

	} else {
		
		$cw1 = trim($_POST["cw1"]);
		$cw2 = trim($_POST["cw2"]);
		$cw3 = trim($_POST["cw3"]);
		$cw4 = trim($_POST["cw4"]);
		$exam = trim($_POST["exam"]);
		$ccode = trim($_POST["ccode"]);
		$stid = trim($_POST["stid"]);

		$today = date("Y-m-d");

		if (!is_numeric($cw1) or !is_numeric($cw2) or !is_numeric($cw3) or !is_numeric($cw4) or !is_numeric($exam)) {
			$errors[] = lang("WRONG_DATA");
		} else {

		$createrecord = $mysqli->prepare("INSERT INTO `bullytrack`.`gradestring` (`course_code`, `student_id`, `cw1`, `cw2`, `cw3`, `cw4`, `exam`,`timestamp`) VALUES ('$ccode', '$stid', '$cw1', '$cw2', '$cw3', '$cw4', '$exam','$today');");
		$createrecord->execute();
		$createrecord->close();
		$successes[] = lang("GRADES_RECORDED");
		}

	}

}

echo "
</div>
	<div id='main' class='col-md-10'>
		<div id='regbox'><h1>Grade distribution for $ccode:</h1>";
echo resultBlock($errors,$successes);

if (isset($grades) && !is_null($grades[0])) {

		echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?stid=$stid&ccode=$ccode' method='post'>
			<fieldset>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='course_id'>Course code:</label>  
			  <div class='col-md-3'>
			  <input id='course_id' name='course_id' value='$ccode' disabled class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='student_id'>Student ID:</label>  
			  <div class='col-md-3'>
			  <input id='student_id' name='student_id' value='$stid' disabled class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw1'>Coursework 1:</label>  
			  <div class='col-md-2'>
			  <input id='cw1' name='cw1' value='$cw1' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw2'>Coursework 2:</label>  
			  <div class='col-md-2'>
			  <input id='cw2' name='cw2' value='$cw2' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw3'>Coursework 3:</label>  
			  <div class='col-md-2'>
			  <input id='cw3' name='cw3' value='$cw3' class='form-control input-md' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw4'>Coursework 4:</label>  
			  <div class='col-md-2'>
			  <input id='cw4' name='cw4' value='$cw4' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='exam'>Examination:</label>  
			  <div class='col-md-2'>
			  <input id='exam' name='exam' value='$exam' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>
			<input type='hidden' name='ccode' value='".$ccode."' />
			<input type='hidden' name='stid' value='".$stid."' />
			<!-- Button -->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='submit'></label>
			  <div class='col-md-2'>
			    <button id='submit' name='submit' class='btn btn-default'>Update</button>
			  </div>
			</div>

			</fieldset>
			</form>"
			;
	} else {
			echo "<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."?stid=$stid&ccode=$ccode' method='post'>
			<fieldset>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='course_id'>Course code:</label>  
			  <div class='col-md-3'>
			  <input id='course_id' name='course_id' value='$ccode' disabled class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='student_id'>Student ID:</label>  
			  <div class='col-md-3'>
			  <input id='student_id' name='student_id' value='$stid' disabled class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw1'>Coursework 1:</label>  
			  <div class='col-md-2'>
			  <input id='cw1' name='cw1' value='$cw1' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw2'>Coursework 2:</label>  
			  <div class='col-md-2'>
			  <input id='cw2' name='cw2' value='$cw2' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw3'>Coursework 3:</label>  
			  <div class='col-md-2'>
			  <input id='cw3' name='cw3' value='$cw3' class='form-control input-md' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='cw4'>Coursework 4:</label>  
			  <div class='col-md-2'>
			  <input id='cw4' name='cw4' value='$cw4' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>

			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='exam'>Examination:</label>  
			  <div class='col-md-2'>
			  <input id='exam' name='exam' value='$exam' class='form-control input-md' required onClick='this.select();' type='text'>			    
			  </div>
			</div>
			<input type='hidden' name='ccode' value='".$ccode."' />
			<input type='hidden' name='stid' value='".$stid."' />
			<!-- Button -->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='submit'></label>
			  <div class='col-md-2'>
			    <button id='submit' name='submit' class='btn btn-default'>Submit</button>
			  </div>
			</div>

			</fieldset>
			</form>";
	}

echo"
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>