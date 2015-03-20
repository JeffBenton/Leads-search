<html>
<head>
</head>
<body>
<?php
	date_default_timezone_set('America/Los_Angeles');
	?><a id='hidden' href='<?= $this->session->userdata('pages') ?>'></a>
<?php
	foreach($leads as $lead){	?>
		<tr>
			<td><?= $lead['leads_id'] ?></td>
			<td><?= $lead['first_name'] ?></td>
			<td><?= $lead['last_name'] ?></td>
			<td><?= date_format(new datetime($lead['registered_datetime']), 'Y/m/d') ?></td>
			<td><?= $lead['email'] ?></td>
		</tr>
<?php	
	}	?>
</body>
</html>