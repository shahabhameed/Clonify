<div id="wrapper">
    <?php include VIEW_PARTIAL_FOLDER_PATH . '/sidebar.php'; ?>
    <form action=" cronController/cron_job_save" method="post" name="adminForm" id="adminForm" onsubmit="return check(this)">
        <table border="0" class="tablehead" width="100%">
            <tr>
                <th width="25%" align="left">Set Timings</th>
                <th width="75%" align="left"></th>
            </tr>
            <tr>
                <td align="left">Min</td>
                <td align="left">
                    <input class="text_area" type="text" name="min" id="min" />
                </td>
            </tr>
            <tr>
                <td align="left">Hours</td>
                <td align="left">
                    <input class="text_area" type="text" name="hour" id="hour" />(0-23)
                </td>
            </tr>
            <tr>
                <td align="left">Day of Month</td>
                <td align="left">
                    <input type="text" name="day_of_month" id="day_of_month" />(1-31)
                </td>
            </tr>
            <tr>
                <td align="left">Month</td>
                <td align="left">
                    <input type="text" name="month" id="month" />(1-12)
                </td>
            </tr>
            <tr>
                <td align="left">Day of Week</td>
                <td align="left">
                    <input type="text" name="day_of_week" id="day_of_week" />(0-6)
                </td>
            </tr>
            <tr>
                <td align="left"></td>
                <td align="left">
                    <input name="Save" type="submit" class="button" id="Save" value="Create" />
                </td>
            </tr>
        </table>
    </form>
</div>