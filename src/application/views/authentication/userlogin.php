<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?=site_url("items/general/css/fonts.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?=site_url("items/authentication/css/authentication.css"); ?>">
    </head>

    <body>
    	<div id="login_container">
    		<h1>FRINK Academy</h1>
    		<form id="authentication_form"
    			action="<?= site_url('authentication/userLogin')?>" method="post">
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
    		<h2 id="errormessage"><? if(isset($errormessage)) echo $errormessage; ?></h2>
    	</div>
    </body>
</html>

