<section id="content">
    <h2>Member Zone</h2>
    <p>Welcome <?php echo $html_pseudo; ?></p>
    <p><a href="index.php?action=logout">Log out</a></p>
    <div id="notification"><?php echo $notification; ?></div>
    <?php if (!$vueupdate && !$vueanswers) { ?>
    <form action="?action=member" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th>Owner</th>
                <th>Creation Date</th>
                <th><input type="submit" name="form_update" value="Update Question"></th>
                <th><input type="submit" name="form_see_answers" value="See Anwsers"></th>
                <th>State</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tabquestions as $i => $question) {
                $checked = (isset($selected_question) && $question->html_id_question() == $selected_question->html_id_question()) ? 'checked' : '';
                $disabled = ($question->state() == 'D') ? 'disabled' : ''; ?>
                <tr>
                    <td><span class="html"><?php echo $question->html_title(); ?></span></td>
                    <td><?php echo  $question->html_subject(); ?></td>
                    <td><?php echo $question->owner()->full_name(); ?></td>
                    <td><?php echo $question->creation_date(); ?></td>
                    <td><input type="radio" name="question" value="<?php echo $question->html_id_question(); ?>" <?php echo $checked; $disabled; ?> /></td>
                    <td><input type="radio" name="idquestion" value="<?php echo $question->html_id_question(); ?>" <?php echo $checked; $disabled; ?> /></td>
                    <td>
                        <p><?php echo $question->state(); ?></p>
                        <?php if ($question->owner()->id_member() == $member->id_member()) { // si je suis le prop de la quest je peux modif l'etat
                            $checked = ($question->state() == 'S') ? 'checked' : ''; ?>
                            <form action="?action=member" method="post">
                                <p><input type="checkbox" value="S" name="state" <?php echo $checked; ?>></p>
                                <input type="hidden" name="idquestion" value="<?php echo $question->html_id_question(); ?>">
                                <input type="submit" name="form_change_state" value="Change state">
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
    <div class="form">
        <h3> Ask your question Here </h3>
        <form action="index.php?action=question" method="post">
            <label for="id_category">Choose a category :</label>
            <select id="id_category" name="id_category">
                <?php foreach ($tabCategories as $i => $category) { ?>
                    <option value="<?php echo $category->id_category(); ?>"><?php echo $category->name(); ?></option>
                <?php } ?>
            </select>
            <p>Title of question :	<input type="text" name="title" /></p>
            <p>Subject :</p>
            <textarea   rows="25" cols="80"   name="subject" placeholder="Develop your question here"></textarea>
            <p><input type="submit" name="form_add" value="Ask Your Question"></p>
        </form>
    </div>
    <?php } ?>
</section>
