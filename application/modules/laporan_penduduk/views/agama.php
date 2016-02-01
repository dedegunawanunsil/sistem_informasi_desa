<html>
<head>
	<title>Jumlah Penduduk Menurut Agama</title>
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
	<h2>Jumlah Penduduk Menurut Jenis Agama</h2>
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
		<th rowspan="2">DESA/KELURAHAN</th>
		<th colspan="2">JENIS KELAMIN</th>
		<th colspan="<?php echo count($agama);?>">AGAMA</th>
		<th rowspan="2">KELUARGA<br/>(KK)</th>
		<th rowspan="2">PENDUDUK<br/>(Jiwa)</th>
	</tr>
	<tr>
		<th>Laki-laki<br/>(Lk)</th>
		<th>Perempuan<br/>(Pr)</th>
		<?php 
			foreach($agama as $_agama) {
				echo "<th>{$_agama->nama}</th>";
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
		foreach($agama as $_agama) {
			echo "<td class='center'>".$this->laporan_penduduk_model->get_count_agama($_agama->id)."</td>";
		}
		?>
		<td class="center"><?php echo $data->jumlah_kk;?></td>
		<td class="center"><?php echo $data->jumlah_penduduk;?></td>
		
	<tr>
	<?php } ?>
</table>
</body>
</html>
