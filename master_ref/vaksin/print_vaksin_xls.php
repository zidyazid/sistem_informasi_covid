<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-vaksin.xls");
require_once '../../config/koneksi.php';
require_once '../vaksin/class.vaksin.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar vaksin</h3>
</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%" border="1">
	<thead>
		<tr align="center">
			<th width="50px">No</th>
			<th>vaksin</th>
			<th>Keterangan</th>
			<th width="50px">Aktif</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$vaksin = new vaksin($pdo);		
		$query = "SELECT * FROM vaksin";		
		$vaksin->view($query);
	?>
	</tbody>
</table>
<p></p>
<p>Tanggal <?php echo date('d-M-Y'); ?><br />
Jumlah vaksin Aktif = <?php $vaksin->count_aktif(); ?><br />
Jumlah vaksin Tidak Aktif = <?php $vaksin->count_not_aktif(); ?></p>
<p></p>