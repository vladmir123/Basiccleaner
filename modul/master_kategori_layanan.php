<script type="text/javascript">
	$(document).ready(function(){
    	$('#table-master-kate-layanan').DataTable({
    		"lengthMenu": [ 5, 10, 20, 30, 40, 50, 100 ]
    	});
    	$('.btn-cliked').click(function(){
    		$('.btn-show').slideToggle('slow');
    	});
    	//VALIDATION RULES
    	$('#validation-master-service').validate({
    		rules:{
    			jenis_layanan:{
    				required:true,
    			},
    			nama_layanan:{
    				required:true,
    			},
    			harga_layanan:{
    				required:true,
    			},
    			deskripsi_layanan:{
    				required:true,
    			}
    		},
    		messages:{
    			jenis_layanan:'jenis layanan tidak boleh kosong !!',
    			nama_layanan:'nama layanan tidak boleh kosong !!',
    			harga_layanan:'harga layanan tidak boleh kosong !!',
    			deskripsi_layanan:'deskripsi layanan tidak boleh kosong !!',
    		},
    	});
	});
</script>
<div class="heading-menubar"><h3>Master Kategori Layanan</h3></div>
	<div class="form-group">
		<button class="btn-cliked btn btn-primary">Tambah Kategori Layanan</button>
	</div>
	<div class="row">
		<div class='main-containpages'>
			<div class="btn-show" style="display:none;">
				<div class="col-md-6">
					<form action="backend/proses_master_kategori_layanan.php?act=add_kategori_layanan" method="post" enctype="multipart/form-data" id="validation-master-service">
						<div class="form-group" style="margin-top:30px;">
							<label>Jenis layanan</label>
							<input type="text" name="jenis_layanan" class="form-control" autofocus required="">
						</div>
						<div class="form-group">
							<label>Nama layanan</label>
							<input type="text" name="nama_layanan" class="form-control" autofocus required="">
						</div>
						<div class="form-group">
							<label>Harga layanan</label>
							<input type="text" name="harga_layanan" id="price" class="form-control" autofocus required="">
						</div>
						<div class="form-group">
							<label>Deskripsi</label> 
							<textarea name="deskripsi_layanan" class="form-control" autofocus required=""></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div><!--col-md-6-->
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color:#212121;color:#fff;">Keterangan :</div> 
						<div class="panel-body">
							<p>Cleaning<span>: Adalah jenis layanan Cleaner ( jasa layanan pencucian sepatu )</span></p>
							<p>Repaint<span>: Adalah jenis layanan Repaint ( jasa layanan pewaranaan sepatu )</span></p>
							<p>Reglue<span>: Adalah jenis layanan Reglue ( jasa layanan pengeleman sol sepatu )</span></p>
						</div>
					</div>
				</div>
			</div><!-- div display none -->
			<div class="col-lg-12 clearfix-bottom">
				<table class="table table-hover" id="table-master-kate-layanan">
					<thead class="custom-headtables-globalconf">
						<tr>
							<th>No</th>
							<th>Kategori layanan</th>
							<th>Nama layanan</th>
							<th>Harga layanan</th>
							<th>Deskripsi layanan</th>
							<th>Action</th>
						</tr>
					</thead>	
					<tbody>
						<?php
							$no=1;
							$x = mysqli_query($con,"SELECT * FROM kategori_layanan ORDER BY jenis_layanan ASC");
							while ($res=mysqli_fetch_array($x)) {
						 ?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $res['jenis_layanan']; ?></td>
							<td><?php echo $res['nama_layanan']; ?></td>
							<td>Rp.<?php echo formatuang($res['harga_layanan']); ?></td>
							<td><?php echo $res['deskripsi_layanan']; ?></td>
							<td>
								<a href="homeadmin.php?page=master_edit_kategory_layanan&id=<?php echo $res['id_kategori_layanan']?>">Edit</a> ||
								<a onclick="return confirm('Anda yakin menghapus !!')" href="backend/proses_master_kategori_layanan.php?act=delete_kate_layanan&id=<?php echo $res['id_kategori_layanan'];?>">Hapus</a>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>					
				</table>
			</div>
		</div>
	</div><!--maincontain-page-->
</div><!--row-->



