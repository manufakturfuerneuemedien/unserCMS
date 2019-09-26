

function module_image(id, parent)
{
	var module_image = 
	{
		id: id,
		type: 'image',
		ordering: 0,
		filepath: '/items/uploads/filemanager/placeholder2.png',
		align: 'center',
		stretch: true,
		caption: '',
		
		parent: parent,
		db_id: -1,
		prototype: $('#module_prototype_image'),
		dialogPrototype: $('#module_image_dialog'),
		contentHandle: null,
		toolsHandle: null,
		moduleHandle: null,
		dialogHandle: null,
		imageHandle: null,
		captionHandle: null,
		
		
		// MODULE BASIC
		init: function(create)
		{
			if(create)
			{
				this.parent.append(this.prototype.children().clone().attr('module_id', this.id).attr('ordering', this.id));
				this.ordering = this.id;
			}
			
			this.moduleHandle = this.parent.find('.module[module_id=' + this.id + ']');
			this.imageHandle = this.moduleHandle.find('.module_content_image');
			this.toolsHandle = this.moduleHandle.find('.module_tools');
			this.captionHandle = this.moduleHandle.find('.module_image_caption');
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

		},
		
		
		dialog: function()
		{
			if(this.dialogHandle == null)
			{
				$('#dialogContainer').append('<div class="dialogWindow" dialogId="' + this.id + '">' + this.dialogPrototype.html() + '</div>'); // create dialog content from templates
			
				this.dialogHandle = $('.dialogWindow[dialogId="' + this.id + '"]'); // save dialog selector to object for later use
				
				this.dialogHandle.find('.module_image_preview').attr('src', this.filepath);
				
				this.dialogHandle.find('button').button(); // style buttons on dialog
				$('.filemanager').on('click', function()
				{
					var dID = $(this).parent().parent().parent().parent().parent().parent().attr('dialogId')
					
					openFilemanager('image' ,dID);
				});
				this.dialogHandle.find('.stretch').attr('checked', this.stretch == 1);
				this.dialogHandle.find('.align').val(this.align);
				this.dialogHandle.find('.caption').val(this.caption);
								
				$('.dialogWindow[dialogId="' + this.id + '"]').dialog( // create dialog with JQUERYUI
				{
					'title': 'Edit IMAGE module',
					'maxHeight': wHeight * 0.95,
					'maxWidth': wWidth * 0.95,
					'width': 'auto',
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
		
		filemanagerResult: function(fileData)
		{
			this.dialogHandle.find('.module_image_preview').attr('src', fileData.fullPath);
			closeFilemanager();
		},
		
		closeDialog: function()
		{
			this.dialogHandle.dialog('close');
			this.dialogHandle.dialog('destroy').remove();
			this.dialogHandle = null;
		},
		
		applyChanges: function()
		{
			this.filepath = this.dialogHandle.find('.module_image_preview').attr('src');
			this.stretch = this.dialogHandle.find('.stretch').prop('checked') ? 1 : 0;
			this.align = this.dialogHandle.find('.align').val();
			this.caption = this.dialogHandle.find('.caption').val();
			this.imageHandle.attr('src', this.filepath);
			this.imageHandle.css({'width': this.stretch == 1 ? '100%' : 'auto'});
			this.moduleHandle.css({'text-align': this.align});
			this.captionHandle.empty().text(this.caption);
			this.closeDialog();
		},
		
		deleteModule: function()
		{
			this.unbindListeners();
			modules.splice(this.id,1);
			this.moduleHandle.remove();
			this.closeDialog();
		},
		
		
		getSaveData: function()
		{
			if(this.filepath != '')
			{
				var ret = 
				{
					'ordering': this.ordering,
					'filepath': this.filepath,
					'type': this.type,
					'align': this.align,
					'stretch': this.stretch,
					'caption': this.caption,
					'db_id': this.db_id,
					'parent': this.parent.attr('parent_id'),
				};
			}
			
			return ret;
		},
	
	}
	
	return module_image;
}