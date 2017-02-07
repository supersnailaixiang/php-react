var React = require("react");

 
var TurnPageComponent = React.createClass({
	onClickFirstPage:function(){
		var type =1;
		this.handlePage(type);
	},
	onClickPreviousPage:function(){
		var type = 2;
		this.handlePage(type);
	},
	onClickNextPage:function(){
		var type = 3;
		this.handlePage(type);
	},
	onClickLastPage:function(){
		var type = 4;
		this.handlePage(type);
	},
	onClickTurnPage:function(){
		var type = 5;
		this.handlePage(type);
	},
	handlePage:function(type){
		var page = this.props.page.cur_page;
		if(type == 1)
		{
			page = 1;
		}
		else if(type == 2)
		{
			page = page >=2 ? page-1:page;
		}
		else if(type ==3)
		{
			page = page >= this.props.page.total_page ? this.props.page.total_page: page+1; 
		}
		else if(type == 4)
		{
			page = this.props.page.total_page;
		}
		else
		{
			page = this.refs.input_page.value.trim();
			var page_regex = /^\d{+}$/;
		//	alert(page);
		/*	if(!page_regex.test(page))
			{
				alert("跳转必须填入要跳转的页面");
				return ;
			}
			*/
		}
		this.props.handleTablePage(page);
		
	},
	render:function(){
		return(
			 
			<div>
			 <span> 共{this.props.page.total}条记录 当前第{this.props.page.cur_page}页 共{this.props.page.total_page}页</span>
			<div style={{display:"inline",float:'right'}}>
				
				 <button onClick={this.onClickFirstPage}>首页</button>
				 <button onClick={this.onClickPreviousPage}>上一页</button>
				 <button onClick={this.onClickNextPage}>下一页</button>
				 <input type='text' ref="input_page"></input>
				 <button onClick={this.onClickTurnPage}>跳转</button>
			</div>
			</div>
			);
	}
});

module.exports=TurnPageComponent;