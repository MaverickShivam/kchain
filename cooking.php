<?php
session_start();
if(!isset($_POST["submit"]))
{
    die;
}

$conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");

$sql="select count(*) from activecooking where status=0";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row["count(*)"]!="0")
{
    ?>
    <script>
        window.history.back(alert("machine is occupied..."));
    </script>
    <?php
    die;
}

unset($_POST["submit"]);
function random_strings($length_of_string) 
{ 
    $str_result = 'abcdefghijklmnopqrstuvwxyz'; 
    $tempid= substr(str_shuffle($str_result),  
                       0, $length_of_string); 
    return $tempid;
} 
$recipeid=random_strings(15);
$_SESSION["recipeid"]=$recipeid;
//$mysql="truncate activecooking";
//$conn->query($mysql);
$mysql="insert into activecooking value('".$recipeid."','new',0)";
$conn->query($mysql);
//$mysql= "CREATE TABLE ".$recipeid." (timestamp int(11) NOT NULL,action varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,quantity int(11) NOT NULL,status int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

//$conn->query($mysql);
$ingsql="select * from ingredients";
$ingresult=$conn->query($ingsql);
$stirsql="select * from stirrer" ;
$stirresult=$conn->query($stirsql);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width,user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <body style="padding:0;margin:0;">
        <div style="height:100%;width:100%;display:block;outline:none;border:none;" id="maincontent" >
            
            <!--Top Part-->
            <div style="width:100%;height:50%;background-color:white;outline:none;border:none;" id="topdiv" tabindex="1" onfocus="closeallpopup()">
                <center>
                    <br>
                    <div style="width:50%;height:50%;background-color:lightgray;font-size:10px;" id="induction">
                        <iframe src="https://newra.in/jitsi/newrameet.php" style="width:100%;height:100%;outline:none;margin:none;border:none;"></iframe>
                    </div>
                    
                    <!--Show Temperature-->
                    <div style="background-color:gray;width:50%;height:20px;">
                        <center>
                            <label style="background-color:yellow;color:red;font-size:12px;top:4px;position:relative;" id="tempval">OFF</label>
                        </center>
                    </div>
                    <!--End of Show Temperature-->
                    
                    <!--Induction Control-->
                    <div id="tempcontrol">
                        <button style="margin:10px;width:60px;height:30px;color:white;background-color:black;outline:none;border:none;" onclick="dectemp()">-</button><button style="margin:10px;width:40px;height:40px;border-radius:20px;color:white;background-color:red;outline:none;border:none;" onclick="onoff()" id="powerbtn"><i class="fa fa-power-off" aria-hidden="true"></i></button><button style="margin:10px;width:60px;height:30px;color:white;background-color:black;outline:none;border:none;" onclick="inctemp()">+</button>
                    </div>
                    <!--End of Induction Control-->
                    
                    <!--Stirrer Control-->
                    <button style="width:60px;height:30px;color:white;background-color:black;outline:none;border:none;" onclick="openpopup('popup2',0)" id="stirrercontrol"><i class="fa fa-spoon" aria-hidden="true"></i>
                    </button>
                    <!--End Of Stirrer Control-->
                </center>
            </div>
            <!--end of Top Part-->
            
            <!--Bottom Part-->
            <div style="width:100%;height:50%;" id="bottomdiv" >
                <!--inside racks-->
                <center>
                    <div style="width:calc(100% - 20px);background-color:#c7e2b2;height:50%;display:block;z-index:-1;position:absolute;left:10px;overflow:scroll;" id="insidediv" >
                        
                        <?php
                            foreach($ingresult as $ing)
                            {
                                echo '<div style="width:100%;height:100px;border-bottom:1px solid white;margin-top:10px;" onclick="openpopup('."'popup1'".','.$ing["ing_id"].')"><img src="'.$ing["image"].'" height="90px" width="90px" style="float:left;"><br><br><i style="font-size:20px;">'.$ing["ing_name"].'</i></div>';
                            }
                        ?>
                        
                    
                    </div>
                </center>
                <!--End of inside racks-->
                
                <div>
                    <div style="width:50%;height:50%;background-color:#7c3c21;position:absolute;left:0;border-right:2px solid black;transition:2s;" id="leftdoor" onclick="opendoors()"></div>
                    <div style="width:50%;height:50%;background-color:#7c3c21;position:absolute;right:0;border-left:2px solid black;transition:2s;" id="rightdoor" onclick="opendoors()"></div>
                </div>
            </div>
        </div>
        <!--Popup box 1-->
        <center><div style="position:fixed;top:150px;left:10%;width:80%;background-color:white;height:200px;z-index:3;box-shadow: rgb(136, 136, 136) 3px 3px 3px 3px; display: none;" id="popup1">
            <i class="fa fa-times" aria-hidden="true" style="position:absolute;top:5px;right:5px;" onclick="closepopup('popup1')"></i>
            <br>
            <label>Quantity: </label><input style="width:50px;margin:10px;" type="number" id="quantity"><select id="selectunits"></select>
            <br>
            <br>
            <br>
            <br>
            <button style="background-color:orange;color:white;width:80px;height:40px;outline:none;border:none;" onclick="ingadded()">Add</button>
        </div>
        </center>
        <!--end of Popup box 1-->
        
        <!--Popup box 2-->
        <center><div style="position:fixed;top:150px;left:10%;width:80%;background-color:white;height:200px;z-index:3;box-shadow: rgb(136, 136, 136) 3px 3px 3px 3px; display: none;" id="popup2">
            <i class="fa fa-times" aria-hidden="true" style="position:absolute;top:5px;right:5px;" onclick="closepopup('popup2')"></i>
            <br>
            <label>Stirrer: </label><select id="selectstir">
                <option value="0">Select</option>
                <?php
                    foreach($stirresult as $stir)
                    {
                        echo "<option value='".$stir["id"]."'>".$stir["name"]."</option>";
                    }
                ?>
                </select>
            <br>
            <br>
            <br>
            <br>
            <button style="background-color:orange;color:white;width:80px;height:40px;outline:none;border:none;" onclick="stirrnow()">Add</button>
        </div>
        </center>
            <i class="fa fa-arrow-right" style="background-color:black;color:white;padding:10px;position:fixed;z-index:2;border-radius:30px;bottom:5px;right:5px;box-shadow: rgba(136, 136, 136,0.2) 2px 2px 2px 2px;"></i>
        <!--end of Popup box 2-->
        <script>
            var fingid;//final ingredient id
            var tempinterval;
            var stirinterval;
            var inginterval;
            document.getElementById("maincontent").style.height=window.innerHeight+"px";
            //document.getElementById("induction").style.height=window.innerHeight/4+"px";
            //document.getElementById("bottomdiv").style.height=window.innerHeight/2+"px";
            function opendoors()
            {
                window.document.getElementById("leftdoor").style.width="10px";
                window.document.getElementById("rightdoor").style.width="10px";
                setTimeout(showinside,2000);
            }
            function showinside()
            {
                window.document.getElementById("insidediv").style["z-index"]="1";
            }
            function ingadded()
            {
                if(document.getElementById("quantity").value.length<1)
                {
                    alert("Please enter valid quantity");
                    return;
                }
                if(document.getElementById("selectunits").value==0)
                {
                    alert("Please choose correct unit");
                    return;
                }
                document.getElementById("bottomdiv").style["pointer-events"]="none";
                document.getElementById("bottomdiv").style["opacity"]="0.4";
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        inginterval=window.setInterval(enableingredcontrol,1000);
                    }  
                };
                xhttp.open("GET", "apis/passingred.php?action=set&ingid="+fingid+"&quantity="+(document.getElementById("quantity").value*document.getElementById("selectunits").value), true);
                xhttp.send();
                closepopup("popup1");
                //do something-----------------
            }
            function stirrnow()
            {
                
                if(document.getElementById("selectstir").value==0)
                {
                    alert("Please choose stirrer type");
                    return;
                }
                document.getElementById("stirrercontrol").style["pointer-events"]="none";
                document.getElementById("stirrercontrol").style["opacity"]="0.4";
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        stirinterval=window.setInterval(enablestirrercontrol,1000);
                    }  
                };
                xhttp.open("GET", "apis/machinecontrol.php?action=set&index=stir&data=type&value="+document.getElementById("selectstir").value, true);
                xhttp.send();
                closepopup("popup2");
                //do something-------------------
            }
            function openpopup(id,ingid)
            {
                if(id=="popup1")
                {
                    fingid=ingid;
                    closepopup('popup2');
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            var unitsarray=JSON.parse(this.responseText);
                            var optionhtml='<option value="0">Unit</option><option value="1">gm</option>';
                            for (var k=0;k<unitsarray.length;k++)
                            {
                                optionhtml=optionhtml+"<option value='"+unitsarray[k][1]+"'>"+unitsarray[k][0]+"</option>"
                            }
                            document.getElementById("selectunits").innerHTML=optionhtml;
                            window.document.getElementById(id).style.display="block";
                            window.document.getElementById(id).style["z-index"]="3";
                        }
                    };
                    xhttp.open("GET", "getingunits.php?ingid="+ingid, true);
                    xhttp.send();
                }
                else if(id=="popup2")
                {
                    closepopup("popup1");
                    window.document.getElementById(id).style.display="block";
                    window.document.getElementById(id).style["z-index"]="3";
                }
                
                
            }
            function closepopup(id)
            {
                if(id=="popup1")
                {
                    window.document.getElementById("quantity").value="";
                }
                window.document.getElementById(id).style["z-index"]="2";
                window.document.getElementById(id).style.display="none";
            }
            function closeallpopup()
            {
                closepopup('popup1');
                closepopup('popup2');
            }
            function play() {
                var audio = new Audio('beep.mp3');
                audio.play();
            }
            function onoff()
            {
                document.getElementById("tempcontrol").style["pointer-events"]="none";
                document.getElementById("tempcontrol").style["opacity"]="0.4";
                play();
                if(document.getElementById("tempval").innerHTML=="OFF")
                {
                    document.getElementById("tempval").innerHTML="1000";
                    document.getElementById("powerbtn").style["background-color"]="green";
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() 
                        {
                            if (this.readyState == 4 && this.status == 200) 
                            {
                                tempinterval=window.setInterval(enabletempcontrol,1000);
                               
                            }
                        };
                        xhttp.open("GET", "apis/machinecontrol.php?action=set&index=temp&data=quantity&value=1000", true);
                        xhttp.send();
                }
                else
                {
                    document.getElementById("tempval").innerHTML="OFF";
                    document.getElementById("powerbtn").style["background-color"]="red";
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() 
                        {
                            if (this.readyState == 4 && this.status == 200) 
                            {
                                tempinterval=window.setInterval(enabletempcontrol,1000);
                               
                            }
                        };
                        xhttp.open("GET", "apis/machinecontrol.php?action=set&index=temp&data=quantity&value=0", true);
                        xhttp.send();
                }
                
            }
            function dectemp()
            {
                if(Number.isInteger(parseInt(document.getElementById("tempval").innerHTML)))
                {
                    if(parseInt(document.getElementById("tempval").innerHTML)>=600)
                    {
                        document.getElementById("tempcontrol").style["pointer-events"]="none";
                        document.getElementById("tempcontrol").style["opacity"]="0.4";
                        play();
                        document.getElementById("tempval").innerHTML=document.getElementById("tempval").innerHTML-200;
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() 
                        {
                            if (this.readyState == 4 && this.status == 200) 
                            {
                                tempinterval=window.setInterval(enabletempcontrol,1000);
                               
                            }
                        };
                        xhttp.open("GET", "apis/machinecontrol.php?action=set&index=temp&data=quantity&value="+document.getElementById("tempval").innerHTML, true);
                        xhttp.send();
                    }
                }
            }
            function inctemp()
            {
                if(Number.isInteger(parseInt(document.getElementById("tempval").innerHTML)))
                {
                    if(parseInt(document.getElementById("tempval").innerHTML)<=1600)
                    {
                        document.getElementById("tempcontrol").style["pointer-events"]="none";
                        document.getElementById("tempcontrol").style["opacity"]="0.4";
                        play();
                        document.getElementById("tempval").innerHTML=parseInt(document.getElementById("tempval").innerHTML)+parseInt(200);
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() 
                        {
                            if (this.readyState == 4 && this.status == 200) 
                            {
                                tempinterval=window.setInterval(enabletempcontrol,1000);
                               
                            }
                        };
                        xhttp.open("GET", "apis/machinecontrol.php?action=set&index=temp&data=quantity&value="+document.getElementById("tempval").innerHTML, true);
                        xhttp.send();
                    }
                }
                    
                
                
            }
            function enabletempcontrol()
            {
                var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            if(this.responseText=="1")
                            {
                                document.getElementById("tempcontrol").style["pointer-events"]="initial";
                                document.getElementById("tempcontrol").style["opacity"]="1";
                                window.clearInterval(tempinterval);
                            }
                           
                        }
                    };
                    xhttp.open("GET", "apis/machinecontrol.php?action=get&index=temp&data=status", true);
                    xhttp.send();
                
            }
            function enablestirrercontrol()
            {
                var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            if(this.responseText=="1")
                            {
                                document.getElementById("stirrercontrol").style["pointer-events"]="initial";
                                document.getElementById("stirrercontrol").style["opacity"]="1";
                                window.clearInterval(stirinterval);
                            }
                           
                        }
                    };
                    xhttp.open("GET", "apis/machinecontrol.php?action=get&index=stir&data=status", true);
                    xhttp.send();
                
            }
            function enableingredcontrol()
            {
                var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() 
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            if(this.responseText=="1")
                            {
                                document.getElementById("bottomdiv").style["pointer-events"]="initial";
                                document.getElementById("bottomdiv").style["opacity"]="1";
                                window.clearInterval(inginterval);
                            }
                           
                        }
                    };
                    xhttp.open("GET", "apis/passingred.php?action=get&data=status", true);
                    xhttp.send();
                
            }
        </script>
    </body>
    
</html>