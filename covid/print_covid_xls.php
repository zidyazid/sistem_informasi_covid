<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-covid.xls");
require_once '../config/koneksi.php';
require_once 'class.covid.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar covid</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th width="50px">No</th>
			<th>Deskripsi</th>
			<th>umur</th>
			<th>Jenis Kelamin</th>
			<th>Keterangan</th>
			<th>Posko</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$covid = new covid($pdo);		
		$id 	= $_SESSION['id_posko'];
		if ($_SESSION['s_level'] == 'administrator'){
			$query = 	"SELECT
						covid.id_covid,
						covid.deskripsi,
						covid.umur,
						covid.jenis_kelamin,
						covid.keterangan,
						covid.id_posko,
						covid.created_by,
						covid.created_at,
						covid.update_by,
						covid.update_at,
						posko.alamat_posko,
						users.id_posko
						FROM
						covid
						INNER JOIN posko ON covid.id_posko = posko.id_posko
						INNER JOIN users ON users.id_posko = posko.id_posko ";	
		}else{
			$query = 	"	SELECT
						covid.id_covid,
						covid.deskripsi,
						covid.umur,
						covid.jenis_kelamin,
						covid.keterangan,
						covid.id_posko,
						covid.created_by,
						covid.created_at,
						covid.update_by,
						covid.update_at,
						posko.alamat_posko,
						users.id_posko
						FROM
						covid
						INNER JOIN posko ON covid.id_posko = posko.id_posko
						INNER JOIN users ON users.id_posko = posko.id_posko
						WHERE
						users.id_posko = $id ";	
		}
		$covid->prin($query);
	?>
	</tbody>
</table>
