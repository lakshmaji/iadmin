<?php
include('login/session.php');
include('session.php');
?>
<html>
<head>
	<title>ADMIN</title>
	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/v.css" rel="stylesheet">
<style>
table a:hover{background:aqua;text-decoration:none;}
</style>
	<script src="assets/js/jquery.min.js"></script>
	<script language="javascript" type="text/javascript">
	      <!--
            	//Browser Support Code
	            function ajaxFunction(current_row,current_val,current_col)
			{
	            	var ajaxRequest;  // The variable that makes Ajax possible!
               		try
				{
		                  // Opera 8.0+, Firefox, Safari
            		      ajaxRequest = new XMLHttpRequest();
               		}
  		            catch (e)
				{
		                  // Internet Explorer Browsers
            		      try
					{
				            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  		}
                              catch (e) 
					{
				            try
						{
		 	                       ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                     			}
                                    catch (e)
						{
			                        // Something went wrong
			                        alert("Your browser broke!");
                   				return false;
			                  }
		                  }
		            }
             		// Create a function that will receive data 
               		// sent from the server and will update
               		// div section in the same page.
				ajaxRequest.onreadystatechange = function()
				{
		                  if(ajaxRequest.readyState == 4){
            		      var ajaxDisplay = document.getElementById('ajaxDiv');
                     		ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  	}
               	}
               	// Now get the value from user and pass it to
              	// server script.
			var total_len=document.getElementById('imp_ref_len').value;	
			/*	alert(current_row);alert(current_val);alert(current_col);*/
			var queryString = "?wrecord=" + current_row ;
                  queryString +=  "&wcolumn=" + current_col + "&wvalue=" + current_val;
			alert("Refresh page to see update");
	            ajaxRequest.open("GET", "updateoperation.php" + queryString, true);
      	      ajaxRequest.send(null); 
            }
         	//-->
      </script>
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
								<button class="btn btn-primary disabled">EDIT</button>
							</div>
							<table class="table table-striped colo-md-9">
								<thead>
								<tr>
								<?php
									$width=100/$num_fields;
									for($y=0;$y<$num_fields;$y++)
									{
										echo "<th style='width:".$width."%'>".mysql_field_name($rs_result, $y)."</th>";
									}
									echo "</tr></thead><tbody>";
									while($row=mysql_fetch_array($rs_result)) { 
									//echo "<b color='red'>".$row[0]."</b>";
								?> 
			            			<tr>
								<?php
									for($l=0;$l<$num_fields;$l++)
									{
								?>
				            		<td >
								<a data-toggle="modal" data-target="#myModal<?php echo $row[0];?>">
									<?php echo $row[$l];?>
								</a>
								</td>
								<!-- Modal -->
  								<div class="modal fade" id="myModal<?php echo $row[0];?>" role="dialog">
    									<div class="modal-dialog modal-sm">
      									<div class="modal-content">
        										<div class="modal-body">
												<?php //echo $row[$l]." ".$row[0];?>
	      										<p>
													<form name='myForm'>
														<input type="hidden" id="imp_ref_len" value="<?php echo $num_fields;?>">
														<?php
															for($w=0;$w<$num_fields;$w++)
															{
																if($w==0)
																{
																	continue;
																}
																echo "<span class='glyphicon glyphicon-book'></span>";
																echo "<textarea class='form-control'  id=".$w."  onchange='ajaxFunction(".$row[0].",this.value,".$w.");'>".$row[$l+$w]."</textarea>";	
																echo "<div id='ajaxDiv'></div>";
		
															}
														?>
													</form>
												</p>
										      </div>
										      <div class="modal-footer">
 												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        										</div>
										</div>
    									</div>
  								</div>
								<?php
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
									echo "<li><a href='updatetbl.php?page=1'>".'|'."<span class='glyphicon glyphicon-chevron-left'></span></a></li> "; // Goto 1st page
									for ($i=1; $i<=$total_pages; $i++)
									{ 
            								echo "<li><a href='updatetbl.php?page=".$i."'>".$i."</a></li> "; 
									} 
									echo "<li><a href='updatetbl.php?page=$total_pages'><span class='glyphicon glyphicon-chevron-right'></span>".'|'."</a> </li>"; // Goto last page
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