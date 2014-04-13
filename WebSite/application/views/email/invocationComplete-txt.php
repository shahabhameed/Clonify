<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>
        <?php if (strlen($username)>0) { 
			echo 'Dear'. $username . '!';
        }
		?>
	</title>
</head>

<body>
    <div style="max-width: 800px; margin: 0; padding: 30px 0;">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="5%"></td>
                <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                    <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your invocation has finished!</h2>
                    Following are some details of the invocation.
                    <br />
					Invocation status : 
					<?php 
					if($status==2){
						echo 'Successfully Completed';
					}
					else if($status==3){
						echo 'Finished with error(s)';
					}
					else if($status==4){
						echo 'Invalidated due to some change in repository. <br /> Note: Usually any changes done to repository after invocation invalidates the results fro that invocation.';
					}
					?>
					<br />
					
					Clone Miner invocation Time : <?php echo $invoked_time ?> 
					<br />
					
					Invocation Name : <?php echo $invocation_name; ?>
					<br />
					<br />
					<br />
					
					Please login to your account and see the results. Thanks for using our application.
					<br />
					
                </td>
            </tr>
        </table>
    </div>
</body>

</html>