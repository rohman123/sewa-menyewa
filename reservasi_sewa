<?php 
$idpk = $_GET['id'];
$detail=$pasang_iklansewa_owner->ambil_pasang_iklansewa_owner($idpk);
?>

<div class="m-tb-13">
	<section style="margin-top: -90px;">
		<div class="row">
			<div class="cta-sektion cta-padding35">
				<div class="container">
					<div class="col-md-9 col-sm-9 col-xs-12">
						<h2><span class="glyphicon glyphicon-edit"></span>&nbsp;<b>DATA PRIBADI PENYEWA</b></h2>
					</div>
				</div>
			</div>
		</div>
		<div class="reservasi-content">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<ul class="nav nav-pills nav-justified thumbnail setup-panel" id="myNav">
							<li id="navStep1" class="li-nav active" step="#step-1">
								<a>
									<h4 class="list-group-item-heading">Step 1</h4>
									<p class="list-group-item-text">First step description</p>
								</a>
							</li>
							<li id="navStep2" class="li-nav disabled" step="#step-2">
								<a>
									<h4 class="list-group-item-heading">Step 2</h4>
									<p class="list-group-item-text">Second step description</p>
								</a>
							</li>
							<li id="navStep3" class="li-nav disabled" step="#step-3">
								<a>
									<h4 class="list-group-item-heading">Step 3</h4>
									<p class="list-group-item-text">Third step description</p>
								</a>
							</li>
							<li id="navStep4" class="li-nav disabled" step="#step-4">
								<a>
									<h4 class="list-group-item-heading">Step 4</h4>
									<p class="list-group-item-text">Second step description</p>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<form class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="setup-content" id="step-1">
								<?php include 'pages/transaksi_sewa/transaksi_sewa_step_1.php'; ?>
							</div>
							<div class="setup-content" id="step-2">
								<?php include 'pages/transaksi_sewa/transaksi_sewa_step_2.php'; ?>
							</div>
							<div class="setup-content" id="step-3">
								<?php include 'pages/transaksi_sewa/transaksi_sewa_step_3.php'; ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function(){

		$('input[name=durasi_awal]').on('change', function(){
			var awal = $(this).val();

			$.ajax({
				type : 'POST',
				data : 'tanggal='+awal,
				url : 'pages/transaksi_sewa/validasi_tgl_awal_sewa.php',
				success : function(tgl_awal)
				{
					$('.notive_durasi_awal').html(tgl_awal);
				}
			})
		});

		$('input[name=durasi_akhir_penyewa]').on('change', function(){
			var akhir = $(this).val();
			var awal = $('input[name=durasi_awal_penyewa]').val();
			var id_iklan = "<?php echo $_GET['id'] ?>";
			var nama_saksi = $('input[name=nama_saksi_penyewa]').val();
			var telp_saksi = $('input[name=no_hp_saksi_penyewa]').val();


			$.ajax({
				type : 'POST',
				data : 'awal='+awal+'&akhir='+akhir+'&id_iklan='+id_iklan+'&nama_saksi='+nama_saksi+'&telp_saksi='+telp_saksi,
				url : 'pages/transaksi_sewa/validasi_tgl_akhir_sewa.php',
				success : function(tgl_akhir)
				{
					$('.notive-durasi-akhir').html(tgl_akhir);

					$('#next_2').removeClass("disabled");
				}
			})
		});
	})
</script>

<script>
	var currentStep = 1;

	$(document).ready(function () 
	{
		$('#next_2').addClass("disabled");

		$('.li-nav').click(function () {

			var $targetStep = $($(this).attr('step'));
			currentStep = parseInt($(this).attr('id').substr(7));

			if (!$(this).hasClass('disabled')) {
				$('.li-nav.active').removeClass('active');
				$(this).addClass('active');
				$('.setup-content').hide();
				$targetStep.show();
			}
		});

		$('#navStep1').click();

	});

	function step1Next() 
	{
		//You can make only one function for next, and inside you can check the current step
		if (true) 
		{
			currentStep += 1;
			$('#navStep' + currentStep).removeClass('disabled');
			$('#navStep' + currentStep).click();
		}
	}
	function prevStep() 
	{
		currentStep -= 1;
		$('#navStep' + currentStep).click();
	}

	function step3Next() 
	{
		if (true) {
			$('#navStep4').removeClass('disabled');
			$('#navStep4').click();
		}
	}
</script>

<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
