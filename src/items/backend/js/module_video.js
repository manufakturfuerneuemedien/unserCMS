

function new_module_video(id, parent)
{
	var new_elem = 
	{
		module: null,
		type: 'video',
		code: 'gtP1eyF8LgI',
		start: 0,
		id: id,
		parent: parent,
		
		
		// MODULE BASIC
		init: function(parent)
		{
			this.module = $('.module[module_id=' + this.id + ']');
			this.bindListeners();
		},
		
		getPrototypeHTML: function()
		{
			var html = '<div module_id=' + this.id + ' class="module module_video has_placeholder" data-text="Insert video here"><div class="module_video_overlay"></div><iframe class="module_video_iframe" src="https://www.youtube.com/embed/gtP1eyF8LgI?start=0&wmode=transparent" frameborder="0" allowfullscreen="" wmode="Opaque"></iframe></div>';
			return html;
		},
		
		
		bindListeners: function()
		{
			this.module.dblclick(function()
			{
				active_module = $(this);
				
				checkMoveButtons(active_module);
				
				$('#popup_module_video').find('.popup_cancel_button').unbind('click');
				$('#popup_module_video').find('.popup_save_button').unbind('click');
				$('#popup_module_video').find('.popup_delete_button').unbind('click');
				$('#popup_module_video').find('.popup_moveup_button').unbind('click');
				$('#popup_module_video').find('.popup_movedown_button').unbind('click');

				$('#popup_module_video').find('#video_code_input').val(modules[active_module.attr('module_id')].code);
				$('#popup_module_video').find('#video_start_input').val(modules[active_module.attr('module_id')].start);
				$('#popup_module_video').show();
				
				$('#popup_module_video').find('.popup_save_button').click(function()
				{
					modules[active_module.attr('module_id')].code =  $('#popup_module_video').find('#video_code_input').val();
					modules[active_module.attr('module_id')].start = $('#popup_module_video').find('#video_start_input').val();
					active_module.find('iframe').attr('src', 'https://www.youtube.com/embed/' + modules[active_module.attr('module_id')].code + '?start=' + modules[active_module.attr('module_id')].start + '&amp;wmode=transparent');
					$('#popup_module_video').hide();
				});
				
				$('#popup_module_video').find('.popup_moveup_button').click(function()
				{
					moveUp(active_module);
				});
				
				$('#popup_module_video').find('.popup_movedown_button').click(function()
				{
					moveDown(active_module);
				});
				
				$('#popup_module_video').find('.popup_cancel_button').click(function()
				{
					$('#popup_module_video').hide();
				});
				
				$('#popup_module_video').find('.popup_delete_button').click(function()
				{
					var parent = active_module.parent();
					modules.splice(active_module.attr('module_id'),1);
					active_module.remove();
					$('#popup_module_video').hide();
				});
				
			});
		},
		
		unbindListeners: function()
		{
			this.module.unbind('dblclick');
		},
		
		getSaveData: function()
		{
			var ret = 
			{
				'code': this.code,
				'start': this.start,
				'order': this.id,
				'type': 'video',
			};
			
			return ret;
		},
		
	}
	
	return new_elem;
}