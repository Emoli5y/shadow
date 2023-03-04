<?php
include_once "../server/rolecontrol.php";
$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>',
    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.all.min.js"></script>'
);

$page_title = 'Soy Ağacı Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

?>
<!--<div class="page-content">-->
<!--BAŞLANGIC-->
<?php

$customCSS = array(
    '<link href="../assets/plugins/DataTables/datatables.min.css" rel="stylesheet">',
    '<link href="../assets/plugins/DataTables/style.css" rel="stylesheet">'
);
$customJAVA = array(
    '<script src="../assets/plugins/DataTables/datatables.min.js"></script>',
    '<script src="../assets/plugins/printer/main.js"></script>',
    '<script src="../assets/js/pages/datatables.js"></script>'

);

$page_title = 'TC Sorgu';
include('inc/header_main.php');
include('inc/header_sidebar.php');
include('inc/header_native.php');

include "../../server/webhook.php";
include "../../server/cooldown.php";

@session_start();

$kadi = $_SESSION["k_adi"];

?>
<div class="arama">
                <form method="post">
				
				
				                            <input require maxlength="30" class="form-control" type="text" name="ad" id="ad" placeholder="TC"><br>


                <input type="submit" name="ara">
  

     <button onclick="checkNumber()" id="sorgula" name="yolla" class="btn waves-effect waves-light btn-rounded btn-success" style="width: 120px; height: 45px; outline: none; margin-left: 5px;"><i class="fas fa-search"></i> Sıfırla <span id="sorgulanumber"></span></button>
                            
                        </center>
                        <div class="table-responsive">

                            <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Yakınlık</th>
                                        <th>TCKN</th>
                                        <th>Ad</th>
                                        <th>Soyad</th>
                                        <th>Doğum Tarihi</th>
                                        <th>Nüfus İl</th>
                                        <th>Nüfus İlçe</th>
                                        <th>Anne Adı</th>
                                        <th>Anne TC</th>
                                        <th>Baba Adı</th>
                                        <th>Baba TC</th>
                                        <th>UYRUK</th>
                                    </tr>
                                </thead>
                                <tbody id="jojjoojj">
                                </tbody>

        <tbody>
            <?php

            $baglanti = new mysqli('localhost', 'root', '', '101m');
            if (isset($_POST["ara"])) {
				
                $str = $_POST["ad"];
                $sth = $baglanti->prepare("SELECT * FROM `101m`");
            // read all row from database table
			$sql = "SELECT * FROM `101m` WHERE `TC` = '$str'";
			$result = $baglanti->query($sql);

            // read data of each row
			while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td> KENDİSİ </td>
                    <td>" . $row["TC"] . "</td>
                    <td>" . $row["ADI"] . "</td>
                    <td>" . $row["SOYADI"] . "</td>
                    <td>" . $row["DOGUMTARIHI"] . "</td>
                    <td>" . $row["ANNEADI"] . "</td>
                    <td>" . $row["ANNETC"] . "</td>
                    <td>" . $row["BABAADI"] . "</td>
                    <td>" . $row["BABATC"] . "</td>
                    <td>" . $row["NUFUSIL"] . "</td>
                    <td>" . $row["NUFUSILCE"] . "</td>
                    <td>" . $row["UYRUK"] . "</td>
                </tr>";
                $sqlcocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                $resultcocugu = $baglanti->query($sqlcocugu);

                $sqlkardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                $resultkardesi = $baglanti->query($sqlkardesi);
                $sqlbabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                $resultbabasi = $baglanti->query($sqlbabasi);
                $sqlanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                $resultanasi = $baglanti->query($sqlanasi);

                $sqlkendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                $resultkendicocugu = $baglanti->query($sqlkendicocugu);
                while($row = $resultkendicocugu->fetch_assoc()) {
                    echo "<tr>
                        <td> ÇOCUĞU </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        <td>" . $row["UYRUK"] . "</td>
                    </tr>";
                    $sqlkendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                    $resultkendikendicocugu = $baglanti->query($sqlkendikendicocugu);    
                    while($row = $resultkendikendicocugu->fetch_assoc()) {
                        echo "<tr>
                            <td> TORUNU </td>
                            <td>" . $row["TC"] . "</td>
                            <td>" . $row["ADI"] . "</td>
                            <td>" . $row["SOYADI"] . "</td>
                            <td>" . $row["DOGUMTARIHI"] . "</td>
                            <td>" . $row["ANNEADI"] . "</td>
                            <td>" . $row["ANNETC"] . "</td>
                            <td>" . $row["BABAADI"] . "</td>
                            <td>" . $row["BABATC"] . "</td>
                            <td>" . $row["NUFUSIL"] . "</td>
                            <td>" . $row["NUFUSILCE"] . "</td>
                            <td>" . $row["UYRUK"] . "</td>
                        </tr>";

                while($row = $resultkardesi->fetch_assoc()) {
                    echo "<tr>
                        <td> KARDEŞİ </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        <td>" . $row["UYRUK"] . "</td>
                    </tr>";

                        
    

                while($row = $resultanasi->fetch_assoc()) {
                    echo "<tr>
                        <td> ANNESİ>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        <td>" . $row["UYRUK"] . "</td>
                    </tr>";

                                }
                            }

                        }
               while($row = $resultbabasi->fetch_assoc()) {
                    echo "<tr>
                        <td> BABASI </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        <td>" . $row["UYRUK"] . "</td>
                    </tr>";
                    $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                    $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                    $sqlbabababasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                    $resultbabababasi = $baglanti->query($sqlbabababasi);
                    $sqlbabaanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                    $resultbabaanasi = $baglanti->query($sqlbabaanasi);
    

}
                while($row = $resultanasi->fetch_assoc()) {
                    echo "<tr>
                        <td> Annesi </td>
                        <td>" . $row["TC"] . "</td>
                        <td>" . $row["ADI"] . "</td>
                        <td>" . $row["SOYADI"] . "</td>
                        <td>" . $row["DOGUMTARIHI"] . "</td>
                        <td>" . $row["ANNEADI"] . "</td>
                        <td>" . $row["ANNETC"] . "</td>
                        <td>" . $row["BABAADI"] . "</td>
                        <td>" . $row["BABATC"] . "</td>
                        <td>" . $row["NUFUSIL"] . "</td>
                        <td>" . $row["NUFUSILCE"] . "</td>
                        <td>" . $row["UYRUK"] . "</td>
                    </tr>";
                    $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                    $resultannekardesi = $baglanti->query($sqlannekardesi);
                    $sqlannebabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                    $resultannebabasi = $baglanti->query($sqlannebabasi);
                    $sqlanneanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                    $resultanneanasi = $baglanti->query($sqlanneanasi);
                        }
                        }
						
                    }
    
                }
            

            ?>
        </tbody>
    </table>        
  
<?php
include('inc/footer_native.php');
include('inc/footer_main.php');
?>