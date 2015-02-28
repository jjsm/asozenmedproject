<!DOCTYPE html>
<html >
<head>
    <title>ASOCIACION ZEN MEDELLIN</title>
    <meta charset="utf-8" />
    
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-themes-1.11.0/themes/humanity/jquery-ui.css" /> 
	<link rel="stylesheet" type="text/css" href="css/ui.jqgrid.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap32/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/grid/jquery.bootgrid.css" />
    

    <script type="text/javascript" src="js/includes/jquery/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/includes/jquery/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/includes/jquery/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/includes/jqgrid/grid.locale-es.js"></script>
	<script type="text/javascript" src="js/includes/jqgrid/jquery.jqGrid.min.js"></script>
 	<script type="text/javascript" src="js/includes/jquery-validation-1.13.0/dist/jquery.validate.js"></script> 
	<script type="text/javascript" src="js/includes/jquery-validation-1.13.0/dist/localization/messages_es.js"></script> 
 	<script type="text/javascript" src="js/includes/jquery-validation-1.13.0/dist/additional-methods.min.js"></script> 
	<script type="text/javascript" src="js/usuario.js"></script>
    <script type="text/javascript" src="js/includes/grid/jquery.bootgrid.js"></script>
	
	<style type="text/css">
		#frmUsuario label.error, .output {color:#FB3A3A;font-weight:bold;}
	</style>
	
</head>
<body>

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Usuarios</a></li>
    <li><a href="views/libros.php">Libros</a></li>
    <li><a href="views/prestamos.php">Prestamos</a></li>
    <li><a href="views/estados.php">Estado</a></li>
    <li><a href="ajax/content4-broken.php">Tab 4 (broken)</a></li>
  </ul>
  
    <div id="tabs-1" style="align:center">
        

          
     <table id="grid-data" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="controllers/ensayogrid.php">
            <thead>
                <tr>
                <th data-column-id="id_usuario" data-type="numeric" data-visible="false" data-identifier="true">ID</th>
                <th data-column-id="cedula">Cedula</th>
                <th data-column-id="usuario" >Usuario</th>
                <th data-column-id="correo" >Correo</th>
                <th data-column-id="celular" >Celular</th>
                <th data-column-id="telefono" >Telefono</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>    

        <!-- <table id='jqgUsuario'></table> -->
	    <!-- <div id='pagerusuario'></div> -->
    </div>
</div>
<!-- Dialogos -->
<div class='edit_modal' id='dlgUsuario' style='display:none'>
			
		<form id='frmUsuario' method='post' style="display:none" class="form-inline" role="form">
	        					 <input type='hidden' name='id'  id='id-usuario'>
	        <div class="form-group"><input type='text'   name='cedula' id='cedula'  class="required clean form-control" placeholder="Cedula"/></div>
	        <div class="form-group"><input type='text'  name='usuario' id='name-user'  class="required clean form-control" placeholder="Usuario"/></div>
	        <div class="form-group"><input type='text'   name='correo' id='correo'  class="required clean form-control" placeholder="Correo"/></div>
	        <div class="form-group"><input type='text'  name='celular' id='celular'  class="required clean form-control" placeholder="Celular"/></div>
	        <div class="form-group"><input type='text' name='telefono' id='telefono'  class="required clean form-control" placeholder="Telefono"/></div>
        </form> 
        
        <form  id='frmUsuarioCancel' method='post' action='' style="display:none">
        	<input type='hidden' name='id'  id='id'>
        	<div class='delete_modal'>¡Estás seguro que deseas eliminar al usuario <label id="lblusuario"></label>?</div>
        </form>
	<div id="errores">
		
	</div>
		
</div>
    
    
    <div  id='dlgActions' style='display:none'>
        <input type='hidden' name='id'  id='id'>
        <input type='hidden' name='id'  id='id'>
    </div>


</body>
</html>