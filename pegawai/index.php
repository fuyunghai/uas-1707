<!DOCTYPE html>
<html>
<head>
	<title>Data Pegawai</title>
</head>
<body>

<?php

// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","","uas_1707") or die(mysqli_error());

// --- Fngsi tambah data (Create)
function tambah($koneksi){
	
	if (isset($_POST['btn_simpan'])){
		$nip = $_POST['nip'];
		$nama = $_POST['nama'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		
		if(!empty($nip) && !empty($nama) && !empty($jenis_kelamin) && !empty($alamat) && !empty($telp)){
			$sql = "INSERT INTO tbl_pegawai (nip, nama, jenis_kelamin, alamat, telp) VALUES(".$nip.",'".$nama."','".$jenis_kelamin."','".$alamat."','".$telp."')";
			$simpan = mysqli_query($koneksi, $sql);
			if($simpan && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'create'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}

	?> 
		<form action="" method="POST">
			<fieldset>
				<legend><h2>Tambah data</h2></legend>
				<label>Nip <input type="number" name="nip" /></label> <br>
				<label>Nama <input type="text" name="nama" /></label> <br>
				<label>Jenis Kelamin <input type="text" name="jenis_kelamin" /></label><br>
				<label>Alamat <input type="text" name="alamat" /></label> <br>
				<label>Telephone <input type="number" name="telp" /></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_simpan" value="Simpan"/>
					<input type="reset" name="reset" value="Besihkan"/>
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
			</fieldset>
		</form>
	<?php

}
// --- Tutup Fngsi tambah data


// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
	$sql = "SELECT * FROM tbl_pegawai";
	$query = mysqli_query($koneksi, $sql);
	
	echo "<fieldset>";
	echo "<legend><h2>Data Pegawai</h2></legend>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr>
			<th>Nip</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th>Telephone</th>
			<th>Aksi</th>
		  </tr>";
	
	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td><?php echo $data['nip']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['jenis_kelamin']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td><?php echo $data['telp']; ?></td>
				<td>
					<a href="index.php?aksi=update&nip=<?php echo $data['nip']; ?>&nama=<?php echo $data['nama']; ?>&jenis_kelamin=<?php echo $data['jenis_kelamin']; ?>&alamat=<?php echo $data['alamat']; ?>&telp=<?php echo $data['telp']; ?>">Ubah</a> |
					<a href="index.php?aksi=delete&nip=<?php echo $data['nip']; ?>">Hapus</a>
				</td>
			</tr>
		<?php
	}
	echo "</table>";
	echo "</fieldset>";
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($koneksi){

	// ubah data
	if(isset($_POST['btn_ubah'])){
		$nip = $_POST['nip'];
		$nama = $_POST['nama'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$alamat = $_POST['alamat'];
		$telp = $_POST['telp'];
		
		if(!empty($nama) && !empty($jenis_kelamin) && !empty($alamat) && !empty($telp)){
			$perubahan = "nama='".$nama."',jenis_kelamin=".$jenis_kelamin.",alamat=".$alamat.",telp='".$telp."'";
			$sql_update = "UPDATE tbl_pegawai SET ".$perubahan." WHERE nip=$nip";
			$update = mysqli_query($koneksi, $sql_update);
			if($update && isset($_GET['aksi'])){
				if($_GET['aksi'] == 'update'){
					header('location: index.php');
				}
			}
		} else {
			$pesan = "Data tidak lengkap!";
		}
	}
	
	// tampilkan form ubah
	if(isset($_GET['nip'])){
		?>
			<a href="index.php"> &laquo; Home</a> | 
			<a href="index.php?aksi=create"> (+) Tambah Data</a>
			<hr>
			
			<form action="" method="POST">
			<fieldset>
				<legend><h2>Ubah data</h2></legend>
				<input type="hidden" name="id" value="<?php echo $_GET['nip'] ?>"/>
				<label>Nama <input type="text" name="nama" value="<?php echo $_GET['nama'] ?>"/></label> <br>
				<label>Jenis Kelamin <input type="text" name="jenis_kelamin" value="<?php echo $_GET['jenis_kelamin'] ?>"/></label><br>
				<label>Alamat <input type="text" name="alamat" value="<?php echo $_GET['alamat'] ?>"/></label> <br>
				<label>Telephone <input type="number" name="telp" value="<?php echo $_GET['telp'] ?>"/></label> <br>
				<br>
				<label>
					<input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="index.php?aksi=delete&nip=<?php echo $_GET['nip'] ?>"> (x) Hapus data ini</a>!
				</label>
				<br>
				<p><?php echo isset($pesan) ? $pesan : "" ?></p>
				
			</fieldset>
			</form>
		<?php
	}
	
}
// --- Tutup Fungsi Update


// --- Fungsi Delete
function hapus($koneksi){

	if(isset($_GET['nip']) && isset($_GET['aksi'])){
		$nip = $_GET['nip'];
		$sql_hapus = "DELETE FROM tbl_pegawai WHERE nip=" . $nip;
		$hapus = mysqli_query($koneksi, $sql_hapus);
		
		if($hapus){
			if($_GET['aksi'] == 'delete'){
				header('location: index.php');
			}
		}
	}
	
}
// --- Tutup Fungsi Hapus


// ===================================================================

// --- Program Utama
if (isset($_GET['aksi'])){
	switch($_GET['aksi']){
		case "create":
			echo '<a href="index.php"> &laquo; Home</a>';
			tambah($koneksi);
			break;
		case "read":
			tampil_data($koneksi);
			break;
		case "update":
			ubah($koneksi);
			tampil_data($koneksi);
			break;
		case "delete":
			hapus($koneksi);
			break;
		default:
			echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($koneksi);
			tampil_data($koneksi);
	}
} else {
	tambah($koneksi);
	tampil_data($koneksi);
}

?>
</body>
</html>