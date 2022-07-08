<?php

    include("data_class.php");

    $name=$_POST['addname'];
    $pasword= $_POST['addpassword'];
    $email= $_POST['addemail'];
    $type= $_POST['addtype'];

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"upload/" . $_FILES["fileToUpload"]["name"])) {
        $photo=$_FILES["fileToUpload"]["name"];
        $obj=new data();
        $obj->setconnection();
        $obj->addregisteruser($name,$pasword,$email,$photo,$type);
    } 
    else {
        echo "File not uploaded";
    }
    
?>