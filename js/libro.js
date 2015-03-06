$(document).ready(function () {
	     //-------------------------------------------------------------------------------------------------GRIDD
	    $("#grid-data-libro").bootgrid(
        {
        caseSensitive:false ,/* make search case insensitive */
            formatters: {
        "commands": function(column, row)
        {
        return "<input  value='Editar' onclick=\"adminLibro('"+row.id_libro+"','"+row.titulo+"','"+row.codigo+"','"+row.descripcion+"','"+row.editorial+"','"+row.año+"','"+row.observaciones+"','"+row.estado+"','" +row.autores+"', 'editar');\" type='button' class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-pencil\"></span></input> " +
        "<input type='button' value='Eliminar' onclick=\"adminLibro('"+row.id_libro+"','"+row.titulo+"','"+row.codigo+"','"+row.descripcion+"','"+row.editorial+"','"+row.año+"','"+row.observaciones+"','"+row.estado+"','" +row.autores+"','eliminar');\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-trash-o\"></span></input>";
        }}
        });
    
    
    //-------------------------------------------------------------------------------------------------------aGREGARlIBRO
         $("#btnAgregarLibro").on("click",function(){
        adminLibro();
     })

});

function adminLibro(id_libro ,titulo ,codigo ,descripcion ,editorial ,año ,observacion ,estado,autores,option){
	 $("#frmLibroCancel").hide();
	 $("#frmLibro").show();
	
	//Agregar
	var url = 'controllers/LibrosController.php?op=1';
	
	
	if(option == 'editar'){
		url = 'controllers/LibrosController.php?op=2';
    var id = id_libro, titulo = titulo, codigo = codigo, descripcion = descripcion, editorial = editorial, año = año, observaciones= observacion, estado = estado,autores = autores;
	}else if(option == 'eliminar'){
        url = 'controllers/LibrosController.php?op=3';
   		 var id = id_libro, nombre = titulo;
	}
		
        $("#dlgLibro").dialog({
        resizable:false,
        title:'Libro.',
        height:370,
        width:450,
        modal:true,
        open:function(){
        	
        	$(".clean").val("");
        	
			$("#frmLibro").validate({  
				  
				rules: {  
					titulo:{required: true,minlength: 10,},  
					codigo:{required: true},                  
					editorial:{required: true},        
					año:{required: true,number:true},  
					autores:{required: true} 
				},  
				messages: {  
					titulo:{required: "*Requerido" },  
					codigo:{required: "*Requerido" },                 
					editorial:{required: "*Requerido" },        
					año:{required: "*Requerido" },  
					autores:{required: "*Requerido" }
				}  
			});
        	
        	
        	if(option == 'eliminar'){
       		 $("#frmLibroCancel").show();
    		 $("#frmLibro").hide();
    		 $("#lbllibro").html(titulo);
        	}
            	$("#id-libro").val(id);
            	$("#titulo").val(titulo);
            	$("#codigo").val(codigo);
            	$("#descripcion").val(descripcion);
            	$("#editorial").val(editorial);
            	$("#año").val(año);
            	$("#observaciones").val(observaciones);
            	$("#autores").val(autores);
            	$("#estado").val(estado);
        },
        buttons:{
            "Ok":function () {
            	
            	
		if ($("#frmLibro").validate().form() == true){
                $.ajax({
                    url : url,
                    type : $('#frmLibro').attr("method"),
                    data : $('#frmLibro').serialize(),
                    complete:function () {
                        $('#dlgLibro').dialog("close");
                         $('#grid-data-libro').bootgrid('reload');
                    }, error:function (error) {
                        $('.insert_modal').dialog("close");
                        $("<div class='insert_modal'>Ha ocurrido un error!</div>").dialog({
                            resizable:false,
                            title:'Error!.',
                            height:200,
                            width:450,
                            modal:true
                        });
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





    
    
    
