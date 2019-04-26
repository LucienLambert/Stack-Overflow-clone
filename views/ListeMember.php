<h1 id="titlePage">Liste Member</h1>
<section class="desclogin">
    <h2>member</h2>
    <table class="tableBalises">
        <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($tabmembers); $i++) { ?>
            <tr>
                <td><span class="html"><?php echo $tabmembers[$i]->html_titre() ?></span></td>
                <td><?php echo $tabmembers[$i]->html_member() ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

