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
        <?php require('../header.php');?>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php
                    $num_rec_per_page=5;
                    // include('../connection.php');
                    $connection = new createConnection(); 			//created a new object
                    $connection_ref = $connection->connectToDatabase();
                    // $connection->selectDatabase();				//selecting db
                    $selected_table_name=$_SESSION["tblname"];
                ?>
                <?php
                    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
                    $start_from = ($page-1) * $num_rec_per_page; 
                    $sql = "SELECT * FROM ".$selected_table_name." LIMIT $start_from, $num_rec_per_page"; 
                    $rs_result = mysqli_query ($connection_ref, $sql); //run the query
                    if($rs_result === FALSE) 
                    { 
                            die(mysqli_error()); // TODO: better error handling
                    }
                    $num_fields=mysqli_num_fields($rs_result);
                    if(isset($_GET['id'])) 
                    {
                        @mysqli_query($connection_ref, "DELETE FROM ".$selected_table_name." WHERE id = '".$_GET['id']."'");
                        header("location:index.php");
                        exit();
                    }
                ?> 
                <div class="row">
                    <div class="col-9">

                    </div>
                    <div class="col-3 ">
                        <div class="float-right py-3">
                            <a href="../create" role="button" class="btn waves-effect waves-light btn-primary">Add</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $selected_table_name;?></h4>
                                <h6 class="card-subtitle">Todo
                                    <code>.table</code>-?.</h6>
                                <h6 class="card-title mt-5"><i
                                        class="mr-1 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> <?php echo $selected_table_name;?></h6>
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead class="">    
                                            <tr class="border-0">
                                                <?php
                                                    $width=100/$num_fields;
                                                    $finfo = mysqli_fetch_fields($rs_result);
                                                    foreach($finfo as $v){
                                                        $image_url = $v=="imageUrl"? true:false;
                                                        echo "<th scope='col' class='border-0 font-14 font-weight-medium text-muted' style='width:".$width."%'>".$v->name."</th>";
                                                    }
                                            
                                                    echo "<th class='border-0 font-14 font-weight-medium text-muted' scope='col' style='width:10%;'>action</th>"
                                                ?>                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_array($rs_result)) { 
                                            ?> 
                                                <tr>
                                                    <?php
                                                        for($l=0;$l<$num_fields;$l++) {
                                                    ?>
                                                        <td>
                                                            <a data-toggle="modal" data-target="#myModal<?php echo $row[0];?>">
                                                                <?php 
                                                                    if($image_url) {
                                                                        echo "<img src='".$row[$l]."' width='100px' height='100px'/>";												
                                                                    } else {
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
                                                    <?php
                                                        }
                                                    ?>
                                                </tr>
                                            <?php
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
                    $sql = "SELECT * FROM ".$selected_table_name; 
                    $rs_result = mysqli_query($connection_ref,$sql); //run the query
                    $total_records = mysqli_num_rows($rs_result);  //count number of records
                    $total_pages = ceil($total_records / $num_rec_per_page); 
                ?>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
                            <?php echo $selected_table_name; ?> has <span class="badge"><?php echo $total_records; ?></span> entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7" style="display:flex;justify-content:end;">
                        <div class="dataTables_paginate paging_simple_numbers" id="zero_config_paginate">
                            <ul class="pagination">
                                <?php
									echo "<li class='paginate_button page-item previous disabled' id='zero_config_previous'><a href='index.php?page=1' aria-controls='zero_config' data-dt-idx='0' tabindex='0' class='page-link'>Previous</a></li>"; // Goto 1st page
                                ?>
                                <!-- <li class="paginate_button page-item previous disabled" id="zero_config_previous">
                                    <a href="#" aria-controls="zero_config" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                </li> -->
                                <?php
                                    for ($i=1; $i<=$total_pages; $i++)
                                    { 
                                        echo "<li class='paginate_button page-item " . ($page == $i ? 'active' : '') . "'><a href='index.php?page=".$i."' aria-controls='zero_config' data-dt-idx='1' tabindex='0' class='page-link'>".$i."</a></li> "; 
                                    } 
                                ?>
                                <?php
									echo "<li class='paginate_button page-item next' id='zero_config_next'><a href='index.php?page=$total_pages' aria-controls='zero_config' data-dt-idx='7' tabindex='0' class='page-link'>Last</a></li>"; // Goto last page
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
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