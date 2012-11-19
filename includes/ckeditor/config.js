/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
  config.height = '120';
  config.width = '95%';
  config.toolbar = 'Full';

  config.toolbar_Full =
  [
      ['Source'],
      ['Cut','Copy','Paste'],
      ['Bold','Italic'],
      ['NumberedList','BulletedList'],
  ];

};