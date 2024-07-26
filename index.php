<?php

include 'database/db.php';

$produk = mysqli_query($conn, "SELECT * FROM tbl_product ORDER BY category_id");

if (isset($_POST['cari'])) {

  $keyword = $_POST['search-box'];

  $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE product_name LIKE '%$keyword%' ");
  // if($produk==true){

  //   header("location:#menu");

  //   }
  //   else{
  //     echo "<script> alert('Data Tidak Ditemukan') </script>";
  //   }
}

if (isset($_GET['kat'])) {
  $category = $_GET['kat'];
  $produk = mysqli_query($conn, "SELECT * FROM tbl_product WHERE category_id=$category ORDER BY category_id");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cateringku</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet" />

  <!-- Bootstrap 4.1.3 CSS -->
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"> -->

  

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- My CSS Style -->
  <link rel="stylesheet" href="style.css" />

  <style>
    .footer {
      background-color: #222;
      color: #ddd;
      padding-top: 40px;
      padding-bottom: 20px;
      font-family: 'Poppins', sans-serif;
    }

    .footer h5 {
      color: #fff;
      font-weight: 600;
      margin-bottom: 20px;
    }

    .footer p,
    .footer a {
      color: #aaa;
      font-size: 14px;
      line-height: 1.7;
    }

    .footer a:hover {
      color: #bb6a00;
      text-decoration: none;
    }

    .footer .social-icons a {
      display: inline-block;
      margin-right: 15px;
      font-size: 20px;
      transition: color 0.3s ease;
    }

    .footer .social-icons a:hover {
      color: #bb6a00;
    }

    .footer .list-unstyled {
      padding-left: 0;
      list-style: none;
    }

    .footer .text-warning {
      color: #bb6a00 !important;
    }
  </style>
</head>

<body>
  <!-- Navbar Start-->
  <nav class="navbar">
    <a href="index.html" class="navbar-logo">Catering<span>ku</span>.</a>
    <div class="navbar-nav">
      <a href="#home">Home</a>
      <a href="#about">Tentang Kami</a>
      <a href="#menu">Menu</a>
      <a href="#contact">Contact</a>

      <!-- Login Navbar For Mobile -->
      <a href="login/login.php" class="nav login" id="login">Log-in / Sign-up</a>
    </div>

    <div class="navbar-extra">
      <a href="#" id="search-button"> <i data-feather="search"></i></a>
      <a href="#" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
      <a href="#" id="hamburger-menu"> <i data-feather="menu"></i></a>
      <!-- Login Navbar -->
      <a href="login/login.php" class="login" id="user login">Log-in / Sign-up</a>
    </div>

    <!-- Search Form start -->
    <div class="search-form">
      <form action="" method="post">
        <input name="search-box" type="search" id="search-box" placeholder="search here...">
        <!-- <label for="search-box"><i data-feather="search"></i></label> -->

        <button name="cari" type="submit"><i data-feather="search"></i></button>
      </form>
    </div>
    <!-- Search Form end -->


  </nav>
  <!-- Navbar End-->

  <!-- Hero Section Start -->
  <section class="hero-section" id="home">
    <main class="content">

      <h1>Pesan <span>Makanan Favorit Anda</span> dengan Mudah</h1>
      <p>Cateringku menyediakan layanan pesan antar makanan yang cepat dan lezat. Nikmati berbagai pilihan menu sehat dan lezat kami!</p>
      <a href="#menu" class="btn-beli">Lihat Menu</a>


    </main>
  </section>
  <!-- Hero Section End-->

  <!-- About Section Start -->
  <section class="about" id="about">
    <h2><span>Tentang</span> Kami</h2>
    <div class="subjudul">
      <p>INI ADALAH MENGENAI CERITA DAN PERJALANAN KAMI</p>
    </div>

    <div class="row">
      <div class="about-img">
        <img src="img/asset/about/about-us-cateringku3.jpg" alt="" srcset="" height="600px" width="400px" />
      </div>
      <div class="content">
        <h3>Apa Itu Cateringku ?</h3>
        <p>Cateringku adalah layanan katering online yang berdedikasi untuk menyediakan makanan sehat dan lezat kepada pelanggan kami. Kami percaya bahwa makanan yang baik dapat membuat hidup lebih baik.</p>
        <h3>Misi Kami</h3>
        <p>Memberikan pengalaman kuliner yang luar biasa dengan kualitas makanan yang terbaik dan pelayanan yang ramah.</p>
      </div>
    </div>
  </section>
  <!-- About Section End -->

  <!-- Menu Section Start -->
  <section class="menu" id="menu">
    <h2><span>Pilihan</span> Menu</h2>
    <p>Makanan cepat dan enak di cateringku solusinya!</p>

    <!-- Kategori -->
    <div class="category">
      <h3>Kategori</h3>
      <div class="category-container">
        <?php
        $kategori = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id ASC");
        if (mysqli_num_rows($kategori) > 0) :
          while ($k = mysqli_fetch_assoc($kategori)) :
        ?>
            <a href="user.php?kat=<?php echo $k['category_id']; ?>#menu" class="category-card">
              <div class="category-icon">
                <i data-feather="tag"></i>
              </div>
              <div class="category-name">
                <?php echo $k['category_name']; ?>
              </div>
            </a>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>

    <div class="row">

      <?php while ($p = mysqli_fetch_object($produk)) : ?>
        <div class="menu-card">
          <img class="menu-card-img" src="img/asset/menu/<?php echo $p->product_image ?>" alt="Menu" />
          <h3 class="menu-card-title">~ <?php echo $p->product_name ?> ~</h3>
          <p class="menu-card-price">Rp.<?php echo $p->product_price ?></p>
          <a class="beli-menu" href="#">Beli Sekarang</a>
        </div>

      <?php endwhile; ?>
    </div>

   
  </section>
  <!-- Menu Section End -->

  <!-- Contact Section Start -->
  <section class="contact" id="contact">
    <h2>Kontak <span>Kami</span></h2>
    <p>HUBUNGI KAMI JIKA ADA YANG INGIN DITANYAKAN</p>

    <div class="row">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.597407767157!2d106.65815551409116!3d-6.184599362317558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f91c36836213%3A0x6352737102ead164!2sGg.%20Annur%2C%20RW.001%2C%20Poris%20Plawad%20Utara%2C%20Kec.%20Cipondoh%2C%20Kota%20Tangerang%2C%20Banten%2015141!5e0!3m2!1sid!2sid!4v1675228682362!5m2!1sid!2sid" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      <form action="" method="get">
        <div class="input-group">
          <i data-feather="user"></i>
          <input type="text" name="nama" id="nama" placeholder="nama" />
        </div>

        <div class="input-group">
          <i data-feather="mail"></i>
          <input type="email" name="email" id="email" placeholder="email" />
        </div>

        <div class="input-group">
          <i data-feather="phone"></i>
          <input type="text" name="phone" id="phone" placeholder="+62" />
        </div>

        <button type="submit">Kirim Pesan</button>
      </form>
    </div>
  </section>
  <!-- Contact Section End  -->

 

  <!-- Footer Start -->
  <footer class="footer bg-dark text-light pt-4">
    <div class="container">
      <div class="row">
        <!-- About Section -->
        <div class="col-md-4">
          <h5>About Cateringku.</h5>
          <p>Cateringku is committed to providing the best ordering food experience. We serve freshly food, drink, and delicious food.</p>
        </div>

        <!-- Quick Links Section -->
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a class="text-light" href="#">Home</a></li>
            <li><a class="text-light" href="#">Products</a></li>
            <li><a class="text-light" href="#">About Us</a></li>
            <li><a class="text-light" href="#">Contact</a></li>
          </ul>
        </div>

        <!-- Social Media Section -->
        <div class="col-md-4">
          <h5>Follow Us</h5>
          <div class="social-icons">
            <a target="_blank" href="" class="text-light"><i data-feather="twitter"></i></a>
            <a target="_blank" href="" class="text-light"><i data-feather="instagram"></i></a>
            <a target="_blank" href="" class="text-light"><i data-feather="github"></i></a>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12 text-center">
          <p class="mb-0">Created by <a class="text-warning" href="#">Cateringku</a> | &copy; 2024. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->

  
  <!-- Feather Icons -->
  <script>
    feather.replace();
  </script>

  <!-- My Javascript-->
  <script src="js/script.js"></script>
</body>

</html>