$(document).ready(function () {

    	$("#tabsPractica").tabs({
	      beforeLoad: function( event, ui ) {
	        ui.jqXHR.error(function() {
	          ui.panel.html(
	            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
	            "If this wouldn't be a demo." );
	        });
	      }
	    });
    
    $("#gridPractica").jqGrid({
				url: '/controllers/gridpractica.php',
				autowidth: true,
                datatype: "json",
				height: "auto",
				autowidth:true,
				colNames:['id_practica','practica','fechapractica' ,'valorPract','Action'],
				colModel:[
					{name:'id_practica',index:'id_practica', width:30,hidden:true},
					{name:'practica',index:'practica', width:30},
                    {name:'fechapractica',index:'fechapractica', width:30},
                    {name:'valorPract',index:'valorPract', width:30},
                    {name:'action',index:'action',sortable:false, formatter: displayButtons,width:10},
					],
				viewrecords: true,
				altRows: true,
				pager:'#pager',
				rowNum: 10,
				rowList:[10,15,20]
			}).navGrid('#pager', { view: false, del: false, add: false, edit: false, search:false},
				{},//opciones edit
				{}, //opciones add
				{}, //opciones del
				{multipleSearch:false,closeAfterSearch: false, closeOnEscape: false}//opciones search
			);
    
    function displayButtons(cellvalue, options, rowObject)
    {  
        var edit = "<input style='...' type='button' value='Edit' onclick=\"adminPractica('" + options.rowId + "');\"  />", 
             save = "<input style='...' type='button' value='Save' onclick=\"jQuery('#gridPractica').saveRow('" + options.rowId + "');\"  />", 
             restore = "<input style='...' type='button' value='Restore' onclick=\"jQuery('#gridPractica').restoreRow('" + options.rowId + "');\" />";
        return edit+save+restore;
    }
    
    
     $("#btnAgregarPractica").on("click",function(){
        adminPractica();
     })
     
     
      $( "#txtFecha").datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date());

});


function adminPractica(id){   
    var fullDate = new Date();
    var twoDigitMonth = (fullDate.getMonth()+1)+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
    var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
    
    url :'/controllers/PracticaController.php?op=1';
    
    if(id){
    $("#btnInsertarPracticante").data('idpractica',id);    
    }else{
        $("#btnInsertarPracticante").data('idpractica',"0");
    }
    
                $("#gridDetallePractica").jqGrid({
				url: '/controllers/gridDetallePractica.php?idPractica='+$("#btnInsertarPracticante").data('idpractica'),
				autowidth: true,
                datatype: "json",
				height: "auto",
				autowidth:true,
				colNames:['id_practica','usuario','valorpago'],
				colModel:[
					{name:'id_practica',index:'id_practica', width:300,hidden:true},
                    {name:'usuario',index:'usuario', width:300},					
                    {name:'valorpago',index:'valorpago', width:300}
                    
					],
				viewrecords: true,
				altRows: true,
				pager:'#pager',
				rowNum: 10,
				rowList:[10,15,20]
			}).navGrid('#pager', { view: false, del: false, add: false, edit: false, search:false},
				{},//opciones edit
				{}, //opciones add
				{}, //opciones del
				{multipleSearch:false,closeAfterSearch: false, closeOnEscape: false}//opciones search
			);
    
		
        $("#dlgPractica").dialog({
        resizable:false,
        title:'Practicante.',
        height:425,
        width:900,
        modal:true,
        open:function(){
        	$(".clean").val("");
			$("label.error").hide();
			$(".error").removeClass("error");
			
			$("#frmPractica").validate({  
  
				rules: {  
					tipopractica:  {required: true},  
					fechaPractica: {required: true },  
					valor:  {required: true, number: true},                
					practicante: {required: true},        
					idpracticante:{required: true,  number: true} 
				},  
				messages: {  
					tipopractica:{  
						required: "*Requerido" 
					},  
					fechaPractica:{  
						required: "*Requerido"  
					},  
					valor: {  
						required: "*Requerido"						
					},  
					practicante:{
						required: "*Requerido"
					},
					idpracticante:{
						required: "*Requerido"
					}
				}  
			});
            
            
            //---------
             var url ='/controllers/gridDetallePractica.php?idPractica='+$("#btnInsertarPracticante").data('idpractica');
            $("#gridDetallePractica").jqGrid('setGridParam', { url: url });
            $("#gridDetallePractica").trigger("reloadGrid");
    
            function displayButtons(cellvalue, options, rowObject)
            { 

            }
            //---------

            $("#txtPracticante").autocomplete({source:"/controllers/UsuariosController.php?op=4",minLength: 1,select: function(event, data) {
                $("#txtPracticante").val(data.item.value);
                $("#id-practicante").val(data.item.id);
					  }});
                       
            $("#txtFecha").val(currentDate);
            $("#txtTipoPractica").val("Practica");
            $("#txtValor").val("0");
            


        },
        buttons:{
            "Ok":function () {
					if ($("#frmPractica").validate().form() == true){
						
						$.ajax({
							url : url,
							type : $("#frmPractica").attr("method"),
							data : $("#frmPractica").serialize(),
							complete:function () {
								$('#dlgPractica').dialog("close");
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

function insertarPracticantePractica ()	{
    						 if ($("#frmPractica").validate().form() == true){
                                 
                                    $.ajax({
									url :'/controllers/PracticaController.php?op=1&idPractica='+$("#btnInsertarPracticante").data('idpractica')+'&idPracticante='+$("#id-practicante").val() ,
									type : $('#frmPractica').attr("method"),
									data : $('#frmPractica').serialize(),
									complete:function (jqXHR,status) {
									
                                        $("#id-practicante").val(jqXHR.responseText);
                                        $("#btnInsertarPracticante").data('idpractica',$("#idpractica").val());
                                        
                                        //--------------------------------------------------GRIDD

                                       $("#gridDetallePractica").jqGrid({
                                        url: '/controllers/gridDetallePractica.php?idPractica='+$("#btnInsertarPracticante").data('idpractica'),
                                        autowidth: true,
                                        datatype: "json",
                                        height: "auto",
                                        autowidth:true,
                                        colNames:['id_practica','usuario','fechapractica' ,'valorPract','Action'],
                                        colModel:[
                                            {name:'id_practica',index:'id_practica', width:30,hidden:true},
                                            {name:'usuario',index:'usuario', width:30},
                                            {name:'valorPract',index:'valorPract', width:30},
                                            {name:'action',index:'action',sortable:false, formatter: displayButtons,width:10},
                                            ],
                                        viewrecords: true,
                                        altRows: true,
                                        pager:'#pager',
                                        rowNum: 10,
                                        rowList:[10,15,20]
                                    }).navGrid('#pager', { view: false, del: false, add: false, edit: false, search:false},
                                        {},//opciones edit
                                        {}, //opciones add
                                        {}, //opciones del
                                        {multipleSearch:false,closeAfterSearch: false, closeOnEscape: false}//opciones search
                                    ); 
                                        
                                          function displayButtons(cellvalue, options, rowObject)
                                            {  
                                                var edit = "<input style='...' type='button' value='Edit' onclick=\"adminPractica('" + options.rowId + "');\"  />"; 
                                               return edit;
                                            }  
                                        //------------------------------------------------------
	
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




							

    

