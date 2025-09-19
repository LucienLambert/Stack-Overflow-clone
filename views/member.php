<section id="content">
    <h2>Member Zone</h2>
    <p>Welcome <?php echo $html_pseudo; ?></p>
    <p><a href="index.php?action=logout">Log out</a></p>
    <span style="color:red;"><?php echo  $bad_notif ; ?></span>
    <span style="color:green;"><?php echo  $good_notif ; ?></span>
    <?php if (!$viewupdate && !$viewanswers) { ?>
        <form action="?action=member" method="post">
            <table id="tableBalises">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Owner</th>
                    <th>Creation Date</th>
                    <th>Update</th>
                    <th>See answers</th>
                    <th>Question state</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tabquestions as $i => $question) {?>
                    <tr>
                        <td><?php echo $question->html_title(); ?></td>
                        <td><?php echo  $question->html_subject(); ?></td>
                        <td><?php echo $question->owner()->full_name(); ?></td>
                        <td><?php echo $question->creation_date(); ?></td>
                        <td><input type="submit" name="form_update[<?php echo $question->html_id_question(); ?>]" value="update"></td>
                        <td><input type="submit" name="form_see_answers[<?php echo $question->html_id_question(); ?>]" value="see answers"></td>
                        <td>
						<?php
							if($question->state() == 'O') {
								echo 'Open';
							} elseif($question->state() == 'S'){
								echo 'Solved';
							} elseif ($question->state() == 'D') {
                                echo 'Duplicate';
                            }
                        ?>
						</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
        <div class="form">
            <h1  id="invitation"> Ask your question Here </h1>
            <form action="index.php?action=member" method="post">
                <label for="id_category">Choose a category :</label>
                <select id="id_category" name="id_category">
                    <?php foreach ($tabCategories as $i => $category) { ?>
                        <option value="<?php echo $category->id_category(); ?>"><?php echo $category->name(); ?></option>
                    <?php } ?>
                </select>
                <p>Title of question :</p>	<textarea   rows="3" cols="60"   name="title" ></textarea>
                <p>Subject :</p>
                <textarea   rows="25" cols="60"   name="subject" placeholder="Develop your question here"></textarea>
                <p><input type="submit" name="form_add_question" value="Ask Your Question"></p>
            </form>
        </div>
    <?php } ?>
</section>
