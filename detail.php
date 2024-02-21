<!doctype html>
<html>
<head>
<meta charset="utf-8"> 
<title>แสดงรายละเอียดสินค้า</title>
</head>

<body>

<h1>แสดงรายละเอียดข้อมูลสินค้า</h1>
	<input type="button" value="back" onClick="history.back();"><br>
 <?php
 include("connectdb.php");
 $sql = "SELECT * FROM products WHERE `p_id`='{$_GET['id']}' ";
 $rs = mysqli_query($conn, $sql);
 $data = mysqli_fetch_array($rs); 
 ?> 
   	<img src="images/<?=$data['p_id'];?>.<?=$data['p_img'];?>"width="400" height="300"><br>
	<?=$data['p_name'];?><br>
    ราคา<?=$data['p_price'];?> บาท<br>
    <strong>รายละเอียดสินค้า</strong><br>
    <?=$data['p_detail'];?>
    
</body>
</html>