<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
    
	<script type="text/javascript" src="js/prestamo.js"></script>
</head>
<body>

    <table id='jqg-prestamo'></table>
	<div id='pager-prestamo'></div>

	<!-- Dialogos -->
	<div  id='dlgPrestamo' style='display:none'>
		<form  id='frmPrestamo' method='post' class="form-inline" role="form" >
	        					 <input type='hidden' name='id'  id='id-prestamo'>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='prestamo' id='txtPrestamo' placeholder="Fecha Prestamo"/></div><br>
	       	<div class="form-group"><input type='text'  class="form-control required clean" name='entrega' id='txtEntrega' placeholder="Fecha Entrega" /></div><br>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='practicante' id='txtPracticante' placeholder="Busque Practicante"/></div><br>
	        					<input type='hidden' name='id-practicante'  id='id-practicante'>
	        <div class="form-group"><input type='text'  class="form-control required clean" name='prestado' id='txtPrestado' placeholder="Busque Prestador"/></div><br>
	        					<input type='hidden' name='id-prestado'  id='id-prestado'>
	        					
	        <div class="form-group"><input type='text' class="form-control required clean" name='libro' id='txtLibro' placeholder="Busque Un Libro"/>
	        						<input type='button' class="form-control " name="insertarlibro" value="Libro" id="btnInsertarLibro"/></div><br>
	        						<input type='hidden' name='id-libro'  id='id-libro'>
	        					
	        					
        </form> 
        
            <table id='jqgDetallePrestamo'></table>
			<div id='pager-detalleprestamo'></div>
	</div>
</body>
</html>