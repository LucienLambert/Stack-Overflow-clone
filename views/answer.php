<section id="contenu">
    <h2>Answers</h2>
    <p>Welcome to the answers.</p>

    <p>Question :</p>
    <p><?= $question->title() . ' : ' . $question->subject(); ?></p>

    <table id="tableBalises">
        <thead>
        <tr>
            <th>subject</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabanswers as $i => $answer) { ?>
            <tr>
                <td><?php echo  $answer->subject(); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="form">
        <form action="index.php?action=member" method="post">
            <p>Subject : <input type="text" name="subject" /></p>
            <input type="hidden" value="<?php echo $question->html_id_question(); ?>" name="idquestion">
            <p><input type="submit" name="form_add_answer" value="Post Your Answer"></p>
        </form>
    </div>
</section>
