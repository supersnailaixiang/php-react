<?php

	/**
	 * ע�����ʼ��඼�Ǿ����Ҳ��Գɹ��˵ģ������ҷ����ʼ���ʱ��������ʧ�ܵ����⣬������¼����Ų飺
	 * 1. �û����������Ƿ���ȷ��
	 * 2. ������������Ƿ�������smtp����
	 * 3. �Ƿ���php���������⵼�£�
	 * 4. ��26�е�$smtp->debug = false��Ϊtrue��������ʾ������Ϣ��Ȼ����Ը��Ʊ�����Ϣ��������һ�´����ԭ��
	 * 5. ������ǲ��ܽ�������Է��ʣ�http://www.daixiaorui.com/read/16.html#viewpl 
	 *    ����������У���������Ҫ�ҵĴ𰸡�
	 */

	require_once "email.class.php";
	//******************** ������Ϣ ********************************
	$smtpserver = "smtp.exmail.qq.com";//SMTP������
	$smtpserverport =25;//SMTP�������˿�
	$smtpusermail = "chenaixiang@wangdian.cn";//SMTP���������û�����
	$smtpemailto = $_POST['toemail'];//���͸�˭
	$smtpuser = "chenaixiang";//SMTP���������û��ʺ�
	$smtppass = "ASZX03166072chen";//SMTP���������û�����
	$mailtitle = $_POST['title'];//�ʼ�����
	$mailcontent = "<h1>"."chen"."</h1>";//�ʼ�����
	$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
	//************************ ������Ϣ ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
	$smtp->debug = true;//�Ƿ���ʾ���͵ĵ�����Ϣ
	echo  "a";
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	echo $state;
	echo "a";
	echo "<div style='width:300px; margin:36px auto;'>";
	if($state==""){
		echo "�Բ����ʼ�����ʧ�ܣ�����������д�Ƿ�����";
		echo "<a href='index.html'>��˷���</a>";
		exit();
	}
	echo "��ϲ���ʼ����ͳɹ�����";
	echo "<a href='index.html'>��˷���</a>";
	echo "</div>";

?>