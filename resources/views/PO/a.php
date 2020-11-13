<html>
<head>
  <title>Multiple Delete</title>
  
  <!-- Load librari/plugin jquery nya -->
  <script src="js/jquery.min.js"></script> 
</head>
<body>
  <h1>Multiple Delete</h1>
  
  <form method="post" action="delete.php" id="form-delete">
    <table border="1" cellpadding="5">
      <tr>
        <th><input type="checkbox" id="check-all"></th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
      </tr>
      <?php
      // Load file koneksi.php
      include "koneksi.php";
      
      // Buat query untuk menampilkan semua data siswa
      $sql = $pdo->prepare("SELECT * FROM siswa");
      $sql->execute(); // Eksekusi querynya
      
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td><input type='checkbox' class='check-item' name='nis[]' value='".$data['nis']."'></td>";
        echo "<td>".$data['nis']."</td>";
        echo "<td>".$data['nama']."</td>";
        echo "<td>".$data['telp']."</td>";
        echo "<td>".$data['alamat']."</td>";
        echo "</tr>";
        
        $no++; // Tambah 1 setiap kali looping
      }
      ?>
    </table>
    <hr>
    <button type="button" id="btn-delete">DELETE</button>
  </form>
  
  <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });
  });
  </script>
</body>
</html>