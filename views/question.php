<h2>Questions</h2>
<p>Welcome to the questions page.</p>
<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=question" method="post">
            <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/><input type="submit" name="form_research" value="Research"></p>
        </form>
    </div>
    <p><?php echo $notification; ?></p>
    <form action="?action=question" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>Category</th>
                <th>Title</th>
                <th>Subject</th>
                <th>Owner</th>
                <th>Creation Date</th>
                <th>See Answers</th>
                <th>State Question</th>
                <?php if($viewDuplicated && $viewDeleted) { ?>
                    <th>Change state</th>
                    <th>Delete question</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tabquestions as $i => $question) { ?>
                <tr>
                    <td><?php echo $question->category()->name(); ?></td>
                    <td><?php echo  $question->html_title(); ?></td>
                    <td><?php echo $question->html_subject(); ?></td>
                    <td><?php echo $question->owner()->full_name(); ?></td>
                    <td><?php echo $question->creation_date(); ?></td>
                    <td><input type="submit" name="form_see_answers[<?php echo $question->html_id_question(); ?>]" value="see answers"</td>
                    <td>
                        <?php if ($question->state() == 'O') {
                            echo 'Open';
                        } elseif ($question->state() == 'S'){
                            echo 'Solved';
                        } elseif ($question->state() == 'D') {
                            echo 'Duplicate';
                        } ?>
                    </td>
                    <?php if ($viewDuplicated) {?>
                        <td>
                            <p>Duplicate</p>
                            <?php $checked_duplicate = ($question->state() == 'D') ? 'checked': ''; ?>
                            <form action="?action=question" method="post">
                                <input type="hidden" name="idquestion" value="<?php echo $question->html_id_question(); ?>">
                                <p><input type="radio" value="D" name="state" <?php echo $checked_duplicate; ?>></p>
                                <p>Open</p>
                                <?php $checked = ($question->state() == 'O') ? 'checked': ''; ?>
                                <p><input type="radio" value="O" name="state" <?php echo $checked; ?>></p>
                                <input type="submit" name="form_change_state" value="Change state">
                            </form>
                        </td>
                    <?php } if ($viewDeleted) { ?>
                        <td>
                            <form action="?action=question" method="post">
                                <input type="hidden" name="idquestion" value="<?php echo $question->html_id_question(); ?>">
                                <input type="submit" name="delete_question" value="Delete question">
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
</section>
