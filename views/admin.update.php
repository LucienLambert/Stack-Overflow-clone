<div id="content">
    <form action="?action=adminZone" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>State</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="state" value="<?php echo $member->html_state(); ?>" size="50"></td>
                <td><input type="text" name="role" value="<?php echo $member->html_is_admin(); ?>" size="50"></td>
                <td><input type="submit" name="form_save" value="Save">
                    <input type="hidden" name="idmember" value="<?php echo $selected_question->html_id_member(); ?>"></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
