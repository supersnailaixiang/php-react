<?php
	class User
	{
		static function login($data)
		{
			$db =db();
			$data = dataTrim($data);
	 	  	$db->beginTransaction();
			$sql = "select cu.user_name,cu.user_id,cu.dept_id,cu.position_id from   cfg_user cu  where cu.is_delete = 0 and user_name=:login_no and cal.pwd =md5(:pwd)";
 			
 	 
 		 
			$result = $db->prepare_execute_result_single($sql,$data);
		 
	 	 
		 
			if(!empty($result))
			{
				$_SESSION['user_id']=$result['user_id'];
			 
				$user_id = $result['user_id'];

		 		 
		 		$db->commit();
				return true;;
			}

			return false;
		}
		static function isLogined()
		{
			
			return isset($_SESSION['user_id']) and $_SESSION['user_id'] !="";
			//return 1;

		}
		 
	}
?>
