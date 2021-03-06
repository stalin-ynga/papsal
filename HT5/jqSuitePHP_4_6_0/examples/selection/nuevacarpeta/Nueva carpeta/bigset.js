jQuery("#bigset").jqGrid({        
   	url:'bigset.php',
	datatype: "json",
	height: 255,
   	colNames:['Codigo','NombreCom', 'Acceso'],
   	colModel:[
   		{name:'Codigo',index:'Codigo', width:65},
   		{name:'NombreCom',index:'NombreCom', width:150},
   		{name:'Acceso',index:'Acceso', width:100}
   	],
   	rowNum:12,
//   	rowList:[10,20,30],
   	mtype: "POST",
   	pager: jQuery('#pagerb'),
   	pgbuttons: false,
   	pgtext: false,
   	pginput:false,
   	sortname: 'item_id',
    viewrecords: true,
    sortorder: "asc"
});
var timeoutHnd;
var flAuto = false;

function doSearch(ev){
	if(!flAuto)
		return;
//	var elem = ev.target||ev.srcElement;
	if(timeoutHnd)
		clearTimeout(timeoutHnd)
	timeoutHnd = setTimeout(gridReload,500)
}

function gridReload(){
	var nm_mask = jQuery("#item_nm").val();
	var cd_mask = jQuery("#search_cd").val();
	jQuery("#bigset").jqGrid('setGridParam',{url:"bigset.php?nm_mask="+nm_mask+"&cd_mask="+cd_mask,page:1}).trigger("reloadGrid");
}
function enableAutosubmit(state){
	flAuto = state;
	jQuery("#submitButton").attr("disabled",state);
}
