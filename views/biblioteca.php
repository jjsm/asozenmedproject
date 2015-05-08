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
    <script type="text/javascript" src="/js/biblioteca.js"></script>
    <script type="text/javascript" src="/js/prestamo.js"></script>
    <script type="text/javascript" src="/js/libro.js"></script>
    	

	<style type="text/css">
		#frmUsuario label.error, .output {color:#FB3A3A;font-weight:bold;}
        #frmLibro label.error, .output {color:#FB3A3A;font-weight:bold;}
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
                <li><a href="/index.php">Practicantes</a></li>
                <li class="active"><a href="/views/biblioteca.php">Biblioteca</a></li>
                <li><a href="/views/practica.php">Practica</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </nav>
</div>

 <div id="tabsPrestamos" >
  <ul>
     <li><a href="../views/prestamos.php">Prestamos</a></li> 
     <li><a href="../views/libros.php">Libros</a></li>
  </ul>
  
</div>
      


</body>
</html>