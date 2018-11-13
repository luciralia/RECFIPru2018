<script language="javascript">
function sumar(){  var a, total = 0;  var elements = document.getElementsById('sumar');var prom = 0;
     for(a=0; a<elements.length; a++){  
	  if (elements[a].value!="" && elements[a].value!="0") { 
	  prom++;         
	  total += (parseFloat(elements[a].value));   }   }  
	 total = total/prom;     
	  document.getElementById("resultado").value = total;}
</script>
</head>
<body>Numero1:<input type="text" name="campo1" id="sumar1" onKeyUp="sumar()" value="0"/>
<br />Numero2:<input type="text" name="campo2" id="sumar2" onKeyUp="sumar()" value="0"/>
<br />Numero3:<input type="text" name="campo3" id="sumar3" onKeyUp="sumar()" value="0"/>
<br />Numero4:<input type="text" name="4" id="sumar4" onKeyUp="sumar()" value="0"/>
<br />Numero5:<input type="text" name="5" id="sumar5" onKeyUp="sumar()" value="0"/>
<br />Numero6:<input type="text" name="6" id="sumar6" onKeyUp="sumar()" value="0"/><br />
<br />Resultado:<input type="text" value="0" id="resultado" />