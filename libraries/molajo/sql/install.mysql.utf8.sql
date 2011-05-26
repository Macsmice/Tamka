/* configuration table */
CREATE TABLE IF NOT EXISTS `#__molajo_configuration` (
  `component_option` varchar(100) NOT NULL DEFAULT '',
  `option_id` int(10) unsigned NOT NULL DEFAULT '0',
  `option_value` varchar(100) NOT NULL DEFAULT '',
  `option_value_literal` varchar(255) NOT NULL DEFAULT ' ',
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_component_option_id_value_key` (`component_option`,`option_id`,`option_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* 001 MOLAJO_CONFIG_OPTION_ID_FIELDS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 1, '', '', 0),
('com_molajo', 1, 'access', 'MOLAJO_FIELD_ACCESS_LABEL', 1),
('com_molajo', 1, 'alias', 'MOLAJO_FIELD_ALIAS_LABEL', 2),
('com_molajo', 1, 'asset_id', 'MOLAJO_FIELD_ASSET_ID_LABEL', 3),
('com_molajo', 1, 'attribs', 'MOLAJO_FIELD_ATTRIBS_LABEL', 4),
('com_molajo', 1, 'catid', 'MOLAJO_FIELD_CATID_LABEL', 5),
('com_molajo', 1, 'checked_out', 'MOLAJO_FIELD_CHECKED_OUT_LABEL', 6),
('com_molajo', 1, 'checked_out_time', 'MOLAJO_FIELD_CHECKED_OUT_TIME_LABEL', 7),
('com_molajo', 1, 'component_id', 'MOLAJO_FIELD_COMPONENT_ID_LABEL', 8),
('com_molajo', 1, 'component_option', 'MOLAJO_FIELD_COMPONENT_OPTION_LABEL', 9),
('com_molajo', 1, 'content_email_address', 'MOLAJO_FIELD_CONTENT_EMAIL_ADDRESS_LABEL', 10),
('com_molajo', 1, 'content_file', 'MOLAJO_FIELD_CONTENT_FILE_LABEL', 11),
('com_molajo', 1, 'content_link', 'MOLAJO_FIELD_CONTENT_LINK_LABEL', 12),
('com_molajo', 1, 'content_numeric_value', 'MOLAJO_FIELD_CONTENT_NUMERIC_VALUE_LABEL', 13),
('com_molajo', 1, 'content_text', 'MOLAJO_FIELD_CONTENT_TEXT_LABEL', 14),
('com_molajo', 1, 'content_type', 'MOLAJO_FIELD_CONTENT_TYPE_LABEL', 15),
('com_molajo', 1, 'created', 'MOLAJO_FIELD_CREATED_LABEL', 16),
('com_molajo', 1, 'created_by', 'MOLAJO_FIELD_CREATED_BY_LABEL', 17),
('com_molajo', 1, 'created_by_alias', 'MOLAJO_FIELD_CREATED_BY_ALIAS_LABEL', 18),
('com_molajo', 1, 'created_by_email', 'MOLAJO_FIELD_CREATED_BY_EMAIL_LABEL', 19),
('com_molajo', 1, 'created_by_ip_address', 'MOLAJO_FIELD_CREATED_BY_IP_ADDRESS_LABEL', 20),
('com_molajo', 1, 'created_by_referer', 'MOLAJO_FIELD_CREATED_BY_REFERER_LABEL', 21),
('com_molajo', 1, 'created_by_website', 'MOLAJO_FIELD_CREATED_BY_WEBSITE_LABEL', 22),
('com_molajo', 1, 'featured', 'MOLAJO_FIELD_FEATURED_LABEL', 23),
('com_molajo', 1, 'id', 'MOLAJO_FIELD_ID_LABEL', 24),
('com_molajo', 1, 'language', 'MOLAJO_FIELD_LANGUAGE_LABEL', 25),
('com_molajo', 1, 'level', 'MOLAJO_FIELD_LEVEL_LABEL', 26),
('com_molajo', 1, 'lft', 'MOLAJO_FIELD_LFT_LABEL', 27),
('com_molajo', 1, 'metadata', 'MOLAJO_FIELD_METADATA_LABEL', 28),
('com_molajo', 1, 'metadesc', 'MOLAJO_FIELD_METADESC_LABEL', 29),
('com_molajo', 1, 'metakey', 'MOLAJO_FIELD_METAKEY_LABEL', 30),
('com_molajo', 1, 'meta_author', 'MOLAJO_FIELD_META_AUTHOR_LABEL', 31),
('com_molajo', 1, 'meta_rights', 'MOLAJO_FIELD_META_RIGHTS_LABEL', 32),
('com_molajo', 1, 'meta_robots', 'MOLAJO_FIELD_META_ROBOTS_LABEL', 33),
('com_molajo', 1, 'modified', 'MOLAJO_FIELD_MODIFIED_LABEL', 34),
('com_molajo', 1, 'modified_by', 'MOLAJO_FIELD_MODIFIED_BY_LABEL', 35),
('com_molajo', 1, 'ordering', 'MOLAJO_FIELD_ORDERING_LABEL', 36),
('com_molajo', 1, 'publish_down', 'MOLAJO_FIELD_PUBLISH_DOWN_LABEL', 37),
('com_molajo', 1, 'publish_up', 'MOLAJO_FIELD_PUBLISH_UP_LABEL', 38),
('com_molajo', 1, 'rgt', 'MOLAJO_FIELD_RGT_LABEL', 39),
('com_molajo', 1, 'state', 'MOLAJO_FIELD_STATE_LABEL', 40),
('com_molajo', 1, 'state_prior_to_version', 'MOLAJO_FIELD_STATE_PRIOR_TO_VERSION_LABEL', 41),
('com_molajo', 1, 'stickied', 'MOLAJO_FIELD_STICKIED_LABEL', 42),
('com_molajo', 1, 'user_default', 'MOLAJO_FIELD_USER_DEFAULT_LABEL', 43),
('com_molajo', 1, 'category_default', 'MOLAJO_FIELD_CATEGORY_DEFAULT_LABEL', 43),
('com_molajo', 1, 'title', 'MOLAJO_FIELD_TITLE_LABEL', 43),
('com_molajo', 1, 'version', 'MOLAJO_FIELD_VERSION_LABEL', 44),
('com_molajo', 1, 'version_of_id', 'MOLAJO_FIELD_VERSION_OF_ID_LABEL', 45);

/* 002 MOLAJO_CONFIG_OPTION_ID_EDITSTATE_FIELDS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 2, '', '', 0),
('com_molajo', 2, 'access', 'MOLAJO_FIELD_ACCESS_LABEL', 1),
('com_molajo', 2, 'featured', 'MOLAJO_FIELD_FEATURED_LABEL', 2),
('com_molajo', 2, 'ordering', 'MOLAJO_FIELD_ORDERING_LABEL', 3),
('com_molajo', 2, 'publish_down', 'MOLAJO_FIELD_PUBLISH_DOWN_LABEL', 4),
('com_molajo', 2, 'publish_up', 'MOLAJO_FIELD_PUBLISH_UP_LABEL', 5),
('com_molajo', 2, 'state', 'MOLAJO_FIELD_STATE_LABEL', 6),
('com_molajo', 2, 'stickied', 'MOLAJO_FIELD_STICKIED_LABEL', 7);

/* 003 MOLAJO_CONFIG_OPTION_ID_JSON_FIELDS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 3, '', '', 0),
('com_molajo', 3, 'attribs', 'MOLAJO_FIELD_ATTRIBS_LABEL', 1),
('com_molajo', 3, 'metadata', 'MOLAJO_FIELD_METADATA_LABEL', 2),
('com_molajo', 3, 'params', 'MOLAJO_FIELD_PARAMETERS_LABEL', 3);

/* 010 MOLAJO_CONFIG_OPTION_ID_CONTENT_TYPES */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 10, '', '', 0),
('com_molajo', 10, 'content_type', 'Content Type', 1);

/* VIEWS */

/* 020 MOLAJO_CONFIG_OPTION_ID_VIEW_PAIRS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 20, '', '', 0),
('com_molajo', 20, 'single', 'multiple', 1);

/* TABLE */

/* 045 MOLAJO_CONFIG_OPTION_ID_TABLE */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 45, '', '', 0),
('com_molajo', 45, '__multiple', '__multiple', 1);

/* FORMAT */

/* 075 MOLAJO_CONFIG_OPTION_ID_FORMAT */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 75, '', '', 0),
('com_molajo', 75, 'html', 'html', 1),
('com_molajo', 75, 'raw', 'raw', 2),
('com_molajo', 75, 'feed', 'feed', 3);

/* TASKS */;

/* 080 MOLAJO_CONFIG_OPTION_ID_DISPLAY_CONTROLLER_TASKS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 80, '', '', 0),
('com_molajo', 80, 'add', 'add', 1),
('com_molajo', 80, 'edit', 'edit', 2),
('com_molajo', 80, 'display', 'display', 3);

/** 085 MOLAJO_CONFIG_OPTION_ID_SINGLE_CONTROLLER_TASKS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 85, '', '', 0),
('com_molajo', 85, 'apply', 'apply', 1),
('com_molajo', 85, 'cancel', 'cancel', 2),
('com_molajo', 85, 'create', 'create', 3),
('com_molajo', 85, 'save', 'save', 4),
('com_molajo', 85, 'save2copy', 'save2copy', 5),
('com_molajo', 85, 'save2new', 'save2new', 6),
('com_molajo', 85, 'restore', 'restore', 7);

/** 090 MOLAJO_CONFIG_OPTION_ID_MULTIPLE_CONTROLLER_TASKS **/
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 90, '', '', 0),
('com_molajo', 90, 'archive', 'archive', 1),
('com_molajo', 90, 'publish', 'publish', 2),
('com_molajo', 90, 'unpublish', 'unpublish', 3),
('com_molajo', 90, 'spam', 'spam', 4),
('com_molajo', 90, 'trash', 'trash', 5),
('com_molajo', 90, 'feature', 'feature', 6),
('com_molajo', 90, 'unfeature', 'unfeature', 7),
('com_molajo', 90, 'sticky', 'sticky', 8),
('com_molajo', 90, 'unsticky', 'unsticky', 9),
('com_molajo', 90, 'checkin', 'checkin', 10),
('com_molajo', 90, 'reorder', 'reorder', 11),
('com_molajo', 90, 'orderup', 'orderup', 12),
('com_molajo', 90, 'orderdown', 'orderdown', 13),
('com_molajo', 90, 'saveorder', 'saveorder', 14),
('com_molajo', 90, 'delete', 'delete', 15),
('com_molajo', 90, 'copy', 'copy', 16),
('com_molajo', 90, 'move', 'move', 17);

/** 100 MOLAJO_CONFIG_OPTION_ID_TASK_ACL_METHODS **/
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 100, '', '', 0),
('com_molajo', 100, 'add', 'core.create', 1),
('com_molajo', 100, 'admin', 'core.admin', 2),
('com_molajo', 100, 'apply', 'core.edit', 3),
('com_molajo', 100, 'archive', 'core.edit.state', 4),
('com_molajo', 100, 'cancel', '', 5),
('com_molajo', 100, 'checkin', 'core.checkin', 6),
('com_molajo', 100, 'close', '', 7),
('com_molajo', 100, 'copy', 'core.create', 8),
('com_molajo', 100, 'create', 'core.create', 9),
('com_molajo', 100, 'delete', 'core.delete', 10),
('com_molajo', 100, 'display', 'core.view', 11),
('com_molajo', 100, 'edit', 'core.edit', 12),
('com_molajo', 100, 'editstate', 'core.edit.state', 13),
('com_molajo', 100, 'feature', 'core.edit.state', 14),
('com_molajo', 100, 'manage', 'core.manage', 15),
('com_molajo', 100, 'move', 'core.edit', 16),
('com_molajo', 100, 'orderdown', 'core.edit.state', 18),
('com_molajo', 100, 'orderup', 'core.edit.state', 19),
('com_molajo', 100, 'publish', 'core.edit.state', 20),
('com_molajo', 100, 'reorder', 'core.edit.state', 21),
('com_molajo', 100, 'restore', 'core.edit.state', 22),
('com_molajo', 100, 'save', 'core.edit', 23),
('com_molajo', 100, 'save2copy', 'core.edit', 24),
('com_molajo', 100, 'save2new', 'core.edit', 25),
('com_molajo', 100, 'saveorder', 'core.edit.state', 26),
('com_molajo', 100, 'search', '', 27),
('com_molajo', 100, 'spam', 'core.edit.state', 28),
('com_molajo', 100, 'state', 'core.edit.state', 29),
('com_molajo', 100, 'sticky', 'core.edit.state', 30),
('com_molajo', 100, 'trash', 'core.edit.state', 31),
('com_molajo', 100, 'unfeature', 'core.edit.state', 32),
('com_molajo', 100, 'unpublish', 'core.edit.state', 33),
('com_molajo', 100, 'unsticky', 'core.edit.state', 34);

/** 110 MOLAJO_CONFIG_OPTION_ID_ACL_IMPLEMENTATION **/
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 110, '', '', 0),
('com_molajo', 110, 'core', 'Joomla! Core ACL', 1);

/** 120 MOLAJO_CONFIG_OPTION_ID_ACL_ITEM_TESTS **/
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 120, '', '', 0),
('com_molajo', 120, 'display', 'display', 1),
('com_molajo', 120, 'edit', 'edit', 2),
('com_molajo', 120, 'editstate', 'editstate', 3),
('com_molajo', 120, 'trash', 'trash', 4),
('com_molajo', 120, 'delete', 'delete', 5),
('com_molajo', 120, 'restore', 'restore', 6);

/* 200 MOLAJO_CONFIG_OPTION_ID_LIST_TOOLBAR_BUTTONS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 200, '', '', 0),
('com_molajo', 200, 'archive', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_ARCHIVE', 1),
('com_molajo', 200, 'checkin', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_CHECKIN', 2),
('com_molajo', 200, 'delete', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_DELETE', 3),
('com_molajo', 200, 'edit', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_EDIT', 4),
('com_molajo', 200, 'feature', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_FEATURE', 5),
('com_molajo', 200, 'help', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_HELP', 6),
('com_molajo', 200, 'new', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_NEW', 7),
('com_molajo', 200, 'options', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_OPTIONS', 8),
('com_molajo', 200, 'publish', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_PUBLISH', 9),
('com_molajo', 200, 'restore', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_RESTORE', 10),
('com_molajo', 200, 'separator', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SEPARATOR', 11),
('com_molajo', 200, 'spam', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SPAM', 12),
('com_molajo', 200, 'sticky', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_STICKY', 13),
('com_molajo', 200, 'trash', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_TRASH', 14),
('com_molajo', 200, 'unpublish', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_UNPUBLISH', 15);

/* 210 MOLAJO_CONFIG_OPTION_ID_EDIT_TOOLBAR_BUTTONS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 210, '', '', 0),
('com_molajo', 210, 'apply', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_APPLY', 1),
('com_molajo', 210, 'close', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_CLOSE', 2),
('com_molajo', 210, 'help', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_HELP', 3),
('com_molajo', 210, 'restore', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_RESTORE', 4),
('com_molajo', 210, 'save', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SAVE', 5),
('com_molajo', 210, 'save2new', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SAVE_AND_NEW', 6),
('com_molajo', 210, 'save2copy', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SAVE_AS_COPY', 7),
('com_molajo', 210, 'separator', 'MOLAJO_CONFIG_MANAGER_OPTION_BUTTON_SEPARATOR', 8);

/* 220 MOLAJO_CONFIG_OPTION_ID_TOOLBAR_SUBMENU_LINKS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 220, '', '', 0),
('com_molajo', 220, 'category', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_CATEGORY', 1),
('com_molajo', 220, 'default', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_DEFAULT', 2),
('com_molajo', 220, 'featured', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_FEATURED', 3),
('com_molajo', 220, 'revisions', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_REVISIONS', 4),
('com_molajo', 220, 'stickied', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_STICKIED', 5),
('com_molajo', 220, 'unpublished', 'MOLAJO_CONFIG_MANAGER_SUB_MENU_UNPUBLISHED', 6);

/* 230 MOLAJO_CONFIG_OPTION_ID_LISTBOX_FILTER */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 230, '', '', 0),
('com_molajo', 230, 'access', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_ACCESS', 1),
('com_molajo', 230, 'alias', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_ALIAS', 2),
('com_molajo', 230, 'created_by', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_AUTHOR', 3),
('com_molajo', 230, 'catid', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_CATEGORY', 4),
('com_molajo', 230, 'content_type', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_CONTENT_TYPE', 5),
('com_molajo', 230, 'created', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_CREATE_DATE', 6),
('com_molajo', 230, 'featured', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_FEATURED', 7),
('com_molajo', 230, 'language', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_LANGUAGE', 9),
('com_molajo', 230, 'modified', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_UPDATE_DATE', 10),
('com_molajo', 230, 'publish_up', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_PUBLISH_DATE', 11),
('com_molajo', 230, 'state', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_STATE', 12),
('com_molajo', 230, 'stickied', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_STICKIED', 13),
('com_molajo', 230, 'title', 'MOLAJO_CONFIG_MANAGER_OPTION_FILTER_TITLE', 14);

/* 240 MOLAJO_CONFIG_OPTION_ID_EDITOR_BUTTONS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 240, '', '', 0),
('com_molajo', 240, 'article', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_ARTICLE', 1),
('com_molajo', 240, 'audio', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_AUDIO', 2),
('com_molajo', 240, 'file', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_FILE', 3),
('com_molajo', 240, 'gallery', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_GALLERY', 4),
('com_molajo', 240, 'image', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_IMAGE', 5),
('com_molajo', 240, 'pagebreak', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_PAGEBREAK', 6),
('com_molajo', 240, 'readmore', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_READMORE', 7),
('com_molajo', 240, 'video', 'MOLAJO_CONFIG_MANAGER_EDITOR_BUTTON_VIDEO', 8);

/* 250 MOLAJO_CONFIG_OPTION_ID_STATE */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 250, '', '', 0),
('com_molajo', 250, '2', 'MOLAJO_OPTION_ARCHIVED', 1),
('com_molajo', 250, '1', 'MOLAJO_OPTION_PUBLISHED', 2),
('com_molajo', 250, '0', 'MOLAJO_OPTION_UNPUBLISHED', 3),
('com_molajo', 250, '-1', 'MOLAJO_OPTION_TRASHED', 4),
('com_molajo', 250, '-2', 'MOLAJO_OPTION_SPAMMED', 5),
('com_molajo', 250, '-10', 'MOLAJO_OPTION_VERSION', 6);

/* 500 MOLAJO_CONFIG_OPTION_ID_PARAMETERS_LAYOUTS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_molajo', 500, '', '', 0),
('com_molajo', 500, 'article', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_ARTICLE', 1),
('com_molajo', 500, 'banner', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_BANNER', 2),
('com_molajo', 500, 'contact', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_CONTACT', 3),
('com_molajo', 500, 'contact_form', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_CONTACT_FORM', 4),
('com_molajo', 500, 'media', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_MEDIA', 5),
('com_molajo', 500, 'newsfeed', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_NEWSFEED', 6),
('com_molajo', 500, 'item', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_ITEM', 7),
('com_molajo', 500, 'user', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_USER', 8),
('com_molajo', 500, 'weblink', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_WEBLINK', 9),
('com_molajo', 500, 'category', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_CATEGORY', 10),
('com_molajo', 500, 'blog', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_BLOG', 11),
('com_molajo', 500, 'integration', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_INTEGRATION', 12),
('com_molajo', 500, 'list', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_LIST', 13),
('com_molajo', 500, 'manager', 'MOLAJO_CONFIG_ITEM_LAYOUT_PARAMETER_MANAGER', 14);