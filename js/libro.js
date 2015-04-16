$(document).ready(function () {
	     //-------------------------------------------------------------------------------------------------GRIDD
	    $("#grid-data-libro").bootgrid(
        {
        caseSensitive:false ,/* make search case insensitive */
            formatters: {
        "commands": function(column, row)
        {
        return "<input  value='Editar' onclick=\"adminLibro('"+row.id_libro+"','"+row.numeroAcceso+"','"+row.codigo+"','"+row.autores+"','"+row.titulo+"','"+row.editorial+"','"+row.año+"'   ,'"+row.isbn+"','"+row.serie+"','"+row.pais+"','"+row.paginas+"','"+row.ejemplares+"'   ,'"+row.descripcion+"','"+row.observaciones+"','"+row.encuadernar+"','"+row.estado+"', 'editar');\" type='button' class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-pencil\"></span></input> " +
        "<input type='button' value='Eliminar' onclick=\"adminLibro('"+row.id_libro+"','"+row.numeroAcceso+"','"+row.codigo+"','"+row.autores+"','"+row.titulo+"','"+row.editorial+"','"+row.año+"'   ,'"+row.isbn+"','"+row.serie+"','"+row.pais+"','"+row.paginas+"','"+row.ejemplares+"'   ,'"+row.descripcion+"','"+row.observaciones+"','"+row.encuadernar+"','"+row.estado+"','eliminar');\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id_usuario + "\"><span class=\"fa fa-trash-o\"></span></input>";
        }}
        });
    
    //------------------------------------------------------------------------------------------tabs

    
    //-------------------------------------------------------------------------------------------------------aGREGARlIBRO
         $("#btnAgregarLibro").on("click",function(){
        adminLibro();
     })

});


  

function adminLibro(id_libro,numeroAcceso,codigo,autores,titulo,editorial,año,isbn,serie,pais,paginas,ejemplares,descripcion,observaciones,encuadernar,estado,option){

    
    $("#frmLibroCancel").hide();
	 $("#frmLibro").show();
	
	//Agregar
	var url = '/controllers/LibrosController.php?op=1';
	
	
	if(option == 'editar'){
		url = '/controllers/LibrosController.php?op=2&idLibro='+id_libro;
        var id_libro=id_libro,numeroAcceso=numeroAcceso,codigo=codigo,autores=autores,titulo=titulo,editorial=editorial,año=año,isbn=isbn,serie=serie,pais=pais,paginas=paginas,ejemplares=ejemplares,descripcion=descripcion,observaciones=observaciones,encuadernar=encuadernar,estado=estado;
    
	}else if(option == 'eliminar'){
        url = '/controllers/LibrosController.php?op=3';
   		 var id = id_libro, nombre = titulo;
	}
		
        $("#dlgLibro").dialog({
        resizable:false,
        title:'Libro.',
        height:550,
        width:700,
        modal:true,
        open:function(){
        	
        	$(".clean").val("");
        	
			$("#frmLibro").validate({  

  
				rules: {  
                    numeroAcceso:{required: true}, 
                    codigo:{required: true}, 
                    autor:{required: true}, 
                    titulo:{required: true}, 
                    editorial:{required: true}, 
                    ano:{required: true,number:true}, 
                    isbn:{required: true}, 
                    serie:{required: true}, 
                    pais:{required: true}, 
                    pagina:{required: true,number:true}, 
                    ejemplares:{required: true,number:true}, 
                    descripcion:{required: true}, 
                    observaciones:{required: true}, 
                    encuadernar:{required: true} 
				},  
				messages: {  
                    numeroAcceso: {required: "*Requerido" },
                    codigo: {required: "*Requerido" },
                    autor: {required: "*Requerido" },
                    titulo: {required: "*Requerido" },
                    editorial: {required: "*Requerido" },
                    ano: {required: "*Requerido" },
                    isbn: {required: "*Requerido" },
                    serie: {required: "*Requerido" },
                    pais: {required: "*Requerido" },
                    pagina: {required: "*Requerido" },
                    ejemplares: {required: "*Requerido" },
                    descripcion: {required: "*Requerido" },
                    observaciones: {required: "*Requerido" }, 
                    encuadernar: {required: "*Requerido" }

				}  
			});
        	
        	
        	if(option == 'eliminar'){
       		 $("#frmLibroCancel").show();
    		 $("#frmLibro").hide();
    		 $("#lbllibro").html(titulo);
        	}
            
              $("#id_libro").val(id_libro);
              $("#txtNumeroAcceso").val(numeroAcceso);
              $("#txtCodigo").val(codigo);
              $("#txtAutor").val(autores);
              $("#txtTitulo").val(titulo);
              $("#txtEditorial").val(editorial);
              $("#txtAno").val(año);
              $("#txtIsbn").val(isbn);
              $("#txtSerie").val(serie);
              $("#txtPais").val(pais);
              $("#txtPagina").val(paginas);
              $("#txtEjemplares").val(ejemplares);
              $("#txtDescripcion").val(descripcion);
              $("#txtObservaciones").val(observaciones);
              $("#txtEncuadernar").val(encuadernar);
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





    
    
    
