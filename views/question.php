<h2>Questions</h2>
<p>Welcome to the questions page.</p>
<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=question" method="post">
            <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/><input type="submit" name="form_research" value="Research"></p>
        </form>
    </div>
        <table id="tableBalises">
            <thead>
            <tr>
                <th>Title</th>
                <th>subject</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tabquestions as $i => $question) { ?>
                <tr>
                    <td><span class="html"><?= $question->html_title(); ?></span></td>
                    <td><?php echo $question->html_subject(); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
</section>
