<?php

    include("data_class.php");
    $login_email=$_POST["login_email"];
    $login_password=$_POST["login_password"];

    if($login_email==null||$login_password==null){
        $emailmsg="";
        $pasdmsg="";

        if($login_email==null){
            $emailmsg="Email Empty";
        }
        if($login_password==null){
            $pasdmsg="Password Empty";
        }

        header("Location: indexs.php?ademailmsg=$emailmsg&adpasdmsg=$pasdmsg");
    }

    else if($login_email!=null||$login_password!=null){
        $obj=new data();
        $obj->setconnection();
        $obj->adminLogin($login_email,$login_password);
    }
    
?>