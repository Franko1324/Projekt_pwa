<?php

session_start();

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $picture = $_FILES['slika']['name'];
    $title=$_POST['naslov'];
    $about=$_POST['sazetak'];
    $content=$_POST['tekst'];
    $category=$_POST['kategorija'];
    $date=date('d.m.Y.');
    if(isset($_POST['arhiva'])){
     $archive=1;
    }else{
     $archive=0;
    }
    
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["slika"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    
    
    
    if ($uploadOk == 0) {
        echo '<script>alert("Upload neuspjesan")</script>';
    } else {
    
        if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
            $file_directory = $target_file;
    
            echo '<script>alert("Uspjesan upload")</script>'; 
        };
    }
    
    $query = "INSERT INTO clanci (datum, naslov, sazetak, tekst, slika, kategorija,
    arhiva ) VALUES ('$date', '$title', '$about', '$content', '$target_file',
    '$category', '$archive')";
    
    $result = mysqli_query($conn, $query) or die('Error querying databese.');
    }

$conn->close();
?>