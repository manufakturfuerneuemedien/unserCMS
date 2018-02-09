<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?=site_url("items/general/css/fonts.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?=site_url("items/authentication/css/authentication.css"); ?>">
    </head>

    <body>
    	<div id="settings_container">
    		<h1>User settings</h1>
    		<form id="settings_form" action="<?= site_url('authentication/updateAdmin')?>" method="post">
                <input type="hidden" name="userid" id="userid" value="<?= isset($user) ? $user->id : set_value('userid')?>" readonly/>    		  
    			<table>
    				<tbody>
    					<tr>
    						<td class="labelwidth"><label for="username">Username</label></td>
    						<td class="inputwidth"><input type="text" name="username" id="username" value="<?= isset($user) ? $user->username : set_value('username')?>" readonly/></td>
    					</tr>
    					<tr>
    						<td class="labelwidth"><label for="firstname">Firstname</label></td>
    						<td class="inputwidth"><input type="text" name="firstname" id="firstname" value="<?= isset($user) ? $user->firstname : set_value('firstname')?>" /></td>
    					</tr>
    					<tr>
    						<td class="labelwidth"><label for="lastname">Lastname</label></td>
    						<td class="inputwidth"><input type="text" name="lastname" id="lastname" value="<?= isset($user) ? $user->lastname : set_value('lastname')?>" /></td>
    					</tr>
    					<tr>
    						<td class="labelwidth"><label for="email">E-Mail</label></td>
    						<td class="inputwidth"><input type="text" name="email" id="email" value="<?= isset($user) ? $user->email : set_value('email')?>" /></td>
    					</tr>
    					<tr>
    						<td class="labelwidth"><label for="pword">New password</label></td>
    						<td class="inputwidth"><input type="password" name="pword" id="pword" value="" /></td>
    					</tr>
    					<tr>
    						<td class="labelwidth"><label for="pword2">Confirm password</label></td>
    						<td class="inputwidth"><input type="password" name="pword2" id="pword2" value="" /></td>
    					</tr>
    					<tr>
    						<td colspan="2"><input type="submit" id="submitbutton" value="Update" /></td>
    					</tr>
    					<tr>
    						<td colspan="2"><a href="<?= site_url('backend')?>"><div id="backbutton"/>Return to backend</a></td>
    					</tr>
    				</tbody>
    			</table>
    		</form>
    		<h2 id="errormessage"><?= isset($success) && $success ? 'Settings updated' : validation_errors(); ?></h2>
    	</div>
    </body>
</html>



