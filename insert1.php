<?php
session_start();
if(empty($_SESSION['aid'])){
	echo"Access Denied !!!";
	exit;
	
}
echo $_SESSION['aname'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ฟอร์มเพิ่มข้อมูลสินค้า</title>
</head>

<body>

<h1>ฟอร์มเพิ่มข้อมูลสินค้า</h1>

<form method="post" action="" enctype="multipart/form-data">
ชื่อสินค้า <input type="text" name="pname" required required > <br>
ราคา (บาท) <input type="number" name="pprice" required> <br>
รายละเอียด <br>
<textarea name="pdetail" cols="50" rows="6"></textarea><br>
รูปสินค้า <input type="file" name="picture"><br>
ประเภทสินค้า <br>
<select name="cate">
<?php
include("connectdb.php");
$sql = "SELECT * FROM `category`";
$rs = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($rs)){
?>
	<option value="<?=$data['c_id'];?>"><?=$data['c_name'];?></option>
    <?php }?>
</select>
<br>
<br>    
<input type="submit" name="Submit" value="บันทึกข้อมูล">
</form>
<?php
if(isset($_POST['Submit'])){
	
	$allowed = array('gif', 'png', 'jpg', 'jpeg', 'jfif');
    $filename = $_FILES['picture']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        echo "<script>";
        echo "alert('บันทึกข้อมูลสินค้าไม่สำเร็จ! ไฟล์รูปต้องเป็น jpg gif หรือ png เท่านั้น');";
        echo "</script>";
        exit;
	}
	$sql2 ="INSERT INTO `products` (`p_id`, `P_name`, `p_detail`, `p_price`, `p_img`, `p_type`) VALUES (NULL, '{$_POST['pname']}', '{$_POST['pdetail']}', '{$_POST['pprice']}', '{$ext}', '{$_POST['cate']}');";
	mysqli_query($conn, $sql2) or die ("เพิ่มข้อมูลสินค้าไม่ได้");
	$idd = mysqli_insert_id($conn);
	
	@copy($_FILES['picture']['tmp_name'], "images/".$idd.".".$ext);
	
	echo"<script>";
	echo"alert('เพิ่มข้อมูลสินค้าสำเร็จ');";
	echo"window.location='index.php';";
	echo"</script>";
		
}
?>
</body>
</html>