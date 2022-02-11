<?php
    include("koneksi.php");
    $sql = mysqli_query($koneksi, "SELECT * FROM datasuhu ORDER BY id DESC LIMIT 1");
    $result = array();
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(array("result" => $data));
?>