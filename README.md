# php-react
初认React 我发现 作为组件 将整个页面分割 搭建 模板太好用了。 封装后不在关注前段实现，只需要在component/下边的 js 文件中实现如下布局就可以了
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
