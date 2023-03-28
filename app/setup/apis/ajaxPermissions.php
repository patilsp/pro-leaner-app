<?php
include_once "../../session_token/checksession.php";
include_once "../../configration/config.php";
//include_once "session_token/checktoken.php";
require_once "../../functions/db_functions.php";

if($_POST['type'] == "get_user_permission"){
	$user_id = $_POST['user_id'];
	$role_id = $_POST['role'];
	$output = '
		    <div class="panel-heading text-center" style="font-weight:bold; font-size:18px;"> ASSIGN ACCESS RIGHTS </div>
			<table class="data_table table table-striped table-bordered">
				<thead>
					<tr>
						<th style="text-align:center">S.No</th>
                        <th style="text-align:center">Feature</th>
                        <th style="text-align:center">Allow Access</th>
                    </tr>
				</thead>
				<tbody>
		';
	$permission_id = array();
	$userrights = "SELECT * FROM users_module_access WHERE user_id = ?";
    $queryrights=$db->prepare($userrights);
    $queryrights->execute(array($user_id));
    $rowcount = $queryrights->rowCount();
    if ($rowcount == 0) {
    	$sqlrights = "SELECT * FROM role_permission WHERE roles_id = ?";
	    $queryrights=$db->prepare($sqlrights);
	    $queryrights->execute(array($role_id));
	    $rowcount = $queryrights->rowCount();
	}
    if($rowcount > 0) {
	    while($rows = $queryrights->fetch(PDO::FETCH_ASSOC)) {
	        $permission_id[] = $rows['permission_id'];
	    }
    } else {
       	$permission_id[] = "";
    }
    $sno = 0;
        $query = "SELECT * FROM permission WHERE level = 1 AND visible = 1 ORDER BY sequence";
        $stmt = $db->query($query);
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {



              $selected_cond = "";
              if(in_array($rows['id'],$permission_id))
               $selected_cond = "checked=\"checked\"";


        	
                            

		
	            $output .='
					
						<tr>
							<td align="center">'. ++$sno .'</td>
							<td>'. $rows['name'] .'</td>
							<td align="center">'. 
								'<input type="checkbox" class="parent'.$rows['id'].'" id = "module'.$rows['id'].'" name="useraccess[]" value="'.$rows['id'].'" onClick="selectAll(this)" '.$selected_cond.' />'
							 .'</td>
						</tr>

						

						';

							$query1 = "SELECT * FROM permission WHERE level = 2 AND visible = 1 AND parent = '".$rows['id']."' ORDER BY sequence";
				            $stmt1 = $db->query($query1);
				            while($rows1 = $stmt1->fetch(PDO::FETCH_ASSOC))
				            {

				            	$selected_cond = "";
                                if(in_array($rows1['id'],$permission_id))
                                	$selected_cond = "checked=\"checked\"";

							$output .='
							  <tr>
							    <td align="center">' .++$sno .'</td>
		                        <td style="padding-left:50px">' . $rows1['name'] . '</td>
		                        <td align="center">'.'<input type="checkbox" class="parent '.$rows['id'].'" child '.$rows['id'].'" name="useraccess[]" onClick="verifyParentChecked(this, '.$rows['id'].')" value="'.$rows1['id'].'" '.$selected_cond.'"/>'
		                        .'</td>
							    </tr>
                        
								';
							$query2 = "SELECT * FROM permission WHERE level = 3 AND visible = 1 AND parent = '".$rows1['id']."' ORDER BY sequence";
				            $stmt2 = $db->query($query2);
				            while($rows2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
				            	$selected_cond = "";
                                if(in_array($rows2['id'],$permission_id))
                                	$selected_cond = "checked=\"checked\"";

							$output .='
							  <tr>
							    <td align="center">' .++$sno .'</td>
		                        <td style="padding-left:50px">' . $rows2['name'] . '</td>
		                        <td align="center">'.'<input type="checkbox" class="parent '.$rows1['id'].'" child '.$rows1['id'].'" name="useraccess[]" onClick="verifyParentChecked(this, '.$rows1['id'].')" value="'.$rows2['id'].'" '.$selected_cond.'"/>'
		                        .'</td>
							    </tr>
                        
								';
				            }
	        				}			

		}
	$output .= '<tbody></table>';
	echo $output;
}
else{
	echo "error";
}
?>