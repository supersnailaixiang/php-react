<?php
	class UserController extends CrmBaseController{

		public function login()
		{
			//$login_no = $_REQUEST['login_no'];
			//$pwd = $_REQUEST['pwd'];

			$login_no =isset($_REQUEST['login_no']) ? $_REQUEST['login_no'] : "";
			$pwd= isset($_REQUEST['pwd']) ?	$_REQUEST['pwd'] : "";
		  	$data['login_no']=$login_no;
		  	$data['pwd']=$pwd;
		   
			if(!isset($login_no) || empty($login_no) || $login_no=="")
			{
				view("login.html");
			}
			else
			{   
				$result = User::login($data);
				// $result = true;
				 
				if($result===true)
				{
					header("Location:index.php?controller=TaskController&act=userTaskList");
					//view("welcome.html");
				}
				else
				{
					view("login.html");
				}
			}
		}

		public function init()
		{
			$this->is_checked=false;
		}
		public function defaultAction()
		{
			 
			if(!User::isLogined())
			{
			 
				//header("Location:index.php?controller=UserController&act=login");
				view("login.html");
				 
			}
			else
			{
				header("Location:index.php?controller=TaskController&act=userTaskList");
				//view("welcome.html");
			}
		}
		public function getUserByDept()
		{
			$depts = $_REQUEST['depts'];
			$result = User::getUserByDept($depts);
			echo json_encode($result);
		}
		public function getUserAll()
		{

			$result = User::getUserAll();
			echo json_encode($result);
		}
		public function userList()
		{
			$post = $_REQUEST;
			$page_size =20;
			$result = User::userList($post,$page_size);
			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			
			if(isset($result['result'])){
				view("user_rights_list.html");
			}else{
			    return "你没有该项操作权限，如果需要请申请";
			}
		}
		public function getUserList()
		{
			$post = $_REQUEST;
			$page_size =20;
			 
			$result = User::userList($post,$page_size);
			echo json_encode($result);
		}
		public function getUserRights()
		{
			$post = $_REQUEST;
			$page_size =20;
			$result = User::getUserRights($post);
			echo json_encode($result);
		}
		public function setUserRights()
		{
			$post = $_POST;
			$request = $_REQUEST;
			$index = intval($request['index'])+1;
			$user_id = intval($request['rec_id']);
			$result = User::setUserRights($post,$index,$user_id);
			echo $result;
		}
		public function getUserMenuRights()
		{
			$result = User::getUserMenuRights();
			echo json_encode($result);
		}
		public function saleCustomerNumList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::saleCustomerNumList($post,$page_size);
			view() -> assign("result",json_encode($result['result']));
			view() -> assign("page",json_encode($result['page']));
			view('setting_area_sale_customer_num.html');
		}
		public function getSaleCustomerNumList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::saleCustomerNumList($post,$page_size);
			echo json_encode($result);
		}
		public function saleCustomerNumSet(){
			$post = $_REQUEST;
			$page_size =20;
			$result = User::saleCustomerNumSet($post,$page_size);
			echo $result;
		}
		public function saleGetByUserid(){
			$result = User::saleGetByUserid();
			echo json_encode($result);
		}
		public function userManageList()
		{
			$post = $_REQUEST;
			$page_size =20;
			$dept = User::getDepartment();
			$position = User::getPosition();
			$check_flag = ColorFlag::getUserFlag();
			$result = User::userManageList($post,$page_size);
			$users = User::getUserByDept(6);
			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("flags",json_encode($result['flags']));
			view()->assign("dept",$dept);
			view()->assign("position",$position);
			view() -> assign("check_flag",$check_flag);
			view() -> assign("users",$users);

			view("user_manage_list.html");
		}
		public function getUserManageList()
		{
			$post = $_REQUEST;
			$page_size =20;
			$result = User::userManageList($post,$page_size);
			echo json_encode($result);
		}
		public function getDepartment()
		{
			$result = User::getDepartment($post,$page_size);
			echo json_encode($result);
		}
		public function userAdd()
		{
			$post = $_REQUEST;
			$result = User::userAdd($post);
			echo $result;
		}
		public function getPosition(){
			$result = User::getPosition();
			echo json_encode($result);
		}
		public function getUserInfoById(){
			$result = User::getUserInfoById();
			echo json_encode($result);
		}
		public function userInfoChg(){
			$result = User::userInfoChg();
			echo $result;
		}
		public function getUserPwdById(){
			$result = User::getUserPwdById();
			echo json_encode($result);
		}
		public function setUserPassword(){
			$result = User::setUserPassword();
			echo $result;
		}
		public function userDemission(){
			$result = User::userDemission();
			echo $result;
			
		}
		public function userRegain(){
			$result = User::userRegain();
			echo $result;
		}
        public function uerMangeRights()
        {
			$user_id = $_SESSION['user_id'];
			$rights_result = User::checkUserRights("personal_area_user_manage");
		 	if($rights_result== false)
		 	{
		 		echo "对不起，你没有此操作权限.";
		 		return false;
			}
            $result = User::uerMangeRights($user_id);
            echo $result;
        }
		public function userContractAdd(){
			$result = User::userContractAdd();
			echo $result;
		}
		public function userImageNew()
		{
			if(isset($_FILES['user_image']))
			{
				$result = User::userImageNew($_REQUEST);

				if($result==1)
				{
					header("Location:index.php?controller=UserController&act=userManageList");
				}
				else
				{
					echo $result;
				}
			}
			else
			{
				 
				$contract_id= $_REQUEST['user_id'];
				view()->assign("user_id",$contract_id);
				view("user_image_new.html");
			}
		}
		public function userImageList()
		{
			$user_id = $_REQUEST['user_id'];
			$result = User::userImageList($user_id);
			view()->assign("result",$result);
			view("user_image_list.html");
		}
		public function userContractList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userContractList($post,$page_size);
			view() -> assign('result',json_encode($result['result']));
			view() -> assign('page',json_encode($result['page']));
			view('personal_area_contract_manage.html');
		}
		public function getUserContractList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userContractList($post,$page_size);
			echo json_encode($result);
		}
		public function getUserContractById(){
			$result = User::getUserContractById();
			echo json_encode($result);
		}
		public function userContractModify(){
			$result = User::userContractModify();
			echo $result;
		}
		public function deptManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::deptManageList($post,$page_size);
			view() -> assign('result',json_encode($result['result']));
			view() -> assign('page',json_encode($result['page']));
			view('personal_area_dept_manage.html');
		}
		public function getDeptManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::deptManageList($post,$page_size);
			echo json_encode($result);
		}
		public function getDeptById(){
			$result = User::getDeptById();
			echo json_encode($result);
		}
		public function userDeptModify(){
			$result = User::userDeptModify();
			echo $result;
		}
		public function userDeptAdd(){
			$result = User::userDeptAdd();
			echo $result;
			
		}
		public function positionManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::positionManageList($post,$page_size);
			view() -> assign('result',json_encode($result['result']));
			view() -> assign('page',json_encode($result['page']));
			view() -> assign('depts',$result['depts']);
			view('personal_area_position_manage.html');
		}
		public function getPositionManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::positionManageList($post,$page_size);
			echo json_encode($result);
		}
		public function getPositionById(){
			$result = User::getPositionById();
			echo json_encode($result);
		}
		public function userPositionAdd(){
			$result = User::userPositionAdd();
			echo $result;
		}
		public function userPositionModify(){
			$result = User::userPositionModify();
			echo $result;
		}
		public function userLoginOut(){
			User::userLoginOut();
			if(!User::isLogined()){
			 
				view("login.html");
				 
			}
		}
		public function userPersonalList()
		{
			$result = User::userPersonalList();
			view()->assign("result",$result);
			view("user_personal_list.html");
		}
		public function userLoginInfoChg()
		{
			$post = $_REQUEST;
			$result = User::userLoginInfoChg($post);
			echo $result;
		}
		public function userDailyList()
		{
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userDailyList($post,$page_size);

			if(isMobile()){
				$result = Mobile::MobileUserDailyList($post);
				view()->assign("result",$result);
		 		view("mobile_user_daily_list.html");
			}else{
				view() -> assign('result',json_encode($result['result']));
				view() -> assign('page',json_encode($result['page']));
				view() -> assign('depts',$result['depts']);
				view('user_daily_list.html');
			}
		}
		public function getUserDailyList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userDailyList($post,$page_size);
			echo json_encode($result);
		}
		public function userDailyNew()
		{
			$post = $_REQUEST;
			$title = isset($post['title'])? $post['title'] :"";
		 
			if($title =="")
			{
				view("user_daily_new.html");
			}
			else
			{
				$result = User::userDailyNew($post);
				//var_dump($result);die();
				if(isMobile()){
					echo $result;
					return ;
				}
				if($result === true)
				{
					header("Location:index.php?controller=UserController&act=userDailyList");
					//view()->assign("result",$result);
					//view("show_msg.html");
				}
				else
				{
					view()->assign("result",$result);
					view("show_msg.html");
				}
			}
		}
		public function userDailyGet()
		{
			$rec_id = $_REQUEST['daily_id'];
			$result = User::userDailyGet($rec_id);
			echo json_encode($result);
		}
		public function userDailyCheck()
		{
			$post = $_REQUEST;
			$result = User::userDailyCheck($post);
			echo $result;
		}
		public function userDailyCheckList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userDailyCheckList($post,$page_size);

			view() -> assign('result',json_encode($result['result']));
			view() -> assign('page',json_encode($result['page']));
			view() -> assign('depts',$result['depts']);
			view('user_daily_check_list.html');
		}
		public function userDailyReject()
		{
			$post = $_REQUEST;
			$result = User::userDailyReject($post);
			echo $result;
		}
		public function userDailySubmit()
		{
			$rec_id = $_REQUEST['rec_id'];
			$result = User::userDailySubmit($rec_id);
			echo $result;
		}
		public function getuserDailyLogList()
		{
			$rec_id = $_REQUEST['rec_id'];
			$result = User::getuserDailyLogList($rec_id);
			echo json_encode($result);
		}
		public function userDailyUpdate()
		{
			$data = $_REQUEST;
			$result = User::userDailyUpdate($data);
			echo $result;
		}
		public function userImageDel(){
			$rec_id = $_REQUEST['user_id'];
			$result = User::userImageDel($rec_id);
			echo $result;
		}
		public function userSalarySend()
		{
			
			if(empty($_FILES))
			{
				view("user_salary_send_list.html");
			}
			else
			{
				$result = User::userSalarySend();
				view()->assign("result",$result);
				view("show_msg.html");
			}
		}
		/*public function userWorkReceiverSet()
		{
			$result = User::userWorkReceiverSet();
			$user_region_41 = User::getUserByRegionId(41);
			$user_region_42 = User::getUserByRegionId(42);
			$user_region_43 = User::getUserByRegionId(43);
			$user_region_44 = User::getUserByRegionId(44);
			view()->assign('user_region_41',$user_region_41);
			view()->assign('user_region_42',$user_region_42);
			view()->assign('user_region_43',$user_region_43);
			view()->assign('user_region_44',$user_region_44);
			if($result == false){
				echo "对不起，你没有此操作权限,如有需求请申请";
			}else{
				view("user_work_receiver_set.html");
			}
		}*/
		public function getUserWorkReceiver()
		{
			$result = User::getUserWorkReceiver();
			echo json_encode($result);	
		}
		public function setWorkReceiver(){
			$post = $_REQUEST;
			$result = User::setWorkReceiver($post);
			echo $result;
		}
		public function userLogs()
		{
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userLogs($post,$page_size);

			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("flags",json_encode(array()));
			view('user_logs.html');
		}
		public function getUserLogs()
		{
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userLogs($post,$page_size);

			echo json_encode($result);
		}
		public function userCompeteManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userCompeteManageList($post,$page_size);

			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("flags",json_encode(array()));
			view('user_compete_manage_list.html');
		}
		public function getUserCompeteManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userCompeteManageList($post,$page_size);

			echo json_encode($result);
		}
		public function getUserCompeteManageListByID(){
			$result = User::getUserCompeteManageListByID();
			echo json_encode($result);
		}
		public function chgUserCompete(){
			$result = User::chgUserCompete();
			echo $result;
		}
		public function AddUserCompete(){
			$result = User::AddUserCompete();
			echo $result;
		}
		public function delUserCompete(){
			$result = User::delUserCompete();
			echo $result;
		}
		public function userWeekWork(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userWeekWork($post,$page_size);
			$users = User::getUserByDept('7,9,12');

			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("flags",json_encode(array()));
			view()->assign("users",$users);
			view('user_week_work.html');
		}
		public function getUserWeekWork(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::userWeekWork($post,$page_size);
			echo json_encode($result);
		}
		public function userWeekWorkAdd(){
			$result = User::userWeekWorkAdd();
			echo $result;
		}
		public function userWeekWorkSet(){
			$result = User::userWeekWorkset();
			echo $result;
		}
		public function setUserReminder(){
			$result = User::setUserReminder();
			echo $result;
		}
		public function getUserReminder(){
			$result = User::getUserReminder();
			echo json_encode($result);
		}
		public function userWeekWorkUser(){
			$result = User::userWeekWorkUser();
			echo $result;
		}
		public function getWeekWorkUser(){
			$result = User::getWeekWorkUser();
			echo json_encode($result);
		}
		public function userDateChg(){
			$result = User::userDateChg();
			echo json_encode($result);
		}
		public function userWeekDel(){
			$result = User::userWeekDel();
			echo $result;
		}
		public function getWeekUserByID(){
			$result = User::getWeekUserByID();
			echo json_encode($result);
		}
		public function userWeekWorkChg(){
			$result = User::userWeekWorkChg();
			echo $result;
		}
		public function fixedAssetManageList(){
			$post = $_REQUEST;
			$page_size = 20;

			$users = User::getUserAll(1);
			$products = DictData::getDictData(19,"");
			$result = User::fixedAssetManageList($post,$page_size);
		 	

			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("is_company",json_encode($result['is_company']));
			view()->assign("users",$users);
			view()->assign("products",$products);
			view('fixed_asset_manage_list.html');
		}
		public function getFixedAssetManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::fixedAssetManageList($post,$page_size);
			echo json_encode($result);
		}
		public function fixedAssetPersonalManageList(){
			$post = $_REQUEST;
			$page_size = 20;

			$users = User::getUserAll(1);
			$products = DictData::getDictData(19,"");
			$result = User::fixedAssetPersonalManageList($post,$page_size);
		 	

			view()->assign("result",json_encode($result['result']));
			view()->assign("page",json_encode($result['page']));
			view()->assign("is_company",json_encode($result['is_company']));
			view()->assign("users",$users);
			view()->assign("products",$products);
			view('fixed_asset_personal_manage_list.html');
		}
		public function getFixedAssetPersonalManageList(){
			$post = $_REQUEST;
			$page_size = 20;
			$result = User::fixedAssetPersonalManageList($post,$page_size);
			echo json_encode($result);
		}
		public function addFixedAsset(){
			$data = $_REQUEST;
			$result = User::addFixedAsset($data);
			echo $result;
		}
		public function getFixedAsset(){
			$rec_id = intval($_REQUEST['rec_id']);
			$result = User::getFixedAsset($rec_id);
			echo json_encode($result);
		}
		public function getFixedAssetManageLog(){

			$rec_id = $_REQUEST['rec_id'];
			$result = User::getFixedAssetManageLog($rec_id);
			echo json_encode($result);
		}
		public function updateFixedAsset(){
			$data = $_REQUEST;
			$result = User::updateFixedAsset($data);
			echo ($result);
		}
		public function addProduct(){
			$data = $_REQUEST;
			$result = User::addProduct($data);
			echo ($result);
		}
		public function getUserManageLogs(){
			$data = $_REQUEST;
			$result = User::getUserManageLogs($data);
			echo json_encode($result);
		}
		public function downUserList(){
			User::downUserList();
		}
		public function fixedAssetDel(){
			$post = $_REQUEST;
			$result = User::fixedAssetDel($post);
			echo $result;
		}
}
?>
