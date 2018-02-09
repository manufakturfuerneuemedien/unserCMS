/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) 
{
	config.removePlugins = 'uploadimage';
	config.uploadUrl = '';
	
	//config.extraPlugins = 'imageuploader';
	
	config.enterMode = CKEDITOR.ENTER_BR;
	
	config.font_names = 'TradeGothic,TradeGothic-Light,' + config.font_names;
	
	config.height = '100px';
	config.resize_enabled=false;

	config.removeButtons = 'About,Source,Save,NewPage,DocProps,Preview,Print,Templates,document,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Anchor,CreatePlaceholder,Flash,PageBreak,Iframe,InsertPre,Blockquote,CreateDiv,BidiLtr,BidiRtl,ShowBlocks,Maximize,UIColor,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Image,Table,HorizontalRule,Smiley,SpecialChar';
};