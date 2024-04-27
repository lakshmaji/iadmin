<?php
require('login/session.php');
include('connection.php');
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
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>i ADMIN</title>
    <!-- Custom CSS -->
    <link href="./assets/css/style.min.css" rel="stylesheet">
    <link href="./assets/css/custom.css" rel="stylesheet">
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
        <?php require('./header.php');?>
        <?php require('./side.php');?>
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
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Library</li>
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
					$connection = new createConnection(); 			//created a new object
					$connection_ref = $connection->connectToDatabase();
					// $connection->selectDatabase();
					$result = mysqli_query($connection_ref, 'SHOW TABLES');
					if($result) {
				?>
				<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h4 class="card-title">Tables</h4>
                                    <div class="ms-auto">
                                        <div class="dropdown sub-dropdown">
                                            <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1" style="">
                                                <a class="dropdown-item" href="#">Insert</a>
                                                <a class="dropdown-item" href="#">Update</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Team Lead
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Status
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Weeks
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$break_line=0;
												while ($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result 	
											?>
											<tr class='border-top-0 px-2 py-4'>
												<td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="me-3"><img src="./assets/images/users/widget-table-pic1.jpg" alt="user" class="rounded-circle" width="45" height="45"></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
																<?php
																	echo $table[0];
																?>
															</h5>
                                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="popover-icon">
                                                        <a class="btn btn-primary rounded-circle btn-circle font-12" href="javascript:void(0)">DS</a>
                                                        <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">SS</a>
                                                        <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item" href="javascript:void(0)">RP</a>
                                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20" href="javascript:void(0)">+</a>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-center px-2 py-4"><i class="fa fa-circle text-primary font-12" data-bs-toggle="tooltip" data-placement="top" aria-label="In Testing" data-bs-original-title="In Testing"></i></td>
                                                <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                    35
                                                </td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4">
													<?php
														echo "<a href='choice.php?dummy=".base64_encode($table[0])."'>view</a>";
														// echo "<pre>".var_dump($table)."</pre>";
													?>
                                                </td>
											</tr>
											<?php
													// echo "<tr class='border-top-0 px-2 py-4' style='background-color:rgba(".rand(0,255).",".rand(0,255).",".rand(0,255).",1);'><a  href='choice.php?dummy=".base64_encode($table[0])."' class='text-uppercase table_title_wrapper' style='color:#fff;'>".$table[0]."</a></div>";
													$break_line++;
													if($break_line==4 || $break_line==8 || $break_line==12) {
														echo "</tr>";
													}	
												} 
											?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
					} else {
						echo 'Error displaying tables';
					}
				?>
				
			</div>
			<!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
			<?php require('./footer.php');?>
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
    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="./assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="./assets/js/app-style-switcher.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="./assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="./assets/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="./assets/js/custom.min.js"></script>
</body>
</html>
