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
        
    .bs-example{margin: 20px;}
        
	</style>
	
</head>
<body>
    
<div class="bs-example">
    <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Brand</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Messages</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>
</div>

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Practicantes</a></li>
    <li><a href="views/libros.php">Libros</a></li>
    <li><a href="views/prestamos.php">Prestamos</a></li>
  </ul>
  
    <div id="tabs-1" style="align:center">
        

     <input type="button" value="Agregar" id="btnAgregarUsuario" /> 
     <table id="grid-data" class="table table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="controllers/ensayogrid.php">
            <thead>
                <tr>
                <th data-column-id="id_usuario" data-type="numeric" data-visible="false" data-identifier="true">ID</th>
                <th data-column-id="cedula">Cedula</th>
                <th data-column-id="usuario" >Practicante</th>
                <th data-column-id="correo" >Correo</th>
                <th data-column-id="celular" >Celular</th>
                <th data-column-id="telefono" >Telefono</th>
                <th data-column-id="edad">Edad</th>
                <th data-column-id="fechaIngreso">Ingreso</th>
                <th data-column-id="direccion">Direccion</th>
                <th data-column-id="profesion">Profesion</th>
                <th data-column-id="descubrio">Conocio</th>
                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>	
    </table>    

    </div>
</div>
<!-- Dialogos -->
<div class='edit_modal bs-example' id='dlgUsuario' style='display:none'>
			
		<form id='frmUsuario' method='post' style="display:none" class="form-horizontal" role="form">
	        					 <input type='hidden' name='id'  id='id-usuario'>
           <div class="form-group">
                <label for="cedula" class="control-label col-xs-2">Cedula</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Cedula" name='cedula' id='cedula'>
                </div>
                <label for="txtEdad" class="control-label col-xs-2">Edad</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Edad" name='edad' id='txtEdad'>
                </div>
            </div>
            
            <div class="form-group">
                <label for="name-user" class="control-label col-xs-2">Usuario</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Usuario" name='usuario' id='name-user'>
                </div>
                <label for="txtIngreso" class="control-label col-xs-2">Ingresó</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Ingresó" name='ingreso' id='txtIngreso'>
                </div>
            </div>
            <div class="form-group">
                <label for="correo" class="control-label col-xs-2">Correo</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Correo" name='correo' id='correo'>
                </div>
                <label for="txtDireccion" class="control-label col-xs-2">Dirección</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Dirección" name='direccion' id='txtDireccion'>
                </div>
            </div>
            <div class="form-group">
                <label for="celular" class="control-label col-xs-2">Celular</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Celular" name='celular' id='celular'>
                </div>
             <label for="txtProfesion" class="control-label col-xs-2">Profesión</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="Profesión" name='profesion' id='txtProfesion'>
                </div>
            </div>
            <div class="form-group">
                <label for="telefono" class="control-label col-xs-2">Telefono</label>
                <div class="col-xs-4">
                 <input type="text" class="form-control required clean" placeholder="Telefono" name='telefono' id='telefono'>
                </div>
             <label for="txtDescubrio" class="control-label col-xs-2">Conoció</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control required clean" placeholder="descubrio" name='descubrio' id='txtDescubrio'>
                </div>
            </div>
            

            
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