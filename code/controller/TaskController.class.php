<?php
	class TaskController extends CrmBaseController
	{
		public function addTask()
		{

			$post = $_REQUEST;
			$result = Task::addTask($post);
			echo $result;
		}
		public function addCustomerBackTask()
		{
			$post = $_REQUEST;
		 
			$result = Task::addCustomerBackTask($post);
			echo $result;
		}
		public function getTaskListByID()
		{
			$post = $_REQUEST;
			$customer_id = intval($post['rec_id']);
			$result = Task::getTaskListByID($customer_id);
			echo json_encode($result);
		}
		public function getTaskListBySellerID()
		{
			$post = $_REQUEST;
			$customer_id = intval($post['rec_id']);
			$result = Task::getTaskListBySellerID($customer_id);
			echo json_encode($result);
		}
		public function getTaskListByWorkID()
		{
			$post = $_REQUEST;
			$work_id = intval($post['rec_id']);
			$result = Task::getTaskListByWorkID($work_id);
			echo json_encode($result);
		}
		public function addWorkTask()
		{
			$post = $_REQUEST;
			$result = Task::addWorkTask($post);
			echo $result;
		}
		public function userTaskList()
		{
			$post = $_REQUEST;
			$page_size =20;
			$all_users = User::getUserAll();
			
			$result = Task::userTaskList($post,$page_size);
			view()->assign("all_users",$all_users);
			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("unaccept_task",$result['unaccept_task']);
			view("user_task_list.html");
		}
		public function getUserTaskList()
		{
			$post = $_REQUEST;
			$page_size =20;
			$result = Task::userTaskList($post,$page_size);
			 echo json_encode($result);
		}
		public function getUserTaskListByID()
		{
			$rec_id = $_REQUEST['rec_id'];
			$result = Task::getUserTaskListByID($rec_id);
			echo json_encode($result);
		}
		
		public function taskAccept()
		{
			$post = $_REQUEST;
			$result = Task::taskAccept($post);
			echo $result;
		}
		public function taskEnd()
		{
			$post = $_REQUEST;
			$result = Task::taskEnd($post);
			echo $result;
		}
		public function taskReject(){
			$post = $_POST;
			$result = Task::taskReject($post);
			echo $result;
		}
		public function taskCancel(){
			$post = $_POST;
			$result = Task::taskCancel($post);
			echo $result;
		}
		public function getTaskById(){
			$rec_id = intval($_REQUEST['rec_id']);
			$result = Task::getTaskById($rec_id);
			echo json_encode($result);
		}
		public function taskChang(){
			$post = dataTrim($_REQUEST);
			$result = Task::taskChang($post);
			echo $result;
		}
		public function taskResend(){
			$task_id = intval($_POST['task_id']);
			$result = Task::taskResend($task_id);
			echo $result;
		}
		public function getSuperTaskListBySellerID(){
			$post = $_REQUEST;
			$customer_id = intval($post['rec_id']);
			$result = Task::getSuperTaskListBySellerID($customer_id);
			echo json_encode($result);
		}
		public function addTaskRemark(){
			$result = Task::addTaskRemark();
			echo $result;
		}
		public function addVisitFile(){
			$result = Task::addVisitFile();
			if($result===true){
				header("Location:index.php?controller=TaskController&act=userTaskList");
			}else{
				view()->assign("result",$result);
				view("show_msg.html");
			}
		}
		public function showVisitFile(){
			$task_id = $_REQUEST['task_id'];
			$result = Task::showVisitFile($task_id);

			$filePath = $result['visit_file'];
			$fileName = explode('/', $result['visit_file']);
			$fileName = array_pop($fileName);
			$file = fopen($filePath, "r");  
			if ($file) {    
			    Header("Content-type:application/pdf");    
			    Header("Accept-Ranges: bytes");    
			    Header("Accept-Length: " . filesize($filePath));    
			    Header("Content-Disposition: attachment; filename=" . $fileName); // 输出文件内容     
			    echo fread($file, filesize($filePath));    
			    fclose($file);    
			}else{
				view()->assign("result",$result);
				view("show_msg.html");
			}
		}
		public function userDemissTask(){
			$post = $_REQUEST;
			$result = Task::userDemissTask($post);
			echo $result;
		}
	
	}
?>