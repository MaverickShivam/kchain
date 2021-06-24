<?php
$conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");
$sql="select * from timeline ORDER BY date desc";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
//echo $row["name"];
function addmore()
{
    $GLOBALS["row"]=$GLOBALS['result']->fetch_assoc();
    //echo $GLOBALS["row"]["name"];
}

?>
<html>
    <head>
        <meta name="viewport" content="width=device-width,user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <style>
        .nutrition
        {
            display:inline-block;
            width:65%;
            height:auto;
        }
        .buying
        {
            display:inline-block;
            width:30%;
            height:auto;
        }
    </style>
    <body style="margin:0;padding:0;">
        <!--Header-->
        <div style="position:fixed;top:0;width:100%;height:50px;border-bottom:1px solid black;font-size:20px;background-color:white;">
            <b><center style="margin-top:10px;">Newra.in</center></b>
            <div style="height:1px;border-bottom:1px solid black;position:absolute;bottom:2px;width:100%;"></div>
        </div>
        <!--Timeline-->
        <div style="margin-top:50px;margin-bottom:80px;" id="maincontent">
            <div style="width:100%;height:auto;margin-bottom:30px;background-color:#f4f6ff;padding-top:10px;border-bottom:0.5px solid #84a9ac;">
                <label style="margin-left:5px;">Matar Paneer</label>
                <br>
                <img src="http://newra.in/intern/uploads/A1j8N86vyWlP7c6.jpg" style="margin-top:5px;" width="100%" height="auto">
                <!--Info about recipe-->                
                <div style="width:100%;margin-top:5px;">                    
                <!--Nutritional Info-->                    
                    <div class="nutrition">                        
                    <label style="margin-left:10px;"><b>Energy: </b></label>
                    <label>370</label>
                    <label>Cal</label>
                    <br>
                    <label style="margin-left:10px;"><b>Protein: </b></label>
                    <label>10</label>
                    <label>gm</label>                        
                    <br>                        
                    <label style="margin-left:10px;"><b>Fat: </b></label>
                    <label>31</label>
                    <label>Cal</label>
                    <br>                        
                    <label style="margin-left:10px;"><b>Fiber: </b></label>
                    <label>1</label>
                    <label>gm</label>                        
                    <br>                        
                    <label style="margin-left:10px;"><b>Carbohydrate: </b></label>
                    <label>12</label>
                    <label>gm</label> 
                    <br>                    
                </div >                    
                <!--Buying Info-->                    
                <div class="buying">                        
                    <div>                            
                        <button style="outline:none;background-color:orange;color:white;width:80px;height:30px;border:1px solid black;">Cook</button>
                    </div>                        
                    <br>                        
                    <div>                            
                        <label ><b>Price: </b></label>
                        <label>Rs.</label>
                        <label>120</label>                            
                        <br>                            
                        <label ><b>Time: </b></label>
                        <label>30</label>
                        <label>min</label>
                        <br>                        
                    </div>                    
                </div>                
                </div>                
                <div style="height:20px;"></div>            
            </div>            
            <div id="loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
        </div>
        
        <!--Footer-->
        <div style="position:fixed;bottom:0;width:100%;height:40px;border-top:2px solid lightgray;background-color:white;">
            <center>
                <a class="fa fa-sm fa-search" aria-hidden="true" style="width:30%;height:100%;color:black;"></a>
                <i class="fa fa-lg fa-home" aria-hidden="true" style="width:30%;height:100%;margin-top:10px;color:gray;"></i>
                <a class="fa fa-sm fa-user" aria-hidden="true" style="width:30%;height:100%; color:black;" href="newcook.php"></a>
            </center>
        </div>
        <!---->
        <script>
            if(screen.width>700)
            {
                alert("sorry the website is not supported for this device");
                window.open("https://newra.in/","_self");
            }
            //document.addEventListener("scroll", addthree);
            //addthree();

            function addthree()
            {
                
                if(elementInViewport(document.getElementById("loader")))
                {
                    document.getElementById("loader").remove();
                    document.getElementById("maincontent").innerHTML=document.getElementById("maincontent").innerHTML+'<div style="width:100%;height:auto;margin-bottom:30px;background-color:#f4f6ff;padding-top:10px;border-bottom:0.5px solid #84a9ac;"><label style="margin-left:5px;">Matar Paneer</label><br><img src="http://newra.in/intern/uploads/A1j8N86vyWlP7c6.jpg" style="margin-top:5px;" width="100%" height="auto"><!--Info about recipe-->                <div style="width:100%;margin-top:5px;">                    <!--Nutritional Info-->                    <div class="nutrition">                        <label style="margin-left:10px;"><b>Energy: </b></label><label>370</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Protein: </b></label><label>10</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Fat: </b></label><label>31</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Fiber: </b></label><label>1</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Carbohydrate: </b></label><label>12</label><label>gm</label>                        <br>                    </div >                    <!--Buying Info-->                    <div class="buying">                        <div>                            <button style="outline:none;background-color:orange;color:white;width:80px;height:30px;border:1px solid black;">Cook Now</button>                        </div>                        <br>                        <div>                            <label ><b>Price: </b></label><label>Rs.</label><label>120</label>                            <br>                            <label ><b>Time: </b></label><label>30</label><label>min</label>                            <br>                        </div>                    </div>                </div>                <div style="height:20px;"></div>            </div>            <!--Single Post-->            <div style="width:100%;height:auto;margin-bottom:30px;background-color:#f4f6ff;padding-top:10px;border-bottom:0.5px solid #84a9ac;">                <label style="margin-left:5px;">Shahi Paneer</label><br>                <img src="https://i0.wp.com/vegecravings.com/wp-content/uploads/2016/08/kadai-paneer-gravy-recipe-step-by-step-instructions.jpg?" style="margin-top:5px;" width="100%" height="auto">                <!--Info about recipe-->                <div style="width:100%;margin-top:5px;">                    <!--Nutritional Info-->                    <div class="nutrition">                        <label style="margin-left:10px;"><b>Energy: </b></label><label>370</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Protein: </b></label><label>10</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Fat: </b></label><label>31</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Fiber: </b></label><label>1</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Carbohydrate: </b></label><label>12</label><label>gm</label>                        <br>                    </div >                    <!--Buying Info-->                    <div class="buying">                        <div>                            <button style="outline:none;background-color:orange;color:white;width:80px;height:30px;border:1px solid black;">Cook Now</button>                        </div>                        <br>                        <div>                            <label ><b>Price: </b></label><label>Rs.</label><label>120</label>                            <br>                            <label ><b>Time: </b></label><label>30</label><label>min</label>                            <br>                        </div>                    </div>                </div>                <div style="height:20px;"></div>            </div>            <!--Single Post-->            <div style="width:100%;height:auto;margin-bottom:30px;background-color:#f4f6ff;padding-top:10px;border-bottom:0.5px solid #84a9ac;">                <label style="margin-left:5px;">Aloo Biryani</label><br>                <img src="https://i2.wp.com/www.vegrecipesofindia.com/wp-content/uploads/2017/01/dum-aloo-biryani-recipe-1.jpg" style="margin-top:5px;" width="100%" height="auto">                <!--Info about recipe-->                <div style="width:100%;margin-top:5px;">                    <!--Nutritional Info-->                    <div class="nutrition">                        <label style="margin-left:10px;"><b>Energy: </b></label><label>370</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Protein: </b></label><label>10</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Fat: </b></label><label>31</label><label>Cal</label>                        <br>                        <label style="margin-left:10px;"><b>Fiber: </b></label><label>1</label><label>gm</label>                        <br>                        <label style="margin-left:10px;"><b>Carbohydrate: </b></label><label>12</label><label>gm</label>                        <br>                    </div >                    <!--Buying Info-->                    <div class="buying">                        <div>                            <button style="outline:none;background-color:orange;color:white;width:80px;height:30px;border:1px solid black;">Cook Now</button>                        </div>                                                <br>                        <div>                            <label ><b>Price: </b></label><label>Rs.</label><label>120</label>                            <br>                            <label ><b>Time: </b></label><label>30</label><label>min</label>                            <br>                        </div>                    </div>                </div>                <div style="height:20px;"></div>            </div>';
                    document.getElementById("maincontent").innerHTML=document.getElementById("maincontent").innerHTML+'<div id="loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>';
                    
                    }
            }
function elementInViewport(el) 
{
  var top = el.offsetTop;
  var left = el.offsetLeft;
  var width = el.offsetWidth;
  var height = el.offsetHeight;

  while(el.offsetParent) {
    el = el.offsetParent;
    top += el.offsetTop;
    left += el.offsetLeft;
  }

  return (
    top >= window.pageYOffset &&
    left >= window.pageXOffset &&
    (top + height) <= (window.pageYOffset + window.innerHeight) &&
    (left + width) <= (window.pageXOffset + window.innerWidth)
  );
}

        </script>
    </body>
</html>