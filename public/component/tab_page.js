var React = require("react");
var ReactDOM = require("react-dom");

var TabComponent = React.createClass({
	onClickTabs:function(){
		//var index = $("#tab_ul").find(".active").index();
		alert("che");
		var dom =  ReactDOM.findDOMNode(this.refs.tab_ul);
		var index = $(dom).find(".active").index();
		var url = $(dom).find(".active").attr("url");
		alert(url)
		
	},
	render:function(){
		var count =1;
		var rows =[];
		this.props.tabs.forEach(function(result){
			if(count==1)
			{
				rows.push(<li className="active" data-url={result.url}><a  url="url" href="tab_crm" data-toggle="tab" >{result.name}</a></li>);
			}
			else
			{
				rows.push(<li data-url={result.url}><a  href="tab_crm" data-toggle="tab">{result.name}</a></li>);
			}
			count++;
		}.bind(this));
		return (
			<div id="tab_page_div" className="ui-widget-content"  style={{'height':'20%'}}>
				<ul className="nav nav-tabs" id="tab_ul" ref="tab_ul" >
					{rows}
				</ul>
				<div className="tab-content" style={{width:'auto',height:'80%',overflow:'auto'}} >
					<div className = "tab-pane fade in active "  id="tab_crm" >
						<table className='table table-hover '  id="tab_crm_table" >
						</table>
						
					</div>
				</div>
			</div>

			);
	}
});
module.exports= TabComponent;