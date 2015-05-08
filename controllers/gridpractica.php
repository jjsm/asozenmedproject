 <?php

    $options = array(
        PDO::ATTR_PERSISTENT    => true,
        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $conn = new PDO("mysql:host=localhost;dbname=asozenmed", 'root', '', $options); 


	//Creamos un arreglo con los datos que envia JqGrid
	$post=array(
		'limit'=>(isset($_REQUEST['rows']))?$_REQUEST['rows']:'',
		'page'=>(isset($_REQUEST['page']))?$_REQUEST['page']:'',
		'orderby'=>(isset($_REQUEST['sidx']))?$_REQUEST['sidx']:'',
		'orden'=>(isset($_REQUEST['sord']))?$_REQUEST['sord']:'',
		'search'=>(isset($_REQUEST['_search']))?$_REQUEST['_search']:'',
	);
//	$se ="";
	//creamos la consulta de busqueda. 
//	if($post['search'] == 'true'){
//		$b = array();
		//Usamos la funci{on elements para crear un arreglo con los datos que van a ser para buscar por like
//		$search['like']=elements(array('total','nota'),$_REQUEST);
		//haciendo un recorrido sobre ellos vamos creando al consulta.
//		foreach($search['like'] as $key => $value){
//			if($value != false) $b[]="$key like '%$value%'";
//		}
		//Usamos la funci{on elements para crear un arreglo con los datos que van a ser para buscar por like
//		$search['where']=elements(array('fecha','cantidad','taza','cliente'),$_REQUEST);
		//haciendo un recorrido sobre ellos vamos creando al consulta.
//		foreach($search['where'] as $key => $value){
//			if($value != false) $b[]="$key = '$value'";
//		}
		//Creamos la consulta where
//		$se=" where ".implode(' and ',$b );		
//	}
	//Realizamos la consulta para saber el numero de filas que hay en la tabla con los filtros
	$query = $conn->query("select count(*) from tblPracticas");//$se
	 
    if(!$query)
		echo mysql_error();
	$count=$query->fetchColumn() ;
	if( $count > 0 && $post['limit'] > 0) {
		//Calculamos el numero de paginas que tiene el sistema
		$total_pages = ceil($count/$post['limit']);
		if ($post['page'] > $total_pages) $post['page']=$total_pages;
		//calculamos el offset para la consulta mysql.
		$post['offset']=$post['limit']*$post['page'] - $post['limit'];
	} else {
		$total_pages = 0;
		$post['page']=0;
		$post['offset']=0;
	}
     
	//Creamos la consulta que va a ser enviada de una ves con la parte de filtrado
	$sql = "select id_practica,practica,fechapractica ,valorPract from tblPracticas  ";//.$se;
	if( !empty($post['orden']) && !empty($post['orderby']))
		//Añadimos de una ves la parte de la consulta para ordenar el resultado
		$sql .= " ORDER BY $post[orderby] $post[orden] ";
	if($post['limit'] && $post['offset']) $sql.=" limit $post[offset], $post[limit]";
		//añadimos el limite para solamente sacar las filas de la apgina actual que el sistema esta consultando
		elseif($post['limit']) $sql .=" limit 0,$post[limit]";
        
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $results_array=$stmt->fetchAll();

	$result = array();
	$i = 0;
	foreach( $results_array as $row ){
		$result[$i]['id']=$row["id_practica"];
		$result[$i]['cell']=array($row["id_practica"],$row["practica"],$row["fechapractica"],$row["valorPract"]);
		$i++;		
	}
	//Asignamos todo esto en variables de json, para enviarlo al navegador
    $json = array('rows' =>$result, 'total' => $total_pages, 'page' => $post['page'], 'records' => $count);
	
    echo json_encode($json);
	
	
	function elements($items, $array, $default = FALSE)
	{
		$return = array();
		if ( ! is_array($items)){
			$items = array($items);
		}
		foreach ($items as $item){
			if (isset($array[$item])){
				$return[$item] = $array[$item];
			}else{
				$return[$item] = $default;
			}
		}
		return $return;
	}



 ?>