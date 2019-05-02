<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=categories" method="post">
            <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/><input type="submit" name="form_research" value="Research"></p>
        </form>
    </div>
    <div id="notification"><?php echo $notification; ?></div>
    <table id="tableBalises">
        <thead>
        <tr>
            <th>Category</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabcategories); $i++) { ?>
            <tr>
                <td><span class="html"><?php echo $tabcategories[$i]->html_name() ?></span></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>


