$(document).ready(function () {

    //-------------------------------------------------------------------------------------------GRID
    $("#grid-data").bootgrid(
        {
        caseSensitive:false ,/* make search case insensitive */
            formatters: {
        "commands": function(column, row)
        {
        return "<input  value='Editar' onclick=\"adminUsuario('"+row.id_usuario+"','"+row.cedula+"','"+row.usuario+"','"+row.correo+"','"+row.celular+"','"+row.telefono+"', 'editar');\" type='button' class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-pencil\"></span></input> " +
        "<input type='button' value='Eliminar' onclick=\"adminUsuario('"+row.id_usuario+"','"+ row.cedula+"','"+row.usuario+"','"+row.correo+"','"+row.celular+"','"+row.telefono+"','eliminar');\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-trash-o\"></span></input>";
        }}
        });
    

    
	//-----------------------------------------------------------------------------------------TABS
	$( "#tabs" ).tabs({
	      beforeLoad: function( event, ui ) {
	        ui.jqXHR.error(function() {
	          ui.panel.html(
	            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
	            "If this wouldn't be a demo." );
	        });
	      }
	    });
    
    
    //-------------------------------------------------------------------------------------------AGREGARUSUARIOS
     $("#btnAgregarUsuario").on("click",function(){
        adminUsuario();
     })
	
	
    /*---fin ready ---*/
});


function adminUsuario(id,cedula,usuario,correo,celular,telefono,option){
	 $("#frmUsuarioCancel").hide();
	 $("#frmUsuario").show();
	//agregar
	var url = 'controllers/UsuariosController.php?op=1';
	if(option == 'editar'){
		url = 'controllers/UsuariosController.php?op=2';
	}else if(option == 'eliminar'){
		url = 'controllers/UsuariosController.php?op=3';
	}
		
        $("#dlgUsuario").dialog({
        resizable:false,
        title:'Usuario.',
        height:320,
        width:450,
        modal:true,
        open:function(){
        	$(".clean").val("");
			$("label.error").hide();
			$(".error").removeClass("error");
			if(option == 'eliminar'){
        		 $("#frmUsuarioCancel").show();
        		 $("#frmUsuario").hide();
        		 $("#lblusuario").html(usuario);
        	}
			
			$("#frmUsuario").validate({  
  
				rules: {  
					cedula:  {required: true, number:true},  
					usuario: {required: true, minlength: 10},  
					correo:  {required: true, email: true},                
					celular: {required: true, number:true},        
					telefono:{required: true,  number: true}  
				},  
				messages: {  
					cedula:{  
						required: "*Requerido" 
					},  
					usuario:{  
						required: "*Requerido"  
					},  
					correo: {  
						required: "*Requerido",  
						email:    "Formato no valido: Correo"						
					},  
					celular:{
						required: "*Requerido"
					},
					telefono:{
						required: "*Requerido"
					}
				}  
			});
        	$("#id-usuario").val(id);
        	$("#cedula").val(cedula);
        	$("#name-user").val(usuario);
        	$("#correo").val(correo);
        	$("#celular").val(celular);
        	$("#telefono").val(telefono);
        },
        buttons:{
            "Ok":function () {
				//$("#frmUsuario").submit(function(event){
					if ($("#frmUsuario").validate().form() == true){
						
						$.ajax({
							url : url,
							type : $("#frmUsuario").attr("method"),
							data : $("#frmUsuario").serialize(),
							complete:function () {
								$('#dlgUsuario').dialog("close");
                                $('#grid-data').bootgrid('reload');
							 }, error:function (error) {
								$('.insert_modal').dialog("close");
								$("<div class='insert_modal'>Ha ocurrido un error!</div>").dialog({resizable:false,title:'Error!.',height:200,width:450,modal:true});
							}
						});
					
					}
				

            },
            Cancelar:function () {
                $(this).dialog("close");
            }
        }
    });

}



