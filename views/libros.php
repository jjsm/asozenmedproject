<!DOCTYPE html>
<html >
<head>
    <title>ASOCIACION ZEN MEDELLIN</title>
    <meta charset="utf-8" />

    <script type="text/javascript" src="/js/libro.js"></script>
    	

	<style type="text/css">
		#frmUsuario label.error, .output {color:#FB3A3A;font-weight:bold;}
        #frmLibro label.error, .output {color:#FB3A3A;font-weight:bold;}
        .bs-example{margin: 20px;}        
	</style>
	
</head>
    
    <body>
    
        <input type="button" value="Agregar" id="btnAgregarLibro" /> 
      <table id="grid-data-libro" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="/controllers/gridlibros.php">
            <thead>
                <tr>
                <th data-column-id="id_libro" data-visible="false" data-type="numeric"  data-identifier="true">ID</th>
                <th data-column-id="numeroAcceso">Acceso</th>
                <th data-column-id="codigo" >Codigo</th>
                <th data-column-id="autores" >Autores</th>
                <th data-column-id="titulo">Titulo</th>
                <th data-column-id="editorial" >Editorial</th>
                <th data-column-id="año" >Año</th>   
                <th data-column-id="isbn">ISBN</th>
                <th data-column-id="serie">Serie</th>
                <th data-column-id="pais">Pais</th>
                <th data-column-id="paginas">Pagina</th>
                <th data-column-id="ejemplares">Ejemplares</th>   
                <th data-column-id="descripcion" >Descripcion</th>
                <th data-column-id="observaciones" >Observaciones</th> 
                <th data-column-id="encuadernar">Encuadernar</th>  
                <th data-column-id="estado" >Estado</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>


    
	<!-- Dialogos -->
	<div class='edit_modal bs-example' id='dlgLibro' style='display:none'>
		<form  id='frmLibro' method='post'  style="display:none" class="form-horizontal" role="form">
	        					 <input type='hidden' name='id'  id='id-libro'>
            <div class="form-group">
                <label for="txtNumeroAcceso" class="control-label col-xs-2">Acceso</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Numero Acceso" name='numeroAcceso' id='txtNumeroAcceso'>
                </div>                
                <label for="txtSerie" class="control-label col-xs-2">Serie</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Serie" name='serie' id='txtSerie'>
                </div>
            </div>
            <div class="form-group">
                <label for="txtCodigo" class="control-label col-xs-2">Codigo</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Codigo" name='codigo' id='txtCodigo'>
                </div>
                
                <label for="txtSerie" class="control-label col-xs-2">Pais</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Pais" name='pais' id='txtPais'>
                </div>                              
            </div>
            
            <div class="form-group">
                <label for="txtAutor" class="control-label col-xs-2">Autor</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Autor" name='autor' id='txtAutor'>
                </div>
                <label for="txtPagina" class="control-label col-xs-2">Página</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Página" name='pagina' id='txtPagina'>
                </div>
                
            </div>
            <div class="form-group">
                <label for="txtTitulo" class="control-label col-xs-2">Titulo</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Titulo" name='titulo' id='txtTitulo'>
                </div>
                <label for="txtEjemplares" class="control-label col-xs-2">Ejemplares</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Ejemplares" name='ejemplares' id='txtEjemplares'>
                </div>
            </div>
            <div class="form-group">
                <label for="txtEditorial" class="control-label col-xs-2">Editorial</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Editorial" name='editorial' id='txtEditorial'>
                </div>
                <label for="txtDescripcion" class="control-label col-xs-2">Descripción</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Descripción" name='descripcion' id='txtDescripcion'>
                </div>                
            </div>
            <div class="form-group">
                <label for="txtAno" class="control-label col-xs-2">Año</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Año" name='ano' id='txtAno'>
                </div> 
                <label for="txtObservaciones" class="control-label col-xs-2">Observaciones</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Observaciones" name='observaciones' id='txtObservaciones'>
                </div>

            </div>
            <div class="form-group">
                <label for="txtIsbn" class="control-label col-xs-2">ISBN</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="ISBN" name='isbn' id='txtIsbn'>
                </div>
                <label for="txtEncuadernar" class="control-label col-xs-2">Encuadernar</label>
                <div class="col-xs-4">
                 
                <select class="form-control required clean" name='encuadernar' id='txtEncuadernar' placeholder="Encuadernar">
					<option value="1" selected>Si</option> 
					<option value="0" >No</option>

                </select>                    
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
