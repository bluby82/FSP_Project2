<?php  
	session_start();
	require_once('class/Cerita.php');
	require_once('class/Koneksi.php');

	if (!isset($_SESSION['userLogin'])) {
		header("location: login.php");
	}

	if (isset($_POST['submit'])) {
		if ($_POST['judul'] === "") {
			$pesan = "Cerita gagal ditambahkan. Berikan sebuah judul untuk ceritamu!";
			echo $pesan;
		}
		elseif ($_POST['paragraf'] === "") {
			$pesan = "Cerita gagal ditambahkan. Berikan sebuah paragraf untuk memulai ceritamu!";
			echo $pesan;
		}
		else {
			$judul = $_POST['judul'];
			$userId = $_SESSION['userLogin'];
			$isi = $_POST['paragraf'];

			$object = new Cerita();
			$hasil = $object->buatCerita($judul, $userId, $isi);

			echo $hasil;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buat Cerita</title>
</head>
<body>
	<h1>Buat Cerita</h1>
	<div>
		<form method="POST" action="new.php">
			Judul<br><input type="text" name="judul"><br>
			Paragraf pertama:<br><textarea placeholder="Tulis paragraf di sini" name="paragraf"></textarea><br>
			<input class="button" type="submit" name="submit" value="Simpan">
		</form>
		<p>Kembali ke <a href="home.php">halaman utama</a></p>
	</div>
</body>
</html>