/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl = '/src/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/src/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/src/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/src/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/src/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/src/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    config.allowedContent = true;
};
