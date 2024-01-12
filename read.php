<?php  
	session_start();
	require_once('class/Koneksi.php');
	require_once('class/Cerita.php');
	require_once('class/Paragraf.php');

	if (!isset($_SESSION['userLogin'])) {
		header("location: login.php");
	}

	if (isset($_POST['submit'])) {
		if ($_POST['paragraf'] === "") {
			$pesan = "Paragraf gagal ditambahkan. Anda belum menuliskan sebuah paragraf.";
			echo $pesan;
		}
		else{
			$user = $_SESSION['userLogin'];
			$idCerita = (int)$_GET['cerita'];
			$isi = $_POST['paragraf'];

			$object = new Paragraf();
			$hasil = $object->buatParagraf($user, $idCerita, $isi);
		}
	}

	if (isset($_GET['cerita'])) {
		$idCerita = (int)$_GET['cerita'];

		$object = new Cerita();
		$hasil = $object->getCeritaById($idCerita);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Baca Cerita</title>
</head>
<body>
	<h1>Lihat Cerita</h1>
	<div>
		<?php  
			echo "<h2>".$hasil['judul']."</h2>";
			$id = (int)$_GET['cerita'];

			$object = new Paragraf();
			$hasil = $object->getParagraf($id);

			while($row = $hasil->fetch_assoc()){
				echo "<div>";
				echo $row['isi_paragraf'];
				echo "</div><br>";
			}
			echo "<br>";
		?>
		<form method="POST" action="read.php?cerita=<?php echo $_GET['cerita']; ?>">
			Tambah Paragraf<br><textarea placeholder="Tulis paragraf di sini" name="paragraf"></textarea><br>
			<input type="submit" name="submit" value="Simpan">
		</form>
		<p>Kembali ke <a href="home.php">halaman awal</a></p>
	</div>
</body>
</html>