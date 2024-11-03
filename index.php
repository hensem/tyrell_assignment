<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- jQuery and Popper.js -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

		<!-- Bootstrap JS -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>

		<style>
		.table-row {
			display: flex;
		}
		.table-cell {
			padding: 10px;
			box-sizing: border-box; /* Ensures padding is included in width calculation */
		}

		#player-table {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Space between boxes */
        }

        .player-box {
            border: 1px solid #ccc; /* Thin border */
            padding: 10px;
            border-radius: 5px; /* Optional: rounded corners */
        }
		
		.sk-fading-circle {
		  margin: 100px auto;
		  width: 40px;
		  height: 40px;
		  position: relative;
		}

		.sk-fading-circle .sk-circle {
		  width: 100%;
		  height: 100%;
		  position: absolute;
		  left: 0;
		  top: 0;
		}

		.sk-fading-circle .sk-circle:before {
		  content: '';
		  display: block;
		  margin: 0 auto;
		  width: 15%;
		  height: 15%;
		  background-color: #333;
		  border-radius: 100%;
		  -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
				  animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
		}
		.sk-fading-circle .sk-circle2 {
		  -webkit-transform: rotate(30deg);
			  -ms-transform: rotate(30deg);
				  transform: rotate(30deg);
		}
		.sk-fading-circle .sk-circle3 {
		  -webkit-transform: rotate(60deg);
			  -ms-transform: rotate(60deg);
				  transform: rotate(60deg);
		}
		.sk-fading-circle .sk-circle4 {
		  -webkit-transform: rotate(90deg);
			  -ms-transform: rotate(90deg);
				  transform: rotate(90deg);
		}
		.sk-fading-circle .sk-circle5 {
		  -webkit-transform: rotate(120deg);
			  -ms-transform: rotate(120deg);
				  transform: rotate(120deg);
		}
		.sk-fading-circle .sk-circle6 {
		  -webkit-transform: rotate(150deg);
			  -ms-transform: rotate(150deg);
				  transform: rotate(150deg);
		}
		.sk-fading-circle .sk-circle7 {
		  -webkit-transform: rotate(180deg);
			  -ms-transform: rotate(180deg);
				  transform: rotate(180deg);
		}
		.sk-fading-circle .sk-circle8 {
		  -webkit-transform: rotate(210deg);
			  -ms-transform: rotate(210deg);
				  transform: rotate(210deg);
		}
		.sk-fading-circle .sk-circle9 {
		  -webkit-transform: rotate(240deg);
			  -ms-transform: rotate(240deg);
				  transform: rotate(240deg);
		}
		.sk-fading-circle .sk-circle10 {
		  -webkit-transform: rotate(270deg);
			  -ms-transform: rotate(270deg);
				  transform: rotate(270deg);
		}
		.sk-fading-circle .sk-circle11 {
		  -webkit-transform: rotate(300deg);
			  -ms-transform: rotate(300deg);
				  transform: rotate(300deg); 
		}
		.sk-fading-circle .sk-circle12 {
		  -webkit-transform: rotate(330deg);
			  -ms-transform: rotate(330deg);
				  transform: rotate(330deg); 
		}
		.sk-fading-circle .sk-circle2:before {
		  -webkit-animation-delay: -1.1s;
				  animation-delay: -1.1s; 
		}
		.sk-fading-circle .sk-circle3:before {
		  -webkit-animation-delay: -1s;
				  animation-delay: -1s; 
		}
		.sk-fading-circle .sk-circle4:before {
		  -webkit-animation-delay: -0.9s;
				  animation-delay: -0.9s; 
		}
		.sk-fading-circle .sk-circle5:before {
		  -webkit-animation-delay: -0.8s;
				  animation-delay: -0.8s; 
		}
		.sk-fading-circle .sk-circle6:before {
		  -webkit-animation-delay: -0.7s;
				  animation-delay: -0.7s; 
		}
		.sk-fading-circle .sk-circle7:before {
		  -webkit-animation-delay: -0.6s;
				  animation-delay: -0.6s; 
		}
		.sk-fading-circle .sk-circle8:before {
		  -webkit-animation-delay: -0.5s;
				  animation-delay: -0.5s; 
		}
		.sk-fading-circle .sk-circle9:before {
		  -webkit-animation-delay: -0.4s;
				  animation-delay: -0.4s;
		}
		.sk-fading-circle .sk-circle10:before {
		  -webkit-animation-delay: -0.3s;
				  animation-delay: -0.3s;
		}
		.sk-fading-circle .sk-circle11:before {
		  -webkit-animation-delay: -0.2s;
				  animation-delay: -0.2s;
		}
		.sk-fading-circle .sk-circle12:before {
		  -webkit-animation-delay: -0.1s;
				  animation-delay: -0.1s;
		}

		@-webkit-keyframes sk-circleFadeDelay {
		  0%, 39%, 100% { opacity: 0; }
		  40% { opacity: 1; }
		}

		@keyframes sk-circleFadeDelay {
		  0%, 39%, 100% { opacity: 0; }
		  40% { opacity: 1; } 
		}
		
		</style>

		<title>Let's Play Cards</title>
	</head>
	
	<body>
	<div class="container-fluid">
		<div id="intialize" style="display: none;">
			<h1>Initilizing.....</h1>
			<h2>MySql Configuration</h2>
			<div class="table-row">
				<div class="table-cell">Host</div>
				<div class="table-cell"><input type='text' value='127.0.0.1' id='mysql_host'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell">Port</div>
				<div class="table-cell"><input type='text' value='3306' id='mysql_port'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell">Username</div>
				<div class="table-cell"><input type='text' id='mysql_user'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell">Password</div>
				<div class="table-cell"><input type='text' id='mysql_password'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell">DB Name</div>
				<div class="table-cell"><input type='text' id='mysql_db'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell"><input type="button" value="Submit" id="mysql_submit" /></div>
			</div>
		</div>
		
		<div id="content" style="display: none;">
			<h1>Lets play cards.....</h1>
			<div class="table-row">
				<div class="table-cell">Number of people</div>
				<div class="table-cell"><input type='number' id='people'/></div>
			</div>
			<div class="table-row">
				<div class="table-cell"><input type="button" value="Submit" id="play_submit" /> <input type="button" value="History" id="history" /></div>
			</div>
			<div><span id="response"></span></div>
		</div>
		
		<div class="sk-fading-circle" style="display: none;" id="spinner">
		  <div class="sk-circle1 sk-circle"></div>
		  <div class="sk-circle2 sk-circle"></div>
		  <div class="sk-circle3 sk-circle"></div>
		  <div class="sk-circle4 sk-circle"></div>
		  <div class="sk-circle5 sk-circle"></div>
		  <div class="sk-circle6 sk-circle"></div>
		  <div class="sk-circle7 sk-circle"></div>
		  <div class="sk-circle8 sk-circle"></div>
		  <div class="sk-circle9 sk-circle"></div>
		  <div class="sk-circle10 sk-circle"></div>
		  <div class="sk-circle11 sk-circle"></div>
		  <div class="sk-circle12 sk-circle"></div>
		</div>
	
		<div class="modal" tabindex="-1" id="alertModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="alertModalTitle"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>				  
					</div>
					<div class="modal-body">
						<p id="alertModalText"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
$( document ).ready(function() {
	$("#spinner").show();
	
	$("#mysql_submit").click(function(){
		intialize_db();
	}); 
	
	$("#play_submit").click(function(){
		play();
	});
	
	$("#history").click(function(){
		get_history();
	}); 
	
	$.ajax({
		url: "backend.php",
		method: "POST", 
		dataType: "json",
		complete: function(jqXHR, textStatus) {
			$("#spinner").hide();
		},
		error: function(jqXHR, textStatus, errorThrown ) {
			$('#alertModal').modal({
				backdrop: 'static',
				keyboard: false
			});
			$("#alertModalTitle").html('Error');
			$("#alertModalText").html(textStatus + ": " + errorThrown);
		},
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.msg)
			} else {
				if (data.msg == 'intialize') {
					$('#intialize').show();
					
					// set consistent column widths
					const rows = document.querySelectorAll('.table-row');
					const columns = rows[0].children.length;

					// Array to store maximum width for each column
					const maxWidths = Array(columns).fill(0);

					// Calculate the maximum width for each column
					rows.forEach(row => {
					  [...row.children].forEach((cell, i) => {
						const cellWidth = cell.offsetWidth;
						if (cellWidth > maxWidths[i]) {
						  maxWidths[i] = cellWidth;
						}
					  });
					});

					// Apply the maximum width to each cell in the corresponding column
					rows.forEach(row => {
					  [...row.children].forEach((cell, i) => {
						cell.style.width = `${maxWidths[i]}px`;
					  });
					});
				} else {
					$('#content').show();
				}
			}
		}
	});
});

function intialize_db() {
	var host = $('#mysql_host').val();
	var port = $('#mysql_port').val();
	var username = $('#mysql_user').val();
	var password = $('#mysql_password').val();
	var db = $('#mysql_db').val();
	host = $.trim(host);
	port = $.trim(port);
	username = $.trim(username);
	password = $.trim(password);
	db = $.trim(db);
	
	if ((host.length == 0) || (port.length == 0) || (username.length == 0) || (db.length == 0) || !Number.isInteger(parseInt(port))) {
		$('#alertModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#alertModalTitle").html('Error');
		$("#alertModalText").html('All fields are required except Password, and Port must be an integer.')
		return;
	} else {
		$("#spinner").show();
		var data = {
			host: host,
			port: port,
			username: username,
			password: password,
			db: db
		}
		$.ajax({
			url: "backend.php?intialize",
			method: "POST", 
			dataType: "json",
			data: data,
			complete: function(jqXHR, textStatus) {
				$("#spinner").hide();
			},
			error: function(jqXHR, textStatus, errorThrown ) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(textStatus + ": " + errorThrown);
			},
			success: function(data, textStatus, jqXHR ) {
				if (!data.success) {
					$('#alertModal').modal({
						backdrop: 'static',
						keyboard: false
					});
					$("#alertModalTitle").html('Error');
					$("#alertModalText").html(data.msg)
				} else {
					location = location;
				}
			}
		});
	}
}
	
function play() {
	var people = $('#people').val();
	people = $.trim(people);
	
	if ((people.length == 0) || !Number.isInteger(parseInt(people)) || (parseInt(people) < 0)) {
		$('#alertModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$("#alertModalTitle").html('Error');
		$("#alertModalText").html('Number of people is required and must be a positive integer.')
		return;
	} else {
		var data = {
			people: people
		}
		$("#spinner").show();
		$.ajax({
			url: "backend.php?play",
			method: "POST", 
			dataType: "json",
			data: data,
			complete: function(jqXHR, textStatus) {
				$("#spinner").hide();
			},
			error: function(jqXHR, textStatus, errorThrown ) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(textStatus + ": " + errorThrown);
			},
			success: function(data, textStatus, jqXHR ) {
				if (!data.success) {
					$('#alertModal').modal({
						backdrop: 'static',
						keyboard: false
					});
					$("#alertModalTitle").html('Error');
					$("#alertModalText").html(data.msg)
				} else {
					if (parseInt(people) == 0) {
						$("#response").html(data.msg);
					} else {
						if (parseInt(people) > 52) {
							var html = 'Only 52 people recieve card.<br /><br />';
						} else {
							var html = '';
						}
						
						var data = data.msg
						
						// Iterate over each player and format the output
						for (const player in data) {
							if (data.hasOwnProperty(player)) {  // Check if data[player] exists
								const cards = data[player].join(", "); // Join cards with commas
								html += `Player ${player}: ${cards}` + '<br />';
							}
							
						}
						$("#response").html(html);
					}
				}
			}
		});
	}
}

function get_history() {
	$("#spinner").show();
	$.ajax({
		url: "backend.php?history",
		method: "POST", 
		dataType: "json",
		complete: function(jqXHR, textStatus) {
			$("#spinner").hide();
		},
		error: function(jqXHR, textStatus, errorThrown ) {
			$('#alertModal').modal({
				backdrop: 'static',
				keyboard: false
			});
			$("#alertModalTitle").html('Error');
			$("#alertModalText").html(textStatus + ": " + errorThrown);
		},
		success: function(data, textStatus, jqXHR ) {
			if (!data.success) {
				$('#alertModal').modal({
					backdrop: 'static',
					keyboard: false
				});
				$("#alertModalTitle").html('Error');
				$("#alertModalText").html(data.msg)
			} else {
				var data = data.msg

				if (data.length == 0) {
					$("#response").html('No history.');
				} else {
					const playerTable = document.createElement("div");
					playerTable.className = "player-table";

					for (const key in data) {
						const box = document.createElement("div");
						box.className = "player-box";

						const playerData = data[key];
						const playerEntries = Object.values(playerData.player).map(player => {
							return `Player ${player.player}: ${player.card}`;
						});

						box.innerHTML = `
							<strong>Date:</strong> ${playerData.date} <br>
							<strong>Number of People:</strong> ${playerData.people} <br>
							<strong>Players:</strong> <br>
							${playerEntries.join("<br>")}
						`;

						playerTable.appendChild(box);
					}
					$("#response").html(playerTable);
				}
			}
		}
	});

}

</script>
</html>