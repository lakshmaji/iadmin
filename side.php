<?php
// include('connection.php');
$connection = new createConnection(); 			//created a new object
$connection_ref = $connection->connectToDatabase();
$result = mysqli_query($connection_ref, 'SHOW TABLES');
if($result)
{
	?>
	<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Tables</span></li>
                        <?php
                            while($table = mysqli_fetch_array($result))	 {// go through each row that was returned in $result 
                                echo "<li class='sidebar-item" . ($table[0] === $_SESSION['tblname'] ? ' selected' : '') . "'> 
                                    <a class='sidebar-link" . ($table[0] === $_SESSION['tblname'] ? ' active' : '') . "' href='../choice.php?dummy=".base64_encode($table[0])."' aria-expanded='false'>
                                        <i data-feather='grid' class='feather-icon'></i>
                                        <span class='hide-menu'>".$table[0]."</span>
                                    </a>
                                </li>";
                            }
                        ?>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="https://github.com/lakshmaji/iadmin"
                                aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                                    class="hide-menu">Documentation</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../login/logout.php"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="col-sm-3 col-md-2 affix-sidebar" >
				<div class="sidebar-nav" >
					<div class="navbar navbar-default" role="navigation" >
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<span class="visible-xs navbar-brand"></span>
						</div>
						<div class="navbar-collapse collapse sidebar-navbar-collapse">
							<ul class="nav navbar-nav" id="sidenav01">
								<li>
									<a href="#" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
										<h4>
											ADMIN i
											<br>
											<small>Gene<span class=""></span></small>
										</h4>
									</a>
								</li>
								<li><a href="#"><span class="glyphicon glyphicon-link"></span> View My WEBSITE</a></li>
								<li><a href="../login/logout.php"><span class="glyphicon glyphicon-off"></span> LOGOUT</a></li>
								<li><a href="#"><span class="glyphicon glyphicon-info-sign"></span> HELP</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
		 echo 'Error displaying tables';
		}
		?>