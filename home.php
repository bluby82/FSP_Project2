<?php  
	session_start();

	if (!isset($_SESSION['userLogin'])) {
		header("location: index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/project.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div id="judul">
		<h2>CERBUNG</h2>
		<h3>Cerita Bersambung</h3>
	</div>
	<div id="container">
		<div id="pilihan">		
			<h3>Kategori:</h3>
			<select id="cmbPilihan">
				<option value="cerita">Kumpulan Cerita</option>
		        <option value="ceritaku">Ceritaku</option>
	    	</select>
	    </div>
		<div id="ceritaku">
			<h3>Ceritaku</h3>
			<div id="pembatasCeritaku">
				<button id="btnCeritaku">Tampilkan cerita selanjutnya</button>
			</div>
		</div>
		<div id="cerita">
			<h3>Kumpulan Cerita</h3>
			<div id="pembatasCerita">
				<button id="btnCerita">Tampilkan cerita selanjutnya</button>
			</div>
		</div>
		<div id="additional">
			<form method="POST" action="new.php">
				<input type="submit" name="new" value="Buat Cerita Baru">
			</form>
			<form method="POST" action="index.php">
				<input type="submit" name="logout" value="Log out">
			</form>
		</div>
	</div>



	<script type="text/javascript">
		var ceritaku_count = 0;
		var cerita_count = 0;
		var user_id = "<?php echo $_SESSION['userLogin']; ?>";
		$.post("ajax/ajaxceritaku.php", { ceritaku_count: ceritaku_count, user_id: user_id}).done(function(data) {
			$("#pembatasCeritaku").before(data);
			ceritaku_count += 2;
		});
		$.post("ajax/ajaxcerita.php", { cerita_count: cerita_count, user_id: user_id}).done(function(data) {
			$("#pembatasCerita").before(data);
			cerita_count += 4;
		});

		$("#btnCeritaku").click(function(){
			$.post("ajax/ajaxceritaku.php", { ceritaku_count: ceritaku_count, user_id: user_id}).done(function(data) {
				$("#pembatasCeritaku").before(data);
				ceritaku_count += 2;
			});
		});

		$("#btnCerita").click(function(){
			$.post("ajax/ajaxcerita.php", { cerita_count: cerita_count, user_id: user_id}).done(function(data) {
				$("#pembatasCerita").before(data);
				cerita_count += 4;
			});
		});

		$("#cmbPilihan").change(function () {
	        var pilihan = $(this).val();
	        if (pilihan === "ceritaku") {
	            $("#ceritaku").show();
	            $("#cerita").hide();
	        } else if (pilihan === "cerita") {
	            $("#cerita").show();
	            $("#ceritaku").hide();
	        }
	    });

	    var width = $(window).width();

		if (width > 575) {
			$("#ceritaku").show();
		    $("#cerita").show();
		} else {
			var pilihan = $("#cmbPilihan").val();
	        if (pilihan === "ceritaku") {
	            $("#ceritaku").show();
	            $("#cerita").hide();
	        } else if (pilihan === "cerita") {
	            $("#cerita").show();
	            $("#ceritaku").hide();
	        }
		}

	    $(window).resize(function () {
	        var p_width = $(window).width();

			if (p_width > 575) {
				$("#ceritaku").show();
			    $("#cerita").show();
			} else {
				var pilihan = $("#cmbPilihan").val();
		        if (pilihan === "ceritaku") {
		            $("#ceritaku").show();
		            $("#cerita").hide();
		        } else if (pilihan === "cerita") {
		            $("#cerita").show();
		            $("#ceritaku").hide();
		        }
			}
	    });
	</script>
</body>
</html>