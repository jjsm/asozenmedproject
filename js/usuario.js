$(document).ready(function () {
	
	jQuery("#jqgUsuario").jqGrid({ 
		// url:'controllers/UsuariosController.php?op=0', 
		url:'controllers/ensayogrid.php',
		datatype: "json",
		mtype: 'POST',
		height:'100%',
		width: 930, 
		colNames:['id','cedula','usuario','correo','celular','telefono','Acciones'], 
		colModel:[ 
		          {name:'id',index:'id_usuario', width:55,hidden:true}, 
		          {name:'cedula',index:'cedula',  width: 80, editable:true}, 
		          {name:'usuario',index:'usuario',  width: 80, editable:true}, 
		          {name:'correo',index:'correo', width:90, editable:true},
                  {name:'celular',index:'celular', width:90, editable:true},
                  {name:'telefono',index:'telefono', width:90, editable:true},
                  {name:'action',index:'action',sortable:false, formatter: displayButtons},
		     	], 
         loadComplete: function() {
                  $('#jqgUsuario').setGridParam({datatype:'json'}).trigger('reloadGrid',[{current:true}]);
 
          },
         onSelectRow: function(rowid, status, e) {
                var $div = $(e.target).closest(".ui-pg-div");
                if ($div.hasClass("ui-inline-del") && $div.attr("id") === "jDeleteButton_" + rowid) {
                    alert("Delete button was clicked");
                }// else if ($div.hasClass("ui-inline-edit") && $div.attr("id") === "jEditButton_" + rowid) {
                //    alert("Edit button was clicked");
                //}
         },
		 pager: '#pagerusuario', 
		 rowNum:10, 
		 rowList:[10,20,30], 
		 sortname: 'id', 
		 sortorder: "asc",
		 viewrecords: true, 
		 caption: 'USUARIOS',
         loadonce: true,
		 toppager: true
		  })
		  .navGrid('#pagerusuario',{edit:false,add:false,del:false,search:false})
		  //Boton Agregar
		  .navButtonAdd('#pagerusuario',{caption:"Add", buttonicon:"ui-icon-add", onClickButton: function(){ agregarUsuario();
		   }, 
		   position:"last"
		});
	

	
	function displayButtons(cellvalue, options, rowObject)
    {

        var id = rowObject[0];
	    var cedula =  rowObject[1];
	    var usuario =  rowObject[2];
	    var correo =  rowObject[3];
	    var celular =  rowObject[4];
	    var telefono =  rowObject[5];
        var edit = "<input  type='button' id=\"editarUsuario"+id+"\"  value='Editar' onclick=\"adminUsuario('"+id+"','"+ cedula+"','"+usuario+"','"+correo+"','"+celular+"','"+telefono+"', 'editar');\"    />",  
             restore = "<input type='button' id=\"editarUsuario"+id+"\"  value='Eliminar' onclick=\"adminUsuario('"+id+"','"+ cedula+"','"+usuario+"','"+correo+"','"+celular+"','"+telefono+"','eliminar');\" />";
        return edit+restore;
    }
	function agregarUsuario () { 
		adminUsuario();
	}
	//----------------------TABS
	$( "#tabs" ).tabs({
	      beforeLoad: function( event, ui ) {
	        ui.jqXHR.error(function() {
	          ui.panel.html(
	            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
	            "If this wouldn't be a demo." );
	        });
	      }
	    });
	
	

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
							
        	$("#id").val(id);
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
                                $('#jqgUsuario').setGridParam({datatype:'json'}).trigger('reloadGrid',[{current:true}]);
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



