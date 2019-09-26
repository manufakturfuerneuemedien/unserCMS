

function mosaic_text(id)
{
	var module_text = 
	{
		id: id,
		db_id: -1,
		type: 'text',
		parent: $('#mosaic_item'),
		
		content: 'New text module',
		width: 100,
		height: 100,
		posX: 0,
		posY: 0,
		zIndex: -1,
		bg_color: '#cecece',
		
		prototype: $('#mosaic_prototype_text'),
		listPrototype: $('#mosaic_prototype_text_list'),
		dialogPrototype: $('#popup_module_text'),
		contentHandle: null,
		toolsHandle: null,
		moduleHandle: null,
		dialogHandle: null,
		listHandle: null,
			
		
		// MODULE BASIC
		init: function(create)
		{
			if(create)
			{
				this.parent.append(this.prototype.children().clone().attr('mosaic_id', this.id));
				$('#mosaic_module_list').prepend(this.listPrototype.children().clone().attr('mosaic_id', this.id).html($("<p>").html(this.content).text().substring(0,20)));
			}
			else
			{
				$('#mosaic_module_list').append(this.listPrototype.children().clone().attr('mosaic_id', this.id).html($("<p>").html(this.content).text().substring(0,20)));
			}

			this.moduleHandle = this.parent.find('.mosaic[mosaic_id=' + this.id + ']');
			this.contentHandle = this.moduleHandle.find('.mosaic_content');
			this.toolsHandle = this.moduleHandle.find('.mosaic_tools');
			
			this.moduleHandle.removeAttr('db_id');
			
			this.listHandle = $('#mosaic_module_list').find('.mosaic_module_list_item[mosaic_id=' + this.id + ']');

			this.bindListeners();
		},
		
		bindListeners: function()
		{
			this.moduleHandle.on('dblclick', function()
			{
				modules[$(this).attr('mosaic_id')].dialog();
			});
			
			this.toolsHandle.find('.edit').on('click', function()
			{
				modules[$(this).parent().parent().attr('mosaic_id')].dialog();
			});
			
			this.moduleHandle.on('click', function()
			{
				if(!modules[$(this).attr('mosaic_id')].moduleHandle.is('.isFocus'))
					modules[$(this).attr('mosaic_id')].focus();
			});
			
			this.listHandle.on('click', function()
			{
				if(!modules[$(this).attr('mosaic_id')].moduleHandle.is('.isFocus'))
					modules[$(this).attr('mosaic_id')].focus();
			});
			
			this.listHandle.on('dblclick', function()
			{
				modules[$(this).attr('mosaic_id')].dialog();
			});
			
		},
		
		unbindListeners: function()
		{
			this.moduleHandle.off('dblclick');
			this.moduleHandle.off('click');
			this.toolsHandle.find('.edit').off('click');
		},
		
		focus: function()
		{
			for(var i = 0 ; i < id_increment ; i++)
			{
				if(modules[i] !== undefined && modules[i].id != this.id)
				{
					modules[i].blur();
				}
			}	
			
			this.toolsHandle.show();
			this.moduleHandle.addClass('isFocus');
			
			if(this.moduleHandle.is('.ui-resizable'))
				this.moduleHandle.resizable( "option", "disabled", false );
			else
			{	
				this.moduleHandle.resizable(
				{
					containment: "#mosaic_item",
					resize: function(event, ui)
					{
						var mod = modules[ui.originalElement.attr('mosaic_id')];
						mod.posX = ui.position.left;
						mod.posY = ui.position.top;
						mod.width = ui.size.width;
						mod.height = ui.size.height;
						if(mod.dialogHandle != null)
						{
							mod.dialogHandle.find('.posX').val(mod.posX);
							mod.dialogHandle.find('.posY').val(mod.posY);
							mod.dialogHandle.find('.width').val(mod.width);
							mod.dialogHandle.find('.height').val(mod.height);
						}
					},
			    });
			}
			
			if(this.moduleHandle.is('.ui-draggable'))
				this.moduleHandle.draggable('enable');
			else
			{
				this.moduleHandle.draggable(
				{
					containment: "#mosaic_item",
					handle: '.move',
					scroll: false,
					drag: function(event, ui)
					{
						var mod = modules[ui.helper.attr('mosaic_id')];
						mod.posX = ui.position.left;
						mod.posY = ui.position.top;
						if(mod.dialogHandle != null)
						{
							mod.dialogHandle.find('.posX').val(mod.posX);
							mod.dialogHandle.find('.posY').val(mod.posY);
						}
					},
				});
			}
		},
		
		blur: function()
		{
			if(this.moduleHandle.is('.isFocus'))
			{
				this.toolsHandle.hide();
				this.moduleHandle.removeClass('isFocus');
				
				if(this.moduleHandle.is('.ui-resizable'))
					this.moduleHandle.resizable( "option", "disabled", true );
				if(this.moduleHandle.is('.ui-draggable'))
					this.moduleHandle.draggable('disable');
			}
		},
		
		getSaveData: function()
		{
			var ret = 
			{
				'type': this.type,
				'content': this.content,
				'width': this.width,
				'height': this.height,
				'posX': this.posX,
				'posY': this.posY,
				'zIndex': this.zIndex,
				'bg_color': this.bg_color,
				'db_id': this.db_id,
			};
			
			return ret;
		},
		
		dialog: function()
		{
			if(this.dialogHandle == null)
			{
				$('#dialogContainer').append('<div class="dialogWindow" dialogId="' + this.id + '">' + this.dialogPrototype.html() + '</div>'); // create dialog content from templates
			
				this.dialogHandle = $('.dialogWindow[dialogId="' + this.id + '"]'); // save dialog selector to object for later use
				
				this.dialogHandle.find('textarea').attr('id', 'module_text_textarea_' + this.id); // give textarea an ID for CKEDITOR.replace
				
			
				
				
				CKEDITOR.replace( 'module_text_textarea_' + this.id, // initiate CKEDITOR for this dialog only
				{
					customConfig: rootUrl + '/items/backend/ckeditor/config_text.js'
				});
				
				
				
				
				CKEDITOR.instances['module_text_textarea_' + this.id].setData(this.content); // get content from module
			
				
				this.dialogHandle.find('.posX').val(this.posX);
				this.dialogHandle.find('.posY').val(this.posY);
				this.dialogHandle.find('.width').val(this.width);
				this.dialogHandle.find('.height').val(this.height);
				this.dialogHandle.find('.bg_color').val(this.bg_color);
				this.dialogHandle.find('.bg_color').spectrum({
				    color: this.bg_color,
				    showInput: true,
				    allowEmpty: true,
				    preferredFormat: "hex",
				});
				
				
				
				
				
				$('.dialogWindow[dialogId="' + this.id + '"]').dialog( // create dialog with JQUERYUI
				{
					'title': 'Edit TEXT module',
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
					 		'text': 'Delete module',
					 		'icons': { 'primary': 'ui-icon-trash'},
					 		'click':  function()
					 		{
					 			modules[$(this).attr('dialogId')].deleteModule();
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
				
				//checkDialogMoveButtons(this);
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
			this.content = CKEDITOR.instances['module_text_textarea_' + this.id].getData();
			this.contentHandle.html(this.content);
			this.listHandle.html($("<p>").html(this.content).text().substring(0,20));
			this.posX = this.dialogHandle.find('.posX').val();
			this.posY = this.dialogHandle.find('.posY').val();
			this.width = this.dialogHandle.find('.width').val();
			this.height = this.dialogHandle.find('.height').val();
			this.bg_color = this.dialogHandle.find('.bg_color').val() != '' ? this.dialogHandle.find('.bg_color').val() : null;
			this.moduleHandle.css({'left': this.posX +'px', 'top': this.posY + 'px', 'width': this.width + 'px', 'height': this.height + 'px', 'background-color': this.bg_color != null ? this.bg_color : 'transparent'});
 			this.closeDialog();
		},
		
		deleteModule: function()
		{
			this.unbindListeners();
			modules.splice(this.id,1);
			this.moduleHandle.remove();
			this.listHandle.remove();
			this.closeDialog();
		},
		
		adjustZIndex: function(zindex)
		{
			this.zIndex = zindex;
			this.moduleHandle.css({'z-index': zindex});
		}
		
		
		
	}
	
	return module_text;
}