<?php
include "config.php";

if(isset($_POST['search'])&& $_POST['name']!="" && $_POST['docType']!=" " && $_POST['date']!=""){
	$valueToSearch = $_POST['name'];
	$docToSearch = $_POST['docType'];
	$dateToSearch = $_POST['date'];
    $query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND (ru.first_name LIKE '%".$valueToSearch."%' OR ru.last_name LIKE '%".$valueToSearch."%' OR ru.mi LIKE '%".$valueToSearch."%') AND d.document_type LIKE '%".$docToSearch."%' AND r.request_date LIKE '%".$dateToSearch."%'";  
	$search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!="" && $_POST['docType']!=" "){
	$valueToSearch = $_POST['name'];
	$docToSearch = $_POST['docType'];
	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND (ru.first_name LIKE '%".$valueToSearch."%' OR ru.last_name LIKE '%".$valueToSearch."%' OR ru.mi LIKE '%".$valueToSearch."%') AND d.document_type LIKE '%".$docToSearch."%'";  
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!="" && $_POST['date']!=""){ //this one has an error
	$valueToSearch = $_POST['name'];
	$dateToSearch = $_POST['date'];
	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND (ru.first_name LIKE '%".$valueToSearch."%' OR ru.last_name LIKE '%".$valueToSearch."%' OR ru.mi LIKE '%".$valueToSearch."%') AND r.request_date LIKE '%".$dateToSearch."%'";  
	$search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['docType']!=" " && $_POST['date']!=""){
	$docToSearch = $_POST['docType'];
	$dateToSearch = $_POST['date'];
	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND d.document_type LIKE '%".$docToSearch."%' AND r.request_date LIKE '%".$dateToSearch."%'";  
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['docType']!=" "){
	$docToSearch = $_POST['docType'];
	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND d.document_type LIKE '%".$docToSearch."%'";  
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['date']!=""){
	$dateToSearch = $_POST['date'];
	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND r.request_date LIKE '%".$dateToSearch."%'";  
    $search_result = filterTable($link, $query);
} else if(isset($_POST['search']) && $_POST['name']!=""){
	$valueToSearch = $_POST['name'];
    	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by AND (ru.first_name LIKE '%".$valueToSearch."%' OR ru.last_name LIKE '%".$valueToSearch."%' OR ru.mi LIKE '%".$valueToSearch."%')";
    $search_result = filterTable($link, $query);
} else {
    	$query = "SELECT ru.grade, ru.current_section, ru.first_name, ru.last_name, ru.mi, r.remarks, r.request_date, r.status, d.document_type FROM request_t r, document_t d, request_user_t ru WHERE r.document_id = d.document_id AND ru.requested_by = r.requested_by";
    $search_result = filterTable($link, $query);
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
		<script>
		$( function() {
			$( "#datepicker" ).datepicker();
		} );
		</script>
		<title>REGISTRAR STATUS</title>
		<link rel="stylesheet" href="css/registrar.css" type="text/css">
    </head>
    <body>
        
        <form action="registrar.php" method="post">
		<div align = "center" id="container">
			<p>Go back to request page? <a href="index.php">Click this to go back.</a>.</p>
			<br><br>
			<label>Request Date: <input type="date" name="date"></label><span></span>
			<label>Name:</label>
            <input type="text" name="name" placeholder=""><span></span>
			<label>Document Type:</label>
			<select name="docType">
			<option value=" " selected></option>
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
                    <th><span></span><span></span><span></span><span></span><span></span></th>
                    <th><span></span><span></span>Request Status<span></span><span></span></th>
					<th><span></span><span></span>Remarks<span></span><span></span></th>
                </tr>
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr class="row-of-data">
                    <td>Name: <?php echo $row['last_name'];?>, <?php echo $row['first_name'];?> <?php echo $row['mi'];?></br>
						Year and Section: <?php echo $row['grade'];?> - <?php echo $row['current_section'];?></br>
						Document Type: <?php echo $row['document_type'];?></br>
						Request Date: <?php echo $row['request_date'];?></td>
						<td align='center'><?php 
							$box_status = $row['status'];
							
							if ($box_status == 'A') { ?>
								<input type = 'submit' class = 'but_accept' value="Accepted" id = "but_accept" disabled></input>
							<?php } else if ($box_status == 'D') { ?>
								<input type = 'submit' class = 'but_decline' value="Declined" id = "but_decline" disabled></input>
							<?php } else if ($box_status == 'P') { ?>
								<input type = 'submit' class = 'but_pending' value="Pending" id = "but_pending" disabled></input>
							<?php } else { 
								echo ("Status not found");
							} ?>
						</td>
					<td><?php echo $row['remarks'];?></td>
				</tr>
                <?php endwhile;?>
            </table>
			</div>
        </form> 
    </body>
</html>