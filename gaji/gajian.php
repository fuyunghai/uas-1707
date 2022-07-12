<?php 
$koneksi = mysqli_connect("localhost","root","","uas_1707") or die(mysqli_error());
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Penggajian</title>
</head>

<body>
  <div class="form">
    <form method="post" action="">
      <h4>INPUT GAJI</h4>
      <table>
        <tr>
          <td>Kode Gaji</td>
          <td>:</td>
          <td>
             <input type="text" name="kd_gaji">
          </td>
        </tr>
        <tr>
          <td>Nip</td>
          <td>:</td>
          <td>
             <input type="text" name="nip">
          </tr>
        </tr>
         <tr>
          <td>Bulan</td>
          <td>:</td>
          <td>
             <select name="bulan">
                 <option value="Januari">januari</option>
                 <option value="Februari">februari</option>
                 <option value="Maret">mar</option>
                 <option value="April">april</option>
                 <option value="Mei">mei</option>
                 <option value="Juni">juni</option>
                 <option value="Juli">juli</option>
                 <option value="Agustus">agustus</option>
                 <option value="September">september</option>
                 <option value="Oktober">oktober</option>
                 <option value="November">november</option>
                 <option value="Desember">desember</option>
             </select>
          </td>
        </tr>
        <tr>
          <td>Gaji Pokok</td>
          <td>:</td>
          <td>
             <input type="number" name="gaji_pokok">
          </td>
        </tr>
          <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td>
             <select name="jabatan">
                 <option value="Direktur">Direktur</option>
                 <option value="Manajer">Manajer</option>
                 <option value="Pegawai">Pegawai</option>
             </select>
          </td>
        </tr>
        <tr>
          <td>
            <input  type="submit" name="simpan" value="simpan" >
          </td>
        </tr>
      </table>
    </form>
  </div>

  <?php

  if(isset($_POST['simpan'])){

    $koneksi = mysqli_connect("localhost","root","","uas_1707") or die(mysqli_error());

    session_start();

      $kd_gaji = $_POST['kd_gaji'];
      $nip = $_POST['nip'];
      $bulan = $_POST['bulan'];
      $gaji_pokok = $_POST['gaji_pokok'];
      $jabatan = $_POST['jabatan'];

      echo "<br/> STRUK GAJI <br/>";
      echo "<br/> Kode Gaji   : $kd_gaji";
      echo "<br/> Nip       : $nip";
      echo "<br/> Bulan     : $bulan";
      echo "<br/> Gaji Poko: $gaji_pokok";
      echo "<br/> Jabatan   : $jabatan";

        if ($jabatan == "Direktur"){
        $tunj_jabatan = 15000000;
        echo "<br/> TUNJANGAN : $tunj_jabatan";
        $total = $gaji_pokok + $tunj_jabatan;
        echo "<br/> TOTAL : $total";

        } elseif ($jabatan == "Manajer") {
        $tunj_jabatan = 10000000;
        echo "<br/> TUNJANGAN : $tunj_jabatan";
        $total = $gaji_pokok + $tunj_jabatan;
        echo "<br/> TOTAL : $total";

        } else {
        $tunj_jabatan = 5000000;
        echo "<br/> TUNJANGAN : $tunj_jabatan";
        $total = $gaji_pokok + $tunj_jabatan;
        echo "<br/> TOTAL : $total";
        }

     $sql = "insert into gaji values ('$kd_gaji','$nip','$bulan', '$gaji_pokok', '$jabatan', '$tunj_jabatan', '$total')";

     mysqli_query($koneksi, $sql);

     // var_dump($kd_gaji,$nip,$bulan, $gaji_pokok, $jabatan, $tunj_jabatan, $total); die(); 

     echo "<script>alert('Data Berhasil di Tambahkan');</script>";

    }

   ?>

 </body>
 </html>