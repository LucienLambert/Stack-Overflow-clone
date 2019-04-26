<h2>Categories</h2>
<p>Welcome to the categories page.</p>
<section id="contenu">
    <div class="formulaire">
        <form action="index.php?action=category" method="post">
            <label for="id_category">Choose a category :</label>
            <select id="id_category" name="id_category">
                <?php foreach ($tabCategories as $i => $category) { ?>
                    <option value="<?php echo $category->id_category(); ?>"><?php echo $category->name(); ?></option>
                <?php } ?>
                <p>Search Box : <input type="text" name="keyword" value="<?php echo $html_keyword ?>"/>
                <p><input type="submit" name="form_research" value="Research"></p>
            </select>
        </form>
    </div>

    <table id="tableBalises">
        <thead>
        <tr>
            <th>categories</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabcategories as $i => $category) { ?>
            <tr>
                <td><span class="html"><?= $category->html_name(); ?></span></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>


