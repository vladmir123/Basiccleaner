<script type="text/javascript">
    $(document).ready(function(){
        $("input[type='number']").bind("input", function() {
            var input_val = $("input[type='number']").val();
            var subtotal  = $('#total_transaksi').val();
            var counting_price_all_shoes = parseFloat(input_val)*parseFloat(subtotal);
            $('#total_transaksi').val(counting_price_all_shoes);
            //console.log(counting_price_all_shoes);
        });
        $('#bayar').blur(function(){
            var total    = $('#total_transaksi').val();
            var bayarnya = $('#bayar').val();
            var get_returnprice = parseFloat(bayarnya)-parseFloat(total);
            $('#price-kembalian').val(get_returnprice);
            console.log(get_returnprice);
        });
        $('input[type=radio][name=jenis_member]').click(function(){
            var member_person=$(this).val();
            $('.'+member_person).show();
                $('input[type=radio][name=jenis_member]').not(':checked').each(function(){
                    var member_person_atasnama=$(this).val();
                    $('.'+member_person_atasnama).hide();
                });
        });
        //choose jenis layanan member
        $('input[type=radio][name=jenis_layanan_member]').click(function(){
            var cat_service_cleaner=$(this).val();
            $('.'+cat_service_cleaner).show();
                $('input[type=radio][name=jenis_layanan_member]').not(':checked').each(function(){
                    var cat_service_cleaner_hide=$(this).val();
                    $('.'+cat_service_cleaner_hide).hide();
                });
        });
        //choose jenis layanan non member
        $('input[type=radio][name=jenis_layanan_nonmember]').click(function(){
            var cat_service_cleaner=$(this).val();
            $('.'+cat_service_cleaner).show();
                $('input[type=radio][name=jenis_layanan_nonmember]').not(':checked').each(function(){
                    var cat_service_cleaner_hide=$(this).val();
                    $('.'+cat_service_cleaner_hide).hide();
                });
        });
        //format currency jquery
        $('#format_price_cleaning').number(true);
        $('#format_price_repaint').number(true);
        $('#format_price_reglue').number(true);
        //json change functon price on transaction
        $("#choose_cleaning").change(function(){
            var getValue= $(this).val();
            if(getValue == 0) {
            }else{
                $.ajax({
                    url:'json/json_cleaning.php',
                    type:'GET',
                    dataType:'json',
                    data: {'id_cleaning' : getValue},
                    success:function (data) {
                        if(data != '') {
                            $.each(data,function(index,value){
                                $(".price_cleaning").val(value.harga_cleaning);
                                $("#deskripsi_cleaning").val(value.deskripsi_cleaning);
                            });
                        }
                    }
                });
            }
        });
        $("#change_repaint").change(function(){
            var getValrepaint =  $(this).val();
            if (getValrepaint == 0) {
            }else{
                $.ajax({
                    url :'json/json_repaint.php',
                    type:'GET',
                    dataType :'json',
                    data : {'id_repaint' : getValrepaint},
                    success :function(data){
                        if (data !='') {
                            $.each(data,function(index,value){
                                $(".price_repaint").val(value.harga_repaint);
                                $("#deskripsi_repaint").val(value.deskripsi_repaint);
                            });
                        }
                    }
                });
            }
        });
        $("#change_reglue").change(function(){
            var getValrepaint =  $(this).val();
            if (getValrepaint == 0) {
            }else{
                $.ajax({
                    url :'json/json_reglue.php',
                    type:'GET',
                    dataType :'json',
                    data : {'id_reglue' : getValrepaint},
                    success :function(data){
                        if (data !='') {
                            $.each(data,function(index,value){
                                $(".price_reglue").val(value.harga_reglue);
                                $("#deskripsi_reglue").val(value.deskripsi_reglue);
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<?php $getdata_member = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM member WHERE id_member='$_GET[id_member]'"));?>
<div class='main-containpages'>
    <div class="col-md-7">
        <h3>Transaksi masuk <span class="heading-notifier-transaction">(member)</span></h3>
        <form action="<?php echo $site;?>backend/proses_transaksi_shoes.php?act=add_transaksi" method="post" enctype="multipart/form-data">
            <input type="hidden" name="status_member" value="member">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Id member</label>
                    <input type="text" name="id_member" class="form-control" autofocus required="" value="<?php echo $_GET['id_member'];?>">
                </div>
                <div class="col-md-6 form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" name="nama_lengkap" class="form-control" autofocus required="" value="<?php echo $getdata_member['nama_member'];?>">
                </div>
                <div class='col-md-6 form-group'>
                    <label>No Telp</label>
                    <input type='text' name='notelp' class='form-control' autofocus required="" value="<?php echo $getdata_member['notelp_member'];?>">
                </div>
                <div class='col-md-6 form-group'>
                    <label>Email</label>
                    <input type='text' name='email' class='form-control' autofocus required="" value="<?php echo $getdata_member['email_member'];?>">
                </div>
            </div><!-- ROW -->
            <div class='form-group'>
                <label>Alamat</label>
                <textarea name="alamat" cols="10" rows="5" class="form-control" autofocus required=""><?php echo $getdata_member['alamat_member']; ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Jumlah sepatu</label>
                        <input type="number" class="form-control" min="1" max="50" name="jumlah_sepatu" autofocus required="">
                    </div>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" id="adding-services">+</button>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Layanan</label>
                        <select name="jenis_layanan" class="form-control">
                            <option value="">Pilih layanan</option>
                            <?php
                                $get_services = mysqli_query($con,"SELECT * FROM ");
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama sepatu / nama barang</label>
                        <textarea name="nama_barang" cols="10" rows="1" class="form-control"></textarea>
                    </div>
                </div>
            </div><!-- row -->
            <div class='form-actions'>
                <button type="submit" id='proses' class="btn btn-success">Submit</button>
                <button type="cancel" class="btn btn-danger" onclick="javascript:history.go(-2);">Cancel</button>
            </div>
        </section>
        <input type="hidden" name="subtotal" class="price_cleaning">
    </div>
    <!-- sidebar right-->
    <div class="row">
        <div class='col-md-5'>
            <div class="panel panel-default">
                <div class="panel-heading"> Dashboard Cashier </div> 
                <div class="inner-box" style="padding:20px;">
                    <div class="logobasic-center">
                        <img class="logos-shadow" src="<?php echo "frontend/logo/android-icon-96x96.png";?>">
                    </div>
                    <div class='form-group'>
                        No. Nota : 
                        <span class='transaksi-nonota'><input type="text" name="kode_transaksi" value="TRK<?php echo acakangkahuruf(3);?>" style="border:none;"></span>
                    </div>  
                    <div class='form-group'>
                        Tanggal <span class="transaksi-tanggal">: <?php echo tgl_indo(date("Y-m-d"))?></span>
                    </div>
                    <div class='form-group'>
                        Kasir <span class="transaksi-namakasir">: <?php echo $_SESSION['nama_admin'];?></span>
                    </div>
                    <div class="form-group">
                      Waktu <span class="transaksi-clock" id="clock">: <?php print date('H:i:s'); ?></span>
                    </div>
                </div>
            </div>
            <!-- PANEL CASHIER MONEY -->
            <div class="panel panel-default">
                <div class="panel-heading"> Cashier payment </div> 
                <div class="inner-box" style="padding:20px;">
                    <div class="form-group">
                        <label>List Transaksi Item</label>
                        <p>-</p>
                    </div>
                    <div class='form-group'>
                        <label>Subtotal Transaksi</label>
                        <input type="text" id="total_transaksi" name="total_trans" class="form-control price_cleaning price_repaint price_reglue">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Jumlah Bayar</label>
                            <input id="bayar" type="text" name="jum_bayar" class="form-control bayar">
                        </div> 
                        <div class="col-md-6">
                            <label>Kembalian</label>
                            <input id="price-kembalian" type="text" name="kembalian" class="form-control" value=""></input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div><!-- row cashier sidebar -->
</div>

