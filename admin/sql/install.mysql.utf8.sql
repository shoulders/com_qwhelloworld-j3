DROP TABLE IF EXISTS `#__com_qwhelloworld`;

CREATE TABLE `#__com_qwhelloworld` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`asset_id` INT(10)     NOT NULL DEFAULT '0',
	`title` VARCHAR(255) NOT NULL,
	`alias`  VARCHAR(400)  NOT NULL DEFAULT '',	
	`catid`	    int(11)    NOT NULL DEFAULT '0',	
	`created`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`checked_out` INT(10) NOT NULL DEFAULT '0',
	`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`published` tinyint(4) NOT NULL DEFAULT '1',
	`access` tinyint(4) NOT NULL DEFAULT '0',	
	`language`  CHAR(7)  NOT NULL DEFAULT '*',
	`parent_id`	int(10)    NOT NULL DEFAULT '1',
	`level`	int(10)    NOT NULL DEFAULT '0',
	`path`	VARCHAR(400)    NOT NULL DEFAULT '',
	`lft`	int(11)    NOT NULL DEFAULT '0',
	`rgt`	int(11)    NOT NULL DEFAULT '0',		
	`params`   VARCHAR(1024) NOT NULL DEFAULT '',
	`description` VARCHAR(4000) NOT NULL DEFAULT '',
	`image`   VARCHAR(1024) NOT NULL DEFAULT '',
	`latitude` DECIMAL(9,7) NOT NULL DEFAULT 0.0,
	`longitude` DECIMAL(10,7) NOT NULL DEFAULT 0.0,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE UNIQUE INDEX `aliasindex` ON `#__com_qwhelloworld` (`alias`, `catid`);

INSERT INTO `#__com_qwhelloworld` (`title`,`alias`, `published`, `language`, `parent_id`, `level`, `path`, `lft`, `rgt`) VALUES
('QWHelloWorld root','qwhelloworld-root-alias', 1, '*', 0, 0, '', 0, 5),
('Hello World!','hello-world', 0, 'en-GB', 1, 1, 'hello-world', 1, 2),
('Goodbye World!','goodbye-world', 0, 'en-GB', 1, 1, 'goodbye-world', 3, 4);

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `content_history_options`, `table`, `field_mappings`, `router`) 
VALUES
('QWHelloWorld Project', 'com_qwhelloworld.project', 
'{"formFile":"administrator\\/components\\/com_qwhelloworld\\/models\\/forms\\/project.xml", 
"hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path"], 
"ignoreChanges":["checked_out", "checked_out_time", "path"],
"convertToInt":[], 
"displayLookup":[
{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},
{"sourceColumn":"parent_id","targetTable":"#__com_qwhelloworld","targetColumn":"id","displayColumn":"title"},
{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}',
'{"special":{"dbtable":"#__com_qwhelloworld","key":"id","type":"Project","prefix":"QwhelloworldTable","config":"array()"},
"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}',
'{"common": {
	"core_content_item_id": "id",
	"core_title": "title",
	"core_state": "published",
	"core_alias": "alias",
	"core_language":"language", 
	"core_created_time": "created",
	"core_body": "description",
	"core_access": "access",
	"core_catid": "catid"
  }}',
'QwhelloworldHelperRoute::getQwhelloworldRoute'),
('QWHelloWorld Category', 'com_qwhelloworld.category',
'{"formFile":"administrator\\/components\\/com_categories\\/models\\/forms\\/category.xml", 
"hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"], 
"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],
"convertToInt":["publish_up", "publish_down"], 
"displayLookup":[
{"sourceColumn":"created_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},
{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},
{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},
{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}',
'{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},
"common":{"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}',
'{"common": {
	"core_content_item_id":"id",
	"core_title":"title",
	"core_state":"published",
	"core_alias":"alias",
	"core_created_time":"created_time",
	"core_modified_time":"modified_time",
	"core_body":"description", 
	"core_hits":"hits",
	"core_publish_up":"null",
	"core_publish_down":"null",
	"core_access":"access", 
	"core_params":"params", 
	"core_featured":"null", 
	"core_metadata":"metadata", 
	"core_language":"language", 
	"core_images":"null", 
	"core_urls":"null", 
	"core_version":"version",
	"core_ordering":"null", 
	"core_metakey":"metakey", 
	"core_metadesc":"metadesc", 
	"core_catid":"parent_id", 
	"core_xreference":"null", 
	"asset_id":"asset_id"}, 
  "special":{
    "parent_id":"parent_id",
	"lft":"lft",
	"rgt":"rgt",
	"level":"level",
	"path":"path",
	"extension":"extension",
	"note":"note"}}',
'QwhelloworldHelperRoute::getCategoryRoute');