<section id="contenu">
    <h2>Answers</h2>
    <p>Welcome to the answers.</p>

    <p>Question :</p>
    <p><?php echo $question->title();?>
        <?php echo $question->subject(); ?></p>

    <table id="tableBalises">
        <thead>
        <tr>
            <th>subject</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tabanswers as $i => $answer) { ?>
            <tr>
                <td><?= $answer->subject(); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>
