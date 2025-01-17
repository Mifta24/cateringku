<?php
session_start();
include '../database/db.php';

	if($_SESSION['status']!="login"){
		header("location:../login/login.php?pesan=belum_login");
	};

    $kategori=mysqli_query($conn,"SELECT * FROM tbl_category WHERE category_id='".$_GET['id']."' ");

    $k=mysqli_fetch_object($kategori);

		include 'layout/header.php';
	?>

<style> 
	/* Edit Menu Section */
.edit-menu {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 20px 0;
}

.edit-menu h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.image-preview {
    margin-top: 20px;
    text-align: center;
}

.image-preview h3 {
    margin-bottom: 10px;
    color: #333;
}

.image-preview img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
 
<section class="edit-menu">
    <div class="container">
        <h2>Edit Menu</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="<?php echo $k->category_name ;?>" required>
            </div>
            <!-- Old Image -->
            <input type="hidden" name="foto" value="<?php echo $k->image; ?>">
            <div class="form-group">
                <label for="gambar">Gambar Lama</label>
                <img src="../img/asset/kategori/<?php echo $k->image; ?>" width="100px" alt="Gambar Produk">
            </div>

            <!-- New Image -->
            <div class="form-group">
                <label for="gambar">Gambar Baru (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control h-100" required>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
        </form>

        <!-- <div class="image-preview">
            <h3>Current Image</h3>
            <img src="img/asset/category/<?php echo $k->gambar ?>" alt="Current Image">
        </div> -->
    </div>
</section>

	<!-- update fata ke data base -->
	<?php

	// Untuk membesarkan huruf depan ucwords()

		if (isset($_POST['submit'])) {
			$nama_menu=ucwords( $_POST['nama_menu']);
		
            $fotoLama = $_POST['foto'];
            $filename = $_FILES['gambar']['name'];
            $tmpname = $_FILES['gambar']['tmp_name'];

            // Process new image if uploaded
            if ($filename != '') {
                $type1 = explode('.', $filename);
                $type2 = end($type1);
                $newimage = 'img' . time() . '.' . $type2;
                $tipefile = array("jpg", "jpeg", "png", "webp");

                if (!in_array($type2, $tipefile)) {
                    echo "<script>alert('Format File Tidak Dizinkan');</script>";
                } else {
                    unlink("../img/asset/kategori/" . $fotoLama);
                    if (move_uploaded_file($tmpname, '../img/asset/kategori/' . $newimage)) {
                        $nama_gambar = $newimage;
                    } else {
                        $nama_gambar = $fotoLama;
                    }
                }
            } else {
                $nama_gambar = $fotoLama;
            }

			$update=mysqli_query($conn,"UPDATE tbl_category SET 
			category_name='$nama_menu', image='$newimage' WHERE category_id='$k->category_id' ");

			if ($update) {
				echo "<p style='color : green'>Update Success</p>";
				echo "<script>window.location='kategori.php'</script>";
			}
			else {
				echo "<p style='color : red'>Update Failed</p>";
			}
		}
	?>
    </section>


<?php include 'layout/footer.php' ?>