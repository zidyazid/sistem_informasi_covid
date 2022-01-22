<?php
session_start();
require_once '../config/koneksi.php';
require_once 'class.covid.php';
require_once '../config/fungsi_sqltgl.php';
$covid = new covid($pdo);
if (!empty($_POST['deskripsi'])) {
	$deskripsi 		= $_POST['deskripsi'];
	$umur 			= $_POST['umur'];
	$jenis_kelamin 		= $_POST['jenis_kelamin'];
	$keterangan 	= $_POST['keterangan'];
	$id_posko 		= $_POST['id_posko'];
	$created_by 	= $_SESSION['s_user'];
	if ($covid->create($deskripsi, $umur, $jenis_kelamin, $keterangan, $id_posko, $created_by)) {
		$sg   = "ok";
		$msg1 = "Data telah ditambahkan";
		$alert = 'alert-success';
	} else {
		$g = "err";
		$msg2 = "Data tidak bisa dimasukan";
		$alert = 'alert-error';
	}
}

?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Tambah covid</legend>
		<span>
			<?php
			if (isset($sg) and $sg == 'ok') {
				echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
			} elseif (isset($sg) and $sg == 'err') {
				echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>";
			}
			?>
		</span>
		<div class="row-fluid">
			<div class="span6">
				<div class="control-group">
					<label class="control-label" for="deskripsi">Nama</label>
					<div class="controls">
						<textarea class="span12" id="deskripsi" name="deskripsi" required></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="umur">Umur</label>
					<div class="controls">
						<input type="text" class="span5" id="umur" name="umur" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
					<div class="controls">
					
					<select name="jenis_kelamin" id="jenis_kelamin" required class="control-label" data-placeholder="Pilih level....">
							<option value=""></option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuanr">Perempuan</option>						
					</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="keterangan">Alamat</label>
					<div class="controls">
						<textarea class="span12" id="keterangan" name="keterangan"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="id_posko">Posko</label>
					<div class="controls">
						<select name="id_posko" id="id_posko" readonly="readonly">
							<?php
							$c = $_SESSION['id_posko'];
							$query = "SELECT * FROM posko";
							$covid->posko($query);
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<div class="controls">
				<button type="submit" class="btn btn-primary">Tambah</button>
				<button type="button" id="close" class="btn btn-primary">Tutup</button>
			</div>
		</div>

	</fieldset>
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$("#close").click(function() {
			$("#form-nest").hide("slow");
		});
	});
</script>