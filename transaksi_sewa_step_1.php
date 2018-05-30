<style>
	.mb-1
	{
		padding: 10px 0px;
	}
</style>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1 class="panel-title"><span class="glyphicon glyphicon-edit"></span>&nbsp; FORM SEWA</h1>
	</div>
	<div class="panel-body">
		<div class="col-sm-6 col-md-6">
			<div class="form-group mb-1">
				<label class="col-sm-12">Nama Lengkap Saksi Penyewa</label>
				<div class="col-sm-12">
					<input type="text" name="nama_saksi_penyewa" class="form-control">
				</div>
			</div>
			<div class="form-group mb-1">
				<label class="col-sm-12">Nomor Hp/Wa Saksi Penyewa</label>
				<div class="col-sm-12">
					<input type="text" name="no_hp_saksi_penyewa" class="form-control">
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-md-6">
			<div class="form-group mb-1">
				<label class="col-sm-12">Durasi Sewa Awal</label>
				<div class="col-sm-12">
					<div class="input-group date form-datetime" data-date="<?php echo date('Y-m-d') ?>T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p">
						<input type="text" name="durasi_awal_penyewa" class="form-control" value="" readonly="">
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
					</div>
				</div>
				<div class="col-sm-12 notive_durasi_awal"></div>
			</div>

			<div class="form-group mb-1">
				<label class="col-sm-12">Durasi Sewa Berakshir</label>
				<div class="col-sm-12">
					<div class="input-group date form-datetime" data-date="<?php echo date('Y-m-d') ?>T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
						<input type="text" name="durasi_akhir_penyewa" class="form-control" value="" readonly>
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
					</div>
				</div>

				<div class="col-sm-12 notive-durasi-akhir"></div>
			</div>

		</div>

		<div class="col-md-12 col-sm-4">
			<input onclick="step1Next()" id="next_2" class="btn btn-md btn-success pull-right" value="Next">
		</div>
	</div>
</div>
