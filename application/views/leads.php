<html>
<head>
	<title>Leads</title>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> 
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.datepicker').datepicker({
				dateFormat: "yy-mm-dd",
				changeYear:true
			});
			$(document).on('submit', 'form', function(){
				$.post($(this).attr('action'), $(this).serialize(), function(res){
					$('.leads').html(res);
					var htmlStr = '';
					for(var i=1; i<=$('#hidden').attr('href'); i++)
						htmlStr += "<li><a href='/leads/update/" + i + "'>"+ i + "</a></li>";
					$('.pages').html(htmlStr);
				});
				return false;
			});
			$(document).on('click', 'a', function(){
				$('form').attr('action', $(this).attr('href'));
				$(this).submit();
				return false;
			});
			$(document).on('keyup', 'form', function(){
				$(this).submit();
			});
			$(document).on('change', 'form', function(){
				$(this).submit();
			});
			$('form').submit();
		});
	</script>
	<style>
	li{
		display:inline;
		list-style:none;
		padding-right:4px;
	}
	</style>
</head>
<body>
	<div class='input'>
		<form action='/leads/update/1' method='post'>
			<label>Name:</label>
			<input type='text' name='name'>
			<label>From:</label>
			<input class='datepicker' name='from'>
			<label>To:</label>
			<input class='datepicker' name='to'>
			<div class='container'>
				<ul class='pages col-md-offset-2'>
				</ul>
			</div>
		</form>
	</div>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>leads_id</th>
					<th>first name</th>
					<th>last name</th>
					<th>registered datetime</th>
					<th>email</th>
				</tr>
			</thead>
			<tbody class='leads'>
			</tbody>
		</table>
</body>
</html>