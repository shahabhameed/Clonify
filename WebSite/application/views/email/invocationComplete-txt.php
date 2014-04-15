<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>
        <?php if (strlen($username)>0) { echo 'Dear'. $username . '!'; } ?>
    </title>
</head>

<body>
    <div style="max-width: 800px; margin: 0; padding: 30px 0;">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="5%"></td>
                <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                    <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your invocation has finished!</h2>
                    Following are some details of the invocation:
                    <br />
                    <br />
                </td>
            </tr>
			<tr width="100%">
				<td width="5%"></td>

			<td width="95%" >
				<br />
				Invocation Name : <b><?php echo $invocation_name; ?></b>
				<br />
				<br />
				Status :<b>
				<?php
					if($status==2)
					{
						echo 'Successfully Completed';
					}
					else if($status==3)
					{
						echo 'Finished with error(s)'; 
					}
					else
					{
						echo 'Some status change occured'; 
					} 
				?>
				</b>
				<br />
				<br />
				Start Time :
				<?php echo $invoked_time ?>

				<br />
				<br />
				Please login to your account and see the results. Thanks for using our application.
				</td>
			</tr>
        </table>
		
    </div>
</body>

</html>