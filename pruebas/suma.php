<script>
function sumar (valor) {
    var total = 0;	
    valor = parseInt(valor); // Convertir el valor a un entero (número).
	
    total = document.getElementById("spTotal").innerHTML;
	
    // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
    total = (total == null || total == undefined || total == "") ? 0 : total;
	
    /* Esta es la suma. */
    total = (parseInt(total) + parseInt(valor));
	
    // Colocar el resultado de la suma en el control "span".
    document.getElementById("spTotal").innerHTML = total;
}
</script>
<span>Valor #1</span>
<input type="text" id="txt_campo_1" onchange="sumar(this.value);" />
<br/ >
<span>Valor #2</span>
<input type="text" id="txt_campo_2" onchange="sumar(this.value);" />
<br/ >
<span>Valor #3</span>
<input type="text" id="txt_campo_3" onchange="sumar(this.value);" />
<br/ >
<input type="text" id="spTotal" />
<!--<span>El resultado es: </span> <span id="spTotal"></span>-->