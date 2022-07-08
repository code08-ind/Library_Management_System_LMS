<?php

    include("data_class.php");

    $addnames=$_POST['addname'];
    $addpass= $_POST['addpass'];
    $addemail= $_POST['addemail'];
    $type= $_POST['type'];

    if (move_uploaded_file($_FILES["userphoto"]["tmp_name"],"uploads/" . $_FILES["userphoto"]["name"])) {
        $photo=$_FILES["userphoto"]["name"];
        $obj=new data();
        $obj->setconnection();
        $obj->addnewuser($addnames,$addpass,$addemail,$photo,$type);
    } 
    else {
        echo "File not uploaded";
    }
    
?>