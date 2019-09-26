

function mosaic_image(id)
{
	var module_image = 
	{
		id: id,
		db_id: -1,
		type: 'image',
		parent: $('#mosaic_item'),
		
		filepath: '/items/uploads/filemanager/placeholder.png',
		width: 100,
		height: 87,
		posX: 0,
		posY: 0,
		zIndex: -1,
		
		prototype: $('#mosaic_prototype_image'),
		listPrototype: $('#mosaic_prototype_image_list'),
		dialogPrototype: $('#popup_module_image'),
		imageHandle: null,
		toolsHandle: null,
		moduleHandle: null,
		dialogHandle: null,
		listHandle: null,
			
		filemanagerWidth: 0,
		filemanagerHeight: 0,
		
		// MODULE BASIC
		init: function(create)
		{
			if(create)
			{
				this.parent.append(this.prototype.children().clone().attr('mosaic_id', this.id)); // clone and append the module prototype
				
				var listclone = this.listPrototype.children().clone();
				listclone.attr('mosaic_id', this.id);
				listclone.children('img').attr('src', this.filepath);
				$('#mosaic_module_list').prepend(listclone);
			}
			else
			{
				var listclone = this.listPrototype.children().clone();
				listclone.attr('mosaic_id', this.id);
				listclone.children('img').attr('src', this.filepath);
				$('#mosaic_module_list').append(listclone);
			}
			this.listHandle = $('#mosaic_module_list').find('.mosaic_module_list_item[mosaic_id=' + this.id + ']');
			this.moduleHandle = this.parent.find('.mosaic[mosaic_id=' + this.id + ']');
			this.imageHandle = this.moduleHandle.find('.mosaic_content_image');
			this.toolsHandle = this.moduleHandle.find('.mosaic_tools');
			
			this.moduleHandle.removeAttr('db_id');
			
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
					//containment: "#mosaic_item",
					aspectRatio: this.width/this.height,
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
				'filepath': this.filepath,
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
				
				this.dialogHandle.find('button').button(); // style buttons on dialog
				
				// filemanager events
				this.filemanagerWidth = 0;
				this.filemanagerHeight = 0;
				$('.filemanager').on('click', function()
				{
					openFilemanager('image' ,$(this).parent().parent().parent().parent().parent().parent().attr('dialogId'));
				});
				
				// set image
				this.dialogHandle.find('.popup_module_image_preview').attr('src', this.filepath);
				
				
				
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
		
		filemanagerResult: function(fileData)
		{
			this.dialogHandle.find('.popup_module_image_preview').attr('src', fileData.fullPath);
			
			var mod = this;
			this.dialogHandle.find('.popup_module_image_preview').imagesLoaded().done(function(imagesLoaded)
			{
				var nat_width = imagesLoaded.images[0].img.naturalWidth;
				var nat_height = imagesLoaded.images[0].img.naturalHeight;
				var ratio = nat_width / nat_height;
				if(nat_width > nat_height) // landscape
				{
					mod.filemanagerWidth = mod.width;
					mod.filemanagerHeight = mod.filemanagerWidth / ratio;
				}
				else // portrait
				{
					mod.filemanagerHeight = mod.height;
					mod.filemanagerWidth = mod.filemanagerHeight * ratio;
				}
			});
			// fit the new image into the existing module
			
			
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
			this.filepath = this.dialogHandle.find('.popup_module_image_preview').attr('src');
			this.imageHandle.attr('src', this.filepath);
			this.listHandle.find('img').attr('src', this.filepath);
			this.posX = this.dialogHandle.find('.posX').val();
			this.posY = this.dialogHandle.find('.posY').val();
			//this.width = this.dialogHandle.find('.width').val();
			//this.height = this.dialogHandle.find('.height').val();
			if(this.filemanagerHeight != 0 && this.filemanagerWidth != 0)
			{
				this.width = this.filemanagerWidth;
				this.height = this.filemanagerHeight;
				this.moduleHandle.resizable( "option", "aspectRatio", this.width/this.height );
			}
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
	
	return module_image;
}