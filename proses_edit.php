<?php
include 'koneksi.php';

  $id = $_POST['id'];
  $judul_buku   = $_POST['judul_buku'];
  $nama_pengarang    = $_POST['nama_pengarang'];
  $nama_penerbit   = $_POST['nama_penerbit'];
  $gambar_buku= $_FILES['gambar_buku']['name'];
  if($gambar_buku != "") {
    $ekstensi_diperbolehkan = array('png','jpg');
    $x = explode('.', $gambar_buku); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_buku']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_buku; 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                   $query  = "UPDATE buku SET judul = '$judul_buku', pengarang = '$nama_pengarang', penerbit = '$nama_penerbit', gambar = '$nama_gambar_baru'";
                    $query .= "WHERE id_buku= '$id'";
                    $result = mysqli_query($koneksi, $query);
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
               
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_buku.php';</script>";
              }
    } else {
      $query  = "UPDATE buku SET judul = '$judul_buku', pengarang = '$nama_pengarang', penerbit = '$nama_penerbit'";
      $query .= "WHERE id_buku = '$id'";
      $result = mysqli_query($koneksi, $query);
      
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }