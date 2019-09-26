var id_increment = 0;
var modules = [];
var active_module = null;

$(document).ready(function()
{	
	toggleMenuListeners(true);
	igniteSortable();
	addDeleteEvent();
	
});



function igniteSortable()
{
	$( "#menu_container" ).sortable();
    $( "#menu_container" ).disableSelection();	
}

function toggleMenuListeners(toggle)
{
	if(toggle)
	{
		$('#menu_lang_switch').on('click', function()
		{
			if(parseInt($('#menu_lang_select').val()) != clientLang)
				window.location.href = rootUrl + 'entities/User/edit_menu/' + clientId + '/' + $('#menu_lang_select').val();
		});
		
		$('#menu_add').on('click', function()
		{
			addMenu();
		});
		
		$('#menu_save').on('click', function()
		{
			saveMenu();
		});
		
		$('#menu_discard').on('click', function()
		{
			window.location.href = rootUrl + 'entities/User/client';
		});
		
		$('#menu_copy').on('click', function()
		{
			toggleMenuCopyDialog(true);
		});
		
		$('#menu_copy_cancel').on('click', function()
		{
			toggleMenuCopyDialog(false);
		});
		
		$('#menu_copy_copy').on('click', function()
		{
			copyMenu();
		});
		
		$('#menu_copy_client').on('change', function()
		{
			getClientLanguages($(this).val());
		});
		
		$('#teaser_save').on('click', function()
		{
			saveTeaser();
		});
		
		$('#teaser_discard').on('click', function()
		{
			switch(contentType)
			{
				case 0:
					window.location.href = rootUrl + 'entities/Content/article';
					break;
				case 1:
				case 7:
					window.location.href = rootUrl + 'entities/Content/quiz';
					break;
				case 4:
				case 6:
					window.location.href = rootUrl + 'entities/Content/assessment';
					break;
				case 8:
					window.location.href = rootUrl + 'entities/Content/lesson/';
					break;
					
			}
		});
	}
	else
	{
		$('#menu_lang_switch').off('click');
		$('#menu_add').off('click');
		$('#menu_save').off('click');
		$('#menu_discard').off('click');
		$('#menu_copy').off('click');
		$('#menu_copy_client').off('change');
	}
}


function saveMenu()
{
	var i = 0;
	var menuitems = [];
	$('.menu_menuitem:not(.is_template)').each(function()
	{
		menuitems.push(
		{
			'name': $(this).find('.menu_menuitem_name input[type="text"]').val(),
			'metatag_id': $(this).find('.menu_menuitem_metatag select').val(),
			'ordering': i++,
		});
	});
	
	$.ajax(
	{
		url: rootUrl + 'entities/User/save_menu',
		data: {
			'client_id': clientId,
			'language_id': clientLang,
			'menuitems': menuitems,
		},
		method: 'POST',
		success: function(data)
		{
			var ret = $.parseJSON(data);
			
			if(ret.success)
			{
				alert('Save successful!');
				window.location.href = rootUrl + 'entities/User/client';
			}
			else
			{
				alert('Error while saving');
			}
		}
	});	
}


function addMenu()
{
	var temp = $('.is_template').clone();
	temp.removeClass('is_template');
	
	$('#menu_container').append(temp);

	addDeleteEvent();
}

function addDeleteEvent()
{
	$('.menu_menuitem_delete').on('click', function()
	{
		$(this).parent().remove();
	});	
}


function toggleMenuCopyDialog(toggle)
{
	if(toggle)
		$('#menu_copy_dialog').show();
	else
		$('#menu_copy_dialog').hide();
		
}


function getClientLanguages(clientId)
{
	if(clientId == "0")
		$('#menu_copy_lang').empty();
	else
	{
		$.ajax(
		{
			url: rootUrl + 'entities/User/getLanguages',
			data: 
			{
				'client_id': clientId,
			},
			method: 'POST',
			success: function(data)
			{
				var ret = $.parseJSON(data);
				
				if(ret.success)
				{
					$('#menu_copy_lang').empty();
					for(var i = 0 ; i < ret.langs.length ; i++)
					{
						$('#menu_copy_lang').append('<option value="' + ret.langs[i].key + '">' + ret.langs[i].value + '</option>');
					}
				}
				else
				{
					alert('Error while saving');
				}
			}
		});
	}
}

function copyMenu()
{
	if(clientId != parseInt($('#menu_copy_client').val()) || clientLang != parseInt($('#menu_copy_lang').val()))
	{
		if($('#menu_copy_client').val() != 0 && $('#menu_copy_lang').val() != null)
		{
			$.ajax(
			{
				url: rootUrl + 'entities/User/copyMenu',
				data: 
				{
					'client_id': clientId,
					'language_id': clientLang,
					'src_client_id': $('#menu_copy_client').val(),
					'src_language_id': $('#menu_copy_lang').val(),
				},
				method: 'POST',
				success: function(data)
				{
					var ret = $.parseJSON(data);
					
					if(ret.success)
					{
						alert('Menu copied!');
						window.location.reload();
					}
					else
					{
						alert('Error while saving');
					}
				}
			});
		}
		else
			alert('Error');
	}
	else
		alert('Source menu is same as destination menu');
}


function saveTeaser()
{
	var i = 0;
	var teasers = [];
	$('.langlist_item').each(function()
	{
		teasers.push(
		{
			'lang_id': $(this).attr('lang_id'),
			'content_id': contentId,
			'teaser_text': $(this).find('.langlist_item_text input').val(),
			'teaser_subtext': $(this).find('.langlist_item_subtext textarea').val(),
		});
	});
	
	$.ajax(
	{
		url: rootUrl + 'entities/Content/save_teaser',
		data: {
			'teasers': teasers,
		},
		method: 'POST',
		success: function(data)
		{
			var ret = $.parseJSON(data);
			
			if(ret.success)
			{
				alert('Save successful!');
			}
			else
			{
				alert('Error while saving');
			}
		}
	});	
}



