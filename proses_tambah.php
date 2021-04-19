<?php
include 'koneksi.php';
  $judul_buku = $_POST['judul_buku'];
  $nama_pengarang  = $_POST['nama_pengarang'];
  $nama_penerbit    = $_POST['nama_penerbit'];
  $gambar_buku = $_FILES['gambar_buku']['name'];
if($gambar_buku != "") {
  $ekstensi_diperbolehkan = array('png','jpg');
  $x = explode('.', $gambar_buku);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_buku']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_buku;
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                  $query = "INSERT INTO buku (judul, pengarang, penerbit, gambar) VALUES ('$judul_buku', '$nama_pengarang', '$nama_penerbit', '$nama_gambar_baru')";
                  $result = mysqli_query($koneksi, $query);
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }

            } else {     
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_buku.php';</script>";
            }
} else {
   $query = "INSERT INTO buku (judul, pengarang, penerbit, gambar) VALUES ('$judul_buku', '$nama_pengarang', '$nama_penerbit', null)";
                  $result = mysqli_query($koneksi, $query);
          
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {

                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }
}