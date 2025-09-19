<section id="contenu">
    <h2>Answers</h2>
    <p>Question :</p>
    <p><?php echo $selected_question->title() . ' : ' . $selected_question->subject(); ?></p>
    <table id="tableBalises">
        <thead>
        <tr>
            <th>subject</th>
            <th>Owner</th>
            <th>Creation Date</th>
            <th>Votes</th>
            <th>Choose the good answer</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabanswers as $i => $answer) { ?>
            <tr>
                <form action="index.php?action=member" method="post">
                    <td><?php echo  $answer->subject(); ?></td>
                    <td><?php echo $answer->id_member()->full_name();?></td>
                    <td><?php echo $answer->creation_date(); ?></td>
                    <td>
                            <input type="hidden" value="<?php echo $selected_question->id_question(); ?>" name="idquestion">
                            <input type="hidden" value="<?php echo $answer->nb_positives_votes(); ?>" name="nb_positives_votes">
                            <input type="hidden" value="<?php echo $answer->nb_negatives_votes(); ?>" name="nb_negatives_votes">
                            <input type="hidden" value="<?php echo $answer->id_answer(); ?>" name="idanswer">
                            <input type="submit" value="+1" name="vote" id="up"/>
                            <span  id="nb_pos_votes"  ><?php echo $answer->nb_positives_votes(); ?></span>
                            <input type="submit" value="-1" name="vote" id="down"/>
                            <span id="nb_neg_votes"><?php echo $answer->nb_negatives_votes(); ?></span>
                    </td>
                    <td><input type="submit" name="form_update_good_answer" value="mark as the best answer"></td>
                </form>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="form">
        <h1 id="invitation">You can post your answer below</h1>
        <form action="index.php?action=member" method="post">
            <p> Subject : </p>
            <textarea rows="25"  cols="80" name="subject" placeholder="Enter your answer here"></textarea>
            <input type="hidden" value="<?php echo $selected_question->html_id_question(); ?>" name="idquestion">
            <p><input type="submit"  name="form_add_answer" value="Post Your Answer"></p>
        </form>
    </div>
</section>
