<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json;charset=UTF-8");
    $data = "";
    $conn = new mysqli("localhost", "root", "", "kuliah_online");
    $result = $conn->query("SELECT * FROM data");
    while($rs = $result->fetch_array(MYSQLI_ASSOC)){
        $data = $data.($data != "" ? "," : "")."{
            'nama':             '$rs[nama]',
            'tanggal_lahir':    '$rs[tanggal_lahir]',
            'jenis_kelamin':    '$rs[jenis_kelamin]',
            'golongan_darah':   '$rs[golongan_darah]',
            'agama':            '$rs[agama]',
            'pendidikan':       '$rs[pendidikan]',
            'pekerjaan':        '$rs[pekerjaan]',
            'alamat':           '$rs[alamat]',
            'penghasilan':      '$rs[penghasilan]'
        }";
    }
    $conn->close();
    $data = "{'records':[$data]}";
    $data = str_replace("'", "\"", $data);
    echo($data);

?>