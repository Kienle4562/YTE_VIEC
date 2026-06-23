/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	 config.language = 'vi';
	 config.entermode = 'div';
	 config.enterMode = CKEDITOR.ENTER_DIV;
	// config.uiColor = '#AADC6E';
	
	config.resize_enabled = true;
    config.toolbarCanCollapse = true;
	
	config.filebrowserBrowseUrl = CKEDITOR.basePath + 'myfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = CKEDITOR.basePath + 'myfinder/ckfinder.html?Type=images';
	config.filebrowserFlashBrowseUrl = CKEDITOR.basePath + 'myfinder/ckfinder.html?Type=flash';
	config.filebrowserUploadUrl = CKEDITOR.basePath + 'myfinder/core/connector/php/connector.php?command=QuickUpload&type=files';
	config.filebrowserImageUploadUrl = CKEDITOR.basePath + 'myfinder/core/connector/php/connector.php?command=QuickUpload&type=images';
	config.filebrowserFlashUploadUrl = CKEDITOR.basePath + 'myfinder/core/connector/php/connector.php?command=QuickUpload&type=flash';
	//filebrowserWindowWidth : '1000',
 	//filebrowserWindowHeight : '700'
	
	// config Toolbar
	config.toolbar = 'MyToolbar';

    config.toolbar_MyToolbar =
    [
        ['Source','NewPage','Preview','Templates'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','Scayt'],
        ['Undo','Redo','Find','Replace','SelectAll','RemoveFormat'],
        ['Bold','Italic','Strike','NumberedList','BulletedList','Outdent','Indent','Blockquote'],
        ['Link','Unlink','Anchor','Maximize','About','TextColor','BGColor','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],		
        ['Styles','Format','FontSize'],		
    ];
	
	config.toolbar = 'Full';

	config.toolbar_Full =
	[
		['Source','-','Save','NewPage','Preview','-','Templates'],
		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
		['BidiLtr', 'BidiRtl'],
		'/',
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Anchor'],
		['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
		'/',
		['Styles','Format','Font','FontSize'],
		['TextColor','BGColor'],
		['Maximize', 'ShowBlocks','-','About']
	];
	
	config.toolbar = 'Basic';
	
	config.toolbar_Basic =
	[
		['Source'],
        ['Bold', 'Italic','Underline','-', 'NumberedList', 'BulletedList','TextColor','BGColor','Styles'],
        ['Format','Font','FontSize'],
        ['Link','Unlink','Anchor'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Table']
	];

};
