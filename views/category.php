<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=categories" method="post">
            <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/><input type="submit" name="form_research" value="Research"></p>
        </form>
    </div>
    <div id="notification"></div>
    <table id="tableBalises">
        <thead>
        <tr>
            <th>Category</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabcategories as $i => $category) { ?>
            <tr>
                <td><span class="html"><?php echo $category->name() ?></span></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>


