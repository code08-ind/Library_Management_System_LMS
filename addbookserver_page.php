<?php

  include("data_class.php");

  $bookname=$_POST['bookname'];
  $bookdetail=$_POST['bookdetail'];
  $bookauthor=$_POST['bookauthor'];
  $bookpub=$_POST['bookpub'];
  $branch=$_POST['branch'];
  $bookprice=$_POST['bookprice'];
  $bookrent=$_POST['bookrent'];
  $bookquantity=$_POST['bookquantity'];
  $bookava=$_POST['bookava'];


  if (move_uploaded_file($_FILES["bookphoto"]["tmp_name"],"uploads/" . $_FILES["bookphoto"]["name"])) {
    $bookpic=$_FILES["bookphoto"]["name"];
    $obj=new data();
    $obj->setconnection();
    $obj->addbook($bookpic, $bookname, $bookdetail, $bookauthor, $bookpub, $branch, $bookprice, $bookrent, $bookquantity, $bookava);
  } 
  else {
    echo "File not uploaded";
  }
  
?>