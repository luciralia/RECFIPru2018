<html>

    <head>
        <title>www.aprender-informatica.com - Curso de JavaScript</title>
        <script type="text/javascript">

			function crear()
			{

				document.getElementById("boton3").onmouseover = function() {
					this.value = "El cursor ha entrado en el área";
				}

				document.getElementById("boton3").onmouseout = function() {
					this.value = "El cursor ha salido del área";
				}

			}

			// ----------------------------

			function eliminar()
			{
				document.getElementById("boton3").onmouseover = function() {}
				document.getElementById("boton3").onmouseout = function() {}
			}

        </script>
    </head>

	<body>

		Usa los siguientes botones para crear y eliminar los eventos para el de abajo:
		<input type="button" id="boton1" name="boton1" onclick="crear();" value="Crear los eventos"  />
		<input type="button" id="boton2" name="boton2" onclick="eliminar();" value="Eliminar los eventos"  /><p/>

		<input type="button" id="boton3" name="boton3" value="Pasa el ratón por encima" />

	</body>

</html>
