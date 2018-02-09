var id_increment = 0;
var modules = [];
var dialogContainer = [];

$(document).ready(function()
{	
	toggleContentMenuListeners(true);
	toggleScrollListeners(true);
	//igniteCKEditor(); 
	initModules();
	igniteSortable();
	
	
});

function igniteCKEditor()
{
	var roxyFileman = rootUrl + 'fileman_ckeditor/index.html?integration=ckeditor'; 
	
	CKEDITOR.replace( 'module_text_editor', 
	{
		filebrowserBrowseUrl:roxyFileman,
        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
		customConfig: rootUrl + '/items/backend/ckeditor/config_text.js'
	});
	
}


function igniteSortable()
{
	$( '#content_container_big, #content_container_small' ).sortable(
	{
		'connectWith': '.content_container',
		'handle': '.module_tool.move',
		'update': function(event, ui)
		{
			var i = 0;
			$('#content_container_big').find('.module').each(function()
			{
				modules[$(this).attr('module_id')].ordering = i;
				modules[$(this).attr('module_id')].parent = $('#content_container_big');
				i++;
			});
			i = 0;
			$('#content_container_small').find('.module').each(function()
			{
				modules[$(this).attr('module_id')].ordering = i;
				modules[$(this).attr('module_id')].parent = $('#content_container_small');
				i++;
			});
			
			if($('#content_container_small').find('.module').length == 0)
				$('#content_container_small').empty();
			
			if($('#content_container_big').find('.module').length == 0)
				$('#content_container_big').empty();
		},
    }).disableSelection();	
}

// listeners for the menu in the contenteditor
function toggleContentMenuListeners(toggle)
{
	if(toggle)
	{
		$('#content_module_add').on('click', function()
		{
			$('#addModuleDialog').dialog( // create dialog with JQUERYUI
			{
				'width': 'auto',
				'modal': true,
				'resize': false,
				'position': {'my': 'center', 'at': 'center'},
				'buttons':
				[
				 	{
				 		'text': 'Left (big) column',
				 		'click':  function()
				 		{
				 			createModule($('#content_module_select').val(), $('#content_container_big'));
				 			$(this).dialog('close');
				 		}
				 	},
				 	{
				 		'text': 'Right (small) column',
				 		'click':  function()
				 		{
				 			createModule($('#content_module_select').val(), $('#content_container_small'));
				 			$(this).dialog('close');
				 		}
				 	},	
				],
			});
		});
		
		$('#content_save').on('click', function()
		{
			saveContent();
		});
		
		$('#content_discard').on('click', function()
		{
			var contentType ="";
			switch(contentType)
			{
				default:
					window.location.href = rootUrl + 'entities/Content/subsite';
					break;
			}
		});
	}
	else
	{
		$('#content_module_add').off('click');
		$('#content_save').off('click');
		$('#content_discard').off('click');
	}
}


// initializes modules, that existed when loading
function initModules()
{
	
	$('.content_container').find('.module').each(function()
	{
		if($(this).hasClass('module_text'))
		{
			modules[$(this).attr('module_id')] = module_text($(this).attr('module_id'), $(this).parent());
			modules[$(this).attr('module_id')].content = $(this).find('.module_content').html();
			modules[$(this).attr('module_id')].ordering = parseInt($(this).attr('ordering'));
			modules[$(this).attr('module_id')].db_id = parseInt($(this).attr('db_id'));
		}
		
		if($(this).hasClass('module_image'))
		{
			modules[$(this).attr('module_id')] = module_image($(this).attr('module_id'), $(this).parent());
			modules[$(this).attr('module_id')].filepath = $(this).find('.module_content_image').attr('src');
			modules[$(this).attr('module_id')].align = $(this).css('text-align');
			modules[$(this).attr('module_id')].caption = $(this).find('.module_image_caption').text();
			modules[$(this).attr('module_id')].stretch = $(this).find('.module_content_image').attr('style').search('100%') != -1 ? 1 : 0;
			modules[$(this).attr('module_id')].db_id = parseInt($(this).attr('db_id'));
			modules[$(this).attr('module_id')].ordering = parseInt($(this).attr('ordering'));
		}
		
		if($(this).hasClass('module_pdf'))
		{
			modules[$(this).attr('module_id')] = new_module_pdf($(this).attr('module_id'), $(this).parent());
			modules[$(this).attr('module_id')].filename = $(this).find('.module_pdf_name').text();
			modules[$(this).attr('module_id')].align = $(this).attr('align');
			modules[$(this).attr('module_id')].text = $(this).find('.module_pdf_text').text();

		}
		
		if($(this).hasClass('module_headline'))
		{
			modules[$(this).attr('module_id')] = module_headline($(this).attr('module_id'), $(this).parent());
			modules[$(this).attr('module_id')].content = $(this).find('.module_content').html();
			modules[$(this).attr('module_id')].ordering = parseInt($(this).attr('ordering'));
			modules[$(this).attr('module_id')].db_id = parseInt($(this).attr('db_id'));
			modules[$(this).attr('module_id')].htype = $(this).attr('htype');
			modules[$(this).attr('module_id')].section = $(this).attr('section');
			modules[$(this).attr('module_id')].display_text = $(this).attr('display_text');
		}

		
		/*if($(this).hasClass('module_video'))
		{
			modules[$(this).attr('module_id')] = new_module_video($(this).attr('module_id'), $(this).parent());
			modules[$(this).attr('module_id')].code = $(this).attr('code');
			modules[$(this).attr('module_id')].start = $(this).attr('start');
		}	*/
		
		if(id_increment <= parseInt($(this).attr('module_id')) +1)
			id_increment = parseInt($(this).attr('module_id')) +1;
		
		modules[$(this).attr('module_id')].init(false);
	});
}


function saveContent()
{
	var moduleData = [];
	
	console.log(modules);
	for(var i = 0 ; i < id_increment ; i++)
	{
		if(modules[i] !== undefined)
		{
			if(modules[i].getSaveData() != null)
				moduleData.push(modules[i].getSaveData());
		}
	}
	
	$.ajax(
	{
		url: rootUrl + 'entities/Content/save_subsite',
		data: {
			'contentId': contentId,
			'moduleData': moduleData,
		},
		method: 'POST',
		success: function(data)
		{
			var ret = $.parseJSON(data);
			
			if(ret.success)
			{
				backendDialog('success', ret.msg, '');
			}
			else
			{
				backendDialog('error', ret.msg, 'ERROR');
			}
		}
	});	
}

// creates modules, when added from the menubar
function createModule(module_type, parent)
{
		switch(module_type)
	{
		case 'text':
			modules[id_increment] = module_text(id_increment, parent);
			break;
		case 'image':
			modules[id_increment] = module_image(id_increment, parent);
			break;
		case 'pdf':
			modules[id_increment] = new_module_pdf(id_increment, parent);
			break;
		case 'headline':
			modules[id_increment] = module_headline(id_increment, parent);
			break;
		/*case 'video':
			modules[id_increment] = new_module_video(id_increment, parent);
			break;*/	
	}
	
	// initialize the module (true = module html is created from prototype)
	modules[id_increment].init(true);
	
	// initialize the ordering variable
	parent.find('.module[module_id!="' + id_increment + '"]').each(function()
	{
		modules[id_increment].ordering = modules[$(this).attr('module_id')].ordering > modules[id_increment].ordering ? modules[$(this).attr('module_id')].ordering + 1 : modules[id_increment].ordering;
	});
	
	// increment the module id 
	id_increment++;
}


function toggleScrollListeners(toggle)
{
	if(toggle)
	{
		$('#content').scroll(function() 
		{
			$('#content_menu_container').css({'top': $('#content').scrollTop()});
		});
	}
	else
	{
		$('#content').unbind('scroll');
	}
}

//moves a modules one up
function moveUp(module)
{
	if(module.ordering > 0)
	{
		module.ordering--;
		modules[module.moduleHandle.prev('.module').attr('module_id')].ordering++;
		module.moduleHandle.prev('.module').before(module.moduleHandle);
	}
	checkMoveButtons();
}


// moves a module one down
function moveDown(module)
{
	if(module.ordering < module.parent.find('.module').length - 1)
	{
		module.ordering++;
		modules[module.moduleHandle.next('.module').attr('module_id')].ordering--;
		module.moduleHandle.next('.module').after(module.moduleHandle);
	}
	checkMoveButtons();
}

// goes through all modules and checks for open dialogs, if found runs the check for the dialog buttons
function checkMoveButtons()
{
	for(var i = 0 ; i < id_increment ; i++)
	{
		if(modules[i] !== undefined)
		{
			if(modules[i].dialogHandle != null)
			{
				checkDialogMoveButtons(modules[i]);
			}
		}
	}
}

// disables/enables the move buttons on the module dialogs
// parameter: the module that needs checking
function checkDialogMoveButtons(module)
{
	if(module.ordering > 0)
		module.dialogHandle.parent().find('.ui-dialog-buttonpane button:contains("Move up")').button("enable");
	else
		module.dialogHandle.parent().find('.ui-dialog-buttonpane button:contains("Move up")').button("disable");
	
	if(module.ordering < module.parent.find('.module').length - 1)
		module.dialogHandle.parent().find('.ui-dialog-buttonpane button:contains("Move down")').button("enable");
	else
		module.dialogHandle.parent().find('.ui-dialog-buttonpane button:contains("Move down")').button("disable");
}

// handles the toolbars for all modules of all types
function showHideToolbars(module)
{
	for(var i = 0 ; i < id_increment ; i++)
	{
		if(modules[i] !== undefined)
		{
			modules[i].toolsHandle.hide();
		}
	}	
	module.toolsHandle.show();
}

function reorderModules()
{
	console.log(modules);
	modules = [];
	initModules();
	
	
	$('.content_container').find('.module').each(function(i,item)
	{
		$(this).attr('ordering', i);
	});
	
	console.log(modules);

}


function nl2br(str, is_xhtml) 
{   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

function br2nl(str)
{
    return str.replace(/<br>/g, "\r");
};

function getFnameFromImageSource(src)
{
	return src.substring(src.lastIndexOf('/')+1);
}





