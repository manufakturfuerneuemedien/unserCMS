var wWidth = null;
var wHeight = null;

$(document).ready(function()
{	
	addGlobalListeners();
	resize();
});

function addGlobalListeners()
{
	$(window).resize(function()
	{
		resize();
	});


	$('#send_pw_user').click(function(){
		
		var uid = $(this).attr('uid');
		
		$.ajax({
            url: rootUrl+"entities/User/send_pw",  
            dataType: 'text',  
            data:  {uid :uid},                         
            type: 'post',
            success: function(response){
            
            	
            	
                
                if(response == "OK")
                {
                	 window.alert("Email Sent!");
                }
                else
                {
                   window.alert('Error');
                }

            }
	     });
		
	});
}

function resize()
{
	wWidth = $(window).width();
	wHeight = $(window).height();
	
	$('#menu').css({'width' : wWidth});
	$('#sidebar').css({'height': wHeight - $('#menu').height()});
	$('#content').css({'height': wHeight - $('#menu').height() -40, 'width': wWidth - $('#sidebar').width() -40});
}

function backendDialog(type, text, title)
{
	switch(type)
	{
		case 'success':
			var icon = '<span class="ui-icon ui-icon-info"></span>';
			break;
		case 'alert':
			var icon = '<span class="ui-icon ui-icon-notice"></span>';
			break;
		case 'error':
			var icon = '<span class="ui-icon ui-icon-alert"></span>';
			break;
		default:
			var icon = '';
			break;
	}
	
	$('<div></div>').html(icon + text).dialog({
        'title': title,
        'resizable': false,
        'modal': true,
        'dialogClass': 'backendDialog',
        'buttons': {
            'Ok': function() 
            {
                $( this ).dialog('close').dialog('destroy');
            }
        }
    });	
}

function openFilemanager(moduleType, moduleId)
{
	$('#filemanPanel iframe').attr('src', rootUrl + 'items/backend/fileman_custom/index.html?integration=custom' + '&module_type=' + moduleType + '&id=' + moduleId);
	$('#filemanPanel').dialog({
		width: parseInt($(window).width() * 0.8),
		height: parseInt($(window).height() * 0.8),
		modal:true, 
	});
}

function closeFilemanager()
{
	$('#filemanPanel').dialog('destroy');
}

