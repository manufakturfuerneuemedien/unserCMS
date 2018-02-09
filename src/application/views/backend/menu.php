
<div id="messagecontainer"></div>

<div id="menu">
	<?php if($username != null):?>
	<ul>
		<li><a href="<?= site_url('authentication/logout')?>">Logout</a></li>
		<li><a href="<?= site_url('authentication/adminsettings')?>"><img src="<?= site_url('items/backend/img/settings_white.png')?>" /></a></li>
		<li>Logged in as <b><?= $username?></b></li>
	</ul>
	<?php endif;?>
</div>

<div id="sidebar">
    <div class="sidebar_logo">
        
        
    </div>
<?php if($username != null):?>
	<ul>
        <li class="sidebar_headline">Menu header</li>
        <li><div class="separator"></div></li>
		<li class="sidebar_menuitem">
            <a href="<?= site_url('entities/Content/items')?>">Menu item 1</a>
        </li>        
        <li class="sidebar_menuitem">
            <a href="<?= site_url('entities/Content/items')?>">Menu item 2</a>
        </li>
    </ul>
<?php endif;?>
</div>

