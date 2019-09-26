/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) 
{
	config.removePlugins = 'uploadimage';
	config.uploadUrl = '';
	
	//config.extraPlugins = 'imageuploader';
	var roxyFileman = rootUrl + 'fileman_ckeditor/index.html';
    config.filebrowserBrowseUrl = roxyFileman;
    config.filebrowserImageBrowseUrl = roxyFileman + '?type=image';
    config.removeDialogTabs = 'link:upload;image:upload';
	

	config.enterMode = CKEDITOR.ENTER_BR;
	
	config.font_names = 'Cooper Hewitt medium/cooper_hewittmedium;' + 
						'Cooper Hewitt regular/cooper_hewittbook;';

	//config.height = parseInt($('#popup_module_text').height() - 200) + 'px';
	config.height = wHeight * 0.60 + 'px';
	config.width = '850px';
	config.resize_enabled=false;
	config.allowedContent = true;
	config.extraPlugins = 'dialogui,dialog,fakeobjects,iframe';
	config.removeButtons = 'Bold,Italic,About,Save,NewPage,DocProps,Preview,Print,Templates,document,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Anchor,CreatePlaceholder,Flash,PageBreak,InsertPre,Blockquote,CreateDiv,BidiLtr,BidiRtl,ShowBlocks,Maximize,UIColor,Format,Image,Table,Smiley,Iframe,HorizontalRule,SpecialChar';
};