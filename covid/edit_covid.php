<?php 
	session_start();
	include_once '../config/koneksi.php';
	require_once 'class.covid.php';
	$covid = new covid($pdo);
	if(!empty($_POST['id_covid'])){
		$id_covid		= $_POST['id_covid'];
		$deskripsi 		= $_POST['deskripsi'];
		$umur 			= $_POST['umur'];
		$jenis_kelamin 		= $_POST['jenis_kelamin'];
		$keterangan 	= $_POST['keterangan'];
		$id_posko 		= $_POST['id_posko'];
		$update_by		= $_SESSION['s_user'];
		if($covid->update($id_covid,$deskripsi,$umur,$jenis_kelamin,$keterangan,$id_posko,$update_by)){
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
		<legend>Edit covid</legend>
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
		if(isset($_GET['id_covid']))
		{
			$id = $_GET['id_covid'];
			extract($covid->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span9">
				<input type="hidden" id="id_covid" name="id_covid" value="<?php echo $id_covid; ?>" readonly="readonly">
		
				<div class="control-group">
				<label class="control-label" for="deskripsi" >Deskripsi</label>
					<div class="controls">
					<textarea class="span12" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi; ?>" required><?php echo $deskripsi; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="umur" >umur</label >
					<div class="controls">
						<input type="text" class="span5" id="umur" value="<?php echo $umur; ?>" name="umur"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="jenis_kelamin" >Jenis Kelamin</label >
					<div class="controls">
						<input type="text" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin; ?>"/>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="keterangan" >Keterangan</label>
					<div class="controls">
					<textarea class="span12" id="keterangan" name="keterangan" value="<?php echo $keterangan; ?>"><?php echo $keterangan; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="id_posko" >Posko</label>
					<div class="controls">
					<select name="id_posko" id="id_posko" readonly="readonly">						
						<?php						
							$c = $_SESSION['id_posko'];
							$query = "SELECT * FROM posko where id_posko='$c' ";		
							$covid->posko($query);
						?>
					</select>
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
		$(".chzn-select").chosen();
	});	
</script>