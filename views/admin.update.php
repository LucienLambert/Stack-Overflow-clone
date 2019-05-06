<div id="content">
    <h2>Now you can update "<?php echo $member->html_last_name(); ?>"</h2>
    <p>Update  1 = admin, 0 = member)</p>
    <p>state (a = 'actif', s = 'suppended')</p>
    <form action="?action=adminZone" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>State</th>
                <th>Role</th>
                <th>Save</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><textarea  rows="3" cols="3"  name="state" ><?php echo $member->state(); ?></textarea></td>
                <td><textarea  rows="3" cols="3"  name="is_admin" ><?php echo $member->is_admin(); ?></textarea></td>
                <input type="hidden" name="member" value="<?php echo $member->html_id_member(); ?>">
                <td><input type="submit" name="form_save" value="Save"></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
