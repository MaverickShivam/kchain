<?php
$conn=mysqli_connect("localhost","u369938951_newra_intern","intern001","u369938951_intern_db");
$sql="select count(*) from activecooking where status=0";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
echo($row["count(*)"]);
?>