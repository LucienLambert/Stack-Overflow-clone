<div class="menu-navigation">
    <nav>
        <a id="button" href="index.php?action=<?= $actionloginmember; ?>"><?= $libelleloginmember; ?></a>
        <a id="button" href="index.php?action=adminZone">Admin Zone</a>
        <a id="button" href="index.php?action=question"> Questions </a>
        <a id="button" href="index.php?action=signup">Sign Up</a>
    </nav>
</div>

<section class="descAccueil">
    <h2>Welcome</h2>
    <p><?php $notification ?></p>
    <p> if you have questions about programming, you are in the right place. site is a community that helps one another. you have a problem posted your question and the community will help you if it can.
        you answer a question, answer it and help the community to your turn.</p>
    <p>ClassNotFound</p>
</section>



<section class="descAccueil">
    <table id="tableBalises">
        <strong id="titreTopQuestion">TOP Questions</strong> :<br/>
        <thead>
        <tr>
            <th>Title</th>
            <th>subject</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabquestions as $i => $question) { ?>
            <tr>
                <td><span class="html"><?php echo $question->html_title(); ?></span></td>
                <td><?php echo $question->html_subject(); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

