<html>
<head>
	<title>Jumlah Penduduk Menurut Pendidikan Terakhir</title>
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
	<h2>Jumlah Penduduk Menurut Pendidikan Terakhir</h2>
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
		<th colspan="<?php echo count($pendidikan_terakhir);?>">PENDIDIKAN TERAKHIR</th>
		<th rowspan="2">KELUARGA<br/>(KK)</th>
		<th rowspan="2">PENDUDUK<br/>(Jiwa)</th>
	</tr>
	<tr>
		<th>Laki-laki<br/>(Lk)</th>
		<th>Perempuan<br/>(Pr)</th>
		<?php 
			foreach($pendidikan_terakhir as $_pk) {
				echo "<th>".romanic_number($_pk->id)."</th>";
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
		foreach($pendidikan_terakhir as $_pk) {
			echo "<td class='center'>".$this->laporan_penduduk_model->get_count_pendidikan_terakhir($_pk->id)."</td>";
		}
		?>
		<td class="center"><?php echo $data->jumlah_kk;?></td>
		<td class="center"><?php echo $data->jumlah_penduduk;?></td>
	<tr>
	<?php } ?>
</table>
<br/>
<br/>
<table style="max-width:300px;">
<tr>
	<td>
	Ket :<br/>
	Pendidikan Terakhir<br/>
	<?php 
	foreach($pendidikan_terakhir as $_pk) {
		echo "<div style='float:left;width:60px;'>".romanic_number($_pk->id)."</div>:".$_pk->nama."<br/>";
	}
	?>
	</td>
</tr>
</table>
</body>
</html>
