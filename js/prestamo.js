$(document).ready(function () {
	
	jQuery("#jqg-prestamo").jqGrid({ 
		url:'controllers/PrestamosController.php?op=0', 
		datatype: "json",
		mtype: 'POST',
		height: '100%',
		width: 930, 
		colNames:['id','practicante','','prestamo','entrega','prestador','','devuelto','estado','action'], 
		colModel:[ 
		          {name:'id',index:'id', width:55,hidden:true}, 
		          {name:'practicante',index:'practicante',  width: 80}, 
		          {name:'idPracticante',index:'idPracticante',  width: 80,hidden:true},
		          {name:'prestamo',index:'prestamo', width:90},
		          {name:'entrega',index:'entrega', width:90},
		          {name:'prestador',index:'prestador', width:90},
		          {name:'idPrestador',index:'idPrestador', width:90,hidden:true},
		          {name:'devuelto',index:'devuelto', width:90},
                  {name:'estado',index:'estado', width:90,hidden:true},
		          {name:'action',index:'action',sortable:false, formatter: displayButtons},
		          ], 
                  afterInsertRow : function(rowid, rowdata)
                   {   
                         if (rowdata.estado == "0"){
                               $("#cerrarPrestamo"+rowid).hide();
                          }
                       },
                 loadComplete: function() {
            debugger;
                  $('#jqg-prestamo').setGridParam({datatype:'json'}).trigger('reloadGrid',[{current:true}]);
                  },
		 pager: '#pager-prestamo', 
		 rowNum:30, 
		 rowList:[100,200,300], 
		 sortname: 'id', 
		 sortorder: "asc",
         loadonce: true,//sirve para paginacion
		 viewrecords: true, 
		 caption: 'PRESTAMOS'
		  })
		  .navGrid('#pager-prestamo',{edit:false,add:false,del:false,search:false})
		  //Boton Agregar
		  .navButtonAdd('#pager-prestamo',{
		   caption:"Add", 
		   buttonicon:"ui-icon-add", 
		   onClickButton: function(){ 
			   agregarPrestamo();
           }
		});
	
	
	function displayButtons(cellvalue, options, rowObject)
    {	
        var id = rowObject[0];
        var practicante = rowObject[1];
	    var id_practicante = rowObject[2];
	    var prestamo = rowObject[3];
	    var entrega = rowObject[4];
	    var prestador= rowObject[5];
	    var id_prestador= rowObject[6];
       
        var edit = "<input type='button' id=\"editarPrestamo"+id+"\" value='Editar' onclick=\"adminPrestamo('"+id+"','"+practicante+"','"+id_practicante+"','"+prestamo+"','"+entrega+"','"+prestador+"','"+id_prestador+"','editar');\" />"; 
        var cerrarPrestamo = "<input type='button' id=\"cerrarPrestamo"+id+"\" value='Cerrar' onclick=\"cerrarPrestamo('"+id+"');\" />"; 
        return edit+cerrarPrestamo;
    }
	
	function agregarPrestamo () {            
		adminPrestamo();
    }
	
     $( "#txtPrestamo").datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
    
     $('#txtEntrega').datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
    
});


function adminPrestamo(id,practicante,id_practicante,prestamo,entrega,prestador,id_prestador,option){
    var url="";
    
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth()+1)+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
    var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
    

 // Dialogo
    $("#dlgPrestamo").dialog({
            resizable:false,
            title:'Prestamo.',
            height:600,
            width:450,
            modal:true,
            open:function(){
                
            	$("#id-prestamo").val("");
            	$(".clean").val("");
                cargarGridDetallePrestamo(id);
    			//validador
                $("#frmPrestamo").validate({  
    				  
    				rules: {  
    					prestamo:  {required: true},  
    					entrega: {required: true},  
    					practicante:  {required: true},                
    					prestado: {required: true},        
    					libro:{required: true}  
    				},  
    				messages: {  
    					prestamo:{  
    						required: "*Requerido" 
    					},  
    					entrega:{  
    						required: "*Requerido"  
    					},  
    					practicante: {  
    						required: "*Requerido",  						
    					},  
    					prestado:{
    						required: "*Requerido"
    					},
    					libro:{
    						required: "*Requerido"
    					}
    				}  
    			});
				
                    //grid detalle
						jQuery("#jqgDetallePrestamo").jqGrid({ 
							url:'controllers/PrestamosController.php?op=2&id='+id, 
							datatype: "json",
							mtype: 'POST',
							height: 190,
							width: 400, 
							colNames:['id','codigo','titulo','idLibro','estado','fechaDevuelto','action'], 
							colModel:[ 
                                {name:'id',index:'id', width:10,hidden:true}, 
                                {name:'codigo',index:'codigo',  width: 10}, 
                                {name:'titulo',index:'titulo',  width: 10},
                                {name:'idLibro',index:'idLibro',width: 10,hidden:true},
                                {name:'estado',index:'estado',width: 10,hidden:true},
                                {name:'fechaDevuelto',index:'fechaDevuelto',width: 10},
                                {name:'action',index:'action',sortable:false, width: 10, formatter: displayButtonsDetalle},
                             ], 
                                afterInsertRow : function(rowid, rowdata)
                                {
                                if (rowdata.estado == "1"){
                                 $("#actualizarLibro"+rowid).hide();
                                }
                                },
                            pager: '#pager-detalleprestamo', 
							rowNum:10, 
							rowList:[100,200,300], 
							sortname: 'id', 
							sortorder: "asc",
							viewrecords: true, 
							caption: 'Detalle',
							toppager: true
						})
            	
            	$("#txtPrestamo").val(currentDate);
						if(option  == "editar"){
							$("#id-prestamo").val(id);
							$("#txtPrestamo").val(prestamo);
							$("#txtEntrega").val(entrega);
							$("#txtPracticante").val(practicante);
							$("#id-practicante").val(id_practicante);
							$("#txtPrestado").val(prestador);
							$("#id-prestado").val(id_prestador);            	
							
						}
					 $("#txtPracticante").autocomplete({source:"controllers/UsuariosController.php?op=4",minLength: 1,select: function(event, data) {
								 $("#txtPracticante").val(data.item.value);
								 $("#id-practicante").val(data.item.id);
					  }});
					 
					 $("#txtPrestado").autocomplete({source:"controllers/UsuariosController.php?op=4",minLength: 1,select: function(event, data) {
								 $("#txtPrestado").val(data.item.value);
								 $("#id-prestado").val(data.item.id);
								 }});
					 
					 $("#txtLibro").autocomplete({source:"controllers/LibrosController.php?op=4",minLength: 1,select: function(event, data) {
								 $("#txtLibro").val(data.item.value);
								 $("#id-libro").val(data.item.id);
								 }});
                
					 //peticion ajax al insertar libro
					 $("#btnInsertarLibro").off("click.libro").on("click.libro",function(){
                         
						 if ($("#frmPrestamo").validate().form() == true){
								 $.ajax({
									url :'controllers/PrestamosController.php?op=1' ,
									type : $('#frmPrestamo').attr("method"),
									data : $('#frmPrestamo').serialize(),
									complete:function (jqXHR,status) {
										
                                        $("#id-prestamo").val(jqXHR.responseText);
										cargarGridDetallePrestamo(jqXHR.responseText);	
                                        $("#txtLibro").val("");
                                        $("#txtLibro").focus();	
									},
									error:function (error) {
										$("#dlgPrestamo").dialog("close");
										$("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
											resizable:false,
											title:'Error!.',
											height:200,
											width:450,
											modal:true
										});
									}
								});
						 }
                         
						 
					 })
            },
            buttons:{
                "OK":function () {
                    
                     $.ajax({
									url :'controllers/PrestamosController.php?op=5' ,
									type : $('#frmPrestamo').attr("method"),
									data : $('#frmPrestamo').serialize(),
									complete:function (jqXHR,status) {
										$("#dlgPrestamo").dialog("close");	
									},
									error:function (error) {
										$("#dlgPrestamo").dialog("close");
										$("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
											resizable:false,
											title:'Error!.',
											height:200,
											width:450,
											modal:true
										});
									}
								});
                }
            }
        });
    
    
}

	function cargarGridDetallePrestamo(idDetalle){
		var url = 'controllers/PrestamosController.php?op=2&id='+idDetalle;
		$("#jqgDetallePrestamo").jqGrid('setGridParam', { url: url });
		$("#jqgDetallePrestamo").trigger("reloadGrid");					
	}
	
	function displayButtonsDetalle(cellvalue, options, rowObject)
    {
        var id = rowObject[0];
        var edit = "<input  type='button' id=\"actualizarLibro"+id+"\"   value='Entregar' onclick=\"actualizarEstadoLibro('"+rowObject+"');\"    />"; 
        return edit;
    }

function actualizarEstadoLibro(event,obj){
    var myOptions = obj.split(',');
     var idLibro = myOptions[3];
     var idDetallePrestamo = myOptions[0];
    
    $.ajax({
        url :'controllers/PrestamosController.php?op=3&id='+idLibro ,
        type : "post",
        complete:function (jqXHR,status) {
          $("#jqgDetallePrestamo").trigger("reloadGrid");
          actualizarFechaDetallePrestamo(idDetallePrestamo);
        },
        error:function (error) {
            $("#dlgPrestamo").dialog("close");
            $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                resizable:false,
                title:'Error!.',
                height:200,
                width:450,
                modal:true
            });
        }
    });
}


function actualizarFechaDetallePrestamo(idDetalle){
    
        $.ajax({
        url :'controllers/PrestamosController.php?op=4&id='+idDetalle ,
        type : "post",
        complete:function (jqXHR,status) {
            $("#jqgDetallePrestamo").trigger("reloadGrid");
        },
        error:function (error) {
            $("#dlgPrestamo").dialog("close");
            $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                resizable:false,
                title:'Error!.',
                height:200,
                width:450,
                modal:true
            });
        }
    });
    
}


function cerrarPrestamo(idPrestamo){
   $.ajax({
        url :'controllers/PrestamosController.php?op=6&id='+idPrestamo ,
        type : "post",
        complete:function (jqXHR,status) {
          $("#jqg-prestamo").trigger("reloadGrid");
            
        },
        error:function (error) {
            $("#dlgPrestamo").dialog("close");
            $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                resizable:false,
                title:'Error!.',
                height:200,
                width:450,
                modal:true
            });
        }
    });
  
}

function actualizarEstadoLibro(obj){
     var myOptions = obj.split(',');
     var idLibro = myOptions[3];
     var idDetallePrestamo = myOptions[0];
    
    $.ajax({
        url :'controllers/PrestamosController.php?op=3&id='+idLibro ,
        type : "post",
        complete:function (jqXHR,status) {
          $("#jqgDetallePrestamo").trigger("reloadGrid");
          actualizarFechaDetallePrestamo(idDetallePrestamo);
        },
        error:function (error) {
            $("#dlgPrestamo").dialog("close");
            $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                resizable:false,
                title:'Error!.',
                height:200,
                width:450,
                modal:true
            });
        }
    });
}

