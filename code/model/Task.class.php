<?php
	class Task
	{
		static function addTask($post)
		{
		 
			$data = dataTrim($post);

			$customer_id = $data['customer_id'];
			$user_id = $_SESSION['user_id'];
			$data['user_id'] = $user_id;
	 
			$db = db();
		 	$assignors_sql ="select group_concat(user_name) as name from cfg_user where find_in_set(user_id,:assignors)";
		 	$assignors_data = array("assignors"=>$data['assignors']);
		 	$assignors_result = $db->prepare_execute_result_single($assignors_sql,$assignors_data);
		 	$data['assignors_name'] = $assignors_result['name'];

			$sql = "insert into task_list(task_namereated)values
			(:task_name,now())";
		 
			$result = $db->prepare_execute($sql,$data);
			
			 
		 
			return true;
		}
		static function getTaskListByID($customer_id)
		{
			$db = db();
			$sql_data = array("customer_id"=>$customer_id);
			$sql = "select cu.user_name,tl.task_name,tl.description,tl.assignors_name,tl.status,tl.created from task_list tl left join cfg_user cu on cu.user_id = tl.creator where customer_id =:customer_id";
			$result = $db->prepare_execute($sql,$sql_data);
			while($row = $db->fetch($result)){
				 
				$row['status'] = get_dict_data('task_status',$row['status']);
				$arr[] = $row;
			};
			 
			$heads = array("任务名称","状态","任务内容","任务接收人","创建人","创建时间");
			$names = array("task_name","status","description","assignors_name","user_name","created");
			return array("heads"=>$heads,"names"=>$names,"result"=>$arr);
		}
		 
		static function userTaskList($post,$page_size)
		{ 
			$rights_result = User::checkUserRights("user_area_task_list");

		 	if($rights_result == false)
		 	{
		 		 
		 		return "你没有该项操作权限，如果需要请申请";
		 	}
		 	$regions = multiple_array_to_string($rights_result['region_result'],"rights_id");
		 	$sources = multiple_array_to_string($rights_result['source_result'],"rights_id");
		  
		 	$user_id = $_SESSION['user_id'];
		 	
		 	$data = dataTrim($post);
		 	$status = isset($data['status']) ? $data['status'] :"0";
		 	$task_name = isset($data['task_name']) ? $data['task_name'] :"";
		 	$shop_name = isset($data['shop_name']) ? $data['shop_name'] :"";

		 	$sql="select tl.*,tl.task_id as rec_id,cu.user_name as creator_name,cil.company_name,cil.shop_name
		 		from task_list tl
		 		left join customer_info_list cil on cil.customer_id = tl.customer_id 
		 		left join cfg_user cu on cu.user_id = tl.creator 
		 		 ";
		 	$sql_count = "
		 		select count(*)
		 		from task_list tl
		 		left join customer_info_list cil on cil.customer_id = tl.customer_id
		 		  ";
		 	$data = array();
		 	$where = " where tl.status != -1 and (tl.creator=:user_id or find_in_set(:user_id,assignors)) ";
		 	$data['user_id'] = $user_id;
		 
		 	if($status !="0")
		 	{
		 		$where .=" And tl.status =:status ";
		 		$data['status'] = $status;
		 	}
		 	if($task_name !="")
		 	{
		 		$where .=" And tl.task_name like :task_name ";
		 		$data['task_name'] = "%".$task_name."%";
		 	}
		 	if($shop_name!=""){
		 		$where .= " And (cil.shop_name like :shop_name or cil.company_name like :shop_name) ";
		 		$data['shop_name'] = "%".$shop_name."%";
		 	}


		 	$sql_count .= $where;
		 	if(isset($_REQUEST['page']))
		 	{
		 		$cur_page = intval($_REQUEST['page']);
		 	}
		 	else
		 	{
		 		$cur_page = 1;
		 	}
		 	$db = db();
		 	$db->beginTransaction();

		 	$count_result = $db->prepare_execute_result_single($sql_count,$data);
		 	
		 	$total = $count_result['count(*)'];
		 	$total_page = ceil($total/$page_size);
		 	if($cur_page >=$total_page)
		 	{
		 		$cur_page = $total_page;
		 	}
		 	$cur_page = $cur_page >=1 ? $cur_page:1;
		 	$start_num = ($cur_page -1)*$page_size;
		 	$sql .= $where." order by task_id desc limit {$start_num},{$page_size}";

		 	$result = $db->prepare_execute($sql,$data);
		 	$arr = array();
		 	while($row = $db->fetch($result))
		 	{
		 		$row['status'] = get_dict_data('task_status',$row['status']);
		 		$arr[] = $row;
		 	}
		 	$sql = "select count(*) from task_list tl where ( find_in_set(:user_id,assignors)) and tl.status=1";
		 	$unaccept_task = $db->prepare_execute_result_single($sql,array('user_id'=>$user_id));

		 	$page = array("cur_page"=>$cur_page,"total_page"=>$total_page,"total"=>$total);
			return array("result"=>$arr,"page"=>$page,"unaccept_task"=>$unaccept_task['count(*)']);

		}
		static function getUserTaskListByID($rec_id)
		{
			$db = db();
			$sql ="select cil.remark,cu.user_name,cil.modified,cil.created from task_log cil left join cfg_user cu on cu.user_id = cil.operator_id
				where task_id =:task_id order by rec_id desc  ";
			$sql_data = array("task_id"=>$rec_id);
			$result = $db->prepare_execute_result($sql,$sql_data);
			$heads = array("操作人","操作","修改时间","创建时间");
			$names = array("user_name","remark","modified","created");
			return array("heads"=>$heads,"names"=>$names,"result"=>$result);
		}
		 
		
		
	}
?>