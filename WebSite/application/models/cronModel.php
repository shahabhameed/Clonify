<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Cronmodel extends CI_Model {
 
	function __construct() {
        parent::__construct();
	}
	
    function create_cron_job($args)
    {
        //Do database operation if you need to do //
        //Else write following code directly in controller
       /* $min            =$args["min"];
        $hour           =$args["hour"];
        $day_of_month   =$args["day_of_month"];
        $month          =$args["month"];
        $day_of_week    =$args["day_of_week"];
 
		$filePath = '/usr/bin/php /var/www/vhosts/mydomain.com/httpdocs/filename.php';
        shell_exec((crontab -l ; echo " ".$min." ".$hour." ".$day_of_month." ".$month." ".$day_of_week." ".$filePath." ") | crontab -1);
		*/
	}
	
	function getUserInvocationsToBeEmailed(){
		$query = "SELECT i.id, user_id, status, invoked_time, comments, invocation_name, repository_version, language_id, is_email_sent_on_completion, username, password, email, first_name, last_name, activated, banned, ban_reason, new_password_key, new_password_requested, new_email, new_email_key, last_ip, last_login, created, modified, role_id FROM user_invocations i JOIN users u ON i.user_id=u.id WHERE is_email_sent_on_completion <> 1 AND status IN (2,3,4);";
		$results = $this->db->query($query);
		return $results->result();
	}

	function setUserInvocationsEmailSentFlag($invcationId){
		$query = "UPDATE user_invocations Set is_email_sent_on_completion=1 WHERE id='".$invcationId."'";
		$this->db->query($query);
	}
}