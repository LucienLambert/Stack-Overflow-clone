<section id="content">
    <h2>Member Zone</h2>
    <p>Welcome <?php echo $html_pseudo; ?></p>
    <p><a href="index.php?action=logout">Log out</a></p>
    <div id="notification"><?php echo $notification; ?></div>
    <form action="?action=member" method="post">
        <table id="tableBalises">
            <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th><input type="submit" name="form_update" value="Update Question"></th>
                <th><input type="submit" name="form_see_answers" value="See Anwsers"></th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($tabquestions); $i++) { ?>
                <tr>
                    <td><span class="html"><?php echo $tabquestions[$i]->html_title(); ?></span></td>
                    <td><?php echo  $tabquestions[$i]->html_subject(); ?></td>
                    <td><input type="radio" name="question" value="<?php echo $tabquestions[$i]->html_id_question(); ?>" <?php echo (isset($question) && $tabquestions[$i]->html_id_question() == $question->html_id_question()) ? 'checked' : ''; ?> /></td>
                    <td><input type="radio" name="idquestion" value="<?php echo $tabquestions[$i]->html_id_question(); ?>" <?php echo (isset($question) && $tabquestions[$i]->html_id_question() == $question->html_id_question()) ? 'checked' : ''; ?> /></td>
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
            <p>Subject : </br><textarea   rows="25" cols="80"   name="subject"> Develop your question here</textarea></p>
            <p><input type="submit" name="form_add" value="Ask Your Question"></p>
        </form>
    </div>
</section>
