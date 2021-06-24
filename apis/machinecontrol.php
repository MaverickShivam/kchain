<?php
session_start();
if(isset($_GET["action"]) and isset($_GET["index"]))
{
    $conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");
    if($_GET["index"]=="temp")
    {
        $_GET["index"]=0;
    }
    else if($_GET["index"]="stir")
    {
        $_GET["index"]=2;
    }
    else
    {
        die;
    }
    if($_GET["action"]=="get")
    {
        if(isset($_GET["data"]))
        {
            $mysql="select * from machine where ind=".$_GET["index"];
            $result=$conn->query($mysql);
            $row=$result->fetch_assoc();
            echo $row[$_GET["data"]];
        }
    }
    else if($_GET["action"]=="set")
    {
        if(isset($_GET["data"]) and isset($_GET["value"]))
        { 
            if($_GET["data"]!="status")
            {
                if(!isset($_SESSION["recipeid"]))
                {
                    die;
                }
                if($_GET["index"]=="0")
                {
                    $newsql="insert into ".$_SESSION["recipeid"]." values(".time().",'temp'".",".$_GET["value"].",0)";
                    $conn->query($newsql);
                }
                else if($_GET["index"]=="2")
                {
                    $newsql="insert into ".$_SESSION["recipeid"]." values(".time().",'stirrer@".$_GET["value"]."',-1,0)";
                    $conn->query($newsql);
                }
                
                $mysql="update machine set ".$_GET["data"]."=".$_GET["value"].",status=0 where ind=".$_GET["index"];
                $conn->query($mysql);
                echo "updated";
                
            }
            else
            {
                $mysql="update machine set ".$_GET["data"]."=".$_GET["value"]." where ind=".$_GET["index"];
                $conn->query($mysql);
                echo "status updated";
            }
            
            
        }
    }
}
?>