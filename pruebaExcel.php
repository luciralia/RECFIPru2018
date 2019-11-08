<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tabla Excel</title>
</head>

<body>

<table id="tblCenso">
<thead>
<th> Fecha Entrada</th><th>linea caja </th>
</thead>
<tbody>
<tr>
<td>Primer linea</td>
<td>Ejem</td>
<td>Ejem2</td>
<td>Ejem3</td>
</tr>
<tr>
<td>Segunda linea</td>
<td>Ejem</td>
<td>Ejem2</td>
<td>Ejem3</td>
</tr>
</tbody>
</table>
</body>
</html>
<script>

http://www.desarrollohidrocalido.com/javascript-exportar-tabla-html-a-excel/
function descargaExcel(){
	var tmpElemento=document.createElement('a');
	var data_type='data:application/vnd.ms-excel';
	var tabla_div=document.getElementById('tblCenso');
	var tabla_html=tabla_div.outerHTML.replace(/ /g, '%20');
	tmpElemento.href=data_type+','+tabla_html;
	tmpElemento.download='Nombre_Del_Achivo.xls';
	tmpElemento.click();
}
descargaExcel();
</script>
	
