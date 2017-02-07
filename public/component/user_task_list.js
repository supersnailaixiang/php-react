var React = require('react');
var ReactDOM =require('react-dom');
 
var BodyTableComponent = require("./body_table.js");
var MainMenu = require("./menu.js");
var TurnPageComponent = require("./table_page.js");
var TabComponent = require("./tab_page.js");
 
 
var heads =[
	"任务名称","任务状态","截止日期","公司名称","店铺名称","任务描述", "指派人", "创建人", "创建时间" 
];
  
var indexs =["task_name","status","deadline","company_name","shop_name","description","assignors_name","creator_name","created"]; //相当于sql的表头

var table_rows =  result;
var user_flags = null;

//不需要输入，返回值
var operates =[
	{"title":"修改任务","class2":"chg_task","target":"#chg_task_list","name":""},
	

]; // 需要输入
var page_turn = page; 
var url ="?controller=TaskController&act=getUserTaskList";


var tabs =[
{name:"日志",url:"?controller=TaskController&act=getUserTaskListByID"},
];

var search_data= Object();
var rows =[];
 
var TaskComponent = React.createClass({
	getInitialState:function(){
		return {rows:table_rows,search_data:'',page:page_turn};
	},
	onSearchSubmit:function(data){
		$.ajax({
     		url:this.props.url,
     		dataType:'json',
     		type:'POST',
     		async:false, 
     		data:data,
     		success:function(result){
     		 	 
	     		this.setState({rows:result.result,search_data:data,page:result.page});
	     		
     		}.bind(this),
     		error:function(xhr, status, err){
     			alert(this.props.url);
     			alert("chen");
     			alert(xhr.responseText);
     			//console.error(this.props.url,status, err.toString());
     		}.bind(this)
	    });

	},
	handleTablePage:function(page){
		var page_data = this.state.search_data+"&page="+page;
		
		$.ajax({
     		url:this.props.url,
     		dataType:'json',
     		type:'POST',
     		async:false, 
     		data:page_data,
     		success:function(result){
     		
	     		this.setState({rows:result.result,page:result.page});
	     		
     		}.bind(this),
     		error:function(xhr, status, err){
     			 
     			alert(xhr.responseText);
     			//console.error(this.props.url,status, err.toString());
     		}.bind(this)
	    });

	},
	handleClick:function(){
 
		var x = this.refs.test.returnData();
	 	alert(x);
	},
	render:function(){
 
		return (
			<div>
			 <MainMenu />
			 <span style={{color:'red'}}>任务中心</span>
		
			 < BodyTableComponent heads={heads} indexs={indexs}  rows={this.state.rows} operates={operates} />
	 		 <TurnPageComponent page={this.state.page} handleTablePage={this.handleTablePage}/>
	 	 
	 		 <TabComponent tabs={tabs} />
			</div>
			 );
	}
});
ReactDOM.render(<TaskComponent url={url}/>,document.getElementById('content'));