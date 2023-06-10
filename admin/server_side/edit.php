
<?php 
require '../conn.php';

if(!empty($_GET['cari_barang'])){
    $cari = trim(strip_tags($_POST['keyword']));
	if($cari == '')
	{

	}else{
		$sql = "SELECT * from barang 
				where kobar like '%$cari%' or nama_barang like '%$cari%' or jenis like '%$cari%'";
		$row = $config -> prepare($sql);
		$row -> execute();
		$hasil1= $row -> fetchAll();
?>
	<table class="table table-stripped" width="100%">
	<?php foreach($hasil1 as $hasil){?>
		<tr>
			<td><h4><?php echo $hasil['kobar'];?></h4></td>
			<td><h4><?php echo $hasil['nama_barang'];?></h4></td>
			<td><h4><?php echo $hasil['jenis'];?></h4></td>
			<td>
			<button class="btn btn-success">Taruh</button></a></td>
		</tr>
	<?php }?>
	</table>
<?php	
	}
}
?>
