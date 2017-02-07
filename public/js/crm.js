$(function(){
 
	$('a[data-toggle="tab"]').on('shown.bs.tab',function(e){
		var index = $("#tab_ul").find(".active").index();		
		var url =   $("#tab_ul li:eq("+index+")").attr("data-url");
		 
		//style='height:400px;overflow:scroll'>
		
	 
		$("#tab_crm_table").empty();
	//	$("#tab_crm").append(table);
		//var html= $("#body_table_list ").find(".tr_selected").html()
		var rec_id= $("#body_table_list").find(".tr_selected").attr("data-id");
		 
		if(rec_id ==null)
			return;
		 $.ajaxSettings.async = false;
		// 操作人，操作，修改时间，创建时间。
		$.getJSON(url,{rec_id:rec_id},function(data){
			var heads = data.heads;
			var names = data.names;
			var result = data.result;
			var table ="<table border='1'><tr>";
			var table ="<thead><tr>";
			$.each(heads,function(i){
				table += "<th>"+heads[i]+"</th>"
			});
			table +="</tr></thead><tbody>";
			$.each(result,function(i){
				table +="<tr>";
				$.each(names,function(key,value){

					table+="<td>"+result[i][value]+"</td>";
				});
				table +="</tr>";
			});
			table +="</tbody></table>"
		 
			$("#tab_crm_table").append(table);
		 
		});
	});
	$("tr[data-search-toggle]").toggle();
	$("#btn_toggle_search").click(function(){
		$("tr[data-search-toggle]").toggle();
	});
	 
 	
	$("table[data-body='body']").on("click","tr:not(first)",function(){
		//$("table tr").find(".tr_selected").css("background-color","white").removeClass("tr_selected");

		$(this).parents("table").find(".tr_selected").removeClass("tr_selected");
	//	alert($(this).parents("table").html());
//		$(this).css("background-color","#51b2f6");
		$(this).addClass("tr_selected");
	
		var index = $("#tab_ul").find(".active").index();		
		var url =   $("#tab_ul li:eq("+index+")").attr("data-url");
		 
		//style='height:400px;overflow:scroll'>
		
	
		$("#tab_crm_table").empty();
	//	$("#tab_crm").append(table);
		//var html= $("#body_table_list ").find(".tr_selected").html()
		var rec_id= $("#body_table_list").find(".tr_selected").attr("data-id");
		 

		if(rec_id ==null)
			return;
		
	$.ajaxSettings.async = false;
		// 操作人，操作，修改时间，创建时间。
	$.getJSON(url,{rec_id:rec_id},function(data){
			var heads = data.heads;
			var names = data.names;
			var result = data.result;
			var table ="<thead><tr>";
			$.each(heads,function(i){
				table += "<th>"+heads[i]+"</th>"
			});
			table +="</tr></thead><tbody>";
			$.each(result,function(i){
				table +="<tr>";
				$.each(names,function(key,value){

					table+="<td>"+result[i][value]+"</td>";
				});
				table +="</tr>";
			});
			table +="</tbody></table>"
		 
			$("#tab_crm_table").append(table);
		});
	});
 
 
$('div[data-modal-url]').on('show.bs.modal', function () {
  	var url = $(this).attr("data-modal-url");
  	var table_dom = $(this).attr("data-target-table");

  	var rec_id= $("#body_table_list ").find(".tr_selected").attr("data-id");
  	if(rec_id =="" || rec_id ==null)
  	{
  		alert("请选中客户");
  		return false;
  	}
  	url = url+"&rec_id="+rec_id;
 	 $.ajaxSettings.async = false;
  	$.getJSON(url,function(result){
   		var province_id = result['province_id'];
   		var industry_new = result['industry_new'];

		var url ="?controller=DictDataController&act=getDictData&type=7&index="+industry_new;
	 	var options ="";
		$.getJSON(url,function(result){
			$.each(result,function(i,data){
				options+="<option value="+data.id+">"+data.name+"</option>";
			});
			$("#"+table_dom).find("[name='cate']").empty();
			$("#"+table_dom).find("[name='cate']").append(options);

			$("#"+table_dom).find("[name='cate']").selectpicker('refresh');
 
		});

		var url ="?controller=DictDataController&act=getDictData&type=2&index="+province_id;
	 	city_options ="<option value='0'>无</option>";
		$.getJSON(url,function(result){
			$.each(result,function(i,data){
			 
				city_options+="<option value="+data.id+">"+data.name+"</option>";
			});
		 $("#"+table_dom).find("[name='city_id']").empty();
			$("#"+table_dom).find("[name='city_id']").append(city_options);

			$("#"+table_dom).find("[name='city_id']").selectpicker('refresh');

			$("#"+table_dom).find("[name='city']").empty();
			$("#"+table_dom).find("[name='city']").append(city_options);

			$("#"+table_dom).find("[name='city']").selectpicker('refresh');
		});
  		$.each(result,function(key,value){
  		//	alert($(this).find("[name="+key+"]").html());
  			if(key =='logo' || key =='collect_voucher' || key =='photo_path')
  			{
  				value='';
  			}
  			//alert(key);
  			if(key =='cate')
  			{
  				var dom = $("#"+table_dom).find("[name='cate']");
  			}
  			else if(key =='sale_remark')
  			{

  			    if("customer_update_version_form" ==table_dom || "customer_buy_other_form" ==table_dom)
  				{
  					value="";
  				 
  				}
  				 
  				var dom = $("#"+table_dom).find("[name="+key+"]");
  			}
  			else
  			{
  				var dom = $("#"+table_dom).find("[name="+key+"]");

  			}

  			 
  			if($(dom).hasClass('selectpicker')==true)
  			{
  				if(key=='cate' || key =='industry_new' || key =='platform_id' || key=='category')
  				{
  					value = value.split(",");
  				}
  				 
  				$(dom).selectpicker('val', value);
  				

  			}
  			else
  			{	

  				 
  				$(dom).val(value);
  				
  			}
  		});
  	});
 
 

 });


//$("input[type='date']").datepicker({ dateFormat: 'yy-mm-dd' })
 var Sys={};
    var ua=navigator.userAgent.toLowerCase();
 
    var s;
 
    (s=ua.match(/msie ([\d.]+)/))?Sys.ie=s[1]:
 
    (s=ua.match(/firefox\/([\d.]+)/))?Sys.firefox=s[1]:
 
    (s=ua.match(/chrome\/([\d.]+)/))?Sys.chrome=s[1]:
 
    (s=ua.match(/opera.([\d.]+)/))?Sys.opera=s[1]:

    (s=ua.match(/version\/([\d.]+).*safari/))?Sys.safari=s[1]:0;

if(!Sys.chrome){//Js判断为谷歌chrome浏览器

    $("input[type='date']").each(function(){
 		$(this).datepicker({dateFormat:'yy-mm-dd'});
 	});

 }
 
 
 

});