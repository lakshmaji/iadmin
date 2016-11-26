<?php
include('../login/session.php');
include('../session.php');
?>
<html>
<head>
	<title>ADMIN</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="../assets/css/main.css">
	<script src="../assets/js/jquery.min.js"></script>
	<link rel="stylesheet" href="../assets/css/v.css">
</head>
<body>
	<div class="row affix-row">
		<?php require('../side.php');?>
		<div class="col-sm-9 col-md-10 affix-content">
			<div class="container">
				<div class="page-header">
					<?php
						$num_rec_per_page=5;
						include('../connection.php');
						$connection = new createConnection(); 			//created a new object
						$connection_ref = $connection->connectToDatabase();
						// $connection->selectDatabase();				//selecting db
						$selected_table_name=$_SESSION["tblname"];
					?><br>
					<button class="btn btn-success disabled text-uppercase"><span class="glyphicon glyphicon-folder-open"></span> <?php echo $selected_table_name;?></button>
				</div>
				<p>
					<?php
						$sql = "SELECT * FROM ".$selected_table_name; 
						$rs_result = mysqli_query($connection_ref,$sql); //run the query
						if($rs_result === FALSE) 
						{ 
							die(mysqli_error()); // TODO: better error handling
						}
						$num_fields=mysqli_num_fields($rs_result);
						$_SESSION['num_flds']=$num_fields;
						$skipid=0;
					?>
					<div class="row">
  						<div class="col-lg-5">
							<div class="progress pull-right">
								<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
									<a href="../cancel.php" style="color:#fff;">CANCEL </a>
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
										<button class="btn btn-primary disabled">ADD</button>
									</div>
									<form action="crtinstbl.php" method="post">
										<?php
										$finfo = mysqli_fetch_fields($rs_result);
											foreach ($finfo as $fieldinfo)
    											{
												if($skipid==0)
												{
													$skipid++;
													continue;
												}
										?>
										<span class="text-uppercase" style="font-weight:600!important;"><?php    printf("%s\n",$fieldinfo->name);?></span>
										<?php 
											if(strval($fieldinfo->type)!= "BLOB" && strval($fieldinfo->type)!="blob")
											{
										?>
										<div class="input-group">
  											<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
											<input type="text" name="<?php echo $skipid;?>" class="form-control" required>
										</div>
										<?php
											}
											else
											{
										?>
										<span class="glyphicon glyphicon-book"></span>
										<textarea name="<?php echo $skipid;?>" class="form-control" rows="5" id="comment" required></textarea>
										<?php
											}
											$skipid++;
											//echo $skipid;
										?>
										<!--sub class="label label-warning pull-right"><?php printf("max Length: %d\n",$fieldinfo->max_length);?></sub-->
										<?php
											echo"<hr>";
    											}
										?> 	
										<input class="btn btn-info" type="submit" value="ADD ENTRIES">
										<input class="btn btn-warning" type="reset" value="CLEAR" > 
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
						</div>
						<div class="col-lg-5">
							<div class="panel panel-info">
								<div class="panel-body">
								<h5 class="text-uppercase">instructions:</h5>
									<div class="list-group text-capitalize">
  										<li href="#" class="list-group-item ">Dapibus ac facilisis in</li>
  										<li href="#" class="list-group-item ">Cras sit amet nibh libero</li>
  										<li href="#" class="list-group-item ">Porta ac consectetur ac</li>
  										<li href="#" class="list-group-item ">Vestibulum at eros</li>
									</div>
								</div>
							</div>
						</div>
					</div><!--form div-->
				</p>
			</div>
		</div>
	</div>
	<script src="../assets/js/bootstrap.js"></script>
</body>
</html>
