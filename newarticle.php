<?php
include('connection.php');
$titre=$_POST['titre'];
$image=$_FILES['image']["name"];
$article=$_POST['article'];

//var_dump($_FILES);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}



$req = $pdo->prepare("INSERT INTO listearticle (titre, image, article) VALUES (:titre, :image, :article)");

//$req->bindParam('titre',$titre);
//$req->bindParam('image',$image);
//$req->bindParam('aticle',$article);
//$req->execute();




$req->execute(array(

    'titre' => $titre,

    'image' => $image,

    'article' => $article

));

header('location:info.php');

