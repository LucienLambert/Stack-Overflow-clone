<section id="contenu">
    <h2>Admin Zone</h2>
    <h2>Welcome <?php echo $html_pseudo ?></h2>
    <p><a href="index.php?action=logout">Log out</a></p>
    <p>Here you can to change the authorization and right of members</p>
    <div id="notification"><?php echo $notification ?></div>
    <form action="?action=adminZone" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>name, last-name</th>
                <th>Email</th>
                <th>state</th>
                <th>role</th>
                <th><input type="submit" name="form_update" value="Update member"></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($tabmember as $i => $member) {
                $checked = (isset($selected_member) && $member->html_id_member() == $selected_member->html_id_member()) ? 'checked': '';?>
                    <tr>
                        <td><?php echo $member->full_name() ?></td>
                        <td><?php echo $member->email() ?></td>
                        <td><?php if($member->state() == 's'){
                                echo $statesuspended;
                            } else {
                                echo $stateactive;
                            }?>
                        </td>
                        <td><?php if($member->is_admin() == 1){
                                echo $roleadmin;
                            } else {
                                echo $roleuser;
                            }?>
                        </td>
                        <td><input type="radio" name="member" value="<?php echo $member->html_id_member(); ?>" <?php echo $checked; ?> /></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
</section>