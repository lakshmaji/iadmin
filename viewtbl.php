<?php
include('login/session.php');
include('session.php');
?>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/css/jquery.min.js"></script>
	<link rel="stylesheet" href="assets/css/v.css">
</head>
<body>
	<div class="row affix-row">
		<?php require('side.php');?>
		<div class="col-sm-9 col-md-10 affix-content">
			<div class="container">
				<div class="page-header">
					<?php
						$num_rec_per_page=5;
						include('connection.php');
						$connection = new createConnection(); 			//created a new object
						$connection->connectToDatabase();
						$connection->selectDatabase();				//selecting db
						$selected_table_name=$_SESSION["tblname"];
					?><br>
					<button class="btn btn-success disabled text-uppercase"><span class="glyphicon glyphicon-folder-open"></span> <?php echo $selected_table_name;?></button>
				</div>
				<p>
					<?php
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$start_from = ($page-1) * $num_rec_per_page;
						$sql = "SELECT * FROM ".$selected_table_name." LIMIT $start_from, $num_rec_per_page";
						$rs_result = mysql_query ($sql); //run the query
						if($rs_result === FALSE) 
						{
							die(mysql_error()); // TODO: better error handling
						}
						$num_fields=mysql_num_fields($rs_result);
					?>
					<div class="progress pull-right">
							<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<a href="cancel.php" style="color:#fff;">CANCEL</a>
							</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-body">
							<div class="progress">
  								<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
    									<span class="sr-only">STATUS</span>
  								</div>
							</div>
							<div class="btn-group" role="group" aria-label="...">
								<button class="btn btn-default disabled">STATUS</button>
								<button class="btn btn-primary disabled">VIEW</button>
							</div>
							<table class="table table-striped ">
							<thead>
								<tr>
									<?php
										$width=100/$num_fields;
										for($y=0;$y<$num_fields;$y++)
										{
											echo "<th style='width:".$width."%'>".mysql_field_name($rs_result, $y)."</th>";
										}
										echo "</tr></thead><tbody>";
										while($row=mysql_fetch_array($rs_result))
										{
									?>
								<tr>
									<?php
										for($l=0;$l<$num_fields;$l++)
										{
											echo "<td>".$row[$l]."</td>";
										}
									?>
								</tr>
									<?php
										};
									?>
							</tbody>
							</table>
							<?php 
								$sql = "SELECT * FROM ".$selected_table_name; 
								$rs_result = mysql_query($sql); //run the query
								$total_records = mysql_num_rows($rs_result);  //count number of records
								$total_pages = ceil($total_records / $num_rec_per_page); 
							?>
							<button class="btn btn-warning disabled" type="button" style="background:#ec971f;"><?php echo $selected_table_name; ?> has <span class="badge"><?php echo $total_records; ?></span> entries</button>
							<ul class="pagination pagination-sm pull-right">
								<?php
									echo "<li><a href='viewtbl.php?page=1'>".'|'."<span class='glyphicon glyphicon-chevron-left'></span></a></li> "; // Goto 1st page
									for ($i=1; $i<=$total_pages; $i++)
									{ 
            								echo "<li><a href='viewtbl.php?page=".$i."'>".$i."</a></li> "; 
									} 
									echo "<li><a href='viewtbl.php?page=$total_pages'><span class='glyphicon glyphicon-chevron-right'></span>".'|'."</a> </li>"; // Goto last page
								?>
							</ul>
						</div>
					</div>
				</p>
			</div>
		</div>
	</div>
	<script src="assets/js/bootstrap.js"></script>
</body>
</html>