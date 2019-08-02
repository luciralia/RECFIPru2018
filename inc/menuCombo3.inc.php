<script type="text/javascript">

            $(document).ready(function(){
				$("#id_coord").click(function () {
                     $("#id_coord option:selected").each(function () {
						    id_coord = $(this).val();
					        $.post("../inc/getDept.inc.php", { id_coord: id_coord }, function(data){
							$("#id_dep").html(data);
					
						});            
					});
				})
			});
			
			
		    $(document).ready(function(){
				$("#id_dep").click(function () {
 
					$("#id_dep option:selected").each(function () {
						    id_dep = $(this).val();
						    $.post("../inc/getArea.inc.php", { id_dep: id_dep }, function(data){
							      $("#id_lab").html(data);
					
						});   
					});
				})
			});
			
			
			function labo(){
				var labor= document.getElementById("id_lab").value;
				  //alert('datos enviados a php correctamente! combo3',labor);
			      window.location='../view/inicio.html.php?lab='+ labor;
			 };
			
</script>

<?php
require ('../conexion.php');



?>



<form>
                                       
  <table  class="table">
                                        

                                           
         <?php
           if ($_SESSION['tipo_usuario']==1){$consultacomp=" l.id_responsable= ";}
       else if ($_SESSION['tipo_usuario']==7){$consultacomp="di.id_comite= ";} 
          else if($_SESSION['tipo_usuario']==3){$consultacomp="di.id_responsable= ";}
              else if($_SESSION['tipo_usuario']==6){$consultacomp="di.id_secacad= ";}
		    	  else if($_SESSION['tipo_usuario']==9 ){$consultacomp=" dv.id_cac= ";
				                                       $consultadepto= " AND de.id_dep= "; 
													   $consultadiv=" AND dv.id_div= ";}                         
			         else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab NOT LIKE 'e' ";
				                                          $consultadepto= "";} 
	  if ($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1 ){
       $querydep = "SELECT DISTINCT co.id_coord, co.id_responsable, co.nombre as coord, dv.nombre  as div,  dv.id_div 
                    FROM coordinacion co
                    JOIN departamentos d
                    ON co.id_coord=d.id_coord
                    JOIN divisiones dv
                    ON dv.id_div=co.id_div
                    JOIN usuarios u
                    ON dv.id_responsable=u.id_usuario
                    WHERE " . $consultacomp  . $_SESSION['id_usuario'] .
                    $consultadiv . $_SESSION['id_div'].
                   " ORDER BY coord";
				//echo $querydep;     
      $datosdep = @pg_query($querydep)  or die('Hubo un error consulta coord');
	
	  }
?>      
       <tr>
       <td>Coordinación:    
           <select name="id_coord" id="id_coord" >
           <?php while ($datosc = pg_fetch_array($datosdep)){?>
               	  <option value="<?php echo $datosc['id_coord']; ?>"><?php echo $datosc['coord']; ?></option><?php } ?>
		            </select>
         </td></tr>
            <tr><td>
                     Departamento: <select name="id_dep" id="id_dep" >   <option value="0">Seleccionar depto</option>
                                                
                                    </select>
                     </td> </tr>
                          <tr><td>
                                   Área: <select name="id_lab" id="id_lab" onChange="labo();">                                                                                             <option value="0">Seleccionar Área</option> 
                                            </select>
                           </td> </tr>
                   </table> 
                                    
                                 <input name="lab" type="hidden" value="<?php echo $_POST['id_lab']; ?>"  />
                       </form>
                 