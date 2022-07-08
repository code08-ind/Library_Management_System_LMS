<?php

  include('data_class.php');
  // session_start();

  // $adminid = $_SESSION['adminid'];
  // echo $adminid;
  // if($adminid==null){
  //     header("Location:index.php");
  // }

  $userloginid = $_SESSION["adminid"];

  if(empty($_SESSION['adminid'])){
    header("Location:indexs.php?msg=Login First");
  }

?>

<!Doctype html>

<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" 
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/225/225932.png" type="image/x-icon">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" integrity="sha512-IXuoq1aFd2wXs4NqGskwX2Vb+I8UJ+tGJEu/Dc0zwLNKeQ7CW3Sr6v0yU3z5OQWe3eScVIkER4J9L7byrgR/fA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <title>Library Management System</title>
  </head>

  <body>
    <h1 class="maintext text-center" style="font-weight: bold; margin-top:20px;margin-bottom:-50px;border:0px;">Library Management System (LMS)</h1>
    <?php
    $msg="";
  if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
  }

  if($msg=="done"){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Sucssefully Done <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button></div>";
  }
  elseif($msg=="fail"){
      echo "<div class='alert alert-danger alert-dismissible fade show'' role='alert'>Fail <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span></div>";
  }

?>
    <div class="container">
      <div class="innerdiv">
        <div class="leftinnerdiv">
        <a href="admin_service_dashboard.php"><Button class="greenbtn"><span><img height="35px" src="images/admin.png" alt="Admin"/> ADMIN</span></Button></a>
          <Button class="greenbtn" onclick="openpart('addbook')"><span><img height="35px" src="images/addbook.png" alt="Admin"/> ADD NEW BOOK</span></Button>
          <Button class="greenbtn" onclick="openpart('bookreport')"><span><img height="35px" src="images/bookreport.png" alt="Admin"/> BOOK REPORT</span></Button>
          <Button class="greenbtn" onclick="openpart('bookrequestapprove')"><span><img height="35px" src="images/bookrequest.png" alt="Admin"/> BOOK REQUESTS</span></Button>
          <Button class="greenbtn" onclick="openpart('addperson')"><span><img height="35px" src="images/addstudent.png" alt="Admin"/> ADD NEW USER</span></Button>
          <Button class="greenbtn" onclick="openpart('studentrecord')"><span><img height="35px" src="images/studentreport.png" alt="Admin"/> USER REPORT</span></Button>
          <Button class="greenbtn"  onclick="openpart('issuebook')"><span><img height="35px" src="images/issuebook.png" alt="Admin"/> ISSUE BOOK</span></Button>
          <Button class="greenbtn" onclick="openpart('issuebookreport')"><span><img height="35px" src="images/issuereport.png" alt="Admin"/> ISSUE REPORT</span></Button>
          <a href="indexs.php"><Button class="greenbtn"><span><img height="35px" src="images/logout.png" alt="Admin"/> LOGOUT</span></Button></a>
        </div>
        <div class="rightinnerdiv">   
          <div id="addperson" class="innerright portion" style="display:none">
            <Button class="greenbtn">ADD NEW USER</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
              <input type="text" name="addname" placeholder="Enter Name"/>
              </br>
              <input type="email" name="addemail" placeholder="Enter Email"/>
              </br>
              <input type="password" name="addpass" placeholder="Enter Password"/>
              </br>
              <label for="type">Choose Type:</label>
              <select name="type" >
                  <option value="Student">Student</option>
                  <option value="Teacher">Teacher</option>
              </select>
              <br>
              <label for="file-upload" class="custom-file-upload">
              <i class="fa-solid fa-cloud-arrow-up"></i> Upload User Image
              </label>
              <input id="file-upload" name="userphoto" type="file"/>
              <input type="submit" value="ADD NEW USER" id="submit"/>
            </form>
          </div>
        </div>

        <!-- ISSUE BOOK RECORD -->

        <div class="rightinnerdiv">   
          <div id="issuebookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn">Issue Book Record</Button>
            <?php

              $u=new data;
              $u->setconnection();
              $u->issuereport();
              $recordset=$u->issuereport();

              $table="<table class='table table-striped' style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr style='border:1px solid #ccc;border-radius:20px;'><th style='
              padding: 8px;background-color: orange;' scope='col'>Issue Name</th><th style='background-color: orange;' scope='col'>Book Name</th><th style='background-color: orange;' scope='col'>Issue Date</th><th style='background-color: orange;' scope='col'>Return Date</th><th style='background-color: orange;' scope='col'>Fine</th><th style='background-color: orange;' scope='col'>Issue Type</th>
              <th style='background-color: orange;' scope='col'>Return</th></tr>";

              foreach($recordset as $row){
                $table.="<tr style='border:1px solid #ccc;border-radius:20px;'>";
                "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td><a href='admin_service_dashboard.php?returnid=$row[0]'><Button class='btn btn-info my-2'>Return</Button></a></td>";
                $table.="</tr>";
              }
              $table.="</table>";
              echo $table;

            ?>
          </div>
        </div>

        <div class="rightinnerdiv">   
          <div id="bookrequestapprove" class="innerright portion" style="display:none">
            <Button class="greenbtn" >BOOK REQUEST APPROVE</Button>

            <?php

              $u=new data;
              $u->setconnection();
              $u->requestbookdata();
              $recordset=$u->requestbookdata();

              $table="<table class='table table-striped' style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr style='border:1px solid #ccc;border-radius:20px;'><th style='
              padding: 8px;' scope='col'>Person Name</th><th scope='col'>Person Type</th><th scope='col'>Book Name</th><th scope='col'>Days </th><th scope='col'>Approve</th></tr>";
              foreach($recordset as $row){
                $table.="<tr style='border:1px solid #ccc;border-radius:20px;'>";
                "<td>$row[0]</td>";
                "<td>$row[1]</td>";
                "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approve BOOK</button></a></td>";
                $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                $table.="</tr>";
              }
              $table.="</table>";
              echo $table;

            ?>

          </div>
        </div>

        <!-- ISSUE BOOK -->
        <div class="rightinnerdiv">   
          <div id="issuebook" class="innerright portion" style="display:none">
            <Button class="greenbtn">ISSUE BOOK</Button>
            <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
              <label for="book">Choose Book :</label>
              <select name="book" >
                <?php

                  $u=new data;
                  $u->setconnection();
                  $u->getbookissue();
                  $recordset=$u->getbookissue();
                  foreach($recordset as $row){
                    echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
                  }   

                ?>
              </select>

              <label for="Select Student"> User :</label>
              <select name="userselect" >
                <?php

                  $u=new data;
                  $u->setconnection();
                  $u->userdata();
                  $recordset=$u->userdata();
                  foreach($recordset as $row){
                    $id= $row[0];
                    echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                  } 

                ?>
              </select>
              <br>
              Days:  <input type="number" name="days"/>
              <input type="submit" value="SUBMIT"/>
            </form>
          </div>
        </div>
        <div class="rightinnerdiv">   
          <div id="bookdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>"> 
            <Button class="greenbtn" >BOOK DETAIL</Button>
            </br>
            <?php

              $u=new data;
              $u->setconnection();
              $u->getbookdetail($viewid);
              $recordset=$u->getbookdetail($viewid);
              foreach($recordset as $row){
                $bookid= $row[0];
                $bookimg= $row[1];
                $bookname= $row[2];
                $bookdetail= $row[3];
                $bookauthor= $row[4];
                $bookpub= $row[5];
                $branch= $row[6];
                $bookprice= $row[7];
                $bookquantity= $row[8];
                $bookrent= $row[9];
              }    

            ?>
            <div class="container mt-3" style='border:1px solid rgb(216, 216, 216); ;'>
              <div class="row">
                <div class="col-md-4">
                  <img width='250px' height='250px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
                </div>
                <div class="col-md-8">
                  <p style="color:black"><span>Name: </span> &nbsp&nbsp<?php echo $bookname ?></p>
                  <p style="color:black"><span>Details: </span> &nbsp&nbsp<?php echo $bookdetail ?></p>
                  <p style="color:black"><span>Author: </span> &nbsp&nbsp<?php echo $bookauthor ?></p>
                  <p style="color:black"><span>Publisher: </span> &nbsp&nbsp<?php echo $bookpub ?></p>
                  <p style="color:black"><span>Branch: </span> &nbsp&nbsp<?php echo $branch ?></p>
                  <p style="color:black"><span>Price: </span> &nbsp&nbsp<?php echo $bookprice ?></p>
                  <p style="color:black"><span>Rent: </span> &nbsp&nbsp<?php echo $bookrent ?></p>
                  <p style="color:black"><span>Quantity: </span> &nbsp&nbsp<?php echo $bookquantity ?></p>
                </div>
              </div>
            </div>
            </br>
          </div>
        </div>
        <div class="rightinnerdiv">   
          <div id="bookreport" class="innerright portion" style="display:none">
            <Button class="greenbtn">BOOK RECORD</Button>
            <?php

              $u=new data;
              $u->setconnection();
              $u->getbook();
              $recordset=$u->getbook();

              $table="<table class='table table-striped' style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;margin-top:5px'><tr style='border:1px solid #ccc;border-radius:20px;'><th style='padding: 8px;' scope='col'>Name</th><th scope='col'>Price</th><th scope='col'>Quantity</th><th scope='col'>Details</th><th scope='col'>Rent</th><th scope='col'>View</th><th scope='col'>Delete</th></tr>";

              foreach($recordset as $row){
                $table.="<tr style='border:1px solid #ccc;border-radius:20px;margin-left:10px;'>";
                "<td>$row[0]</td>";
                $table.="<td class='ml-2' style='margin-left:10px;'>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary my-1'>View BOOK</button></a></td>";
                $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'><button type='button' class='btn btn-danger my-1'>Delete</button></a></td>";
                $table.="</tr>";
              }
              $table.="</table>";
              echo $table;

            ?>
          </div>
        </div>
        <div class="rightinnerdiv">   
          <div id="userdetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewids'])){ $viewids=$_REQUEST['viewids'];} else {echo "display:none"; }?>"> 
            <Button class="greenbtn" >USER DETAIL</Button>
            </br>
            <?php

              $u=new data;
              $u->setconnection();
              $u->getuserdetail($viewids);
              $recordset=$u->getuserdetail($viewids);
              foreach($recordset as $row){
                $userid= $row[0];
                $username= $row[1];
                $useremail= $row[2];
                $userpass= $row[3];
                $userphoto= $row[4];
                $usertype= $row[5];
              }    

            ?>
            <div class="container mt-3" style='border:1px solid rgb(216, 216, 216); ;'>
              <div class="row">
                <div class="col-md-4" style="margin-left:-30px;">
                  <img width='200px' height='200px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $userphoto?> "/>
                </div>
                <div class="col-md-8 ml-4">
                  <p style="color:black"><span>Name: </span> &nbsp&nbsp<?php echo $username ?></p>
                  <p style="color:black"><span>Email: </span> &nbsp&nbsp<?php echo $useremail ?></p>
                  <p style="color:black"><span>Type: </span> &nbsp&nbsp<?php echo $usertype ?></p>
                </div>
              </div>
            </div>
            </br>
          </div>
        </div>
        <div class="rightinnerdiv">   
          <div id="studentrecord" class="innerright portion" style="display:none">
            <Button class="greenbtn">USER RECORD</Button>
            <?php
              $u=new data;
              $u->setconnection();
              $u->userdata();
              $recordset=$u->userdata();

              $table="<table class='table table-striped' style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;margin-top:5px;'><tr style='border:1px solid #ccc;border-radius:20px;'><th style='padding: 8px;' scope='col'>Name</th><th scope='col'>Email</th><th scope='col'>Type</th><th scope='col'>View User</th><th scope='col'>Delete User</th><tr>";
              foreach($recordset as $row){
                $table.="<tr style='border:1px solid #ccc; border-radius:20px;'>";
                "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td><button type='button' class='btn btn-success my-1'><a style='color:white; text-decoration:none;' href='admin_service_dashboard.php?viewids=$row[0]'>View</a></button></td>";
                $table.="<td><button type='button' class='btn btn-danger my-1'><a style='color:white; text-decoration:none;' href='deleteuser.php?useriddelete=$row[0]'>Delete</a></button></td>";
                $table.="</tr>";
              }
              $table.="</table>";
              echo $table;

            ?>
          </div>
        </div>
        <div class="rightinnerdiv">   
          <div id="addbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewids'])||!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="greenbtn" >ADD NEW BOOK</Button>
            <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">
              <input type="text" name="bookname" placeholder="Enter Book Name"/>
              </br>
              <input  type="text" name="bookdetail" placeholder="Enter Book Details"/></br>
              <input type="text" name="bookauthor" placeholder="Enter Book Author"/></br>
              <input type="text" name="bookpub" placeholder="Enter Book Publication"/></br>
              <div class="radios">
                Branch: &nbsp;
                <span class="liner">
                  <input type="radio" name="branch" value="IT">
                  <label for="IT">IT</label>
                </span>
                <br>
                <span class="liner">
                  <input type="radio" name="branch" value="CSE">
                  <label for="CSE">CSE</label>
                </span>
                <br>
                <span class="liner">
                  <input type="radio" name="branch" value="ECE">
                  <label for="ECE">ECE</label>
                </span>
              </div>   
              <input type="number" name="bookprice" placeholder="Enter Book Price"/></br>
              <input type="number" name="bookrent" placeholder="Enter Book Rent"/></br>
              <input type="number" name="bookava" placeholder="Enter Books Available"/></br>
              <input type="number" name="bookquantity" placeholder="Enter Book Quantity"/></br>
              <label for="file-upload" class="custom-file-upload">
              <i class="fa-solid fa-cloud-arrow-up"></i> Upload Book Image
              </label>
              <input id="file-upload" name="bookphoto" type="file"/>
              </br>
              <input type="submit" value="ADD NEW BOOK" id="submit1"/>
              </br>
              </br>
          </form>
        </div>
      </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let submit = document.getElementById('submit');
        let submit1 = document.getElementById('submit1');
        submit.onclick = function() { 
            alertify.alert('New Addition', 'User Added Successfully!', function(){ alertify.success('Successfull Addition!');});
        }
        submit1.onclick = function() { 
            alertify.alert('New Addition', 'Book Added Successfully!', function(){ alertify.success('Successfull Addition!'); });
        }
    </script>
</body>
<script type="text/javascript" src="assets/js/main1.js"></script>
</html>
