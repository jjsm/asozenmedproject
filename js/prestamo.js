$(document).ready(function () {
	//------------------------------------------------------------------------------------------------GRIDD  
    $("#grid-data-prestamo").bootgrid(
        {
        caseSensitive:false ,/* make search case insensitive */
            formatters: {
        "commands": function(column, row)
        {
        return "<input  value='Editar' onclick=\"adminPrestamo('"+row.idPrestamo+"','"+row.practicante+"','"+row.idPracticante+"','"+row.prestamo+"','"+row.entrega+"','"+row.prestador+"','"+row.idPrestador+"','editar');\" type='button' class=\"btn btn-xs btn-default command-edit\"><span class=\"fa fa-pencil\"></span></input> " +
        "<input type='button' value='Cerrar' onclick=\"cerrarPrestamo('"+row.idPrestamo+"');\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-trash-o\"></span></input>";
        }}
        });

	
     $( "#txtPrestamo").datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
    
     $('#txtEntrega').datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
  
        //-------------------------------------------------------------------------------------------------------AGREGARPRESTAMO
         $("#btnAgregarPrestamo").off("click.AgregarpRESTAMO").on("click.AgregarpRESTAMO",function(){
        adminPrestamo();
     })
    
    
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
            height:850,
            width:600,
            modal:true,
            open:function(){
                 
            	$("#id-prestamo").val("");
            	$(".clean").val("");
                //cargarGridDetallePrestamo(id);
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
				    $('#grid-data-detalle-prestamo').bootgrid('destroy');
                
                    //-------------------------------------------------------GRIDD
                    $("#grid-data-detalle-prestamo").bootgrid(
                    {
                    caseSensitive:false ,
                    url: 'controllers/gridDetallePrestamo.php?id='+id,
                        formatters: {
                    "commands": function(column, row)
                    {
                    return "<input  value='Entregar' onclick=\"actualizarEstadoLibro('"+row.idDetallePrestamo+"','"+row.idLibro+"');\" type='button' class=\"btn btn-xs btn-default command-edit\"><span class=\"fa fa-pencil\"></span></input> "; 
                    }}
                    });
                  //
            	
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
										$('#grid-data-detalle-prestamo').bootgrid('destroy');
                                        
                                        //--------------------------------------------------GRIDD
                                                   $("#grid-data-detalle-prestamo").bootgrid(
                                                    {
                                                    caseSensitive:false ,
                                                    url: 'controllers/gridDetallePrestamo.php?id='+id,
                                                        formatters: {
                                                    "commands": function(column, row)
                                                    {
                                                    return "<input  value='Entregar' onclick=\"actualizarEstadoLibro('"+row.idDetallePrestamo+"','"+row.idLibro+"');\" type='button' class=\"btn btn-xs btn-default command-edit\"><span class=\"fa fa-pencil\"></span></input> "; 
                                                    }}
                                                    });
                                        //------------------------------------------------------
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
                                        $('#grid-data-prestamo').bootgrid('reload');
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

	

function actualizarEstadoLibro(idDetPres,idLib){
     var idLibro =idLib ;
     var idDetallePrestamo =idDetPres ;
    
    $.ajax({
        url :'controllers/PrestamosController.php?op=3&id='+idLibro ,
        type : "post",
        complete:function (jqXHR,status) {
            //actualizar grid
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
            $('#grid-data-detalle-prestamo').bootgrid('reload');
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

