<html>
<head>
	<title>Data Keseluruhan Penduduk Desa WINDURAJA</title>
</head>
<body>
<div class="title center">
	<?php $this->load->view('logo');?>
	<h2>Data Keseluruhan Penduduk Desa WINDURAJA</h2>
</div>
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

<table>
<?php 
$no_kk = 1;
$no_kel = 1;
if(@$data_kk && is_array($data_kk)) {
	foreach($data_kk as $_data_kk) {
		echo "<tr class='bg-abu80'>
		<td class='center'>NO</td>
		<td class='center'>NIKK</td>
		<td colspan='3' class='center'>NAMA KK</td>
		<td colspan='9' class='center'>ALAMAT</td>
		</tr>
		<tr>
		<td class='center'>$no_kk</td>
		<td class='center'>{$_data_kk->nikk}</td>
		<td class='center' colspan='3'>{$_data_kk->nama_kk}</td>
		<td class='center' colspan='9'>{$_data_kk->alamat_detail}</td>
		</tr>";
		if(isset($data_kel[$_data_kk->id]) && is_array($data_kel[$_data_kk->id]) ) {
			echo "<tr>
			<td>NO</td>
			<td>NIK</td>
			<td>NAMA</td>
			<td>JK</td>
			<td>TMPTLAHIR</td>
			<td>TGLLAHIR</td>
			<td>GDR</td>
			<td>AGAMA</td>
			<td>STATUS</td>
			<td>SHDK</td>
			<td>PENDIDIKAN</td>
			<td>PEKERJAAN</td>
			<td>IBU</td>
			<td>AYAH</td>
			</tr>";
			foreach($data_kel[$_data_kk->id] as $_data_kel) {
				echo "<tr>
				<td>$no_kel</td>
				<td>{$_data_kel->nik}</td>
				<td>{$_data_kel->nama}</td>
				<td>{$_data_kel->jenis_kelamin}</td>
				<td>{$_data_kel->tempat_lahir}</td>
				<td>{$_data_kel->tgl_lahir}</td>
				<td>-</td>
				<td>{$_data_kel->agama}</td>
				<td>".($_data_kel->status_nikah == 1 ? "Kawin" : "Belum Kawin")."</td>
				<td>{$_data_kel->status}</td>
				<td>{$_data_kel->pendidikan}</td>
				<td>{$_data_kel->pekerjaan}</td>
				<td>{$_data_kel->ibu}</td>
				<td>{$_data_kel->ayah}</td>
				</tr>";
				$no_kel++;
			}
		}
		$no_kk++;
	}
} 
?>
</table>
</body>
</html>
