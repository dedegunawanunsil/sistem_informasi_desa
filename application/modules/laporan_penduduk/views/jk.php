<html>
<head>
	<title>Jumlah Penduduk Menurut Jenis Kelamin dan Potensial Pemilih</title>
	<style type="text/css">
	table {
		border-collapse: collapse;
	}
	table {
		width:100%;
	}
	table, th, tr, td {
		border: 1px solid black;
		font-size:11px;
	}
	table.no-border, table.no-border th, table.no-border tr, table.no-border td {
		border: none !important;
	}
	td {
		padding:4px;
	}
	.center {
		text-align:center;
	}
	.bg-abu80 {
		background-color:#ccc !important;
	}

	</style>
</head>
<body>
<div class="title">
	<?php $this->load->view('logo');?>
	<h2>Jumlah Penduduk Menurut Jenis Kelamin dan Potensial Pemilih</h2>
	<table class="no-border">
		<tr>
			<td>Provinsi :</td><td>Jawa Barat</td>
		</tr>
		<tr>
			<td width="120px">Kabupaten/Kota :</td><td>Ciamis</td>
		</tr>
		<tr>
			<td>Kecamatan :</td><td>Kawali</td>
		</tr>
	</table>
</div>
<br/>
<br/>
<table>
	<tr>
		<th rowspan="2" colspan="2">DESA/KELURAHAN</th>
		<th colspan="2">JENIS KELAMIN</th>
		<th rowspan="2">RASIO JENIS<br/>KELAMIN<br/>(LK/PR) x 100</th>
		<th rowspan="2">KELUARGA<br/>(KK)</th>
		<th rowspan="2">PENDUDUK<br/>(Jiwa)</th>
		<th rowspan="2">POTENSIAL PEMILIH<br/>(Jiwa)</th>
	</tr>
	<tr>
		<th>Laki-laki<br/>(Lk)</th>
		<th>Perempuan<br/>(Pr)</th>
	</tr>
	<?php 
	if(is_object($data)) { ?>
	<tr>
		<td class="center" colspan="2">WINDURAJA</td>
		<td class="center"><?php echo $data->lk;?></td>
		<td class="center"><?php echo $data->pr;?></td>
		<td class="center"><?php echo (($data->lk/$data->pr)*100);?></td>
		<td class="center"><?php echo $data->jumlah_kk;?></td>
		<td class="center"><?php echo $data->jumlah_penduduk;?></td>
		<td class="center"><?php echo $data->potensial_pemilih;?></td>
	<tr>
	<?php } ?>
</table>
</body>
</html>
