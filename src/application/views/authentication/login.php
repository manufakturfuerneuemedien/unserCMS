<link rel="stylesheet" type="text/css" href="<?=site_url("items/authentication/css/authentication.css"); ?>">
        
<div id="content">
	<form id="authentication_form"
		action="<?= site_url('authentication/' . ($type == 'user' ? 'loginUser' : 'loginAdmin'))?>" method="post">
		<table>
			<tbody>
				<tr>
					<td class="labelwidth"><label for="username">Username</label></td>
					<td class="inputwidth"><input type="text" name="username" id="username" value="" /></td>
				</tr>
				<tr>
					<td class="labelwidth"><label for="pword">Password</label></td>
					<td class="inputwidth"><input type="password" name="pword" id="pword" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" id="submitbutton" value="Login" /></td>
				</tr>
			</tbody>
		</table>
	</form>
	<div id="errormessage"><?php if($errormessage != '') echo $errormessage; ?></div>
</div>
