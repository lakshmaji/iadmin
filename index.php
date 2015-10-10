<?php
require('login/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>i ADMIN</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
 	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<style>
		html,body{height:100%;}
  		body {position: relative;}
		.tpmg{margin-top:15%;}
  		.affix {top: 5%; }
		.nav{box-shadow: 20px 20px 20px !important;}
		.nav-pills > li > a {border-radius: 0px;}
		.container-fluid{background-color:#2196F3;color:#fff;height:100%;}
		.list-group,.table{box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.8);}
		input[type=radio]{display:none;}
		.rd{margin:2px;width:70%;border-radius:0px;}
		.bla{color: rgba(251, 152, 13, 1);background-color: rgba(246, 245, 243, 0.01);border-color: #EEA236;}
		option{padding:4px;background-color: #2196F3;color: #fff;}
		.container h1{font-family: century gothic;border-left: 3px solid rgba(159, 103, 62, 1);color: rgba(255, 164, 47, 1);padding:10px;}
		.container-fluid h1,h3{font-family:Harlow Solid Italic;}
		@media screen and (max-width: 810px) {#section1, #section2, #section3, #section41, #section42  {margin-left: 150px;}}
	</style>
</head>
<body data-spy="scroll" data-offset="0" data-target="#nav">
<div class="container-fluid">
	<div class="text-center tpmg">
		<h1>Backend Admin Generator</h1>
  		<h3>php mysql bootstrap</h3>
  		<p>Scroll this page to see how to work with this.It is independent backend generator based on php , mysql.</p>
  		<p>Available with ready designed bootstrap template.</p>
		<a href="#section1" class="smoothScroll"><button class="btn btn-sm btn-primary">Begin Now</button></a>
	</div>
</div><br><!--end container fluid-->
<div class="container">
	<div class="row">
    		<nav class="col-sm-3" id="nav">
      		<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="665"><!--205-->
        			<li class="active"><a href="#section1" class="active smoothScroll">My WEB SITE</a></li>
 			      <li><a class="smoothScroll" href="#section2">HELP</a></li>
 			      <li><a class="smoothScroll" href="#section3">SETUP INSTRUCTIONS</a></li>
				<li><a class="smoothScroll" href="#section4">SUPPORT</a></li>
  			      <li><a class="smoothScroll" href="login/logout.php">LOGOUT</a></li>
      		</ul>
    		</nav>
    		<div class="col-sm-9 text-uppercase">
      		<div id="section1">    
        			<h1>Start here </h1>
        			<p>
					<?php
						include('connection.php');
						$connection = new createConnection(); 			//created a new object
						$connection->connectToDatabase();
						$connection->selectDatabase();
					   	$result = mysql_query('SHOW TABLES');
   						if($result)
						{
					?>
				<form name="form1" action="choice.php" method="post">
				<table class="table text-uppercase">
				<tr>
				<td>
					<select name="table_to_operation" class="btn btn-primary rd text-uppercase">
					<?php
						while($table = mysql_fetch_array($result))	// go through each row that was returned in $result 
						{ 	
							echo "<option value='$table[0]'>$table[0]</option>";
						} 	
					?>
					</select>
				</td>
				<td>
					<label class="btn btn-warning rd bla" data-placement="right" data-trigger="hover" data-toggle="tooltip" title="Click me and then click proceed,That's it! (step2)"><input type="radio" name="act" checked value="view1">view</label><br>
					<label class="btn btn-warning rd" data-placement="right" data-trigger="hover" data-toggle="tooltip" title="Click me and then click proceed,That's it! (step2)"><input type="radio" name="act" value="update1">edit</label><br>
					<label class="btn btn-warning rd" data-placement="right" data-trigger="hover" data-toggle="tooltip" title="Click me and then click proceed,That's it! (step2)"><input type="radio" name="act" value="delete1">delete</label><br>
					<label class="btn btn-warning rd" data-placement="right" data-trigger="hover" data-toggle="tooltip" title="Click me and then click proceed,That's it! (step2)"><input type="radio" name="act" value="create1">add new</label>
				</td>
				<td>
					<input type="submit" class="btn btn-primary rd" value="proceed">
				</td>
				</tr>
				</table> 
				</form>
					<?php
						}
						else
						{
							echo 'Error displaying tables';
						}
					?>
				</p>
			</div>
      		<div id="section2"> 
        			<h1>begining guidelines</h1>
        			<p>
					<div class="list-group text-left text-uppercase btn-default">
 						<a  class="list-group-item text-success">SELECT TABLE NAME <img src="assets/img/tblselect.png"/> that you want to perform changes</a>
 						<a  class="list-group-item"><input type='hidden' value="lakki">select the task <img src="assets/img/edittbl.png"/> that you want to perform on selected table</a>
 						<a  class="list-group-item">then click <img src="assets/img/ok.png"/> button to accomplish the certain task</a>
 						<a  class="list-group-item">the table you selected is shown at top left corner<img src="assets/img/curtbl.png"/></a>
 						<a  class="list-group-item">the current task iss viewd at top side left corner of the table<img src="assets/img/status.png"/></a>
 						<a  class="list-group-item">click the page number<img src="assets/img/pg.png"/>to jump from one page to other to view all records </a>
 						<a  class="list-group-item">Total entrie spresent in atbale can be found at bottom left corner of the table<img src="assets/img/en.png"/></a>
 						<a  class="list-group-item">the field | column names can be seen at table header<img src="assets/img/tblheader.png"/></a>
 						<a  class="list-group-item">click <img src="assets/img/cancel.png"/> buuton at right side top corner to the table to go back from current task(<b>VIEW,add,edit,delete</b>) or cancel the current task</a>
					</div>
				</p>
			      <h1>delete task</h1>
        			<p>
					<div class="list-group text-left text-uppercase btn-default">
 						<a  class="list-group-item">when mouse points to data entry its color changes to red and it indicates that it is ready to delete.click that entry to delete<img src="assets/img/del.png"/></a>
					</div>
				</p>
			      <h1>edit task</h1>
        			<p>
					<div class="list-group text-left text-uppercase btn-default">
 						<a  class="list-group-item">when mouse points to data entry its color changes to aqua color(sky blue) and it indicates that it is ready to update.click that entry to update<img src="assets/img/edit.png"/></a>
 						<a  class="list-group-item">when you click that button it will show you small window which enables you to update the entries<img src="assets/img/swin.png"/></a>
 						<a  class="list-group-item">after change focus of entry it will be updated with new values and confirms with a alert box<img src="assets/img/alrt.png"/></a>
					</div>
				</p>
			      <h1>add new task</h1>
        			<p>
					<div class="list-group text-left text-uppercase btn-default">
 						<a  class="list-group-item">enter new entries then click add entries<img src="assets/img/adn.png"/></a>
 						<a  class="list-group-item">after sccessful completion it asks for more insertions or end task <img src="assets/img/ada.png"/><br>based on your selction it redierects to add entry page or home page.</a>
					</div>
				</p>
			</div>
      		<div id="section3">         
				<h1>setup instructions</h1>
        				<p>
						<div class="list-group text-left text-uppercase btn-default">
 							<a  class="list-group-item text-success">
								goto 
								<i class="glyphicon glyphicon-file"></i> 
								<b>connection.php</b> 
								file<br>
								<div class="well">
									<code>
										var $host="localhost";    // specify the host address
										<br>var $username="root"; // specify the username for mysql
										<br>var $password="";     // specify the password for mysql
										<br>var $database="mysql";// specify name of the database
									</code>
								</div>
								<br>edit these line to gain access to your database with admin panel
							</a>
 						</div>
					</p>
				      <h1>other instructions</h1>
        				<p>
						<div class="list-group text-left text-uppercase btn-default">
 							<a  class="list-group-item">the table must conatin acolumn id as the frst field and which must be a primary key and set to auto increment.</a>
 							<a  class="list-group-item">this admin panel doesnot support images ,so you are required to insert image urls instead of image.</a>
							<a  class="list-group-item"><img src="assets/img/tbl.png"/></a>
						</div>
					</p>  
					<h1></h1>
				      <p>
						<div class="list-group text-left text-uppercase btn-default">
							<a  class="list-group-item">php mysql bootstrap</a>
							<a  class="list-group-item">any suggestions!write to lakshmajee88@gmail.com</a>
						</div>
					</p>
			      </div> 
 				<div id="section4">         
        				<p>
						<span class="glyphicon glyphicon-copyright-mark">created by lakshmaji</span>
					</p>
		      	</div>
			</div>       
		</div>
	</div>
</div>
<script src="assets/js/bootstrap.js"></script>
<script>
$(document).ready(
			function()
			{
    				$('[data-toggle="tooltip"]').tooltip();   
			});

$(".nav li").click(function() {
    $(".nav li").removeClass('active');
    $(this).addClass('active');    
});
$(".btn-warning").click(function() {
    $(".btn-warning").removeClass('bla');
    $(this).addClass('bla');    
});
</script>
</body>
</html>                 
<?php
?>               		