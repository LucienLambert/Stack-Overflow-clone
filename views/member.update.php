<div id="content">
    <h2>Update your Question here</h2>
    <form action="?action=member" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="title" value="<?php echo $selected_question->html_title(); ?>" size="50"></td>
                <td><input type="text" name="subject" value="<?php echo $selected_question->html_subject(); ?>"></td>
                <input type="hidden" name="idquestion" value="<?php echo $selected_question->html_id_question(); ?>">
                <td><input type="submit" name="form_save" value="Save"></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>