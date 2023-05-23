<?php

    //koneksi ke database dnegan PDO
    $connect = new PDO("mysql:host=localhost;dbname=smk", "root", "");
    $received_data = json_decode(file_get_contents("php://input"));

    //membuat variabel data
    //variabel ini akan digunakan untuk menampung data dari database nantinya
    $data = array();

    //script untuk menampilkan semua data
    if($received_data->action == 'fetchall')
    {
        //perintah untuk mengambil data dari database
        $query      = "SELECT * FROM siswa ORDER BY id DESC limit 2";
        $statement  = $connect->prepare($query);
        $statement->execute();

        //melakukan perulangan dan memasukan tiap data ke dalam variabel data
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        
        //menampilkan data dalam bentuk json
        echo json_encode($data);
    }

?>