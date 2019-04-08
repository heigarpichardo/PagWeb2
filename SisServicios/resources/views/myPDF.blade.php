<!DOCTYPE html>

<html>

<head>

	<title>Factura</title>

</head>

<body>

<table width="737" border="0">
  <tr>
    <td width="461"><strong>Sistema de Servicios</strong></td>
    <td width="266"><font size="-1">5 de Abril del 2019</font></td>
  </tr>
  <tr>
    <td><strong>Tel: (809)-555-5555  * Cel:(829)-555-4444</strong></td>
    <td><font size="-1">Pagina 1 de 1</font></td>
  </tr>
  <tr>
    <td><strong>Vista Linda, Calle Penetración, Plaza New York Primer Nivel Modulo #2</strong></td>
    <td>&nbsp;</td>
  </tr>
</table>
<hr />
<br>
<br>
<h2 align="center">Factura</h2>
<br>
<a><strong>Cliente:</strong>{{ $venta->codigo_persona }} </a>
<br>
<a><strong>NCF:</strong>{{ $venta->NCF }} </a>
<br>
<a><strong>Fecha:</strong>{{ $venta->fecha }} </a>
<br>
<a><strong>Condicion:</strong>{{ $venta->condicion }} </a>
<br>
<br>
<table width=559 border=0>
	<tr>
		<td  width=87><strong>Servicios</strong></td>
		<td  width=87><strong>Precio</strong></td>
		<td  width=87><strong>Itbis</strong></td>
		<td  width=87><strong>Importe</strong></td>
	</tr>
	<?php foreach($detalles as $detalle){ ?>
		<tr>
			<td>{{$detalle->descripcion_servicio}}</td>
			<td>{{$detalle->monto_importe}}</td>
			<td>{{$detalle->monto_itbis}}</td>
			<td>{{$detalle->monto_total}}</td>
		</tr>
	<?php } ?>
</table>

</body>

</html>