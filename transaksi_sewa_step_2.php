<?php
if (!isset($_SESSION['member']))
{
	echo "<script>location='login.php';</script>";
}

$jaminan = array("KTP (Wajib)","SIM C","NPWP","Kartu Pegawai","Password WNA/WNI","BPKB","STNK Aktif (1 atau 5 tahun)","KTM Aktif (Kartu Tanda Mahasiswa)","Kartu peserta BPJS/Akses","KK (Kartu Keluarga)");

// $detail_1 = $pengaturan->detail(1);
// $detail_2 = $pengaturan->detail(2);
?>
<div class="row">
	<div class="col-md-6">
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>PENGUMUMAN!</strong> Bagi penyewa sepeda motor dapat dilihat syaratnya, dibawah ini :
			<!-- Detail syaratan -->
			<?php //echo $detail['isi']; ?>

		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>PENGUMUMAN!</strong> Bagi penyewa mobil dapat dilihat syaratnya, dibawah ini :
			<?php //echo $detail_1['isi']; ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1 class="panel-title"><span class="glyphicon glyphicon-edit"></span>&nbsp; SYARAT SEWA</h1>
				<p class="" style="padding: 10px 20px;">Persyaratan untuk sewa menyewa di Sewobro cukup menjaminkan identitas tanpa deposit uang. Silahkan pilih 3 dari identitas di bawah ini :</p>
			</div>
			<div class="panel-body">
				<div class="">
					<?php foreach ($jaminan as $index => $nama_jaminan): ?>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="jenis_jaminan[]" data-id="<?php echo $nama_jaminan; ?>" id="<?php echo $nama_jaminan ?>" onclick="return show_form(this)" value="<?php echo $nama_jaminan ?>" 
										<?php 
										if (isset($_SESSION['jaminan'][$nama_jaminan])) 
										{
											if ($nama_jaminan == "KTP (Wajib)") 
											{
												echo "required checked disabled";
											}
											else
											{
												echo "checked";
											}
										}
										elseif ($nama_jaminan == "KTP (Wajib)") 
										{
											echo "required checked disabled";
										}
										?>
										> <?php echo $nama_jaminan ?>
									</label>
								</div>
								<div class="ml-1" id="<?php echo $index.'-'.$nama_jaminan; ?>" <?php if ($nama_jaminan == "KTP (Wajib)") {echo 'style="display: "';} else { echo 'style="display: none"'; } ?> >
									<label class="control-label">Scan <?php echo $nama_jaminan ?></label>
									<div class="mb-1">
										<input type="file" name="<?php echo $nama_jaminan ?>" class="filejaminan" nama="<?php echo $nama_jaminan ?>" multiple="">
									</div>
									<img nama="<?php echo $nama_jaminan ?>" width="100" height="100"
									<?php 
									if (isset($_SESSION['jaminan'][$nama_jaminan])) 
									{
										$src = $_SESSION['jaminan'][$nama_jaminan];
										echo "src='images/jaminan/$src'";
									}
									else
									{
										echo "src='images/icon/noimage.jpg'";
									}
									?>>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
				<div class="col-md-12 col-xs-7">
					<input onclick="prevStep()" class="btn btn-md btn-danger" value="Prev">
					<!-- 1. Saat di klik menyimpan jika belum pesan sudah pernah pesan 
						2. jika saat masih transaksi dari tgl checkin dan checkout-->
					<?php $check_iklan = $pemesanan->check_transaksi($_GET['id'], $_SESSION['member']['id_member']);?>
					<?php if ($check_iklan == "belum"): ?>
						<input type="submit" name="simpan" class="btn btn-success btn-md pull-right" value="Next">
					<?php else: ?>
						<input onclick="step2Next()" class="btn btn-md btn-success pull-right" value="Next">
					<?php endif ?>
				</div>
				<?php
				if (isset($_POST['simpan'])) 
				{
					$id_iklan = $_GET['id'];
					$id_member = $_SESSION['member']['id_member'];
					$tgl_sewa = date("Y-m-d H:i:s");
					$tgl_chek_in = $_SESSION['step1']['awal'];
					$tgl_chek_out = $_SESSION['step1']['akhir'];
					$total_bayar = $_SESSION['step1']['biaya'];
					$metode_pembayaran = $detail['metode_pembayaran'];
					$id_pemesanan = $pemesanan->simpan_pemesanan($id_iklan, $id_member, $tgl_sewa, $tgl_chek_in, $tgl_chek_out, $total_bayar, $metode_pembayaran);

					$urut = 1;
					foreach ($_SESSION['jaminan'] as $nama_jaminan_input => $file_jaminan)
					{
						$pemesanan->simpan_jaminan($id_pemesanan, $nama_jaminan_input, $file_jaminan, $urut);
						$urut ++;
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$(".filejaminan").on("change", function(){
			var nama = $(this).attr("nama");
			var file_data = $(this).prop("files")[0];
			var form_data = new FormData();
			form_data.append ('file', file_data);
			form_data.append ("nama", nama);
			console.log(file_data);

			$.ajax({
				url : 'pages/transaksi_sewa/skripupload.php',
				dataType : 'text',
				cache : false,
				contentType : false,
				processData : false,
				data : form_data,
				type : 'POST',
				success : function(hasil)
				{
					$("img[nama='"+nama+"']").attr("src","images/jaminan/"+hasil);
					location.reload();
				}
			})
		})
	})
</script>

<script>
	function show_form(elemen)
	{
		var nama_checkbox = document.getElementsByName('jenis_jaminan[]');
		var jumlah = 0;

		<?php foreach ($jaminan as $id_c => $nama_c): ?>
		if (nama_checkbox[<?php echo $id_c ?>].checked) 
		{
			jumlah = jumlah + 1;
		}

		if (jumlah <= 3)
		{
			var ygDiklik = $(elemen).data('id');
			var ygpilih = document.getElementById("<?php echo $nama_c ?>");
			var ygTampil = document.getElementById("<?php echo $id_c.'-'.$nama_c ?>");
			ygTampil.style.display = ygpilih.checked ? "block" : "none";

			$.ajax ({
				data : 'nama_jaminan'+ygDiklik,
				type : 'POST',
				url : 'pages/transaksi_sewa/hapus_session.php',
				success: function (hapus)
				{

				}
			})
		}
		else
		{
			nama_checkbox[<?php echo $id_c ?>].checked = false;
			nama_checkbox[<?php echo $id_c ?>].disabled = false;
			return false;
		}
		<?php endforeach ?>
	}
</script>
<script>
	function step2Next() 
	{
		if (true) {
			currentStep += 1;
			$('#navStep3').removeClass('disabled');
			$('#navStep3').click();
		}
	}
</script>
