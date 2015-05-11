<!DOCTYPE html>
<html >
<head>
    <title>ASOCIACION ZEN MEDELLIN</title>
    <meta charset="utf-8" />
    
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui-themes-1.11.0/themes/humanity/jquery-ui.css" /> 
	<link rel="stylesheet" type="text/css" href="/css/ui.jqgrid.css"/>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap32/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/css/grid/jquery.bootgrid.css" />
    
	<script type="text/javascript" src="/js/includes/jquery/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/includes/jquery/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/includes/jqgrid/grid.locale-es.js"></script>
	<script type="text/javascript" src="/js/includes/jqgrid/jquery.jqGrid.min.js"></script>
 	<script type="text/javascript" src="/js/includes/jquery-validation-1.13.0/dist/jquery.validate.js"></script> 
	<script type="text/javascript" src="/js/includes/jquery-validation-1.13.0/dist/localization/messages_es.js"></script> 
 	<script type="text/javascript" src="/js/includes/jquery-validation-1.13.0/dist/additional-methods.min.js"></script> 
    <script type="text/javascript" src="/js/includes/grid/jquery.bootgrid.js"></script>
	<script type="text/javascript" src="/js/practica.js"></script>
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
            <a href="#" class="navbar-brand">ASOCIACION ZEN MEDELLIN</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li ><a href="/index.php">Practicantes</a></li>
                <li><a href="/views/biblioteca.php">Biblioteca</a></li>
                <li class="active"><a href="/views/practica.php">Practica</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>
</div>

<div id="tabsPractica">
  <ul>
    <li><a href="#tabs-1">Practica</a></li>
  </ul>
    
    <div id="tabs-1" style="align:center">
     <input type="button" value="Agregar" id="btnAgregarPractica" /><br><br>   
    <div style="align:center">
        <table id='gridPractica'></table>
        <div id='pager'></div>
    </div>

    </div>
</div>
<!-- Dialogos -->
<div  class=' bs-example' id='dlgPractica' style='display:none'  >
		<form  id='frmPractica' method='post' class="form-horizontal" role="form" >
	        					 <input type='hidden' name='id'  id='id-practica'>
             <div class="form-group">
                <label for="txtTipoPractica" class="control-label col-xs-2">Tipo Practica</label>
                <div class="col-xs-2">
                <select class="form-control required clean" name='tipopractica' id='txtTipoPractica' placeholder="Tipo Practica">
					<option value="" disabled="disabled" hidden="true" style="display:none">Please select a name</option>
                    <option value="Practica" selected>Practica</option> 
					<option value="Sesshin">Sesshin</option>
                    <option value="DiaPractica">DiaPractica</option>
                </select> 
                </div>
                 

                 
                     <label for="txtFecha" class="control-label col-xs-2">Fecha</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control required clean" placeholder="Fecha" name='fechaPractica' id='txtFecha'>
                </div> 
                <label for="txtValor" class="control-label col-xs-2">Valor</label>
                <div class="col-xs-2">
                    <input type="text" class="form-control required clean" placeholder="Valor" name='valor' id='txtValor'>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                <label for="txtPracticante" class="control-label col-xs-2">Practicante</label>
                <div class="col-xs-4">
                    <input type='text' class="form-control required clean" name='practicante' id='txtPracticante' placeholder="Busque Un Practicante"/>
	        		<input type='hidden' name='idpracticante'  id='id-practicante'>
                </div>  
                <div class="col-xs-4">
                    <input type='button' class="form-control " Value="Practicante" name="insertarpracticante" id="btnInsertarPracticante" onclick="insertarPracticantePractica()"/>
                </div>
            </div><br>
	        <input type='hidden' name='idpractica'  id='id-practica'>
            </div>     
    </form>
        <div style="align:center; right:50px;    margin-left: auto;margin-right: auto">
        <table id='gridDetallePractica'></table>
        <div id='pager'></div>
    </div>
</div>


</body>
</html>