<?php 
session_start();
$bag=mysqli_connect("localhost","root","","sinav5");
if(isset($_COOKIE['ad'])){
	$_SESSION['ad']=$_COOKIE['ad'];
}
if(isset($_POST['giris'])){
	$ad=$_POST['ad'];
	$sifre=$_POST['sifre'];
	$s1=mysqli_query($bag,"select * from kisi where ad='$ad' and sifre='$sifre'");
	$s2=mysqli_query($bag,"select * from kisi where ad='$ad' ");
	$s3=mysqli_query($bag,"select * from kisi where  sifre='$sifre'");
	$sayi=mysqli_num_rows($s1);
	$sayi1=mysqli_num_rows($s2);
	$sayi2=mysqli_num_rows($s3);
	if($sayi>0)
	{
		$_SESSION['ad']=$ad;
		header("location:index.php");
	}
	if($sayi1>0 && $sayi2==0)
	{
echo 'sifre hatalı'	;
	
	}
	else if($sayi1==0 && $sayi2==0){
		echo 'kullanıcı yok'	;
	}
	if(isset($_POST['benih'])){
		setcookie("ad","$ad",time()+60*60*24);
		header("location:index.php");
	}
}
$is="";
if(isset($_GET["i"])){
	$is=$_GET["i"];
}
if($is=="cikis"){
	session_destroy();
	setcookie("ad","$ad",time()-60*60*24);
		header("location:index.php");
}
if($is=="paylas"){
	$paylass=mysqli_query($bag,"INSERT INTO gonderi(ad, gonderi) VALUES ('".$_SESSION['ad']."','".$_POST['yorum']."')");
		header("location:index.php");
}
if($is=="begen"){
	$paylass=mysqli_query($bag,"INSERT INTO begen(ad, gonderi_id) VALUES ('".$_SESSION['ad']."','".$_GET['id']."')");
		header("location:index.php");
}
if($is=="begenv"){
	$paylass=mysqli_query($bag,"delete from begen where ad='".$_SESSION['ad']."' and gonderi_id='".$_GET['id']."'");
		header("location:index.php");
}
if($is=="ekle"){
	$paylass=mysqli_query($bag,"INSERT INTO yorum(ad, gonderi_id,yorum) VALUES ('".$_SESSION['ad']."','".$_GET['id']."','".$_POST['yorum']."')");
		header("location:index.php");
}
if($is=="aekle"){
	$paylass=mysqli_query($bag,"INSERT INTO anket(ad,s,c1,c2,c3) VALUES ('".$_SESSION['ad']."','".$_POST['soru']."','".$_POST['c1']."','".$_POST['c2']."','".$_POST['c3']."')");
		header("location:index.php?i=anket");
}
if($is=="anketoyla"){
	$paylass=mysqli_query($bag,"INSERT INTO cevap(ad,anketid,c) VALUES ('".$_SESSION['ad']."','".$_GET['id']."','".$_POST['c']."')");
		header("location:index.php?i=anket");
}
?>
<html>
<body>
<div style="float:left;">
<div style="float:left;"><h1><a href="index.php">WEBBOOK</a></h1></div>

<?php
if(isset($_SESSION['ad'])){
	?>
<div style="float:left;">
<form method="post" action="index.php?i=paylas">
<table>

<tr>
<td><textarea style="width:200px;height:100px;"name="yorum" placeholder="ne dusunuyorsun <?php echo $_SESSION['ad']; ?> ?"></textarea></td>
<td><input type="submit" value="paylas" name="paylas"/></td>
<td><a href="index.php?i=cikis">cikis yap</a></td>
<td><a href="index.php?i=anket">anket</a></td>
</tr>

</table>
</form>
</div>
<?php
}
else {
?>
<div style="float:left;">
<form method="post" action="index.php">
<table>
<tr>
<td>kullanıcı adı</td>
<td>sıfre</td>
</tr>

<tr>
<td><input type="text" name="ad"/></td>
<td><input type="text" name="sifre"/></td>
<td><input type="submit" value="giris" name="giris"/></td>
</tr>
<tr>
<td><input type="Checkbox" name="benih"/> beni hatırla</td>
</tr>
</table>
</form>
</div>

<?php } ?>
</div>
<?php
$is="";
if(isset($_GET["i"])){
	$is=$_GET["i"];
}
if($is=="anket")
{?>
<center>
	<div style="border:1px solid;float:left;width:100%;">
	<form method="post" action="index.php?i=aekle">
	<input type="text" name="soru" placeholder="soru"/><br>
	<input type="text" name="c1" placeholder="c1"/><br>
	<input type="text" name="c2" placeholder="c2"/><br>
	<input type="text" name="c3" placeholder="c2"/><br>
	<input type="submit" value="ekle" name="aekle"/>
	</form>
	</div>
	
	
	<div style="border:1px solid;float:left;width:100%;">
	<?php
	$a=mysqli_query($bag,"select * from anket order by tarih desc");
	while($an=mysqli_fetch_array($a)){
	$a1=mysqli_query($bag,"select * from cevap where anketid='".$an['id']."'");
	$a2=mysqli_query($bag,"select * from cevap where anketid='".$an['id']."' and c='".$an['c1']."' ");
	$a3=mysqli_query($bag,"select * from cevap where anketid='".$an['id']."' and c='".$an['c2']."' ");
	$a4=mysqli_query($bag,"select * from cevap where anketid='".$an['id']."' and c='".$an['c3']."' ");
	$as1=mysqli_num_rows($a1);
	$as2=mysqli_num_rows($a2);
	$as3=mysqli_num_rows($a3);
	$as4=mysqli_num_rows($a4);
	
	?>
	<form method="post" action="index.php?i=anketoyla&id=<?php echo $an['id'] ;?>">
<span><?php echo $an['s'] ;?></span><br>
	<input type="radio" name="c" value="<?php echo $an['c1'] ;?>"/><?php echo $an['c1'] ; if($as2>0) echo (($as2/$as1)*100); else echo 0;?><br>
	<input type="radio" name="c" value="<?php echo $an['c2'] ;?>"/><?php echo $an['c2'] ; if($as3>0) echo (($as3/$as1)*100); else echo 0;?><br>
	<input type="radio" name="c" value="<?php echo $an['c3'] ;?>"/><?php echo $an['c3'] ;  if($as4>0) echo (($as4/$as1)*100); else echo 0;?><br>
	<input type="submit" value="oyla" name="oyla"/>
	</form>
	</div>
	<?php
	}
	?>
	
	</center>
	
<?php	
}

else if($is=="yorum"){
		$yo3=mysqli_query($bag,"select * from gonderi  where  id='".$_GET['id']."'");
	
	$y3=mysqli_fetch_array($yo3);
	?>
	<div style="border:1px solid;float:left;width:100%;">

<div style="border-bottom:1px solid;width:100%;float:left;"><?php echo $y3['ad'] ;?> paylastı <?php echo $y3['tarih'] ;?> </div>
<div style="width:100%;float:left;" ><?php echo $y3['gonderi'] ;?></div>
</div>
	<div style="float:left;border:1px solid;width:100%;"><center><h1>iligili yorumlar</h1></center></div>
	
<?php	
$yo4=mysqli_query($bag,"select * from yorum  where  gonderi_id='".$_GET['id']."' order by tarih desc");
while($y4=mysqli_fetch_array($yo4)){
?>
	<div style="border:1px solid;float:left;width:100%;">

<div style="border-bottom:1px solid;width:100%;float:left;"><?php echo $y4['ad'] ;?> diyor ki <?php echo $y4['tarih'] ;?> </div>
<div style="width:100%;float:left;" ><?php echo $y4['yorum'] ;?></div>
</div>
<?php


}
}
else{
	?>














<div style="float:left">
<div style="float:left;border:1px solid; margin-top:150px;"><center><h1>son paylasılanla</h1></center></div>
<?php
$gos=mysqli_query($bag,"select * from gonderi order by tarih desc");
while($g=mysqli_fetch_array($gos)){
	
?>
<div style="border:1px solid; margin-top:250px;width:100%;">

<div style="border-bottom:1px solid;width:100%;"><?php echo $g['ad'] ;?> paylastı <?php echo $g['tarih'] ;?> </div>
<div style="border-bottom:1px solid;width:100%;" ><?php echo $g['gonderi'] ;?></div>
<?php
if(isset($_SESSION['ad'])){
	$beg=mysqli_query($bag,"select * from begen where ad='".$_SESSION['ad']."' and gonderi_id='".$g['id']."'");
	$beg2=mysqli_query($bag,"select * from begen where gonderi_id='".$g['id']."'");
	$bs=mysqli_num_rows($beg);
	$bs2=mysqli_num_rows($beg2);

	
?>
<div style="float:left;width:50%;">
<div style="float:left;width:50%;">
<?php
while($b2=mysqli_fetch_array($beg2)){
	?>
	<span>-<?php echo $b2['ad'] ;?> </span>
	
	<?php
	
}
?>
	<span>-</span><br>
<?php
if($bs==0){
?>
<a href="index.php?i=begen&id=<?php echo $g['id'] ;?> "><?php echo $bs2 ;?> begen</a>
<?php
}
else{
?>
<a href="index.php?i=begenv&id=<?php echo $g['id'] ;?> "><?php echo $bs2 ;?> begen vazgec</a>
<?php
}
?>
</div>
<div style="float:left">
<?php

	$yo2=mysqli_query($bag,"select * from yorum where gonderi_id='".$g['id']."'");
	
	$ys2=mysqli_num_rows($yo2);

while($y2=mysqli_fetch_array($yo2)){
	?>
	<span>-<?php echo $y2['ad'] ;?> </span>
	
	<?php
	
}
?>
	<span>-</span><br>

<a href="index.php?i=yorum&id=<?php echo $g['id'] ;?>"><?php echo $ys2;?> yorum</a>
<form method="post" action="index.php?i=ekle&id=<?php echo $g['id'] ;?> ">
<input type="text" name="yorum"/>
<input type="submit" value="yorum yap" name="yorumy"/>
</form>
</div>
</div>
<?php }
else
{?>
<div style="float:left;width:50%;">
<div style="float:left;width:50%;">
<?php
	$beg2=mysqli_query($bag,"select * from begen where gonderi_id='".$g['id']."'");
	$bs2=mysqli_num_rows($beg2);
while($b2=mysqli_fetch_array($beg2)){
	?>
	<span>-<?php echo $b2['ad'] ;?> </span>
	
	<?php
	
}
?>
	<span>-</span><br>
<?php echo $bs2 ;?>begen

</div>
<div style="float:left">

<?php

	$yo2=mysqli_query($bag,"select * from yorum where gonderi_id='".$g['id']."'");
	
	$ys2=mysqli_num_rows($yo2);

while($y2=mysqli_fetch_array($yo2)){
	?>
	<span>-<?php echo $y2['ad'] ;?> </span>
	
	<?php
	
}
?>
	<span>-</span><br>
	
	<?php echo $ys2;?>  yorum

</div>
</div>
<?php
}?>

</div>
<?php
} } ?>





</div>





</body>

</html>