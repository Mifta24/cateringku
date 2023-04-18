<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>

	<link rel="stylesheet" href="produk.css">
</head>
<body>
    <!-- cek apakah sudah login -->
	<?php 
	session_start();
    include 'db.php';
	if($_SESSION['status']!="login"){
		header("location:login.php?pesan=belum_login");
	}
	?>
 
	<header>
		<a href="index.php" target="_blank"  class="logo">Tracker<span>coffee</span>.</a>
      <div class="nav">
        <a href="admin.php">Dashboard</a>
        <a href="profil.php">Profil</a>
        <a href="kategori.php">Data Kategori</a>
        <a href="produk.php">Data Produk</a>
      </div>

      <div class="navbar-extra">
        <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
		<a href="logout.php">LOGOUT</a>
      </div>
	</header>

		<section class="dashboard" >
            <div class="box">
              <a href="tambah_produk.php">Tambah Data</a>
                <table border="1" cellpadding=8 cellspacing="0" bordercolor="black">
                    <thead>

                        <tr>
                            <td>No</td>
                            <td>Kategori</td>
                            <td>Nama Produk</td>
                            <td>Harga</td>
                            <td>Stock</td>
                            <td>Gambar</td>
                            <!-- <td>Deskripsi</td> -->
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
    <?php 
        $produk=mysqli_query($conn,"SELECT * FROM tbl_product LEFT JOIN tbl_category USING (category_id) ORDER BY product_id");
        $i=0;
        while($row=mysqli_fetch_array($produk)) :
            $i++;
    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['product_price']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td><a href="img/coffee-menu/<?php echo $row['product_image']; ?>" target="_blank"><img alt="<?php echo $row['product_image']; ?>" src="img/coffee-menu/<?php echo $row['product_image']; ?>" width="100px"></a></td>
                            <!-- deskripsi dihapus -->
                            <td><?php echo ($row['product_status']==0)? 'Not Sale' : 'For Sale'; ?></td>
                            <td>
                              <a href="edit_produk.php?id=<?php echo $row['product_id'] ?>">Edit</a>|<a href="hapus_menu.php?idp=<?php echo $row['product_id'] ?> " onclick="return confirm('Yakin ingin menghapus data ini ?')">Hapus</a>
                           </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
	
 
	<!-- Fotter Start -->
    <footer>
		<div class="sosial">
		  <a target="_blank" href="https://twitter.com/MiftaAldi24?t=tGR24pLkyKmcJkHMb6NlwA&s=09"><i data-feather="twitter"></i></a>
		  <a target="_blank" href="https://instagram.com/mifta_xh_ui?igshid=ZDdkNTZiNTM="><i data-feather="instagram"></i></a>
		  <a target="_blank" href="https://github.com/Mifta24"><i data-feather="github"></i></a>
		</div>
  
		<div class="link">
		  <a href="#home">Home</a>
		  <a href="#about">Tentang Kami</a>
		  <a href="#menu">Menu</a>
		  <a href="#contact">Contact</a>
		</div>
  
		<div class="credit">
		  <p>Created by <a href="">Miftahudin Aldi Saputra</a>| &copy; 2023.</p>
		</div>
	  </footer>
	  <!-- Fotter End -->
</body>
</html>