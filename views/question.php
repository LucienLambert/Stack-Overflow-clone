<h2>Questions</h2>
<p>Welcome to the questions page.</p>
<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=question" method="post">
            <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/><input type="submit" name="form_research" value="Research"></p>
        </form>
    </div>
        <form action="?action=question" method="post">
            <table id="tableBalises">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Owner</th>
                    <th>Creation Date</th>
                    <th><input type="submit" name="form_see_answers" value="See Anwsers"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tabquestions as $i => $question) { ?>
                    <tr>
                        <td><span class="title"><?php echo $question->html_title(); ?></span></td>
                        <td><?php echo $question->html_subject(); ?></td>
                        <td><?php echo $question->owner()->full_name(); ?></td>
                        <td><?php echo $question->creation_date(); ?></td>
                        <td><input type="radio" name="idquestion" value="<?php echo $question->html_id_question(); ?>" <?php echo (isset($selected_question) && $question->html_id_question() == $selected_question->html_id_question()) ? 'checked' : ''; ?> /></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
</section>
