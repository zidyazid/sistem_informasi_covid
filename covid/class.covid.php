<?php

class covid
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($deskripsi,$umur,$jenis_kelamin,$keterangan,$id_posko,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO covid(deskripsi,umur,jenis_kelamin,keterangan,id_posko,created_by) VALUES (:deskripsi, :umur, :jenis_kelamin, :keterangan, :id_posko, :created_by)");			
			$query -> bindparam(":deskripsi",$deskripsi);
			$query -> bindparam(":umur",$umur);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":keterangan",$keterangan);
			$query -> bindparam(":id_posko",$id_posko);
			$query -> bindparam(":created_by",$created_by);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function count_aktif()
	{
		$query = $this->db->prepare("SELECT * FROM covid where aktif = 'Y' ");	
		$query->execute();
		$row_count = $query->rowCount();
		echo $row_count;
	}

	public function count_not_aktif()
	{
		$query = $this->db->prepare("SELECT * FROM covid where aktif = 'N' ");	
		$query->execute();
		$row_count = $query->rowCount();
		echo $row_count;
	}

	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM covid WHERE id_covid=:id_covid");
		$query->execute(array(":id_covid"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_covid,$deskripsi,$umur,$jenis_kelamin,$keterangan,$id_posko,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE covid SET 	deskripsi		= :deskripsi,
															umur 			= :umur,
															jenis_kelamin 			= :jenis_kelamin,
															keterangan 		= :keterangan,
															id_posko		= :id_posko,
													   		update_by 		= :updated_by
													WHERE 	id_covid		= :id_covid ");
			$query -> bindparam(":deskripsi",$deskripsi);
			$query -> bindparam(":umur",$umur);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":keterangan",$keterangan);
			$query -> bindparam(":id_posko",$id_posko);
			$query -> bindparam(":updated_by",$update_by);
			$query -> bindparam(":id_covid",$id_covid);
			$query -> execute();			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		//try
		//{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM covid WHERE id_covid=:id_covid");
		$query->bindparam(":id_covid",$id);
		$query->execute();
		return true;
		/*
		}
		catch(PDOException $e)
		{
			echo "
			<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data masih di gunakan oleh username ( hapus / edit username yang masih menggunakan covid ini ....! )
			</div>";	
			return false;
		}
		*/
	}

	public function posko($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_posko]'>$row[keterangan]</option>";
		}
		
	}

	public function posko_1($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo $row['alamat_posko'];
		}
		
	}
	
	public function view($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><div align="center" width="50px"><?php print($no); ?></div></td>
                <td><?php print($row['deskripsi']); ?></td>
                <td><?php print($row['umur']); ?></td>
                <td><?php print($row['jenis_kelamin']); ?></td>
                <td><?php print($row['keterangan']); ?></td>
                <td><?php print($row['alamat_posko']); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_covid]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_covid]','$row[deskripsi]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable( {
						"sPaginationType": "bootstrap",
	                    "sSorting":[[2, "desc"]]
					});
				});
			</script><?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
	
	public function Prin($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                	<td><div align="center" width="50px"><?php print($no); ?></div></td>
	                <td><?php print($row['deskripsi']); ?></td>
	                <td><?php print($row['umur']); ?></td>
	                <td><?php print($row['jenis_kelamin']); ?></td>
	                <td><?php print($row['keterangan']); ?></td>
	                <td><?php print($row['alamat_posko']); ?></td>
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
	
}
