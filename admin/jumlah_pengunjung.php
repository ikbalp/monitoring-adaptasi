<?php
    include("koneksi.php");
    $get1 = mysqli_query($koneksi,"SELECT * FROM datasuhu WHERE DATE(waktu) = CURDATE()");
	$count1 = mysqli_num_rows($get1); //menghitung seluruh kolom

	$result = array();

    echo json_encode(array("result" => $count1));

?>


