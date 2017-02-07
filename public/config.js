var webpack = require('webpack');
module.exports={
	entry:{
		bundle:'./component/test.js'
	},
	output:{
	path:"./js/",
	filename:'[name].js'
	},
	resolve:{
		extensions:['','.js','.jsx']
	},
	module:{
		loaders:[{
			test:/\.js$/,
			exclude:/(node_modules|bower_components)/,
			loader:'babel-loader',
			query:{
			 presets: ['es2015', 'react']
			}
		}]
	}
};
