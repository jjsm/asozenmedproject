$(document).ready(function () {
	
	jQuery("#jqg-prestamo").jqGrid({ 
		url:'controllers/PrestamosController.php?op=0', 
		datatype: "json",
		mtype: 'POST',
		height: 190,
		width: 930, 
		colNames:['id','practicante','','prestamo','entrega','prestador','','devuelto','action'], 
		colModel:[ 
		          {name:'id',index:'id', width:55,hidden:true}, 
		          {name:'practicante',index:'practicante',  width: 80}, 
		          {name:'idPracticante',index:'idPracticante',  width: 80,hidden:true},
		          {name:'prestamo',index:'prestamo', width:90},
		          {name:'entrega',index:'entrega', width:90},
		          {name:'prestador',index:'prestador', width:90},
		          {name:'idPrestador',index:'idPrestador', width:90,hidden:true},
		          {name:'devuelto',index:'devuelto', width:90},
		          {name:'action',index:'action',sortable:false, formatter: displayButtons},
		          ], 
		 pager: '#pager-prestamo', 
		 rowNum:10, 
		 rowList:[10,20,30], 
		 sortname: 'id', 
		 sortorder: "asc",
		 viewrecords: true, 
		 caption: 'PRESTAMOS',
		 toppager: true
		  })
		  .navGrid('#pager-prestamo',{edit:false,add:false,del:false,search:false})
		  //Boton Agregar
		  .navButtonAdd('#pager-prestamo',{
		   caption:"Add", 
		   buttonicon:"ui-icon-add", 
		   onClickButton: function(){ 
			   agregarPrestamo();
		   }, 
		   position:"last"
		});
	
	
	function displayButtons(cellvalue, options, rowObject)
    {	var id = rowObject[0];
        var edit = "<input  type='button' id=\"editarPrestamo"+id+"\"   value='Editar' onclick=\"adminPrestamo('"+rowObject+"','editar');\"    />"; 
        return edit;
    }
	
	function agregarPrestamo () {            
		adminPrestamo();
    }
	
     $( "#txtPrestamo").datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
    
     $('#txtEntrega').datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());
    
});


function adminPrestamo(opt,option){
    var url="";
    var id = "";
    
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth()+1)+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
    var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
    
	if(option == "editar"){
		var myOptions = opt.split(',');
	    id = myOptions[0];
	    var practicante = myOptions[1];
	    var id_practicante = myOptions[2];
	    var prestamo = myOptions[3];
	    var entrega = myOptions[4];
	    var prestador= myOptions[5];
	    var id_prestador= myOptions[6];
	}

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
				

						jQuery("#jqgDetallePrestamo").jqGrid({ 
							url:'controllers/PrestamosController.php?op=2&id='+id, 
							datatype: "json",
							mtype: 'POST',
							height: 190,
							width: 400, 
							colNames:['id','codigo','titulo','action'], 
							colModel:[ 
							{name:'id',index:'id', width:10,hidden:true}, 
							{name:'codigo',index:'practicante',  width: 10}, 
							{name:'titulo',index:'idPracticante',  width: 10},
							{name:'action',index:'action',sortable:false, width: 10, formatter: displayButtonsDetalle},
							], 
							pager: '#pager-detalleprestamo', 
							rowNum:10, 
							rowList:[10,20,30], 
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
					 $("#txtPracticante").autocomplete({source:"controllers/buscar_usuario_ac.php",minLength: 1,select: function(event, data) {
								 $("#txtPracticante").val(data.item.value);
								 $("#id-practicante").val(data.item.id);
					  }});
					 
					 $("#txtPrestado").autocomplete({source:"controllers/buscar_usuario_ac.php",minLength: 1,select: function(event, data) {
								 $("#txtPrestado").val(data.item.value);
								 $("#id-prestado").val(data.item.id);
								 }});
					 
					 $("#txtLibro").autocomplete({source:"controllers/buscar_libro_ac.php",minLength: 1,select: function(event, data) {
								 $("#txtLibro").val(data.item.value);
								 $("#id-libro").val(data.item.id);
								 }});
					 //peticion ajax al insertar libro
					 $("#btnInsertarLibro").on("click",function(){
						
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
                	$("#dlgPrestamo").dialog("close");
                }
            }
        });
}

    function addDays(theDate, days) {
         return new Date(theDate.getTime() + days*24*60*60*1000);
    }

	function cargarGridDetallePrestamo(idDetalle){
        debugger;
		var url = 'controllers/PrestamosController.php?op=2&id='+idDetalle;
		$("#jqgDetallePrestamo").jqGrid('setGridParam', { url: url });
		$("#jqgDetallePrestamo").trigger("reloadGrid");					
	}
	
	function displayButtonsDetalle(cellvalue, options, rowObject)
    {	var id = rowObject[0];
        var edit = "<input  type='button' id=\"editarPrestamo"+id+"\"   value='Editar' onclick=\"adminPrestamo('"+rowObject+"','editar');\"    />"; 
        return edit;
    }