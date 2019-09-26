$(document).ready(function()
{
	toggleArtworkSearchListeners(true);
	toggleArtworkImportListeners(true);
});


function toggleArtworkSearchListeners(toggle)
{
	if(toggle)
	{
		$('#artwork_search_button').click(function()
		{
			searchArtwork($('#artwork_search_input').val(), $('#artwork_search_by').val());
		});
		
		$('#artwork_search_input').keypress(function (e) 
		{
			if (e.which == 13) 
			{
				searchArtwork($('#artwork_search_input').val(), $('#artwork_search_by').val());
				return false; 
			}
		});
	}
	else
	{
		$('#artwork_search_button').unbind('click');
		$('#artwork_search_input').unbind('keypress');
	}
}

function toggleArtworkImportListeners(toggle)
{
	if(toggle)
	{
		$('#artwork_import').click(function()
		{
			importArtworks();
		});
	}
	else
	{
		$('#artwork_import').unbind('click');
	}
}


function searchArtwork(searchString, searchBy)
{
	$.ajax(
	{
		url: rootUrl + 'entities/Import/searchArtwork',
		data: 
		{
			searchString: searchString,
			searchBy: searchBy
		},
		method: 'POST',
		success: function(data)
		{
			var ret = $.parseJSON(data);
			
			if(ret.success)
			{
				$('#artwork_search_results tbody tr').remove();
				for(var i = 0 ; i < ret.artworks.length ; i++)
				{
					var html = "";
					html += '<tr>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '><input type="checkbox" class="artwork_result_checkbox" artwork_id="' + ret.artworks[i].id + '" imported="' + ret.artworks[i].imported + '"/></td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + ret.artworks[i].id + '</td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + ret.artworks[i].title + '</td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + ret.artworks[i].artist + '</td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + ret.artworks[i].production_date + '</td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + ret.artworks[i].imported + '</td>';
					html += '<td ' + (ret.artworks[i].imported == 'YES' ? 'style="background-color: #a5e591;"' : '') + '>' + (ret.artworks[i].imported == 'YES' ? '<a href="' + rootUrl + 'entities/Item/edit_item/' + ret.artworks[i].itemId + '" target="_blank">Content</a> <a href="' + rootUrl + 'entities/Item/items/edit/' + ret.artworks[i].itemId + '" target="_blank">Item</a> <a href="' + rootUrl + 'entities/Item/tetrahaedron/' + ret.artworks[i].itemId + '/' + ret.artworks[i].detailimg + '" target="_blank">Tetra</a>' : '' ) + '</td>';
					html += '</tr>';
					$('#artwork_search_results table > tbody:last-child').append(html);
				}
			}
			else
			{
				alert('Error while searching');
			}
		}
	});	
}


function importArtworks()
{
	var artworks = '';
	var is_update = false;
	
	$('.artwork_result_checkbox:checked').each(function()
	{
		if(artworks != '')
			artworks += ';';
		artworks += $(this).attr('artwork_id');
		
		if($(this).attr('imported') == 'YES')
			is_update = true;
	});
	
	var confirm = true;
	if(is_update)
	{
		confirm = window.confirm('At least one artwork is already imported. Do you want to overwrite this?');
	}
	
	if(confirm)
	{
		toggleArtworkImportListeners(false);
		$('#artwork_import').text('Importing ...');
		
		$.ajax(
		{
			url: rootUrl + 'entities/Import/importArtwork',
			data: 
			{
				artworks: artworks,
			},
			method: 'POST',
			success: function(data)
			{
				var ret = $.parseJSON(data);
				
				if(ret.success)
				{
					alert('Import done!');
					$('#artwork_import').text('Import selected');
					$('#artwork_search_button').click();
				}
				else
				{
					alert('Error while importing');
				}
				
				toggleArtworkImportListeners(true);
			}
		});
	}
}