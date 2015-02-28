 <?php
    try {

    $conn = new PDO("mysql:host=localhost;dbname=asozenmed", 'root', ''); // SQLite Database
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $where =" 1=1 ";
    //$order_by="rating_imdb";
    $rows=25;
    $current=1;
    $limit_l=($current * $rows) - ($rows);
    $limit_h= $rows ;
    //Handles Sort querystring sent from Bootgrid
    if (isset($_REQUEST['sort']) && is_array($_REQUEST['sort']) )
    {
    $order_by="";
    foreach($_REQUEST['sort'] as $key=> $value)
    $order_by.=" $key $value";
    }
    //Handles search querystring sent from Bootgrid
    if (isset($_REQUEST['searchPhrase']) )
    {
    $search=trim($_REQUEST['searchPhrase']);
    $where.= " AND ( movie LIKE '".$search."%' OR year LIKE '".$search."%' OR genre LIKE '".$search."%' ) ";
    }
    //Handles determines where in the paging count this result set falls in
    if (isset($_REQUEST['rowCount']) )
    $rows=$_REQUEST['rowCount'];

    //calculate the low and high limits for the SQL LIMIT x,y clause
    if (isset($_REQUEST['current']) )
    {
    $current=$_REQUEST['current'];
    $limit_l=($current * $rows) - ($rows);
    $limit_h=$rows ;
    }
    if ($rows==-1)
    $limit=""; //no limit
    else
    $limit=" LIMIT $limit_l,$limit_h ";
    //NOTE: No security here please beef this up using a prepared statement - as is this is prone to SQL injection.
   $id =$_GET["id"];
        
        $sql="SELECT  detallePrestamo.id_detallePrestamo  AS idDetallePrestamo,
						libros.codigo as codigo,
						libros.titulo as titulo,
                        libros.id_libro as idLibro,
                        detallePrestamo.estadoDetalle  as estado,
                        detallePrestamo.fechaDevuelto as fechaDevuelto
                        
    
				FROM 	tblDetallePrestamo detallePrestamo
					INNER JOIN tblPrestamos prestamos ON detallePrestamo.idPrestamo = prestamos.id_prestamo
					INNER JOIN tblLibros libros ON detallePrestamo.idLibros=libros.id_libro 
    			WHERE prestamos.id_prestamo =$id $limit ";
        
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $results_array=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode( $results_array );
    $nRows=$conn->query("SELECT COUNT(*) AS count FROM tblDetallePrestamo ")->fetchColumn();
    header('Content-Type: application/json'); //tell the broswer JSON is coming
    if (isset($_REQUEST['rowCount']) ) //Means we're using bootgrid library
    echo "{ \"current\": $current, \"rowCount\":$rows, \"rows\": ".$json.", \"total\": $nRows }";
    else
    echo $json; //Just plain vanillat JSON output
    exit;
    }
    catch(PDOException $e) {
    echo 'SQL PDO ERROR: ' . $e->getMessage();
    }
    ?>