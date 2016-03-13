<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

if(!empty($_POST))
{
	$errors = array();

	$cw1_0 = trim($_POST["cw1_0"]);
	$cw1_1 = trim($_POST["cw1_1"]);
	$cw1_2 = trim($_POST["cw1_2"]);
	$cw1_3 = trim($_POST["cw1_3"]);
	$cw1_4 = trim($_POST["cw1_4"]);
	$cw1_5 = trim($_POST["cw1_5"]);
	$cw1_6 = trim($_POST["cw1_6"]);
	$cw1_7 = trim($_POST["cw1_7"]);
	$cw1_8 = trim($_POST["cw1_8"]);
	$cw1_9 = trim($_POST["cw1_9"]);

	$cw2_0 = trim($_POST["cw2_0"]);
	$cw2_1 = trim($_POST["cw2_1"]);
	$cw2_2 = trim($_POST["cw2_2"]);
	$cw2_3 = trim($_POST["cw2_3"]);
	$cw2_4 = trim($_POST["cw2_4"]);
	$cw2_5 = trim($_POST["cw2_5"]);
	$cw2_6 = trim($_POST["cw2_6"]);
	$cw2_7 = trim($_POST["cw2_7"]);
	$cw2_8 = trim($_POST["cw2_8"]);
	$cw2_9 = trim($_POST["cw2_9"]);

	$cw3_0 = trim($_POST["cw3_0"]);
	$cw3_1 = trim($_POST["cw3_1"]);
	$cw3_2 = trim($_POST["cw3_2"]);
	$cw3_3 = trim($_POST["cw3_3"]);
	$cw3_4 = trim($_POST["cw3_4"]);
	$cw3_5 = trim($_POST["cw3_5"]);
	$cw3_6 = trim($_POST["cw3_6"]);
	$cw3_7 = trim($_POST["cw3_7"]);
	$cw3_8 = trim($_POST["cw3_8"]);
	$cw3_9 = trim($_POST["cw3_9"]);

	$cw4_0 = trim($_POST["cw4_0"]);
	$cw4_1 = trim($_POST["cw4_1"]);
	$cw4_2 = trim($_POST["cw4_2"]);
	$cw4_3 = trim($_POST["cw4_3"]);
	$cw4_4 = trim($_POST["cw4_4"]);
	$cw4_5 = trim($_POST["cw4_5"]);
	$cw4_6 = trim($_POST["cw4_6"]);
	$cw4_7 = trim($_POST["cw4_7"]);
	$cw4_8 = trim($_POST["cw4_8"]);
	$cw4_9 = trim($_POST["cw4_9"]);

	$exam_0 = trim($_POST["exam_0"]);
	$exam_1 = trim($_POST["exam_1"]);
	$exam_2 = trim($_POST["exam_2"]);
	$exam_3 = trim($_POST["exam_3"]);
	$exam_4 = trim($_POST["exam_4"]);
	$exam_5 = trim($_POST["exam_5"]);
	$exam_6 = trim($_POST["exam_6"]);
	$exam_7 = trim($_POST["exam_7"]);
	$exam_8 = trim($_POST["exam_8"]);
	$exam_9 = trim($_POST["exam_9"]);

	$overall_0 = trim($_POST["overall_0"]);
	$overall_1 = trim($_POST["overall_1"]);
	$overall_2 = trim($_POST["overall_2"]);
	$overall_3 = trim($_POST["overall_3"]);
	$overall_4 = trim($_POST["overall_4"]);
	$overall_5 = trim($_POST["overall_5"]);
	$overall_6 = trim($_POST["overall_6"]);
	$overall_7 = trim($_POST["overall_7"]);
	$overall_8 = trim($_POST["overall_8"]);
	$overall_9 = trim($_POST["overall_9"]);

	$acsession = trim($_POST["acsession"]);
	$coursecode = trim($_POST["coursecode"]);
	$coursetitle = trim($_POST["coursetitle"]);
	$courselead = $loggedInUser->displayname;
	$faculty = trim($_POST["faculty"]);
	$studcount = trim($_POST["studcount"]);

	if(count($errors) == 0) {
		$addcmr = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_cmr` (`cmr_academicsession`, `cmr_coursecode`, `cmr_coursetitle`, `cmr_courseleader`, `cmr_faculties`, `cmr_studentcount`) VALUES ('".$acsession."', '".$coursecode."', '".$coursetitle."', '".$courselead."', '".$faculty."', '".$studcount."')");
		$addcmr->execute();
		$inserted_id = $mysqli->insert_id;
		$addcmr->close();

		$addcw1 = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_cw1` (`cmr_id`, `cw1_0`, `cw1_1`, `cw1_2`, `cw1_3`, `cw1_4`, `cw1_5`, `cw1_6`, `cw1_7`, `cw1_8`, `cw1_9`) VALUES ('".$inserted_id."', '".$cw1_0."', '".$cw1_1."', '".$cw1_2."', '".$cw1_3."', '".$cw1_4."', '".$cw1_5."', '".$cw1_6."', '".$cw1_7."', '".$cw1_8."', '".$cw1_9."')");
		$addcw1->execute();
		$addcw1->close();
		
		$addcw2 = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_cw2` (`cmr_id`, `cw2_0`, `cw2_1`, `cw2_2`, `cw2_3`, `cw2_4`, `cw2_5`, `cw2_6`, `cw2_7`, `cw2_8`, `cw2_9`) VALUES ('".$inserted_id."', '".$cw2_0."', '".$cw2_1."', '".$cw2_2."', '".$cw2_3."', '".$cw2_4."', '".$cw2_5."', '".$cw2_6."', '".$cw2_7."', '".$cw2_8."', '".$cw2_9."')");
		$addcw2->execute();
		$addcw2->close();
		
		$addcw3 = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_cw3` (`cmr_id`, `cw3_0`, `cw3_1`, `cw3_2`, `cw3_3`, `cw3_4`, `cw3_5`, `cw3_6`, `cw3_7`, `cw3_8`, `cw3_9`) VALUES ('".$inserted_id."', '".$cw3_0."', '".$cw3_1."', '".$cw3_2."', '".$cw3_3."', '".$cw3_4."', '".$cw3_5."', '".$cw3_6."', '".$cw3_7."', '".$cw3_8."', '".$cw3_9."')");
		$addcw3->execute();
		$addcw3->close();
		
		$addcw4 = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_cw4` (`cmr_id`, `cw4_0`, `cw4_1`, `cw4_2`, `cw4_3`, `cw4_4`, `cw4_5`, `cw4_6`, `cw4_7`, `cw4_8`, `cw4_9`) VALUES ('".$inserted_id."', '".$cw4_0."', '".$cw4_1."', '".$cw4_2."', '".$cw4_3."', '".$cw4_4."', '".$cw4_5."', '".$cw4_6."', '".$cw4_7."', '".$cw4_8."', '".$cw4_9."')");
		$addcw4->execute();
		$addcw4->close();
		
		$addexam = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_exam` (`cmr_id`, `exam_0`, `exam_1`, `exam_2`, `exam_3`, `exam_4`, `exam_5`, `exam_6`, `exam_7`, `exam_8`, `exam_9`) VALUES ('".$inserted_id."', '".$exam_0."', '".$exam_1."', '".$exam_2."', '".$exam_3."', '".$exam_4."', '".$exam_5."', '".$exam_6."', '".$exam_7."', '".$exam_8."', '".$exam_9."')");
		$addexam->execute();
		$addexam->close();
		
		$addoverall = $mysqli->prepare("INSERT INTO `bullytrack`.`cl_overall` (`cmr_id`, `overall_0`, `overall_1`, `overall_2`, `overall_3`, `overall_4`, `overall_5`, `overall_6`, `overall_7`, `overall_8`, `overall_9`) VALUES ('".$inserted_id."', '".$overall_0."', '".$overall_1."', '".$overall_2."', '".$overall_3."', '".$overall_4."', '".$overall_5."', '".$overall_6."', '".$overall_7."', '".$overall_8."', '".$overall_9."')");
		$addoverall->execute();
		$addoverall->close();
		$successes[] = lang("CMR_ADDED");
	}
}

require_once("models/header.php");

echo "
</div>
	<div id='main' class='col-md-10'>
		<div id='regbox'>".resultBlock($errors,$successes)."
			<h1>Create Course Monitoring Report:</h1><br />
			<form class='form-horizontal' action='".$_SERVER['PHP_SELF']."' method='post' name='createcmr'>
			<fieldset>
			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='acsession'>Session: <span class='required'>*</span></label>  
			  <div class='col-md-4'>
			  <input id='acsession' name='acsession' placeholder='session id' class='form-control input-md' required type='text'>
			  </div>
			</div>
			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='coursecode'>Course code: <span class='required'>*</span></label>  
			  <div class='col-md-4'>
			  <input id='coursecode' name='coursecode' placeholder='course code' class='form-control input-md' required type='text'>
			  </div>
			</div>
			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='coursetitle'>Course title: <span class='required'>*</span></label>  
			  <div class='col-md-4'>
			  <input id='coursetitle' name='coursetitle' placeholder='course title' class='form-control input-md' required type='text'>
			</div>
			</div>
			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='courselead'>Course leader: <span class='required'>*</span></label>  
			  <div class='col-md-4'>
			  <input id='courselead' name='courselead' value='".$loggedInUser->displayname."' disabled class='form-control input-md' type='text'>
			  </div>
			</div>
			<!-- Select Basic -->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='faculty'>Faculty: <span class='required'>*</span></label>
			  <div class='col-md-4'>
			    <select id='faculty' name='faculty' class='form-control'>
				<option value='Gryffindor'>Gryffindor</option>
				<option value='Hufflepuff'>Hufflepuff</option>
				<option value='Ravenclaw'>Ravenclaw</option>
				<option value='Slytherin'>Slytherin</option>
			    </select>
			  </div>
			</div>
			<!-- Text input-->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='studcount'>Student count: <span class='required'>*</span></label>  
			  <div class='col-md-2'>
			  <input id='studcount' name='studcount' placeholder='number' class='form-control input-md' required type='text'>
			  </div>
			</div>
			<table class='table table-hover table-condensed'><thead>
			<tr><th class='cmrtop'></th><th>0 - 9</th><th>10 - 19</th><th>20 - 29</th><th>30 - 39</th><th>40 - 49</th><th>50 - 59</th><th>60 - 69</th><th>70 - 79</th><th>80 - 89</th><th>90 +</th></tr></thead><tbody>
		<tr><td>CW1</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_0' id='cw1_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_1' id='cw1_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_2' id='cw1_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_3' id='cw1_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_4' id='cw1_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_5' id='cw1_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_6' id='cw1_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_7' id='cw1_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_8' id='cw1_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw1_9' id='cw1_9' placeholder='0' value='0'></td></tr>
		<tr><td>CW2</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_0' id='cw2_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_1' id='cw2_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_2' id='cw2_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_3' id='cw2_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_4' id='cw2_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_5' id='cw2_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_6' id='cw2_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_7' id='cw2_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_8' id='cw2_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw2_9' id='cw2_9' placeholder='0' value='0'></td></tr>
		<tr><td>CW3</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_0' id='cw3_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_1' id='cw3_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_2' id='cw3_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_3' id='cw3_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_4' id='cw3_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_5' id='cw3_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_6' id='cw3_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_7' id='cw3_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_8' id='cw3_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw3_9' id='cw3_9' placeholder='0' value='0'></td></tr>
		<tr><td>CW4</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_0' id='cw4_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_1' id='cw4_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_2' id='cw4_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_3' id='cw4_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_4' id='cw4_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_5' id='cw4_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_6' id='cw4_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_7' id='cw4_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_8' id='cw4_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='cw4_9' id='cw4_9' placeholder='0' value='0'></td></tr>
    	<tr><td>EXAM</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_0' id='exam_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_1' id='exam_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_2' id='exam_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_3' id='exam_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_4' id='exam_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_5' id='exam_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_6' id='exam_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_7' id='exam_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_8' id='exam_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='exam_9' id='exam_9' placeholder='0' value='0'></td></tr>
		<tr><td>OVERALL</td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_0' id='overall_0' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_1' id='overall_1' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_2' id='overall_2' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_3' id='overall_3' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_4' id='overall_4' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_5' id='overall_5' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_6' id='overall_6' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_7' id='overall_7' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_8' id='overall_8' placeholder='0' value='0'></td><td><input required onClick='this.select();' type='text' class='form-control cmrnum' name='overall_9' id='overall_9' placeholder='0' value='0'></td></tr></tbody></table>

			<!-- Button -->
			<div class='form-group'>
			  <label class='col-md-2 control-label' for='submit'></label>
			  <div class='col-md-2'>
			    <button id='submit' name='submit' class='btn btn-default'>Submit CMR for approval</button>
			  </div>
			</div>

			</fieldset>
			</form>
		</div>
	</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";