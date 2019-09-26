var id_increment = 0;
var modules = [];
var dialogContainer = [];

$(document).ready(function()
{	
	toggleContentMenuListeners(true);
	toggleScrollListeners(true);
//	prepareMosaicCanvas(0);
	initModules();
	igniteModuleList();
});


function igniteModuleList()
{
	$("#mosaic_module_list").sortable(
	{
		placeholder: "mosaic_module_list_item_highlight",
		update: function(event, ui)
		{
			var zindex = 99;
			$("#mosaic_module_list").find('.mosaic_module_list_item').each(function()
			{
				modules[$(this).attr('mosaic_id')].adjustZIndex(zindex--);
			});
		},
    });
}

// listeners for the menu in the contenteditor
function toggleContentMenuListeners(toggle)
{
	if(toggle)
	{
		$('#content_module_add').on('click', function()
		{
			createMosaic($('#content_module_select').val());
		});
		
		$('#content_module_clone').on('click', function()
		{
			cloneDialog();
		});
		
		$('#content_save').on('click', function()
		{
			saveMosaic();
		});
		
		$('#content_discard').on('click', function()
		{
			var contentType = "";
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
	
	$('#mosaic_item').find('.mosaic').each(function()
	{
		if($(this).hasClass('mosaic_text'))
		{
			modules[$(this).attr('mosaic_id')] = mosaic_text($(this).attr('mosaic_id'));
			modules[$(this).attr('mosaic_id')].width = parseInt($(this).css('width'));
			modules[$(this).attr('mosaic_id')].height = parseInt($(this).css('height'));
			modules[$(this).attr('mosaic_id')].posX = parseInt($(this).css('left'));
			modules[$(this).attr('mosaic_id')].posY = parseInt($(this).css('top'));
			modules[$(this).attr('mosaic_id')].zIndex = parseInt($(this).css('z-index'));
			modules[$(this).attr('mosaic_id')].db_id = parseInt($(this).attr('db_id'));
			modules[$(this).attr('mosaic_id')].content = $(this).find('.mosaic_content').html();
			modules[$(this).attr('mosaic_id')].bg_color = $(this).css('background-color') == 'rgba(0, 0, 0, 0)' ? '#ffffff' : rgb2hex($(this).css('background-color'));
		}
		
		if($(this).hasClass('mosaic_image'))
		{
			modules[$(this).attr('mosaic_id')] = mosaic_image($(this).attr('mosaic_id'));
			modules[$(this).attr('mosaic_id')].width = parseInt($(this).css('width'));
			modules[$(this).attr('mosaic_id')].height = parseInt($(this).css('height'));
			modules[$(this).attr('mosaic_id')].posX = parseInt($(this).css('left'));
			modules[$(this).attr('mosaic_id')].posY = parseInt($(this).css('top'));
			modules[$(this).attr('mosaic_id')].zIndex = parseInt($(this).css('z-index'));
			modules[$(this).attr('mosaic_id')].db_id = parseInt($(this).attr('db_id'));
			modules[$(this).attr('mosaic_id')].filepath = $(this).find('.mosaic_content_image').attr('src');
			modules[$(this).attr('mosaic_id')].bg_color = $(this).css('background-color') == 'rgba(0, 0, 0, 0)' ? '#ffffff' : rgb2hex($(this).css('background-color'));
		}		
		
		if(id_increment <= parseInt($(this).attr('mosaic_id')) +1)
			id_increment = parseInt($(this).attr('mosaic_id')) +1;
		
		modules[$(this).attr('mosaic_id')].init(false);
	});
}


function saveMosaic()
{
	var moduleData = [];
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
		url: rootUrl + 'entities/Content/save_mosaic',
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
function createMosaic(module_type)
{
	switch(module_type)
	{
		case 'text':
			modules[id_increment] = mosaic_text(id_increment);
			break;
		case 'image':
			modules[id_increment] = mosaic_image(id_increment);
			break;
	}
	
	// initialize the module (true = module html is created from prototype)
	modules[id_increment].init(true);
	
	// initialize the zIndex
	var zindex = -1;
	$('#mosaic_item').find('.mosaic').each(function()
	{
		console.log($(this).attr('mosaic_id'));
		zindex = modules[$(this).attr('mosaic_id')].zIndex > zindex ? modules[$(this).attr('mosaic_id')].zIndex : zindex;
	});
	
	modules[id_increment].adjustZIndex(zindex + 1);
	
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


function prepareMosaicCanvas(mosaic_type)
{
	switch(mosaic_type)
	{
		case 0:
			var width = 390;
			var height = 437;
			break;
		case 1:
			var width = 793;
			var height = 437;
			break;
	}
	
	$('#mosaic_item_container').css({'width': width + 20 + 2, 'height': height + 20 + 2});
	$('#mosaic_item').css({'width': width, 'height': height});
	$('.mosaic_dimensions.height').css({'width': height + 20 + 2});
	$('.mosaic_dimensions.width').css({'width': width + 20 + 2});
	$('.mosaic_dimensions.width').html(width + ' px');
	$('.mosaic_dimensions.height').html(height + ' px');
	
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

function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
   
    
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    
    if(rgb == null)
    {
    	return '#ffffff';
    }
    else
    {
    	 return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
    }
   
}


function cloneDialog()
{
	$('#cloneDialog').dialog(
	{
		'title': 'Clone mosaic from ...',
		'maxHeight': wHeight * 0.95,
		'maxWidth': wWidth * 0.95,
		'width': 'auto',
		'position': {'my': 'center', 'at': 'center'},
		'open': function(event, ui) 
	    {
			if(!$('#cloneMosaics').hasClass('scombobox')) // only init combobox once
			{
				$('#cloneMosaics').scombobox({
				    fullMatch: true,
				    empty: true,
				});
				$('#cloneMosaics').scombobox('change', function()
				{
					$.ajax(
					{
						url: rootUrl + 'entities/Content/get_mosaic',
						data: {
							'contentId': $('#cloneMosaics').scombobox('val'),
						},
						method: 'GET',
						success: function(data)
						{
							var ret = $.parseJSON(data);
							$('#mosaic_preview').empty().html(ret.html);
						}
					});						
				});
			}
			
	    },
	    'buttons':
		[
		 	{
		 		'text': 'Clone',
		 		'icons': { 'primary': 'ui-icon-check'},
		 		'click':  function()
		 		{
					$.ajax(
					{
						url: rootUrl + 'entities/Content/clone_mosaic',
						data: {
							'source': $('#cloneMosaics').scombobox('val'),
							'destination': contentId,
						},
						method: 'POST',
						success: function(data)
						{
							var ret = $.parseJSON(data);
							if(ret.success)
							{
								backendDialog('success', ret.msg, '');
								window.location.reload();
							}
							else
							{
								backendDialog('error', ret.msg, 'ERROR');
							}
						}
					});	
		 		}
		 	},
		 	{
		 		'text': 'Close',
		 		'icons': {'primary': 'ui-icon-closethick'},
		 		'click':  function()
		 		{
		 			$('#cloneDialog').dialog('close');
		 		}
		 	},
		],
	});
}
