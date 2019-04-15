<div id="content">
	<form action="?action=member" method="post">
		<table id="tableBalises">
			<thead>
				<tr>
					<th>Title</th>
					<th>Subject</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="text" name="title" value="<?php echo $question->html_title(); ?>" size="50"></td>
				<td><input type="text" name="subject" value="<?php echo $question->html_subject(); ?>"></td>
                <td><input type="submit" name="form_save" value="Save">
                    <input type="hidden" name="idquestion" value="<?php echo $question->html_id_question(); ?>"></td>
			</tr>
			</tbody>
		</table>
	</form>			
</div>