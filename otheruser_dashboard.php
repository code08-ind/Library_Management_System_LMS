<?php

    include("data_class.php");

    $userloginid = $_SESSION["userid"];

    // echo $_SESSION["userid"];
    if(empty($userloginid)){
        header("Location:indexs.php?msg=Login First");
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library Management System (LMS)</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/225/225932.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    </head>
<body>
    <h1 class="maintext text-center" style="font-weight: bold; margin-top:20px;margin-bottom:-50px;border:0px;">Library Management System (LMS)</h1>
    <div class="container">
        <div class="innerdiv">
            <div class="leftinnerdiv">
                <Button class="greenbtn"><span><img height="35px" src="images/addstudent.png" alt="Admin"/>Welcome</span>
                <Button class="greenbtn" onclick="openpart('myaccount')"> <span><img height="35px" src="images/admin.png" alt="Admin"/> My Account</span></Button>
                <Button class="greenbtn" onclick="openpart('requestbook')"> <span><img height="35px" src="images/bookreport.png" alt="Admin"/> Request Book</span></Button>
                <Button class="greenbtn" onclick="openpart('issuereport')"> <span><img height="35px" src="images/bookrequest.png" alt="Admin"/> Book Report</span></Button>
                <a href="indexs.php"><Button class="greenbtn" ><span><img height="35px" src="images/logout.png" alt="Admin"/> LOGOUT</span></Button></a>
            </div>
            <div class="rightinnerdiv">   
                <div id="myaccount" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo ""; }?>">
                    <Button class="greenbtn" >My Account</Button>
                    <?php

                        $u=new data;
                        $u->setconnection();
                        $u->userdetail($userloginid);
                        $recordset=$u->userdetail($userloginid);
                        foreach($recordset as $row){
                            $id= $row[0];
                            $name= $row[1];
                            $email= $row[2];
                            $pass= $row[3];
                            $type= $row[5];
                        }      

                    ?>
                    <p style="color:black"><span style="color:#16df7e; font-weight:bold;">Person Name:</span> &nbsp&nbsp<?php if($name){ echo $name; } else {echo "No User Available"; }?></p>
                    <p style="color:black"><span style="color:#16df7e; font-weight:bold;">Person Email:</span> &nbsp&nbsp<?php if($email){ echo $email; } else {echo "No Email Available"; }?></p>
                    <p style="color:black"><span style="color:#16df7e; font-weight:bold;">Account Type:</span> &nbsp&nbsp<?php if($type){ echo $type; } else {echo "No Type Available"; }?></p>
                </div>
            </div>
            <div class="rightinnerdiv">   
                <div id="issuereport" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ echo "display:none";} else {echo "display:none"; }?>">
                    <Button class="greenbtn" >ISSUE RECORD</Button>

                    <?php

                        $userloginid = $_SESSION["userid"] = $_GET['userlogid'];
                        $u=new data;
                        $u->setconnection();
                        $u->getissuebook($userloginid);
                        $recordset=$u->getissuebook($userloginid);

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='
                        padding: 8px;'>Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Return</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'><button type='button' class='btn btn-success my-2'>Return</button></a></td>";
                            $table.="</tr>";
                            // $table.=$row[0];
                        }
                        $table.="</table>";

                        echo $table;
                    ?>
                </div>
            </div>
            <div class="rightinnerdiv">   
                <div id="return" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];} else {echo "display:none"; }?>">
                    <Button class="greenbtn" >Return Book</Button>
                    <?php

                        $u=new data;
                        $u->setconnection();
                        $u->returnbook($returnid);
                        $recordset=$u->returnbook($returnid);

                    ?>
                </div>
            </div>
            <div class="rightinnerdiv">   
                <div id="requestbook" class="innerright portion" style="<?php  if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid'];echo "display:none";} else {echo "display:none"; }?>">
                    <Button class="greenbtn" >Request Book</Button>
                    <?php

                        $u=new data;
                        $u->setconnection();
                        $u->getbookissue();
                        $recordset=$u->getbookissue();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr>
                        <th>Image</th><th>Book Name</th><th>Book Authour</th><th>branch</th><th>price</th></th><th>Request Book</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            $table.="<td><img src='uploads/$row[1]' width='100px' height='100px' style='border:1px solid #333333;'></td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[4]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td><a href='requestbook.php?bookid=$row[0]&userid=$userloginid'><button type='button' class='btn btn-primary my-2'>Request Book</button></a></td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";

                        echo $table;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="assets/js/main1.js"></script>
</html>