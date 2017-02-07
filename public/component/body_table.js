//table 数据
// 操作参数
// 第一列中 操作参数 class title  data-toggle="modal"   data-target="#myModal"
// 传入table行数据
//表头，以及对应的name

var React = require("react");
var TableHeadRowComponent = React.createClass({
	render:function(){
		var ths =[];
		this.props.heads.forEach(function(name){
			ths.push(<th style={{background:'#000000',color:'#FFFFFF'}}>{name}</th>);
		}.bind(this));
		return (
				<tr>
					<th style={{background:'#000000',color:'#FFFFFF'}}> 操作</th>
				 
					{ths}
				</tr>
			);
	}
});
var TdOperateComponent = React.createClass({
	render:function(){
		var buttons =[];
		this.props.operates.forEach(function(operate){
			if(operate.name !="")
			{
				buttons.push(<button  className={operate.class2}  data-toggle="modal" title={operate.title} 
				 data-target={operate.target}>{operate.name}</button>);
			}
			else{
				buttons.push(<button  className={operate.class2} data-toggle="modal" title={operate.title} 
				 data-target={operate.target}></button>);
			}
			
		}.bind(this));
		return(
			<th>
				{buttons}
			</th>
			);

	}
});
var TableCommonRowComponent = React.createClass({
	onClickRow:function(e){
	 
		$(e).addClass("tr_selected");
	},
	render:function(){
		var tds =[];
		var operates =[];
		
		this.props.indexs.forEach(function(index){
				tds.push(<td>{this.props.row[index]}</td>);
		}.bind(this));
		if(this.props.row.bg_color ==null)
		{
			return (
			<tr onClick={this.onClickRow} data-id={this.props.row.rec_id} data-work_id={this.props.row.work_id} data-customer_id={this.props.row.customer_id} data-type={this.props.row.type} data-seller_id={this.props.row.seller_id} >
			<TdOperateComponent operates={this.props.operates}/>
			{tds}
			</tr>
			);
		}
		else
		{
			return (
			<tr onClick={this.onClickRow} data-id={this.props.row.rec_id} data-work_id={this.props.row.work_id} data-customer_id={this.props.row.customer_id} data-seller_id={this.props.row.seller_id} data-type={this.props.row.type} style={{background:'#'+this.props.row.bg_color}}>
			<TdOperateComponent operates={this.props.operates}/>
			{tds}
			</tr>
			);
		}
		
	}
});
var BodyTableComponent = React.createClass({
	 
	render:function(){
		var rows=[];
	 	if(this.props.rows ==null)
	 	{
	 		rows=[];
	 	}
	 	else
	 	{
		 	this.props.rows.forEach(function(row){
		 		rows.push(<TableCommonRowComponent row={row} operates ={this.props.operates} indexs={this.props.indexs}/>);
		 	}.bind(this));
		 }
 	
		return(
				<div  border="1"  style={{height:'380px',width:'auto',overflow:'auto','display':'block'}}>
				<table className="table  table-bordered "   id="body_table_list" data-body="body"  >
					<thead  style={{width:'auto'}}>
						<TableHeadRowComponent heads={this.props.heads} />
					</thead>
					<tbody  >
						{rows}
					</tbody>
				</table>
				</div>
			);

	}
});

module.exports = BodyTableComponent;
 
