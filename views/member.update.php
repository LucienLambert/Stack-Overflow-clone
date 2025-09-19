<div id="content">
    <h1 id="invitation">Update your Question here</h1>
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
                <td><textarea rows="3" cols="60" name="title" ><?php echo $selected_question->html_title(); ?></textarea></td>
                <td><textarea  rows="25" cols="60"  name="subject" ><?php echo $selected_question->html_subject(); ?></textarea></td>
                <input type="hidden" name="idquestion" value="<?php echo $selected_question->html_id_question(); ?>">
                <td><input type="submit" name="form_save" value="Save"></td>
            </tr>
            </tbody>
        </table>
    </form>
</div>