<?php  
	$cerita_count = $_POST['cerita_count'];
	$user_id = $_POST['user_id'];

	$con = new mysqli("localhost", "root", "", "fsp_project1_160721046");

	$sql = "SELECT c.idcerita, c.judul, COUNT(p.idparagraf) as jumlahParagraf, u.nama as author FROM cerita c INNER JOIN paragraf p ON p.idcerita = c.idcerita INNER JOIN users u ON u.idusers = c.idusers_pembuat_awal WHERE c.idusers_pembuat_awal != ? GROUP BY c.idcerita ORDER BY c.idcerita LIMIT ?,4";
	$stmt = $con->prepare($sql);
	$stmt->bind_param("si", $user_id, $cerita_count);
	$stmt->execute();
	$result = $stmt->get_result();

	while ($row = $result->fetch_assoc()) {
		$id = $row['idcerita'];
		$judul = $row['judul'];
		$jumlahParagraf = $row['jumlahParagraf'];
		$author = $row['author'];
		echo "<div class='cardCerita'><h3 class='judul'>$judul</h3><p>Pemilik cerita: $author</p><p>Jumlah Paragraf: $jumlahParagraf</p><a href='read.php?cerita=".$id."'>Baca Lebih Lanjut</a></div>";
	}

	$con->close();
?>