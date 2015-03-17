<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8" />
	<script type="text/javascript" src="js/libro.js"></script>
	<style type="text/css">
		#frmLibro label.error, .output {color:#FB3A3A;font-weight:bold;}
        .bs-example{margin: 20px;}
	</style>
    
    </head>
    
<body>  
         <input type="button" value="Agregar" id="btnAgregarLibro" /> 
      <table id="grid-data-libro" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="controllers/gridlibros.php">
            <thead>
                <tr>
                <th data-column-id="id_libro" data-visible="false" data-type="numeric"  data-identifier="true">ID</th>
                <th data-column-id="titulo">titulo</th>
                <th data-column-id="codigo" >codigo</th>
                <th data-column-id="descripcion" >descripcion</th>
                <th data-column-id="editorial" >editorial</th>
                <th data-column-id="año" >año</th>
                <th data-column-id="observaciones" >observaciones</th>
                <th data-column-id="estado" >estado</th>
                <th data-column-id="autores" >autores</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>
    
	<!-- Dialogos -->
	<div class='edit_modal bs-example' id='dlgLibro' style='display:none'>
		<form  id='frmLibro' method='post'  style="display:none" class="form-horizontal" role="form">
	        					 <input type='hidden' name='id'  id='id-libro'>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-2">Titulo</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="Titulo" name='titulo' id='titulo'>
                </div>
            </div>
            <div class="form-group">
                <label for="codigo" class="control-label col-xs-2">Codigo</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="Codigo" name='codigo' id='codigo'>
                </div>
            </div>
            
            <div class="form-group">
                <label for="descripcion" class="control-label col-xs-2">Descripcion</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="descripcion" name='descripcion' id='descripcion'>
                </div>
            </div>
            <div class="form-group">
                <label for="editorial" class="control-label col-xs-2">Editorial</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="editorial" name='editorial' id='editorial'>
                </div>
            </div>
            <div class="form-group">
                <label for="año" class="control-label col-xs-2">Año</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="Año" name='año' id='año'>
                </div>
            </div>
            <div class="form-group">
                <label for="observaciones" class="control-label col-xs-2">Observaciones</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="Observaciones" name='observaciones' id='observaciones'>
                </div>
            </div>
            <div class="form-group">
                <label for="autores" class="control-label col-xs-2">Autor</label>
                <div class="col-xs-11">
                 <input type="text" class="form-control required clean" placeholder="Autor" name='autores' id='autores'>
                </div>
            </div>
        </form> 
        
        <form  id='frmLibroCancel' method='post' action='' style="display:none">
        	<input type='hidden' name='id'  id='id'>
        	<div class='delete_modal'>¡Estás seguro que deseas eliminar el libro <label id="lbllibro"></label>?</div>
        </form>
	</div>


</body>
</html>