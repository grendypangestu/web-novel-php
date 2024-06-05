<?php 
	require '../koneksi.php';
	$id_buku = $_GET['id_buku'];
	$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id_buku = '$id_buku'"));
	$nama_buku = ucwords($data['nama_buku']);
	if (isset($id_buku)) {
		if (hapusBuku($id_buku) > 0) {
			setAlert("Berhasil dihapus", "Buku $nama_buku berhasil dihapus", "success");
      		header("Location: buku.php");
		}
	}