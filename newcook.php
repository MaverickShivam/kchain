
<html>
    <head>
        <meta name="viewport" content="width=device-width,user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    <style>
        input
        {
            width:70%;
            height:40px;
            margin:10px;
            text-align:center;
            
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
            <form method="post" action="cooking.php" style="text-align:center;" onsubmit="return validate()">
                <br><br>
                <label style="color:red;display:none;" id="nameerror">Please enter valid recipe name</label>
                <input placeholder="Recipe Name" name="name" id="name" onfocus="hideerror('nameerror')">
                <br>
                <br>
                <label style="color:red;display:none;" id="servingserror">Please enter valid servings</label>
                <input type="number" placeholder="No. Of Servings" name="servings" id="servings" onfocus="hideerror('servingserror')" min="1" max="6">
                <br>
                <button type="submit" name="submit" style="margin-top:30px;width:80%;height:50px;background-color:orange;color:white;outline:none;border:none;">Start Cooking</button>
            </form>
        </div>
        
        <!--Footer-->
        <div style="position:fixed;bottom:0;width:100%;height:40px;border-top:2px solid lightgray;background-color:white;">
            <center>
                <a class="fa fa-sm fa-search" aria-hidden="true" style="width:30%;height:100%;color:black;text-decoration:none;"></a>
                <a class="fa fa-sm fa-home" aria-hidden="true" style="width:30%;height:100%;margin-top:10px;color:black;text-decoration:none;" href="index.php"></a>
                <i class="fa fa-lg fa-user" aria-hidden="true" style="width:30%;height:100%; color:gray;" href="newcook.php"></i>
            </center>
        </div>
        <!---->
        <script>
            if(screen.width>700)
            {
                alert("sorry the website is not supported for this device");
                window.open("https://newra.in/","_self");
            }
            function validate()
            {
                if(document.getElementById("name").value.length<1)
                {
                    document.getElementById("nameerror").style["display"]="block"
                    return false;
                }
                if(document.getElementById("servings").value.length<1)
                {
                    document.getElementById("servingserror").style["display"]="block"
                    return false;
                }
                return true;
                
            }
            function hideerror(id)
            {
                document.getElementById(id).style["display"]="none";
            }

            
        </script>
    </body>
</html>