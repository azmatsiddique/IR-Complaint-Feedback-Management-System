<html>
<head>
  <title>IR Complaint &amp; Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
  	
	tr{
		border-bottom: 3px groove;
	}
	td {
  
  		padding:20px;
  
	}
    .active{color:white;}
  	.line{border-right: 2px groove;min-height:98.5vh;overflow-x:hidden;}
  	.left{
  		width:70%;
  		float:left;
  	}
  	.right{
  		float: left;
  		width:25%;
  	}
  </style>	
  <script>
window.setInterval(function() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("feedback-content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","db.php",true);
        xmlhttp.send();
    
},5000);

window.setInterval(function() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("emergency-content").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","emergency.php",true);
        xmlhttp.send();
    
},5000);

</script>

</head>

<body class="line">  
	<div class="navbar navbar-inverse"  style="width:101%;padding-bottom:1px;" id="main">
		<ul style="font-size: 24px; color: gray;margin-top: 5px;cursor: pointer;">
			<li class="active" style="display: inline;margin-right: 20px"; data-toggle="tab" href="#emergency">
				Emergency
			</li>
			<li style="display:inline;" data-toggle="tab" href="#feedback">
				Feedback
			</li>
		</ul>
	</div>
		<div class='tab-content left'>
			<div id="emergency" class='tab-pane fade in active'>
				<div id='emergency-content' style="width:90%;padding: 50px;margin:auto;background:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					<table>

<?php
$servername = "127.0.0.1";
$username = "kunwar";
$password = "";
$database = "twitter";

$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

						$sql = "select * from tweets where prediction=1 order by id desc;";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
    					while($row = $result->fetch_assoc()) {
        					echo "<tr><td style='color:black' width='180%'>";
        					echo $row["tweet"];
        					echo "</td><td width='20%'><button type='button' class='btn btn-info add'><b>Reply</b></button></td></tr>";
    						}


							} ?>

					</table>
				</div>
					
			</div>
	        <div id="feedback" class='tab-pane fade'>
				<div id='feedback-content' style="width:90%;padding: 50px;margin:auto;background:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					<table>
					<?php

						$sql = "select * from tweets where prediction=0 order by id desc;";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
    					while($row = $result->fetch_assoc()) {
        					echo "<tr><td style='color:black' width='180%'>";
        					echo $row["tweet"];
        					echo "</td><td width='20%'><button type='button' class='btn btn-info add'><b>Reply</b></button></td></tr>";
    						}

							} ?>
					</table>
				</div>	
			</div>
			
		</div>
		<div class="container-fluid right">
			<div id="selection" style="min-height:200px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);font-size: 16px;padding:10px;"></div>
			<h3 style="color:#c6c6c6;">Type your response...</h3>
  			<textarea rows="10" style="width:100%;"></textarea>
  			<button type="button" class="btn btn-info" style="width:100%;margin-top: 10px;">Reply</button>
  		</div>
  		<script>
	
	$(function () {
    $(".add").click(function () {
    	document.getElementById("selection").innerHTML = "";
        var $this = $(this),
            myCol = $this.closest("td"),
            myRow = myCol.closest("tr"),
            targetArea = $("#selection");
        targetArea.append(myRow.children().not(myCol).text() + "<br />");
    });
});

</script>
</body>
</html>