<?php
session_start();
if(isset($_GET["action"]))
{
    $conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");
    if($_GET["action"]=="get")
    {
        if(isset($_GET["data"]))
        {
            $mysql="select * from machine where ind=1";
            $result=$conn->query($mysql);
            $row=$result->fetch_assoc();
            echo $row[$_GET["data"]];
        }
    }
    else if($_GET["action"]=="set")
    {
        if(isset($_GET["ingid"]) and isset($_GET["quantity"]))
        { 
            if(!isset($_SESSION["recipeid"]))
            {
                die;
            }
            $newsql="insert into ".$_SESSION["recipeid"]." values(".time().",'ingred@".$_GET["ingid"]."',".$_GET["quantity"].",0)";
            $conn->query($newsql);
            $mysql="update machine set type=".$_GET["ingid"].", quantity=".$_GET["quantity"].", status=0 where ind=1";
            
            $conn->query($mysql);
            echo "updated";
        }
        if(isset($_GET["data"]) and isset($_GET["value"]))
        {
            $mysql="update machine set ".$_GET["data"]."=".$_GET["value"]." where ind=1";
            
            $conn->query($mysql);
            echo "updated status";
            
        }
    }
}
?>