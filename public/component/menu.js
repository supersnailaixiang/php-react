
var React = require("react");
var ReactDOM =require('react-dom');
var MainMenu= React.createClass({
	componentWillMount:function(){

	},
	render:function(){
		return (
		<div className="navbar navbar-fixed-top navbar-inverse" role="navigation">
		  <div className="navbar-header">
		   
		       <button className="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		         <span className="sr-only">Toggle Navigation</span>
		         <span className="icon-bar"></span>
		         <span className="icon-bar"></span>
		         <span className="icon-bar"></span>
		       </button>
		  
		       <a href="##" className="navbar-brand"></a>
		  </div>
		<nav className="collapse navbar-collapse navbar-responsive-collapse" role="navigation">
			<div>
				<ul className="nav navbar-nav " ref="menu" id="menu_ul">
					<li className="dropdown" data-require="customer_intention"><a className="dropdown-toggle"  data-toggle="dropdown" href="#">第一列</a>
						<ul className="dropdown-menu">
							<li><a href="#">第一列1</a></li>
							<li><a href="#">第一列2</a></li>
							<li><a href="#">第一列3</a></li>
						</ul>
					</li>
					<li className="dropdown" data-require="customer_deal"><a className="dropdown-toggle" data-toggle="dropdown" href="#">第二列</a>
						<ul className="dropdown-menu">
							<li><a href="#">第二列1</a></li>
							<li><a href="#">第二列2</a></li>
							<li><a href="#">第二列3</a></li>
							 
						</ul>
					</li>

					<li className="dropdown" data-require="customer_sucess"><a className="dropdown-toggle" data-toggle="dropdown" href="#">第三列</a>
						<ul className="dropdown-menu">
							<li><a href="#">第三列1</a></li>
							<li><a href="#">第三列2</a></li>
							 
							<li className="dropdown-submenu" data-require="customer_success_function"><a className="dropdown-toggle" data-toggle="dropdown" >第三列3</a>
								<ul className="dropdown-menu">
								 		<li><a href="#">第三列31</a></li>
										<li><a href="#">第三列32</a></li>
								</ul>
							</li>
							 <li className="divider"></li>
						 
						</ul>
					</li>
					 
					 
				</ul>
			</div>
		</nav>
		</div>
		);
	}
});


module.exports = MainMenu;
