<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json;charset=UTF-8");
    $data = "";
    $conn = new mysqli("localhost", "root", "", "kuliah_online");
    $querys = "SELECT COALESCE(jenis_kelamin, 'Total') AS 'jenis_kelamin', ".
            " SUM(IF(pendidikan='TK',1,0)) AS 'TK', ".
            " SUM(IF(pendidikan='SD',1,0)) AS 'SD', ".
            " SUM(IF(pendidikan='SLTP',1,0)) AS 'SLTP', ".
            " SUM(IF(pendidikan='SLTA',1,0)) AS 'SLTA', ".
            " SUM(IF(pendidikan='D1',1,0)) AS 'D1', ".
            " SUM(IF(pendidikan='D2',1,0)) AS 'D2', ".
            " SUM(IF(pendidikan='D3',1,0)) AS 'D3', ".
            " SUM(IF(pendidikan='S1',1,0)) AS 'S1', ".
            " SUM(IF(pendidikan='S2',1,0)) AS 'S2', ".
            " SUM(IF(pendidikan='S3',1,0)) AS 'S3', ".
            " COUNT(*) AS total ".
            " FROM data GROUP BY jenis_kelamin WITH ROLLUP";
    $result = $conn->query($querys);
    while($rs = $result->fetch_array(MYSQLI_ASSOC)){
        $data = $data.($data != "" ? "," : "")."{
            'jenis_kelamin':    '$rs[jenis_kelamin]',
            'TK':               '$rs[TK]',
            'SD':               '$rs[SD]',
            'SLTP':             '$rs[SLTP]',
            'SLTA':             '$rs[SLTA]',
            'D1':               '$rs[D1]',
            'D2':               '$rs[D2]',
            'D3':               '$rs[D3]',
            'S1':               '$rs[S1]',
            'S2':               '$rs[S2]',
            'S3':               '$rs[S3]',
            'total':            '$rs[total]'
        }";
    }
    $conn->close();
    $data = "{'records':[$data]}";
    $data = str_replace("'", "\"", $data);
    echo($data);

?>