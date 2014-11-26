$(document).ready(function () {
	
	jQuery("#jqgLibro").jqGrid({ 
		url:'controllers/LibrosController.php?op=0', 
		datatype: "json",
		mtype: 'POST',
		height: 190,
		width: 930, 
		colNames:['id','titulo','codigo','descripcion','editorial','año','observaciones','estado','Acciones'], 
		colModel:[ 
		          {name:'id',index:'id_libro', width:55,hidden:true}, 
		          {name:'titulo',index:'cedula',  width: 80}, 
		          {name:'codigo',index:'usuario',  width: 80}, 
		          {name:'descripcion',index:'correo', width:90},
		          {name:'editorial',index:'celular', width:90},
		          {name:'año',index:'telefono', width:90},
		          {name:'observaciones',index:'celular', width:90},
		          {name:'estado',index:'telefono', width:90},
		          {name:'action',index:'action',sortable:false, formatter: displayButtons},
		          ], 
         		          ], 
         loadComplete: function() {
            
                  $('#jqgLibro').setGridParam({datatype:'json'}).trigger('reloadGrid',[{current:true}]);
          },
		 pager: '#pagerlibro', 
		 rowNum:10, 
		 rowList:[10,20,30], 
		 sortname: 'id', 
		 sortorder: "asc",
		 viewrecords: true, 
		 caption: 'LIBROS',
         loadonce: true,
		 toppager: true
		  })
		  .navGrid('#pagerlibro',{edit:false,add:false,del:false,search:false})
		  //Boton Agregar
		  .navButtonAdd('#pagerlibro',{
		   caption:"Add", 
		   buttonicon:"ui-icon-add", 
		   onClickButton: function(){ 
			   agregarLibro();
		   }, 
		   position:"last"
		});
	
	function agregarLibro(){
		adminLibro();
	}
	
	function displayButtons(cellvalue, options, rowObject)
    {	var id = rowObject[0];
        var edit = "<input  type='button' id=\"editarLibro"+id+"\"  value='Editar' onclick=\"adminLibro('"+rowObject+"','editar');\"    />",
             restore = "<input type='button' id=\"editarLibro"+id+"\"  value='Eliminar' onclick=\"adminLibro('"+rowObject+"','eliminar');\" />";
        return edit+restore;
    }

});

function adminLibro(opt,option){
	 $("#frmLibroCancel").hide();
	 $("#frmLibro").show();
	
	//Agregar
	var url = 'controllers/LibrosController.php?op=1';
	
	
	if(option == 'editar'){
		url = 'controllers/LibrosController.php?op=2';
	var myOptions = opt.split(',');

	    var id = myOptions[0];
	    var titulo = myOptions[1];
	    var codigo = myOptions[2];
	    var descripcion = myOptions[3];
	    var editorial = myOptions[4];
	    var año = myOptions[5];
	    var observaciones= myOptions[6];
	    var estado = myOptions[7];
	    var autores = myOptions[8];
	}else if(option == 'eliminar'){
		url = 'controllers/LibrosController.php?op=3';
		 var myOptions = opt.split(',');

   		 var id = myOptions[0];
   		 var nombre = myOptions[2];
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
                        $('.insert_modal').dialog("close");
                        $("<div class='insert_modal'>Operacion Exitosa</div>").dialog({
                            resizable:false,
                            title:'Estado.',
                            height:200,
                            width:450,
                            modal:true
                        });
                        setTimeout(function() {
                        	$('#jqgLibro').trigger( 'reloadGrid' );
                        	 window.location.href = "index.php";
                            
                        }, 2000);
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





    
    
    
