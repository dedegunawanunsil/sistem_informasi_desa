<html>
<head>
	<title>Jumlah Penduduk Menurut Status Perkawinan dan Potensial Pemilih</title>
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
	<div>
		<?php $this->load->view('logo');?>
	</div>
	<div style="clear:both" ></div>
	<h2>Jumlah Penduduk Menurut Status Perkawinan dan Potensial Pemilih</h2>
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
		<th rowspan="2" >DESA/KELURAHAN</th>
		<th colspan="2">JENIS KELAMIN</th>
		<th colspan="<?php echo count($status_nikah);?>">STATUS PERKAWINAN</th>
		<th rowspan="2">KELUARGA<br/>(KK)</th>
		<th rowspan="2">PENDUDUK<br/>(Jiwa)</th>
		<th rowspan="2">POTENSIAL PEMILIH<br/>(Jiwa)</th>
	</tr>
	<tr>
		<th>Laki-laki<br/>(Lk)</th>
		<th>Perempuan<br/>(Pr)</th>
		<?php 
			foreach($status_nikah as $_status_nikah) {
				echo "<th>{$_status_nikah->nama}</th>";
			}
		?>
	</tr>
	<?php 
	if(is_object($data)) { ?>
	<tr>
		<td class="center" >WINDURAJA</td>
		<td class="center"><?php echo $data->lk;?></td>
		<td class="center"><?php echo $data->pr;?></td>
		<?php 
		foreach($status_nikah as $_status_nikah) {
			echo "<td class='center'>".$this->laporan_penduduk_model->get_count_status_nikah($_status_nikah->id)."</td>";
		}
		?>
		<td class="center"><?php echo $data->jumlah_kk;?></td>
		<td class="center"><?php echo $data->jumlah_penduduk;?></td>
		<td class="center"><?php echo $data->potensial_pemilih;?></td>
	<tr>
	<?php } ?>
</table>
</body>
</html>
