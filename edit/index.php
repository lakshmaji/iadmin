<?php

ob_start();

include('../login/session.php');
include('../session.php');
?>
<html>
<head><title>i ADMIN</title>
<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap core CSS -->

	<link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/main.css" rel="stylesheet">
	<link href="../assets/css/v.css" rel="stylesheet">
	

<style>
table a:hover{background:aqua;text-decoration:none;}
</style>
	<script src="../assets/js/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$('tr th:nth-child(1)').hide();
    			$('tr td:nth-child(1)').hide();
		});


	</script>

	<script language="javascript" type="text/javascript">
	      <!--
            	//Browser Support Code
	            function ajaxFunction(current_row,current_val,current_col)
			{



			if ($(".nonepty").val()=='') {
    alert("please enter anything");
}else{


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
			
	            ajaxRequest.open("GET", "updateoperation.php" + queryString, true);
      	      ajaxRequest.send(null); 

            }
         	}//-->
      </script>
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
						if(isset($_GET['id'])) 
						{
   							@mysql_query("DELETE FROM ".$selected_table_name." WHERE id = '".$_GET['id']."'");
   							header("location:index.php");
   							exit();
						}
					?> 
					<div class="progress pull-right">
						<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<a href="../cancel.php" style="color:#fff;">CANCEL</a>
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


<?php
if($selected_table_name=="achievements" || $selected_table_name=="courses" || $selected_table_name=="events" || $selected_table_name=="news" || $selected_table_name=="tutors" || $selected_table_name=="students" || $selected_table_name=="notices")
{

?>
							<div class="btn-group" role="group" style="float:right;" aria-label="...">
								<a href="../create" class="btn btn-primary">ADD</a>
							</div>
<?php
}
?>







<div class="table-responsive">

							<table class="table table-striped colo-md-9">
							<thead>
								<tr>
									<?php
										$width=100/$num_fields;
										for($y=0;$y<$num_fields;$y++)
										{
											echo "<th style='width:".$width."%'>".mysql_field_name($rs_result, $y)."</th>";
										}
										echo "<th style='width:10%;'>action</th></tr></thead><tbody>";

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
						<?php if(mysql_field_name($rs_result, $l)=="imageUrl")
											{
											echo "<img src='".$row[$l]."' width='100px' height='100px'/>";												
											}
											else
											{
												echo $row[$l];
											}

?>
					</a>
				</td>
<?php
if($l== $num_fields-1){
echo "<td><a class='btn btn-danger' href='index.php?id=".$row[0]."'>delete</a></td>";
}


?>				
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
				echo "<textarea class='form-control nonepty'  id=".$w."  onchange='ajaxFunction(".$row[0].",this.value,".$w.");' >".$row[$l+$w]."</textarea>";	
echo "		<div id='ajaxDiv'></div>";
		
			}

		?>
		</form>
	</p>
        </div>
        <div class="modal-footer">

          <a type="button" class="btn btn-danger" href="index.php">Update</a>
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
</div>


























							<?php 
								$sql = "SELECT * FROM ".$selected_table_name; 
								$rs_result = mysql_query($sql); //run the query
								$total_records = mysql_num_rows($rs_result);  //count number of records
								$total_pages = ceil($total_records / $num_rec_per_page); 
							?>
							<button class="btn btn-warning disabled" type="button" style="background:#ec971f;"><?php echo $selected_table_name; ?> has <span class="badge"><?php echo $total_records; ?></span> entries</button>
							<ul class="pagination pagination-sm pull-right">
								<?php
									echo "<li><a href='index.php?page=1'>".'|'."<span class='glyphicon glyphicon-chevron-left'></span></a></li> "; // Goto 1st page
									for ($i=1; $i<=$total_pages; $i++)
									{ 
            								echo "<li><a href='index.php?page=".$i."'>".$i."</a></li> "; 
									} 
									echo "<li><a href='index.php?page=$total_pages'><span class='glyphicon glyphicon-chevron-right'></span>".'|'."</a> </li>"; // Goto last page
								?>
							</ul>
						</div>
					</div>
				</p>
			</div>
		</div>
	</div>

	<script src="../assets/js/bootstrap.js"></script>
<script>
$(document).ready(function() {
    $("#MyModal").modal();
  });
</script>
</body>
</html>
