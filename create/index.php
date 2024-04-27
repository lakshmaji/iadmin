<?php
ob_start();
include('../login/session.php');
include('../session.php');
include('../connection.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>i ADMIN</title>
    <!-- Custom CSS -->
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

	<!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
<!-- ============================================================== -->
		<?php require('../header.php');?>
        <!-- ============================================================== -->
		<?php require('../side.php');?>
		<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
			<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $_SESSION["tblname"] ?></h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Add data to table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

			<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

				<?php
					$num_rec_per_page=5;
					$connection = new createConnection(); 			//created a new object
					$connection_ref = $connection->connectToDatabase();
					// $connection->selectDatabase();				//selecting db
					$selected_table_name=$_SESSION["tblname"];
				?>
				<div>
					<h6>Add data to <?php echo $selected_table_name;?> table</h6>
					<div>
						<div class="btn-list">
							<a href="../cancel.php" type="button" class="btn waves-effect waves-light btn-secondary">Back</a>
						</div>
					</div>
				</div>
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
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="crtinstbl.php" method="post">
									<?php
										$finfo = mysqli_fetch_fields($rs_result);
										foreach ($finfo as $fieldinfo) {
											if($skipid==0) {
												$skipid++;
												continue;
											}
									?>
											<span class="text-uppercase" style="font-weight:600!important;"><?php    printf("%s\n",$fieldinfo->name);?></span>
											<?php 
												if(strval($fieldinfo->type)!= "BLOB" && strval($fieldinfo->type)!="blob") {
											?>
													<div class="input-group">
														<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
														<input type="text" name="<?php echo $skipid;?>" class="form-control" required>
													</div>
											<?php
												} else {
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
										}
									?> 	
									<input class="btn btn-info" type="submit" value="ADD ENTRIES">
									<input class="btn btn-warning" type="reset" value="CLEAR" > 
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
			<?php require('../footer.php');?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
	</div>

	
	<!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../assets/js/app-style-switcher.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="../assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../assets/js/custom.min.js"></script>
</body>

</html>