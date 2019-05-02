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
            <th>Last name</th>
            <th>Name</th>
            <th>Email</th>
            <th>state</th>
            <th>role</th>
            <th><input type="submit" name="form_update" value="Update member"></th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabmember); $i++) { ?>
            <tr>
                <td><?php echo $tabmember[$i]->html_last_name() ?></td>
                <td><?php echo $tabmember[$i]->html_name() ?></td>
                <td><?php echo $tabmember[$i]->html_email() ?></td>
                <td><?php if($tabmember[$i]->html_state() == 's'){
                    echo $suspended;
                    } else {
                    echo $active;
                    }?></td>
                <td><?php if($tabmember[$i]->html_is_admin() == 1){
                    echo $admin;
                    } else {
                        echo $user;
                    }?></td>
                <td><input type="radio" name="membre" value="<?php echo $tabmember[$i]->html_id_member(); ?>"
                        <?php echo (isset($member) && $tabmember[$i]->html_id_member() == $member->html_id_member()) ? 'checked' : ''; ?> /></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</form>
</section>