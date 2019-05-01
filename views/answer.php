<section id="contenu">
    <h2>Answers</h2>
    <p>Welcome to the answers page.</p>

    <p>Question :</p>
    <p><?php echo $selected_question->title() . ' : ' . $selected_question->subject(); ?></p>

    <table id="tableBalises">
        <thead>
        <tr>
            <th>subject</th>
            <th>Owner</th>
            <th>Creation Date</th>
            <th>Number of votes</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($tabanswers as $i => $answer) { ?>
                <tr>
                    <td><?php echo  $answer->subject(); ?></td>
                    <td><?php echo $answer->id_member()->full_name();?></td>
                    <td><?php echo $answer->creation_date(); ?></td>
                    <td>
                        <form action="index.php?action=member" method="post">
                            <input type="hidden" value="<?php echo $selected_question->id_question(); ?>" name="idquestion">
                            <input type="hidden" value="<?php echo $answer->nb_votes(); ?>" name="nb_votes">
                            <input type="hidden" value="<?php echo $answer->id_answer(); ?>" name="idanswer">
                            <input type="submit" value="+1" name="up_down" id="up"/>
                            <input type="submit" value="-1" name="up_down" id="down"/>
                            <span><?php echo $answer->nb_votes(); ?></span>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="form">
        <form action="index.php?action=member" method="post">
            <p> Subject : </p>
            <textarea rows="25"  cols="80" name="subject" placeholder="Enter your answer here"></textarea>
            <input type="hidden" value="<?php echo $selected_question->html_id_question(); ?>" name="idquestion">
            <p><input type="submit" name="form_add_answer" value="Post Your Answer"></p>
        </form>
    </div>
</section>
