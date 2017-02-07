var React = require('react');
var ReactDOM =require('react-dom');
 
var BodyTableComponent = require("./body_table.js");
var MainMenu = require("./menu.js");
var TurnPageComponent = require("./table_page.js");
var TabComponent = require("./tab_page.js");
 
 
var heads =[
	"表头1","表头2"
	
];
  
var indexs =[
	"table_head1","table_head2" 
	
	]; //相当于sql的表头

var table_rows = [{"table_head1":"测试1","table_head2":"测试2"}] ;

var page_turn = {"cur_page":1,"total_page":1,"total":2};
// 进入的网页用来搜索，翻页 
var url ="url";

var tabs =[
 
];

var search_data= Object();
var rows =[];


var TableTemplate = React.createClass({
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
     		 	 
     			window.history.pushState(null, null, "url&"+data);
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
     			window.history.pushState(null, null, "url"+page_data);
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
			
			 < BodyTableComponent heads={heads} indexs={indexs}  rows={this.state.rows} operates={operates} />
	 		 <TurnPageComponent page={this.state.page} handleTablePage={this.handleTablePage}/>
	 		 
	 		 <TabComponent tabs={tabs} />
			</div>
			 );
	}
});
ReactDOM.render(<TableTemplate url={url}/>,document.getElementById('content'));