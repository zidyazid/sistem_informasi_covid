<?php 
	session_start();
	include_once '../../config/koneksi.php';
	require_once 'class.vaksin.php';
	$vaksin_ = new vaksin($pdo);
	if(!empty($_POST['id_vaksin'])){
		$id_vaksin	= $_POST['id_vaksin'];
		$vaksin		= $_POST['vaksin'];
		$keterangan 	= $_POST['keterangan'];
		$aktif			= $_POST['aktif'];
		$update_by		= $_SESSION['s_user'];
		if($vaksin_->update($id_vaksin,$vaksin,$keterangan,$aktif,$update_by)){
			$sg   = "ok";
			$msg1 = "Data Berhasil Di Update";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data Gagal Di Update";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Edit vaksin</legend>
		<span>
		<?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
        	?>
        <div class="form-actions">
			<div class="controls">
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		<?php }elseif(isset($sg) and $sg=='err')
		{
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>"; 
		}
		else
		{
		if(isset($_GET['id_vaksin']))
		{
			$id = $_GET['id_vaksin'];
			extract($vaksin_->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<div class="control-group">
				<label class="control-label" for="id_vaksin" >ID vaksin</label>
					<div class="controls">
					<input type="text" id="id_vaksin" name="id_vaksin" value="<?php echo $id_vaksin; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="alamat_vaksin" >vaksin</label>
					<div class="controls">
					<textarea class="span12" id="vaksin" name="vaksin" value="<?php echo $vaksin; ?>" required><?php echo $vaksin; ?></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span12" id="keterangan" name="keterangan" value="<?php echo $keterangan; ?>" ><?php echo $keterangan; ?></textarea>
					</div>
				</div>		
				<div class="control-group">
					<label class="control-label">Aktif</label>
					<div class="controls">
						<label>
							<input name="aktif" type="radio" value="Y" <?php echo ($aktif=='Vaksin 1')?'checked':''; ?> />
							<span class="lbl"> Vaksin 1</span>
						</label>
						<label>
							<input name="aktif" type="radio" value="N" <?php echo ($aktif=='Vaksin 2')?'checked':''; ?> />
							<span class="lbl"> Vaksin 2</span>
						</label>
					</div>
				</div>
			</div>							
		</div>
		<div class="form-actions">
			<div class="span6">
				<div class="controls-group">
				<button type="submit" class="btn btn-primary">Edit</button>
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
				</div>
			</div>
			<div class="span6">
			<div class="control-group">
				<label class="control">Data Input :<?php echo "$created_by"; echo " - "; echo "$created_at"; ?> </label>
				<label class="control">Data Update :<?php echo "$update_by"; echo " - "; echo "$update_at"; ?> </label>
			</div>
		</div>
		<?php 
		}
		?>		
	</fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
	});	
</script>