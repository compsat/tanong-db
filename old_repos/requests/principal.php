<?php
include "config.php";
$reqRn = filter_input(INPUT_POST, 'requested_no');
if(isset($_POST['search'])&& $_POST['name']!="" && $_POST['docType']!="" && $_POST['date']!=""){
	$valueToSearch = $_POST['name'];
	$docToSearch = $_POST['docType'];
	$dateToSearch = $_POST['date'];
    $query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND r.requested_by LIKE '%".$valueToSearch."%' AND d.document_type LIKE '%".$docToSearch."%' AND r.due_date LIKE '%".$dateToSearch."%'";  
	$search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!="" && $_POST['docType']!=""){
	$valueToSearch = $_POST['name'];
	$docToSearch = $_POST['docType'];
	$query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t, document_t d WHERE r.document_id = d.document_id AND r.requested_by LIKE '%".$valueToSearch."%' AND d.document_type LIKE '%".$docToSearch."%'";
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!="" && $_POST['date']!=""){
	$valueToSearch = $_POST['name'];
	$dateToSearch = $_POST['date'];
	$query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND r.requested_by LIKE '%".$valueToSearch."%' AND r.due_date LIKE '%".$dateToSearch."%'";
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['docType']!="" && $_POST['date']!=""){
	$docToSearch = $_POST['docType'];
	$dateToSearch = $_POST['date'];
	$query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND r.document_type LIKE '%".$docToSearch."%' AND r.due_date LIKE '%".$dateToSearch."%'";
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['docType']!=""){
	$docToSearch = $_POST['docType'];
	$query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND d.document_type LIKE '%".$docToSearch."%'";
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['date']!=""){
	$dateToSearch = $_POST['date'];
	$query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND r.due_date LIKE '%".$dateToSearch."%'";
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!=""){
	$valueToSearch = $_POST['name'];
    $query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id AND r.requested_by LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($link, $query);
} else {
    $query = "SELECT r.request_no, r.requested_by, d.document_type, r.due_date, r.status FROM request_t r, document_t d WHERE r.document_id = d.document_id";
    $search_result = filterTable($link, $query);
}

if(isset($_POST['accept']))
{
	$status=('A');
	$updateReqNo = $_POST['accept'];
	$query = "UPDATE `request_t` SET `status`='$status' WHERE request_no='$updateReqNo'";
	echo ($query);
    $accept_result = filterTable($link, $query);
	header("Refresh:0");   
}

if(isset($_POST['decline']))
{
	$status=('D');
	$updateReqNo = $_POST['decline'];
	$query = "UPDATE `request_t` SET `status`='$status' WHERE request_no='$updateReqNo'";
	echo ($query);
    $accept_result = filterTable($link, $query);
	header("Refresh:0");   
}

if(isset($_POST['decline']))
{
	$status=('D');
	$updateReqNo = $_POST['decline'];
	$query = "UPDATE `request_t` SET `status`='$status' WHERE request_no='$updateReqNo'";
	echo ($query);
    $decline_result = filterTable($link, $query);
	header("Refresh:0");   
}

if(isset($_POST['remark']))
{
	$remark=$_POST['text_remark'];
	$updateReqNo = $_POST['remark'];
	$query = "UPDATE `request_t` SET `remarks`='$remark' WHERE request_no='$updateReqNo'";
    $remark_result = filterTable($link, $query);
	header("Refresh:0");   
}


function filterTable(mysqli $link, $query)
{
    $filter_Result = mysqli_query($link, $query);
    return $filter_Result;
}


?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PRINCIPAL</title>
		<link rel="stylesheet" href="css/principal.css" type="text/css">
    </head>
    <body>
        
        <form action="principal.php" method="post">
		<div align = "center" id="container">
			<br><br>
			<label>Due Date: <input type="date" name="date"></label><span></span>
			<label>Student Number:</label>
            <input type="text" name="name" placeholder=""><span></span>
			<label>Document Type:</label>
			<select name="docType">
			<option value="" selected></option>
			<option value="F137">F137</option>
			<option value="F138">F138</option>
			<option value="DD">DD</option>
			<option value="COE">COE</option>
			<option value="OTHERS">OTHERS</option>
			</select><span></span>
            <input type="submit" name="search" value="Filter">
			<br><br>
		</div>
		
        <div align = "center" id="table">  
            <table>
                <tr>
                    <th>Request No.<span></span></th>
                    <th>Requested by<span></span></th>
					<th>Document Type<span></span></th>
                    <th>Due Date<span></span></th>
					<th><span></span></th>
					<th><span></span></th>
					<th>Remarks<span></span></th>
					<th>Status<span></span></th>
                </tr>
      
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr id="row-of-data">
                    <td class="reqTable">
					<input class = "req-btn" type = "submit" name = "req-btn" value = <?php echo $row['request_no'];?> /><br>
					<?php 
					if(isset(($_POST['req-btn'])) /*you can validate the link here*/){
						
						session_start();
						$_SESSION['request_no']= $_POST["req-btn"];
						header('Location: filledTemp.php');
					}
					?></a>
					</td>
                    <td><?php echo $row['requested_by'];?></td>
					<td><?php echo $row['document_type'];?></td>
                    <td><?php echo $row['due_date'];?></td>
					<?php 
						$reqNo = $row['request_no'];
						$reqBy = $row['requested_by'];
						$but_Status = $row['status']; 
					?>
					<td><input type ="submit" class = "but_accept" value= "<?php echo $reqNo ?>"  name = "accept" id = "but_accept" <?php if ($but_Status != 'P'){ ?> disabled <?php } ?> /></td>
					<td><input type="submit" class="but_decline" value="<?php echo $reqNo ?>" name="decline" id="but_decline" <?php if ($but_Status != 'P'){ ?> disabled <?php   } ?> /></td>
					<td><input type="text" class="textbox" id="text_remark" name="text_remark" placeholder="" />				
					</br>
					<input type = 'submit' class = 'but_remark' value="<?php echo $reqNo ?>"  name = "remark" id = "but_remark"  <?php if ($but_Status != 'P'){ ?> disabled <?php   } ?> /></input></td>
					<td><?php echo $row['status'];?></td>
				</tr>
                <?php endwhile;?>
            </table>

			</div> 
		</form>			
    </body>
</html>