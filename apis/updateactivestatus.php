<?php
if(!isset($_GET["setstatus"]))
{
    die;
}
$conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");
if($_GET["setstatus"]=="1")
{
    $sql="update activecooking set status=1 where status=0";
    $conn->query($sql);
}
else if($_GET["setstatus"]=="-1")
{
    $sql="select * from activecooking where status=0";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    
    $activeid=$row["id"];
    
    $sql="update activecooking set status=-1 where status=0";
    $conn->query($sql);
    
    $sql="drop table ".$activeid;
    $conn->query($sql);
}




?>