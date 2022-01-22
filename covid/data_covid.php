<?php
session_start();
include_once '../config/koneksi.php';
include_once 'class.covid.php';
?>
<?php if ($_SESSION['s_level'] == 'administrator' ) { ?><?php } ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar covid</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/covid/print_covid.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simdinkes/covid/print_covid_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simdinkes/covid/print_covid_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th width="50px">No</th>
			<th>Nama</th>
			<th>Umur</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th>Posko</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
			<?php
			$covid = new covid($pdo);
			$query = "SELECT covid.deskripsi, covid.umur, covid.id_covid, covid.jenis_kelamin, covid.keterangan, posko.alamat_posko
  FROM covid 
  JOIN posko ON covid.id_posko = posko.id_posko
 WHERE covid.id_posko = posko.id_posko";
			$covid->view($query);
			?>
		</tbody>
</table>


