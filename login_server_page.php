<?php

    include("data_class.php");

    $logins_email=$_POST['logins_email'];
    $logins_password=$_POST['logins_password'];

    if($logins_email==null||$logins_password==null){
        $emailms="";
        $pasdmsg="";
        
        if($logins_email==null){
            $emailmsg="Email Empty";
        }
        if($logins_password==null){
            $pasdmsg="Pasword Empty";
        }
        header("Location: indexs.php?emailmsg=$emailmsg&pasdmsg=$pasdmsg");
    }

    elseif($logins_email!=null&&$logins_password!=null){
        $obj=new data();
        $obj->setconnection();
        $obj->userLogin($logins_email,$logins_password);
    }
    
?>
