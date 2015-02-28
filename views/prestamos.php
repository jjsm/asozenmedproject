<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    
	<script type="text/javascript" src="js/prestamo.js"></script>
</head>
<body>


    <table id="grid-data-prestamo" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="controllers/gridPrestamo.php">
            <thead>
                <tr>
                <th data-column-id="idPrestamo" data-type="numeric" data-visible="false"  data-identifier="true">ID</th>
                <th data-column-id="practicante" >Practicante</th>
                <th data-column-id="idPracticante" data-visible="false" >idPracticante</th>
                <th data-column-id="prestamo" >Prestamo</th>
                <th data-column-id="entrega" >Entrega</th>
                <th data-column-id="prestador"  >Prestador</th>
                <th data-column-id="idPrestador" data-visible="false" >idPrestador</th>
                <th data-column-id="devuelto" >Devuelto</th>
                <th data-column-id="estado" >Estado</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>

	<!-- Dialogos -->
	<div  id='dlgPrestamo' style='display:none'>
		<form  id='frmPrestamo' method='post' class="form-inline" role="form" >
	        					 <input type='hidden' name='id'  id='id-prestamo'>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='prestamo' id='txtPrestamo' placeholder="Fecha Prestamo"  /></div><br>
	       	<div class="form-group"><input type='text'  class="form-control required clean" name='entrega' id='txtEntrega' placeholder="Fecha Entrega" /></div><br>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='practicante' id='txtPracticante' placeholder="Busque Practicante"/></div><br>
	        					<input type='hidden' name='id-practicante'  id='id-practicante'>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='prestado' id='txtPrestado' placeholder="Busque Prestador"/></div><br>
	        					<input type='hidden' name='id-prestado'  id='id-prestado'>
	        					
	        <div class="form-group"><input type='text' class="form-control required clean" name='libro' id='txtLibro' placeholder="Busque Un Libro"/>
	        						<input type='button' class="form-control " name="insertarlibro" value="Libro" id="btnInsertarLibro"/></div><br>
	        						<input type='hidden' name='id-libro'  id='id-libro'>
	        					
	        					
        </form> 
        
                <table id="grid-data-detalle-prestamo"  class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" >
            <thead>
                <tr>
                <th data-column-id="idDetallePrestamo" data-visible="false" data-type="numeric"  data-identifier="true">ID</th>
                <th data-column-id="codigo" >Codigo</th>
                <th data-column-id="titulo"  >Titulo</th>
                <th data-column-id="idLibro" data-visible="false" >idLibro</th>
                <th data-column-id="estado"  >Estado</th>
                <th data-column-id="fechaDevuelto"  >Devuelto</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>
	</div>
</body>
</html>