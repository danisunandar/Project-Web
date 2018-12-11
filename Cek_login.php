<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
require 'functions.php';
 
// menangkap data yang dikirim dari form login
$Username = $_POST['Username'];
$Password = $_POST['Password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from user where username='$Username' and password='$Password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['Hak_akses']=="Admin"){
 
		// buat session login dan username
		$_SESSION['Username'] = $Username;
		$_SESSION['Hak_akses'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:indexAdmin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['Hak_akses']=="Mahasiswa"){
		// buat session login dan username
		$_SESSION['Username'] = $Username;
		$_SESSION['Hak_akses'] = "Mahasiswa";
		// alihkan ke halaman dashboard pegawai
		header("location:indexMahasiswa.php");
 
    }else{
 
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
 
?>