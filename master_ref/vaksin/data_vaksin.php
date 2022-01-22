<?php
session_start();
include_once '../../config/koneksi.php';
include_once 'class.vaksin.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' || $_SESSION['s_level'] == 'supervisor' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Warga Yang Sudah di Vaksin</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 <?php } ?>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/master_ref/vaksin/print_vaksin.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/master_ref/vaksin/print_vaksin_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simdinkes/master_ref/vaksin/print_vaksin_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<!--<th width="50px">No</th>-->
			<!--<th width="50px">ID</th>-->
			<th>Nama</th>
			<th>Keterangan</th>
			<th width="50px">Status</th>
			<th>Aksi</th>
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


