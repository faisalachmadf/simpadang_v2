<?php
	//$cnn = mysql_connect("localhost","root",""); //local
	$cnn = mysql_connect("localhost:3306","adminspektorat","inspektoratJago"); //server
	mysql_select_db("db_inspektorat", $cnn);
	$n = $_POST['nama'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Inspektorat Cianjur </title>

		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<script type="text/javascript" src="jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="bootstrap.min.js"></script>
		
		<style type="text/css">
			.red {color: red}
			th,td {padding: 10px}
		</style>
	</head>

	<body>

		<div class="col-sm-12"><br/><br/><br/><br/><br/></div>
		<h1 align="center">- CEK USER PASS INSPEKTORAT -</h1> <hr/>

		<?php
			$select = "SELECT * FROM tb_pegawai AS p JOIN tb_user AS u ON p.id_pegawai=u.id_fk WHERE p.nama LIKE '%$n%'";
			$q_slct = mysql_query($select, $cnn);
			$cek = mysql_num_rows($q_slct);

			if($cek<1) {
				echo "<center><h5 class='red'>Tidak ditemukan nama yang dicari.</h5>";
				echo "<a href='javascript:history.back();'> Kembali </a></center>";
			}
			else {
				echo "
				<center>
				<table border='1'>
					<tr>
						<th> NO </th>
						<th> NAMA </th>
						<th> ID PEGAWAI </th>
						<th> USERNAME </th>
						<th> PASSWORD </th>
					</tr>
				
				"; $no=1;
				while($get = mysql_fetch_array($q_slct)) {
					echo "
					<tr>
						<td align='center'>$no</td>
						<td>$get[nama]</td>
						<td align='center'>$get[id_pegawai]</td>
						<td align='center'>$get[username]</td>
						<td align='center'>". base64_decode($get['password']) ."</td>
					</tr>
					"; $no++;
				}
				echo "</table><br/><a href='javascript:history.back();'> Kembali </a></center><hr/>";
			}
		?>

</html>
