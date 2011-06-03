# $Id: molajo.sql

# Changes to core
# removed the following tables from the installation script:
#
# [#25685] __update_categories table installed but never used - Amy Stephen removed from molajo.sql
# [#25636] Database stored session data easily overflows forcing a silent session failure and logout on admin side
# [#25307] Improper datatypes in database
# [#24792] onContentPrepareData event is not implemented in all components generating forms to allow manipulation of the form data
#

#
# Table structure for table `#__molajo_configuration`
#
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

#
# Table structure for table `#__assets`
#

CREATE TABLE IF NOT EXISTS `#__assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` TEXT NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) DEFAULT CHARSET=utf8;


INSERT INTO `#__assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`)
VALUES
(1,0,1,43, 0, 'root.1', 'Root Asset', '{"core.login.site":{"4":1,"3":1},"core.login.admin":{"4":1},"core.admin":{"4":1},"core.manage":{"4":1},"core.create":{"4":1,"3":1},"core.delete":{"4":1},"core.edit":{"4":1},"core.edit.state":{"4":1},"core.edit.own":{"4":1,"3":1}}'),
(2,1,2,3,1,'com_admin','com_admin','{}'),
(3,1,4,9,1,'com_articles', 'com_article', '{"core.admin":{"4":1},"core.create":{"3":1},"core.manage":{"3":1},"core.view":{"1":1},"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":{"3":1}}'),
(4,3,5,8,2,'com_articles.category.2', 'Uncategorised', '{"core.view":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(5,4,6,7,3,'com_articles.article.1', 'My First Article', '{"core.view":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(6,1,7,8,1,'com_cache','com_cache','{}'),
(7,1,9,10,1,'com_checkin','com_checkin','{}'),
(8,1,11,12,1,'com_config','com_config','{}'),
(9,1,13,14,1,'com_cpanel','com_cpanel','{}'),
(10,1,15,16,1,'com_installer','com_installer','{}'),
(11,1,17,18,1,'com_languages','com_languages','{}'),
(12,1,19,20,1,'com_login','com_login','{}'),
(13,1,21,26,1,'com_media', 'com_article', '{"core.admin":{"4":1},"core.create":{"3":1},"core.manage":{"3":1},"core.view":{"1":1},"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":{"3":1}}'),
(14,13,22,25,2,'com_media.category.3', 'Uncategorised', '{"core.view":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(15,14,23,24,3,'com_media.media.1', 'My First Image', '{"core.view":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(16,1,27,28,1,'com_menus','com_menus','{}'),
(17,1,29,30,1,'com_messages','com_messages','{}'),
(18,1,31,32,1,'com_modules','com_modules','{}'),
(19,1,33,34,1,'com_plugins','com_plugins','{}'),
(20,1,35,36,1,'com_redirect','com_redirect','{}'),
(21,1,37,38,1,'com_search','com_search','{}'),
(22,1,39,40,1,'com_templates','com_templates','{}'),
(23,1,41,42,1,'com_users','com_users','{}');

#
# Table structure for table `#__articles`
#

CREATE TABLE IF NOT EXISTS `#__articles` (
  `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `catid` INT (11) NOT NULL COMMENT 'Category ID associated with the Primary Key',

  `title` VARCHAR (255) NOT NULL COMMENT 'Title',
  `alias` VARCHAR (255) NOT NULL COMMENT 'URL Alias',

  `content_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Content Type: Links to #__molajo_configuration.option_id = 10 and component_option values matching ',

  `content_text` MEDIUMTEXT NULL COMMENT 'Content Primary Text Field, can include break to designate Introductory and Full text',
  `content_link` VARCHAR (2083) NULL COMMENT 'Content Link for Weblink or Newsfeed Field',
  `content_email_address` VARCHAR (255) NULL COMMENT 'Content Email Field',
  `content_numeric_value` TINYINT (3) NULL COMMENT 'Content Numeric Value, ex. vote on poll',
  `content_file` VARCHAR (255) NOT NULL DEFAULT '' COMMENT 'Content Network Path to File',

  `featured` boolean NOT NULL DEFAULT '0' COMMENT 'Featured 1-Featured 0-Not Featured',
  `stickied` boolean NOT NULL DEFAULT '0' COMMENT 'Stickied 1-Stickied 0-Not Stickied',
  `user_default` boolean NOT NULL DEFAULT '0' COMMENT 'User Default 1-Default 0-Not Default',
  `category_default` boolean NOT NULL DEFAULT '0' COMMENT 'Category Default 1-Default 0-Not Default',
  `language` CHAR (7) NOT NULL DEFAULT '' COMMENT 'Language',
  `ordering` INT (11) NOT NULL DEFAULT '0' COMMENT 'Ordering',

  `state` TINYINT (3) NOT NULL DEFAULT '0' COMMENT 'Published State 2: Archived 1: Published 0: Unpublished -1: Trashed -2: Spam -10 Version',
  `publish_up` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Publish Begin Date and Time',
  `publish_down` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Publish End Date and Time',
  `version` INTEGER UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Version Number',
  `version_of_id` INT (11) NULL COMMENT 'Category ID associated with the Primary Key',
  `state_prior_to_version` INTEGER UNSIGNED NULL COMMENT 'State value prior to creating this version copy and changing the state to Version',

  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Created Date and Time',
  `created_by` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by User ID',
  `created_by_alias` VARCHAR (255) NOT NULL DEFAULT '' COMMENT 'Created by Alias',
  `created_by_email` VARCHAR (255) NULL COMMENT 'Created By Email Address',
  `created_by_website` VARCHAR (255) NULL COMMENT 'Created By Website',
  `created_by_ip_address` CHAR(15) NULL COMMENT 'Created By IP Address',
  `created_by_referer` VARCHAR (255) NULL COMMENT 'Created By Referer',

  `modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Modified Date',
  `modified_by` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Modified By User ID',

  `checked_out` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Checked out by User Id',
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Checked out Date and Time',

  `asset_id` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK to the #__assets table.',
  `access` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'View Level Access',

  `component_option` VARCHAR(50) NOT NULL COMMENT 'Component Option Value',
  `component_id` INT (11) NOT NULL COMMENT 'Primary Key for Component Content',
  `parent_id` INT (11) NULL COMMENT 'Nested set parent',
  `lft` INT (11) NULL COMMENT 'Nested set lft',
  `rgt` INT (11) NULL COMMENT 'Nested set rgt',
  `level` INT (11) NULL DEFAULT '0' COMMENT 'The cached level in the nested tree',

  `metakey` TEXT NULL COMMENT 'Meta Key',
  `metadesc` TEXT NULL COMMENT 'Meta Description',
  `metadata` TEXT NULL COMMENT 'Meta Data',

  `attribs` TEXT NULL COMMENT 'Attributes (Custom Fields)',

  `params` TEXT NULL COMMENT 'Parameters (Content Detail Parameters)',

  PRIMARY KEY  (`id`),

  KEY `idx_component_component_id_id` (`component_option`, `component_id`, `id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_stickied_catid` (`stickied`,`catid`),
  KEY `idx_language` (`language`)

) DEFAULT CHARSET=utf8;

INSERT INTO `#__articles` (`id`, `catid`, `title`, `alias`, `content_type`, `content_text`, `content_link`, `content_email_address`, `content_numeric_value`, `content_file`, `featured`, `stickied`, `language`, `ordering`, `state`, `publish_up`, `publish_down`, `version`, `version_of_id`, `state_prior_to_version`, `created`, `created_by`, `created_by_alias`, `created_by_email`, `created_by_website`, `created_by_ip_address`, `created_by_referer`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `asset_id`, `access`, `component_option`, `component_id`, `parent_id`, `lft`, `rgt`, `level`, `metakey`, `metadesc`, `metadata`, `attribs`, `params`) VALUES
(1, 0, 'My First Article', 'my-first-article', 10, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', NULL, NULL, NULL, '', 1, 1, '*', 1, 1, '2011-03-06 00:00:00', '0000-00-00 00:00:00', 1, NULL, NULL, '2011-03-06 00:00:00', 42, 'Harry Potter', 'HarryPotter@example.com', 'http://example.com', '127.1.0.0', 'http://example.com', '2011-03-06 00:00:00', 42, 0, '0000-00-00 00:00:00', 0, 1, '', 0, 0, NULL, NULL, 0, '', '', '{"robots":"1","author":"","rights":""}', '{"text_entry_tag":"","tags":[""],"tag_category":[""]}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","alternative_readmore":"","article_layout":""}');

/* FIELDS */

/* 010 MOLAJO_CONFIG_OPTION_ID_CONTENT_TYPES */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_articles', 10, '', '', 0),
('com_articles', 10, 'articles', 'Articles', 1);

/* VIEWS */

/* 020 MOLAJO_CONFIG_OPTION_ID_VIEW_PAIRS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_articles', 20, '', '', 0),
('com_articles', 20, 'article', 'articles', 1);

/* TABLE */

/* 045 MOLAJO_CONFIG_OPTION_ID_TABLE */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_articles', 45, '', '', 0),
('com_articles', 45, '__articles', '__articles', 1);

/* 050 MOLAJO_CONFIG_OPTION_ID_EDIT_LAYOUTS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_articles', 50, '', '', 0),
('com_articles', 50, 'article', 'article', 1);

/* 060 MOLAJO_CONFIG_OPTION_ID_DEFAULT_LAYOUT */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_articles', 60, '', '', 0),
('com_articles', 60, 'articles', 'articles', 1);

#
# Table structure for table `#__categories`
#

CREATE TABLE `#__categories` (
  `id` int(11) NOT NULL auto_increment,
  `asset_id` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL default '0',
  `lft` int(11) NOT NULL default '0',
  `rgt` int(11) NOT NULL default '0',
  `level` int(10) unsigned NOT NULL default '0',
  `path` varchar(255) NOT NULL default '',
  `extension` varchar(50) NOT NULL default '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `note` varchar(255) NOT NULL default '',
  `description` TEXT NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `params` TEXT NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL default '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL default '0',
  `modified_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL default '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  INDEX `idx_language` (`language`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__categories` VALUES
(1, 1, 0, 0, 5, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2009-10-18 16:07:09', 0, '0000-00-00 00:00:00', 0, '*'),
(2, 3, 1, 1, 2, 1, 'uncategorised', 'com_articles', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:26:37', 0, '0000-00-00 00:00:00', 0, '*'),
(3, 13, 1, 3, 4, 1, 'uncategorised', 'com_media', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*');

# -------------------------------------------------------

#
# Table structure for table `#__extensions`
#

CREATE TABLE `#__extensions` (
  `extension_id` INT  NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100)  NOT NULL,
  `type` VARCHAR(20)  NOT NULL,
  `element` VARCHAR(100) NOT NULL,
  `folder` VARCHAR(100) NOT NULL,
  `client_id` TINYINT(3) NOT NULL,
  `enabled` TINYINT(3) NOT NULL DEFAULT '1',
  `access` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1',
  `protected` TINYINT(3) NOT NULL DEFAULT '0',
  `manifest_cache` TEXT  NOT NULL,
  `params` MEDIUMTEXT NOT NULL,
  `custom_data` MEDIUMTEXT NOT NULL,
  `system_data` MEDIUMTEXT NOT NULL,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) default '0',
  `state` int(11) default '0',
  PRIMARY KEY (`extension_id`),
  INDEX `element_clientid`(`element`, `client_id`),
  INDEX `element_folder_clientid`(`element`, `folder`, `client_id`),
  INDEX `extension`(`type`,`element`,`folder`,`client_id`)
) AUTO_INCREMENT=10000 CHARACTER SET utf8;

INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 1, 1),
(2, 'com_articles', 'component', 'com_articles', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 2, 1),
(3, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 3, 1),
(4, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 4, 1),
(5, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 5, 1),
(6, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 6, 1),
(7, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 7, 1),
(8, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 2),
(9, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 9, 1),
(10, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 10, 1),
(11, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html","enable_flash":"0"}', '', '', 0, '0000-00-00 00:00:00', 11, 1),
(12, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 12, 1),
(13, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 13, 1),
(14, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 14, 1),
(15, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 15, 1),
(16, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 16, 1),
(17, 'com_search', 'component', 'com_search', '', 1, 1, 1, 1, '', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 17, 1),
(18, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 18, 1),
(19, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '', '{"allowUserRegistration":"1","new_usertype":"2","useractivation":"1","frontend_userparams":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 19, 1);

UPDATE `#__extensions`
SET params = '{"config_component_tags":"1","config_component_tag_categories":"1","config_component_state_spam":"0","config_component_enable_comments":"1","config_component_version_management":"1","config_component_maintain_version_count":5,"config_component_retain_versions_after_delete":"1","config_component_uninstall":"1","config_component_single_item_parameter1":"item","config_component_single_item_parameter2":"0","config_component_single_item_parameter3":"0","config_component_single_item_parameter4":"0","config_component_single_item_parameter5":"0","config_component_candy_editor_parameter1":"item","config_component_candy_editor_parameter2":"0","config_component_candy_editor_parameter3":"0","config_component_candy_editor_parameter4":"0","config_component_candy_editor_parameter5":"0","config_component_candy_default_parameter1":"item","config_component_candy_default_parameter2":"0","config_component_candy_default_parameter3":"0","config_component_candy_default_parameter4":"0","config_component_candy_default_parameter5":"0","config_component_land_blog_parameter1":"category","config_component_land_blog_parameter2":"blog","config_component_land_blog_parameter3":"item","config_component_land_blog_parameter4":"integration","config_component_land_blog_parameter5":"0","config_component_land_default_parameter1":"category","config_component_land_default_parameter2":"list","config_component_land_default_parameter3":"item","config_component_land_default_parameter4":"integration","config_component_land_default_parameter5":"0","config_manager_title":"1","config_manager_button_bar_option1":"new","config_manager_button_bar_option2":"edit","config_manager_button_bar_option3":"checkin","config_manager_button_bar_option4":"separator","config_manager_button_bar_option5":"publish","config_manager_button_bar_option6":"unpublish","config_manager_button_bar_option7":"feature","config_manager_button_bar_option8":"sticky","config_manager_button_bar_option9":"archive","config_manager_button_bar_option10":"separator","config_manager_button_bar_option11":"spam","config_manager_button_bar_option12":"trash","config_manager_button_bar_option13":"delete","config_manager_button_bar_option14":"restore","config_manager_button_bar_option15":"separator","config_manager_button_bar_option16":"options","config_manager_button_bar_option17":"separator","config_manager_button_bar_option18":"help","config_manager_button_bar_option19":"0","config_manager_button_bar_option20":"0","config_manager_sub_menu_for_content_types":"0","config_manager_sub_menu1":"default","config_manager_sub_menu2":"category","config_manager_sub_menu3":"featured","config_manager_sub_menu4":"revisions","config_manager_sub_menu5":"0","config_manager_list_search":"1","config_manager_list_filters1":"catid","config_manager_list_filters2":"state","config_manager_list_filters3":"featured","config_manager_list_filters4":"created_by","config_manager_list_filters5":"access","config_manager_list_filters6":"0","config_manager_list_filters7":"0","config_manager_list_filters8":"0","config_manager_list_filters9":"0","config_manager_list_filters10":"0","config_manager_list_filters_query_filters1":"access","config_manager_list_filters_query_filters2":"catid","config_manager_list_filters_query_filters3":"created_by","config_manager_list_filters_query_filters4":"0","config_manager_list_filters_query_filters5":"0","config_manager_grid_column_display_alias":"1","config_manager_grid_column1":"id","config_manager_grid_column2":"title","config_manager_grid_column3":"created_by","config_manager_grid_column4":"state","config_manager_grid_column5":"publish_up","config_manager_grid_column6":"publish_down","config_manager_grid_column7":"featured","config_manager_grid_column8":"stickied","config_manager_grid_column9":"catid","config_manager_grid_column10":"ordering","config_manager_grid_column11":"0","config_manager_grid_column12":"0","config_manager_grid_column13":"0","config_manager_grid_column14":"0","config_manager_grid_column15":"0","config_manager_editor_button_bar_new_option1":"apply","config_manager_editor_button_bar_new_option2":"save","config_manager_editor_button_bar_new_option3":"save2new","config_manager_editor_button_bar_new_option4":"close","config_manager_editor_button_bar_new_option5":"help","config_manager_editor_button_bar_new_option6":"0","config_manager_editor_button_bar_new_option7":"0","config_manager_editor_button_bar_new_option8":"0","config_manager_editor_button_bar_new_option9":"0","config_manager_editor_button_bar_new_option10":"0","config_manager_editor_button_bar_edit_option1":"save","config_manager_editor_button_bar_edit_option2":"0","config_manager_editor_button_bar_edit_option3":"save2new","config_manager_editor_button_bar_edit_option4":"save2copy","config_manager_editor_button_bar_edit_option5":"close","config_manager_editor_button_bar_edit_option6":"help","config_manager_editor_button_bar_edit_option7":"0","config_manager_editor_button_bar_edit_option8":"0","config_manager_editor_button_bar_edit_option9":"0","config_manager_editor_button_bar_edit_option10":"0","config_manager_editor_buttons1":"article","config_manager_editor_buttons2":"image","config_manager_editor_buttons3":"pagebreak","config_manager_editor_buttons4":"readmore","config_manager_editor_buttons5":"audio","config_manager_editor_buttons6":"video","config_manager_editor_buttons7":"file","config_manager_editor_buttons8":"gallery","config_manager_editor_buttons9":"0","config_manager_editor_buttons10":"0","config_manager_editor_left_top_column1":"title","config_manager_editor_left_top_column2":"alias","config_manager_editor_left_top_column3":"id","config_manager_editor_left_top_column4":"0","config_manager_editor_left_top_column5":"0","config_manager_editor_left_top_column6":"0","config_manager_editor_left_top_column7":"0","config_manager_editor_left_top_column8":"0","config_manager_editor_left_top_column9":"0","config_manager_editor_left_top_column10":"0","config_manager_editor_primary_column1":"content_text","config_manager_editor_left_bottom_column1":"catid","config_manager_editor_left_bottom_column2":"featured","config_manager_editor_left_bottom_column3":"stickied","config_manager_editor_left_bottom_column4":"language","config_manager_editor_left_bottom_column5":"0","config_manager_editor_right_publishing_column1":"state","config_manager_editor_right_publishing_column2":"created_by","config_manager_editor_right_publishing_column3":"created_by_alias","config_manager_editor_right_publishing_column4":"created","config_manager_editor_right_publishing_column5":"publish_up","config_manager_editor_right_publishing_column6":"publish_down","config_manager_editor_right_publishing_column7":"0","config_manager_editor_right_publishing_column8":"0","config_manager_editor_right_publishing_column9":"0","config_manager_editor_right_publishing_column10":"0","config_manager_editor_attribs":"1","config_manager_editor_params":"1","config_manager_editor_metadata":"1","params":{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"3","multi_column_order":"1","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_feed_link":"","feed_summary":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","display_num":"10"}}'
WHERE element = 'COM_ARTICLES';
UPDATE `#__extensions`
SET params = '{"config_component_tags":"1","config_component_tag_categories":"1","config_component_state_spam":"0","config_component_enable_comments":"1","config_component_version_management":"1","config_component_maintain_version_count":5,"config_component_retain_versions_after_delete":"1","config_component_uninstall":"1","config_component_single_item_parameter1":"item","config_component_single_item_parameter2":"0","config_component_single_item_parameter3":"0","config_component_single_item_parameter4":"0","config_component_single_item_parameter5":"0","config_component_candy_editor_parameter1":"item","config_component_candy_editor_parameter2":"0","config_component_candy_editor_parameter3":"0","config_component_candy_editor_parameter4":"0","config_component_candy_editor_parameter5":"0","config_component_candy_default_parameter1":"item","config_component_candy_default_parameter2":"0","config_component_candy_default_parameter3":"0","config_component_candy_default_parameter4":"0","config_component_candy_default_parameter5":"0","config_component_land_blog_parameter1":"category","config_component_land_blog_parameter2":"blog","config_component_land_blog_parameter3":"item","config_component_land_blog_parameter4":"integration","config_component_land_blog_parameter5":"0","config_component_land_default_parameter1":"category","config_component_land_default_parameter2":"list","config_component_land_default_parameter3":"item","config_component_land_default_parameter4":"integration","config_component_land_default_parameter5":"0","config_manager_title":"1","config_manager_button_bar_option1":"new","config_manager_button_bar_option2":"edit","config_manager_button_bar_option3":"checkin","config_manager_button_bar_option4":"separator","config_manager_button_bar_option5":"publish","config_manager_button_bar_option6":"unpublish","config_manager_button_bar_option7":"feature","config_manager_button_bar_option8":"sticky","config_manager_button_bar_option9":"archive","config_manager_button_bar_option10":"separator","config_manager_button_bar_option11":"spam","config_manager_button_bar_option12":"trash","config_manager_button_bar_option13":"delete","config_manager_button_bar_option14":"restore","config_manager_button_bar_option15":"separator","config_manager_button_bar_option16":"options","config_manager_button_bar_option17":"separator","config_manager_button_bar_option18":"help","config_manager_button_bar_option19":"0","config_manager_button_bar_option20":"0","config_manager_sub_menu_for_content_types":"0","config_manager_sub_menu1":"default","config_manager_sub_menu2":"category","config_manager_sub_menu3":"featured","config_manager_sub_menu4":"revisions","config_manager_sub_menu5":"0","config_manager_list_search":"1","config_manager_list_filters1":"catid","config_manager_list_filters2":"state","config_manager_list_filters3":"featured","config_manager_list_filters4":"created_by","config_manager_list_filters5":"access","config_manager_list_filters6":"0","config_manager_list_filters7":"0","config_manager_list_filters8":"0","config_manager_list_filters9":"0","config_manager_list_filters10":"0","config_manager_list_filters_query_filters1":"access","config_manager_list_filters_query_filters2":"catid","config_manager_list_filters_query_filters3":"created_by","config_manager_list_filters_query_filters4":"0","config_manager_list_filters_query_filters5":"0","config_manager_grid_column_display_alias":"1","config_manager_grid_column1":"id","config_manager_grid_column2":"title","config_manager_grid_column3":"created_by","config_manager_grid_column4":"state","config_manager_grid_column5":"publish_up","config_manager_grid_column6":"publish_down","config_manager_grid_column7":"featured","config_manager_grid_column8":"stickied","config_manager_grid_column9":"catid","config_manager_grid_column10":"ordering","config_manager_grid_column11":"0","config_manager_grid_column12":"0","config_manager_grid_column13":"0","config_manager_grid_column14":"0","config_manager_grid_column15":"0","config_manager_editor_button_bar_new_option1":"apply","config_manager_editor_button_bar_new_option2":"save","config_manager_editor_button_bar_new_option3":"save2new","config_manager_editor_button_bar_new_option4":"close","config_manager_editor_button_bar_new_option5":"help","config_manager_editor_button_bar_new_option6":"0","config_manager_editor_button_bar_new_option7":"0","config_manager_editor_button_bar_new_option8":"0","config_manager_editor_button_bar_new_option9":"0","config_manager_editor_button_bar_new_option10":"0","config_manager_editor_button_bar_edit_option1":"save","config_manager_editor_button_bar_edit_option2":"0","config_manager_editor_button_bar_edit_option3":"save2new","config_manager_editor_button_bar_edit_option4":"save2copy","config_manager_editor_button_bar_edit_option5":"close","config_manager_editor_button_bar_edit_option6":"help","config_manager_editor_button_bar_edit_option7":"0","config_manager_editor_button_bar_edit_option8":"0","config_manager_editor_button_bar_edit_option9":"0","config_manager_editor_button_bar_edit_option10":"0","config_manager_editor_buttons1":"article","config_manager_editor_buttons2":"image","config_manager_editor_buttons3":"pagebreak","config_manager_editor_buttons4":"readmore","config_manager_editor_buttons5":"audio","config_manager_editor_buttons6":"video","config_manager_editor_buttons7":"file","config_manager_editor_buttons8":"gallery","config_manager_editor_buttons9":"0","config_manager_editor_buttons10":"0","config_manager_editor_left_top_column1":"title","config_manager_editor_left_top_column2":"alias","config_manager_editor_left_top_column3":"id","config_manager_editor_left_top_column4":"0","config_manager_editor_left_top_column5":"0","config_manager_editor_left_top_column6":"0","config_manager_editor_left_top_column7":"0","config_manager_editor_left_top_column8":"0","config_manager_editor_left_top_column9":"0","config_manager_editor_left_top_column10":"0","config_manager_editor_primary_column1":"content_text","config_manager_editor_left_bottom_column1":"catid","config_manager_editor_left_bottom_column2":"featured","config_manager_editor_left_bottom_column3":"stickied","config_manager_editor_left_bottom_column4":"language","config_manager_editor_left_bottom_column5":"0","config_manager_editor_right_publishing_column1":"state","config_manager_editor_right_publishing_column2":"created_by","config_manager_editor_right_publishing_column3":"created_by_alias","config_manager_editor_right_publishing_column4":"created","config_manager_editor_right_publishing_column5":"publish_up","config_manager_editor_right_publishing_column6":"publish_down","config_manager_editor_right_publishing_column7":"0","config_manager_editor_right_publishing_column8":"0","config_manager_editor_right_publishing_column9":"0","config_manager_editor_right_publishing_column10":"0","config_manager_editor_attribs":"1","config_manager_editor_params":"1","config_manager_editor_metadata":"1","params":{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_category_title":"","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","num_leading_articles":"1","num_intro_articles":"4","num_columns":"2","num_links":"3","multi_column_order":"1","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_feed_link":"","feed_summary":"","show_pagination_limit":"","filter_field":"","show_headings":"","list_show_date":"","date_format":"","list_show_hits":"","list_show_author":"","display_num":"10"}}'
WHERE element = 'COM_MEDIA';

# Libraries
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(101, 'Akismet', 'library', 'akismet', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 1, 1),
(102, 'Curl', 'library', 'curl', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 2, 1),
(103, 'Joomla! Web Application Framework', 'library', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Web Application Framework","type":"library","creationDate":"2008","author":"Joomla","copyright":"Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"1.6.0","description":"The Joomla! Web Application Framework is the Core of the Joomla! Content Management System","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 1),
(104, 'Molajo Web Application Development', 'library', 'molajo', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 4, 1),
(105, 'Mollom', 'library', 'mollom', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 5, 1),
(106, 'Overrides', 'library', 'overrides', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 6, 1),
(107, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 7, 1),
(108, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 8, 1),
(109, 'Recaptcha', 'library', 'recaptcha', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 9, 1),
(110, 'Secureimage', 'library', 'secureimage', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 10, 1),
(111, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 11, 1),
(112, 'Twig', 'library', 'twig', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 12, 1),
(113, 'WideImage', 'library', 'wideimage', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 13, 1);

# Modules

## Site
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(201, 'mod_articles', 'module', 'mod_articles', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 1, 1),
(202, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 2, 1),
(203, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 3, 1),
(204, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 4, 1),
(205, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 5, 1),
(206, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 6, 1),
(207, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 7, 1),
(208, 'mod_media', 'module', 'mod_media', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 8, 1),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 9, 1),
(210, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 10, 1),
(211, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 11, 1),
(212, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 12, 1),
(213, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 13, 1),
(214, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 14, 1);

## Administrator
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(301, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(302, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(303, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(304, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(305, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(306, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(307, 'mod_mypanel', 'module', 'mod_mypanel', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(308, 'mod_myshortcuts', 'module', 'mod_myshortcuts', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(309, 'mod_online', 'module', 'mod_online', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(310, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(311, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 11, 0),
(312, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 12, 0),
(313, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 13, 0),
(314, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '', '', '', '', 0, '0000-00-00 00:00:00', 14, 0),
(315, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(316, 'mod_unread', 'module', 'mod_unread', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 16, 0);

# Plug-ins
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(402, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(403, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '', '{"style":"none"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(404, 'plg_editors_aloha', 'plugin', 'aloha', 'editors', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(405, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '', '{"linenumbers":"0","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(406, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(407, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(408, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(409, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '', '{}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(410, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '', '{}', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(411, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 11, 0),
(412, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 12, 0),
(413, 'plg_search_articles', 'plugin', 'articles', 'search', 0, 1, 1, 0, '', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 13, 0),
(414, 'plg_search_media', 'plugin', 'media', 'search', 0, 1, 1, 0, '', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 14, 0),
(415, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 15, 0),
(416, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 16, 0),
(417, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 17, 0),
(418, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 18, 0),
(419, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 19, 0),
(420, 'plg_system_molajo', 'plugin', 'molajo', 'system', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 20, 0),
(421, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 1, '', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 21, 0),
(422, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 22, 0),
(423, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '', '{}', '', '', 0, '0000-00-00 00:00:00', 23, 0),
(424, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '', '{}', '', '', 0, '0000-00-00 00:00:00', 24, 0),
(425, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 25, 0);

# Templates

INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(501, 'molajo-construct', 'template', 'molajo-construct', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.6.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 1),
(502, 'bluestork', 'template', 'bluestork', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.6.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 1),
(503, 'minima', 'template', 'minima', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"1.6.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 1);

# Languages
INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);

INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(700, 'Molajo', 'file', 'molajo', '', 0, 1, 1, 1, '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0);

# -------------------------------------------------------

#
# Table structure for table `#__languages`
#

CREATE TABLE `#__languages` (
  `lang_id` int(11) unsigned NOT NULL auto_increment,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `published` int(11) NOT NULL default '0',
  PRIMARY KEY  (`lang_id`),
  UNIQUE `idx_sef` (`sef`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__languages` (`lang_id`,`lang_code`,`title`,`title_native`,`sef`,`image`,`description`,`metakey`,`metadesc`,`published`)
VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', 1);

#
# Table structure for table `#__media`
#

CREATE TABLE IF NOT EXISTS `#__media` (
  `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `catid` INT (11) NOT NULL COMMENT 'Category ID associated with the Primary Key',

  `title` VARCHAR (255) NOT NULL COMMENT 'Title',
  `alias` VARCHAR (255) NOT NULL COMMENT 'URL Alias',

  `content_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Content Type: Links to #__molajo_configuration.option_id = 10 and component_option values matching ',

  `content_text` MEDIUMTEXT NULL COMMENT 'Content Primary Text Field, can include break to designate Introductory and Full text',
  `content_link` VARCHAR (2083) NULL COMMENT 'Content Link for Weblink or Newsfeed Field',
  `content_email_address` VARCHAR (255) NULL COMMENT 'Content Email Field',
  `content_numeric_value` TINYINT (3) NULL COMMENT 'Content Numeric Value, ex. vote on poll',
  `content_file` VARCHAR (255) NOT NULL DEFAULT '' COMMENT 'Content Network Path to File',

  `featured` boolean NOT NULL DEFAULT '0' COMMENT 'Featured 1-Featured 0-Not Featured',
  `stickied` boolean NOT NULL DEFAULT '0' COMMENT 'Stickied 1-Stickied 0-Not Stickied',
  `user_default` boolean NOT NULL DEFAULT '0' COMMENT 'User Default 1-Default 0-Not Default',
  `category_default` boolean NOT NULL DEFAULT '0' COMMENT 'Category Default 1-Default 0-Not Default',
  `language` CHAR (7) NOT NULL DEFAULT '' COMMENT 'Language',
  `ordering` INT (11) NOT NULL DEFAULT '0' COMMENT 'Ordering',

  `state` TINYINT (3) NOT NULL DEFAULT '0' COMMENT 'Published State 2: Archived 1: Published 0: Unpublished -1: Trashed -2: Spam -10 Version',
  `publish_up` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Publish Begin Date and Time',
  `publish_down` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Publish End Date and Time',
  `version` INTEGER UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Version Number',
  `version_of_id` INT (11) NULL COMMENT 'Category ID associated with the Primary Key',
  `state_prior_to_version` INTEGER UNSIGNED NULL COMMENT 'State value prior to creating this version copy and changing the state to Version',

  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'  COMMENT 'Created Date and Time',
  `created_by` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by User ID',
  `created_by_alias` VARCHAR (255) NOT NULL DEFAULT '' COMMENT 'Created by Alias',
  `created_by_email` VARCHAR (255) NULL COMMENT 'Created By Email Address',
  `created_by_website` VARCHAR (255) NULL COMMENT 'Created By Website',
  `created_by_ip_address` CHAR(15) NULL COMMENT 'Created By IP Address',
  `created_by_referer` VARCHAR (255) NULL COMMENT 'Created By Referer',

  `modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Modified Date',
  `modified_by` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Modified By User ID',

  `checked_out` INTEGER UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Checked out by User Id',
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Checked out Date and Time',

  `asset_id` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK to the #__assets table.',
  `access` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'View Level Access',

  `component_option` VARCHAR(50) NOT NULL COMMENT 'Component Option Value',
  `component_id` INT (11) NOT NULL COMMENT 'Primary Key for Component Content',
  `parent_id` INT (11) NULL COMMENT 'Nested set parent',
  `lft` INT (11) NULL COMMENT 'Nested set lft',
  `rgt` INT (11) NULL COMMENT 'Nested set rgt',
  `level` INT (11) NULL DEFAULT '0' COMMENT 'The cached level in the nested tree',

  `metakey` TEXT NULL COMMENT 'Meta Key',
  `metadesc` TEXT NULL COMMENT 'Meta Description',
  `metadata` TEXT NULL COMMENT 'Meta Data',

  `attribs` TEXT NULL COMMENT 'Attributes (Custom Fields)',

  `params` TEXT NULL COMMENT 'Parameters (Content Detail Parameters)',

  PRIMARY KEY  (`id`),

  KEY `idx_component_component_id_id` (`component_option`, `component_id`, `id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_stickied_catid` (`stickied`,`catid`),
  KEY `idx_language` (`language`)

) DEFAULT CHARSET=utf8;

/* FIELDS */

/* 010 MOLAJO_CONFIG_OPTION_ID_CONTENT_TYPES */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_media', 10, '', '', 0),
('com_media', 10, 'medias', 'Medias', 1);

/* VIEWS */

/* 020 MOLAJO_CONFIG_OPTION_ID_VIEW_PAIRS */
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_media', 20, '', '', 0),
('com_media', 20, 'media', 'medias', 1);

/* TABLE */

/* 045 MOLAJO_CONFIG_OPTION_ID_TABLE */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_media', 45, '', '', 0),
('com_media', 45, '__media', '__media', 1);

/* 050 MOLAJO_CONFIG_OPTION_ID_EDIT_LAYOUTS */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_media', 50, '', '', 0),
('com_media', 50, 'media', 'media', 1);

/* 060 MOLAJO_CONFIG_OPTION_ID_DEFAULT_LAYOUT */;
INSERT INTO `#__molajo_configuration` (`component_option`, `option_id`, `option_value`, `option_value_literal`, `ordering`) VALUES
('com_media', 60, '', '', 0),
('com_media', 60, 'medias', 'medias', 1);

#
# Table structure for table `#__menu`
#

CREATE TABLE `#__menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` MEDIUMTEXT NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias` (`client_id`,`parent_id`,`alias`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(333)),
  KEY `idx_language` (`language`)
)   DEFAULT CHARSET=utf8;


INSERT INTO `#__menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 41, 0, '*', 0),
(2, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 17, 22, 0, '*', 1),
(3, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 18, 19, 0, '*', 1),
(4, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 20, 21, 0, '*', 1),
(5, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 37, 38, 0, '*', 1),
(6, 'menu', 'com_search', 'Search', '', 'Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 29, 30, 0, '*', 1),
(7, 'mainmenu', 'Home', 'home', '', 'home', 'index.php?option=com_articles&view=featured', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"num_leading_articles":"1","num_intro_articles":"3","num_columns":"3","num_links":"0","orderby_pri":"","orderby_sec":"front","order_date":"","multi_column_order":"1","show_pagination":"2","show_pagination_results":"1","show_noauth":"","article-allow_ratings":"","article-allow_comments":"","show_feed_link":"1","feed_summary":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_readmore":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","show_page_heading":1,"page_title":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 39, 40, 1, '*', 0);

# -------------------------------------------------------

#
# Table structure for table `#__menu_types`
#

CREATE TABLE `#__menu_types` (
  `id` integer unsigned NOT NULL auto_increment,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE `idx_menutype` (`menutype`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__menu_types` VALUES (1, 'mainmenu', 'Main Menu', 'The main menu for the site');

#
# Table structure for table `#__messages`
#

CREATE TABLE `#__messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

#
# Table structure for table `#__messages_cfg`
#

CREATE TABLE `#__messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Table structure for table `#__modules`
#

CREATE TABLE `#__modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` TEXT NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__modules` VALUES
(1, 'Main Menu', '', '', 1, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"0","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(2, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(5, 'Unread Messages', '', '', 1, 'header', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_unread', 3, 1, '', 1, '*'),
(6, 'Online Users', '', '', 2, 'header', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_online', 3, 1, '', 1, '*'),
(7, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(8, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(9, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(10, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(11, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(12, 'User Status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(13, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(14, 'Login Form', '', '', 7, 'position-7', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"greeting":"1","name":"0"}', 0, '*'),
(15, 'Breadcrumbs', '', '', 1, 'position-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 1, 1, '{"moduleclass_sfx":"","showHome":"1","homeText":"Home","showComponent":"1","separator":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(16, 'My Panel', '', '', 1, 'widgets-first', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_mypanel', 1, 1, '', 1, '*'),
(17, 'My Shortcuts', '', '', 1, 'widgets-last', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_myshortcuts', 1, 1, '{"show_add_link":"1"}', 1, '*');

# -------------------------------------------------------

#
# Table structure for table `#__modules_menu`
#

CREATE TABLE `#__modules_menu` (
  `moduleid` integer NOT NULL default '0',
  `menuid` integer NOT NULL default '0',
  PRIMARY KEY  (`moduleid`,`menuid`)
)  DEFAULT CHARSET=utf8;

#
# Dumping data for table `#__modules_menu`
#

INSERT INTO `#__modules_menu` VALUES
(1,0),
(2,0),
(3,0),
(4,0),
(6,0),
(7,0),
(8,0),
(9,0),
(10,0),
(12,0),
(13,0),
(14,0),
(15,0);

# -------------------------------------------------------

#
# Table structure for table `#__schemas`
#

CREATE TABLE `#__schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`, `version_id`)
)  DEFAULT CHARSET=utf8;
# -------------------------------------------------------

#
# Table structure for table `#__session`
#

CREATE TABLE `#__session` (
  `session_id` varchar(32) NOT NULL default '',
  `client_id` tinyint(3) unsigned NOT NULL default '0',
  `guest` tinyint(4) unsigned default '1',
  `time` varchar(14) default '',
  `data` LONGTEXT default NULL,
  `userid` int(11) default '0',
  `username` varchar(150) default '',
  `usertype` varchar(50) default '',
  PRIMARY KEY  (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
)  DEFAULT CHARSET=utf8;


# -------------------------------------------------------

# Update Sites
CREATE TABLE  `#__updates` (
  `update_id` int(11) NOT NULL auto_increment,
  `update_site_id` int(11) default '0',
  `extension_id` int(11) default '0',
  `categoryid` int(11) default '0',
  `name` varchar(100) default '',
  `description` text NOT NULL,
  `element` varchar(100) default '',
  `type` varchar(20) default '',
  `folder` varchar(20) default '',
  `client_id` tinyint(3) default '0',
  `version` varchar(10) default '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  PRIMARY KEY  (`update_id`)
)  DEFAULT CHARSET=utf8;

CREATE TABLE  `#__update_sites` (
  `update_site_id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default '',
  `type` varchar(20) default '',
  `location` text NOT NULL,
  `enabled` int(11) default '0',
  PRIMARY KEY  (`update_site_id`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__update_sites` VALUES
(1, 'Molajo Core', 'collection', 'http://update.molajo.org/core/list.xml', 1),
(2, 'Molajo Directory', 'collection', 'http://update.molajo.org/directory/list.xml', 1);

CREATE TABLE `#__update_sites_extensions` (
  `update_site_id` INT DEFAULT 0,
  `extension_id` INT DEFAULT 0,
  PRIMARY KEY(`update_site_id`, `extension_id`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__update_sites_extensions` VALUES
(1, 700),
(2, 700);


#
# Table structure for table `#__template_styles`
#

CREATE TABLE IF NOT EXISTS `#__template_styles` (
  `id` integer unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` TEXT NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
)  DEFAULT CHARSET=utf8 ;

INSERT INTO `#__template_styles` VALUES (1, 'molajo-construct', '0', '1', 'Molajo Construct - Default', '{}');
INSERT INTO `#__template_styles` VALUES (2, 'bluestork', '1', '0', 'Bluestork', '{"useRoundedCorners":"1","showSiteName":"0"}');
INSERT INTO `#__template_styles` VALUES (3, 'minima', 1, 1, 'Minima - Default', '{}');

# -------------------------------------------------------
#
# Table structure for table `#__user_usergroup_map`
#

CREATE TABLE IF NOT EXISTS `#__user_usergroup_map` (
  `user_id` integer unsigned NOT NULL default '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` integer unsigned NOT NULL default '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY  (`user_id`,`group_id`)
)  DEFAULT CHARSET=utf8;

# -------------------------------------------------------

#
# Table structure for table `#__usergroups`
#

CREATE TABLE IF NOT EXISTS `#__usergroups` (
  `id` integer unsigned NOT NULL auto_increment COMMENT 'Primary Key',
  `parent_id` integer unsigned NOT NULL default '0' COMMENT 'Adjacency List Reference Id',
  `lft` integer NOT NULL default '0' COMMENT 'Nested set lft.',
  `rgt` integer NOT NULL default '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` USING BTREE (`lft`,`rgt`)
)  DEFAULT CHARSET=utf8;

INSERT INTO `#__usergroups` (`id` ,`parent_id` ,`lft` ,`rgt` ,`title`)
VALUES
(1, 0, 1, 2, 'Public'),
	(2, 1, 3, 4, 'Guest'),
	(3, 1, 5, 8, 'Registered'),
	  (4, 3, 6, 7, 'Administrator');

# -------------------------------------------------------

#
# Table structure for table `#__users`
#

CREATE TABLE `#__users` (
  `id` integer NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `username` varchar(150) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `usertype` varchar(25) NOT NULL default '',
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `registerDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL default '',
  `params` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
)  DEFAULT CHARSET=utf8;

#
# Table structure for table `#__viewlevels`
#

CREATE TABLE IF NOT EXISTS `#__viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` MEDIUMTEXT NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
)   DEFAULT CHARSET=utf8;

#
# Dumping data for table `#__viewlevels`
#

INSERT INTO `#__viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 1, '[1]'),
(2, 'Guest', 2, '[2]'),
(3, 'Registered', 3, '[3,4]'),
(4, 'Special', 4, '[4]');
