/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.filebrowserBrowseUrl = '../../public/ckfinder/ckfinder.html'; 
	config.filebrowserImageBrowseUrl = '../../public/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = '../../public/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	config.filebrowserWindowWidth = '800'; 
	config.filebrowserWindowHeight = '500'; 
	
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	//REMOVE IMAGEM
	//config.removePlugins = 'image';

	// VIDEO DO YOUTUBE 
	config.extraPlugins = 'youtube';
	
	//=== CONFIGURACAO VIDEO ===
	//Video width:
	config.youtube_width = '640';
	
	//Video height:
	config.youtube_height = '480';
	
	//Show related videos:
	config.youtube_related = true;
	
	//Use old embed code:
	config.youtube_older = false;
	
	//Enable privacy-enhanced mode:
	config.youtube_privacy = false;
		

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Font,FontSize,Flash,Smiley,Iframe,PageBreak,Find,Replace,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Superscript,Subscript,CreateDiv,Language,ShowBlocks,Save,NewPage,Preview,Print,Templates,BidiRtl,BidiLtr,TextColor,BGColor';
		

	// Set the most common block elements.
	//config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
