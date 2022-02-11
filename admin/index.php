<?php
  require("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

//get data
//ambil data total
//harus refresh
$get1 = mysqli_query($koneksi,"SELECT * FROM datasuhu WHERE DATE(waktu) = CURDATE()");
$count1 = mysqli_num_rows($get1); //menghitung seluruh kolom

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home - Monitoring New Normal</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">	

		<!-- cek apakah sudah login -->
		<?php 
		session_start();
		if($_SESSION['status']!="login"){
			header("location:../index.php?pesan=belum_login");
		}
		?>

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Screening</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>                   
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!---h1 class="mt-4">Home</h1--->
                        <ol class="breadcrumb mb-4">
                            <!--- li class="breadcrumb-item active">Home</li --->
                        </ol>


                        <div class="row">

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Deteksi Masker
                                    </div>
                                    <div class="card-body">
                                        <center>
                                           <button id='start_button' type="button" onclick="init()">Aktifkan Kamera</button> 
                                           
                                            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
                                            <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
                                            <script type="text/javascript" src="script.js"></script>
                                            <div id="label-container"></div>
                                            <div id="webcam-container"></div></center>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4 h5">
                                    <div class="card-body">
                                             <!--- Pengunjung ke : <?=$count1;?> dari 100 --->
                                             Cek Suhu Tubuh
                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between h5">
                                        <table>
                                             <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
                                             <script type="text/javascript" src="fungsi.js"></script>
                                        </table>
                                    </div>
                                </div>
                            </div>

                       


<!--   table               <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Data Suhu Tubuh
                                    </div>

                                    <div class="card-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Suhu</th>
                                                    <th>Waktu</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <?php

                                            $sql = mysqli_query($koneksi, "SELECT * FROM datasuhu ORDER BY id DESC");

                                            if(mysqli_num_rows($sql) == 0){ 
                                             echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
                                             }else{ // jika terdapat entri maka tampilkan datanya
                                               $no = 1; // mewakili data dari nomor 1
                                               while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
                                                echo '
                                              <tr>
                                                <td>'.$no.'</td>
                                                <td>'.$row['data'].' °C </td>
                                                <td>'.$row['waktu'].'</td>
                                                <td>'.($row['data'] > 37.50 ? 'Tinggi' : 'Normal').'</td>
                                              </tr>               
                                              ';
                                              $no++; // mewakili data kedua dan seterusnya
                                              }
                                            }
                                            ?>
                                        </table>                                        
                                    </div>

                                </div>
                            </div> 
 --> 

                        </div>                        

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
	</body>
</html>

<!-- Warna teks link : Clouds -->