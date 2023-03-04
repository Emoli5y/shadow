<html>
  <head>
    <style>
      body {
        background-image: url('/assets/images/arkaplan.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
      }
    </style>
  </head>
  <body>
</html>

<?php
include_once "../server/rolecontrol.php";

$customCSS = array('<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
'<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>',
    '<script src="../assets/plugins/jquery.toast/jquery.toast.js"></script>'

);

$page_title = 'Ad Soyad Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

include "../api/2022/patient.php";

?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
      <div class="content-body">
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title mb-1">Ad Soyad Sorgu</h4>
                            </div>
                            <form action="proadsoyad" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <section id="floating-label-input">
                                            <div class="row">

                                                <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                                                    <div class="form-floating">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="basicInput">Adı :</label>
                                                            <input type="text" class="form-control" name="txtad" placeholder="Kişinin Adını Girin" />
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-sm-6 col-12 mb-1 mb-sm-0">
                                                    <div class="form-floating">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="basicInput">Soyadı :</label>
                                                            <input type="text" class="form-control" name="txtsoyad" placeholder="Kişinin Soyadını Girin" />
                                                        </div>
                                                    </div>
                                                </div>
												 <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                                                    <div class="form-floating">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="basicInput">Yaşadığı İl :</label>
                                                            <input type="text" class="form-control" name="txtil" placeholder="Kişinin Yaşadığı İli Girin" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <div class="card-header">
                                        <center class="nw">
                                <button onclick="checkNumber()" id="sorgula" class="btn waves-effect waves-light btn-rounded btn-primary btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
                                    <span><i class="fas fa-search"></i> Sorgula </span></button>
                                <button onclick="clearResults()" id="durdurButon" class="btn waves-effect waves-light btn-rounded btn-danger btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
                                    <span><i class="fas fa-trash-alt"></i> Sıfırla </span></button>
                                <button onclick="printTable()" id="yazdirTable" class="btn waves-effect waves-light btn-rounded btn-warning btn-new" style="width: 180px; height: 45px; outline: none; margin-left: 5px;">
                                    <span><i class="fas fa-print"></i> Yazdır Detay </span></button><br><br>
                            </center>
                                        </div>
										<br>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <div class="content-body">
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table id="example2" class="table">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>TCKN</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Doğum Tarihi</th>
                                            <th>İl</th>
                                            <th>İlçe</th>
                                            <th>Anne Adı</th>
                                            <th>Anne TC</th>
                                            <th>Baba Adı</th>
                                            <th>Baba TC</th>
                                            <th>Uyruk</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    if ($_POST) {
                                        
                                        $ad = $_POST['txtad'];

                                        $soyad = $_POST['txtsoyad'];
										
                                        $il = $_POST['txtil'];

                                        date_default_timezone_set('Europe/Istanbul');

                                        $datetimenow = date('d.m.y H:i:s');

                                        session_start();



                                        $db = new PDO("mysql:host=localhost;dbname=101m;charset=utf8", "root", "");

                                        if ($il != "") 
										{
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad' AND NUFUSIL = '$il'");
                                        }										
										else {
                                            $query = $db->query("SELECT * FROM 101m WHERE ADI = '$ad' AND SOYADI = '$soyad'");
                                        }
										
										

                                        while ($data = $query->fetch()) {

                                    ?>
                                    <tbody>
                                            <tr style="text-align: center;">
                                                    <td> <?php echo $data['TC']; ?> </td>
                                                    <td> <?php echo $data['ADI']; ?> </td>
                                                    <td> <?php echo $data['SOYADI']; ?> </td>
                                                    <td> <?php echo $data['DOGUMTARIHI']; ?> </td>
													<td> <?php echo $data['NUFUSIL']; ?> </td>
                                                    <td> <?php echo $data['NUFUSILCE']; ?> </td>
                                                    <td> <?php echo $data['ANNEADI']; ?> </td>
                                                    <td> <?php echo $data['ANNETC']; ?> </td>
                                                    <td> <?php echo $data['BABAADI']; ?> </td>
                                                    <td> <?php echo $data['BABATC']; ?> </td>
                                                    <td> <?php echo $data['UYRUK']; ?> </td>

 
                                            </tr>
                                        <?php } }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      
 
    </div>
    <!--BİTİŞ-->
    <?php
    include('inc/footer_native.php');
    include('inc/footer_main.php');
    ?>