

function module_headline(id, parent)
{
	var module_headline = 
	{
		id: id,
		type: 'headline',
		ordering: 0,
		content: '',
		display_text: '',
		htype: 'small',
		section: '',
		parent: parent,
		db_id: -1,
		prototype: $('#module_prototype_headline'),
		contentHandle: null,
		toolsHandle: null,
		moduleHandle: null,
		dialogHandle: null,
			
		
		// MODULE BASIC
		init: function(create)
		{
			if(create)
			{
				this.parent.append(this.prototype.children().clone().attr('module_id', this.id).attr('ordering', this.id));
				this.ordering = this.id;
			}
			
			this.moduleHandle = this.parent.find('.module[module_id=' + this.id + ']');
			this.contentHandle = this.moduleHandle.find('.module_content');
			this.toolsHandle = this.moduleHandle.find('.module_tools');
		/*	this.moduleHandle.removeAttr('ordering');
			this.moduleHandle.removeAttr('db_id');*/
			this.bindListeners();
		},
		
		bindListeners: function()
		{
			this.moduleHandle.on('dblclick', function()
			{
				modules[$(this).attr('module_id')].dialog();
			});
			
			this.moduleHandle.on('click', function()
			{
				showHideToolbars(modules[$(this).attr('module_id')]);
			});
			
			this.toolsHandle.find('.edit').on('click', function()
			{
				modules[$(this).parent().parent().attr('module_id')].dialog();
			});
		},
		
		unbindListeners: function()
		{
			this.moduleHandle.off('dblclick');
			this.moduleHandle.off('click');
			this.toolsHandle.find('.edit').off('click');
		},
		
		getSaveData: function()
		{
			var ret = 
			{
				'type': this.type,
				'parent': this.parent.attr('parent_id'),	
				'ordering': this.ordering,
				'content': this.content,
				'display_text': this.display_text,
				'db_id': this.db_id,
				'htype': this.htype,
				'section': this.section,
			};
			
			return ret;
		},
		
		dialog: function()
		{
			if(this.dialogHandle == null)
			{
				$('#dialogContainer').append('<div class="dialogWindow" dialogId="' + this.id + '">' + $('#popup_module_headline').html() + '</div>'); // create dialog content from templates
			
				this.dialogHandle = $('.dialogWindow[dialogId="' + this.id + '"]'); // save dialog selector to object for later use	
				this.dialogHandle.find('.select_type option[value="'+this.htype+'"]').prop('selected', true);
				this.dialogHandle.find('.section').val(this.section);
				this.dialogHandle.find('.content').val(this.content);
				this.dialogHandle.find('.display').val(this.display_text);
				
				$('.dialogWindow[dialogId="' + this.id + '"]').dialog( // create dialog with JQUERYUI
				{
					'title': 'Edit HEADLINE module',
					'maxHeight': wHeight * 0.95,
					'maxWidth': wWidth * 0.95,
					'width': 'auto',
					'height': wHeight * 0.5,
					'position': {'my': 'center', 'at': 'center'},
					'closeOnEscape': false,
				    'open': function(event, ui) 
				    {
				        $(".ui-dialog-titlebar-close", ui.dialog | ui).hide();
				    },
					'beforeClose': function(event, ui)
					{
						dialogContainer[$('#' + event.target.id).attr('dialogId')] = 'closed';
					},
					'buttons':
					[
					 	
					 		
					 	{
					 		'text': 'Move up module',
					 		'icons': { 'primary': 'ui-icon-arrowthick-1-n'},
					 		'click':  function()
					 		{
					 			moveUp(modules[$(this).attr('dialogId')]);
					 		}
					 	},	
					 	{
					 		'text': 'Move down module',
					 		'icons': { 'primary': 'ui-icon-arrowthick-1-s'},
					 		'click':  function()
					 		{
					 			moveDown(modules[$(this).attr('dialogId')]);
					 		}
					 	},	
					 	{
					 		'text': 'Delete module',
					 		'icons': { 'primary': 'ui-icon-trash'},
					 		'click':  function()
					 		{
					 			modules[$(this).attr('dialogId')].deleteModule();
					 			reorderModules();
					 		}
					 	},	
					 	{
					 		'text': 'Apply changes',
					 		'icons': { 'primary': 'ui-icon-check'},
					 		'click':  function()
					 		{
					 			modules[$(this).attr('dialogId')].applyChanges();
					 		}
					 	},
					 	{
					 		'text': 'Close',
					 		'icons': {'primary': 'ui-icon-closethick'},
					 		'click':  function()
					 		{
					 			modules[$(this).attr('dialogId')].closeDialog();
					 		}
					 	},
					 	
					]
					
				});
				
				$('.dialogWindow[dialogId="' + this.id + '"]').dialogExtend({
					'minimizable': true,
					'closable': false,
					'beforeMinimize': function(event)
					{
						dialogContainer[$(this).attr('dialogId')] = 'minimized';
					},
					'beforeRestore': function(event)
					{
						dialogContainer[$(this).attr('dialogId')] = 'open';
					},
				});
				
				checkDialogMoveButtons(this);
				dialogContainer[this.id] = 'open';
			}
			else
			{
				switch(dialogContainer[this.id])
				{
					case 'minimized':
						$('.dialogWindow[dialogId="' + this.id + '"]').dialogExtend('restore');
					case 'open':
						$('.dialogWindow[dialogId="' + this.id + '"]').dialog('moveToTop');
						break;
				}
			}
		},

		closeDialog: function()
		{
			this.dialogHandle.dialog('close');
			this.dialogHandle.dialog('destroy').remove();
			this.dialogHandle = null;
			

		},
		
		applyChanges: function()
		{
			

			this.htype = this.dialogHandle.find('.select_type').val();
			this.content = this.dialogHandle.find('.content').val();
			this.display_text = this.dialogHandle.find('.display').val();
			this.section = this.dialogHandle.find('.section').val();
			
			//this.content = CKEDITOR.instances['module_headline_textarea_' + this.id].getData();
			this.contentHandle.html(this.content);
			this.moduleHandle.removeClass('small').removeClass('big').addClass(this.htype);
			
 			this.closeDialog();
		},
		
		deleteModule: function()
		{
			this.unbindListeners();
			modules.splice(this.id,1);
			this.moduleHandle.remove();
			this.closeDialog();
		},
		
		
		
	}
	
	return module_headline;
}