<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
	<script type="text/javascript" src="js/libro.js"></script>
	<style type="text/css">
		#frmLibro label.error, .output {color:#FB3A3A;font-weight:bold;}
	</style>
    
    </head>
    
<body>

    <table id='jqgLibro'></table>
	<div id='pagerlibro'></div>

	<!-- Dialogos -->
	<div class='edit_modal' id='dlgLibro' style='display:none'>
		<form  id='frmLibro' method='post'  style="display:none" class="form-inline" role="form">
	        					 <input type='hidden' name='id'  id='id-libro'>
	        <div class="form-group"><input type='text' class="form-control required clean" placeholder="Titulo" name='titulo' id='titulo' /></div>
	        <div class="form-group"><input type='text' class="form-control required clean" placeholder="Codigo" name='codigo' id='codigo' /></div>
	        <div class="form-group"><input type='text' class="form-control clean" placeholder="Descripcion" name='descripcion' id='descripcion' /></div>
	        <div class="form-group"><input type='text' class="form-control required clean" placeholder="Editorial" name='editorial' id='editorial' /></div>
	       	<div class="form-group"><input type='text' class="form-control required clean" placeholder="Año" name='año' id='año' /></div>
	        <div class="form-group"><input type='text' class="form-control clean" placeholder="Observaciones" name='observaciones' id='observaciones' /></div>
	        <div class="form-group"><input type='text' class="form-control required clean" placeholder="Autor" name='autores' id='autores' /></div>
        </form> 
        
        <form ' id='frmLibroCancel' method='post' action='' style="display:none">
        	<input type='hidden' name='id'  id='id'>
        	<div class='delete_modal'>¡Estás seguro que deseas eliminar el libro <label id="lbllibro"></label>?</div>
        </form>
	</div>


</body>
</html>