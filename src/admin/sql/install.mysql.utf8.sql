CREATE TABLE IF NOT EXISTS `#__iot_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `ipaddress` varchar(255) NOT NULL DEFAULT '',
  `iotdata` text NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__iot_details` (`name`,`ipaddress`) VALUES
('e660a4931754432c','192.168.1.10'),
('e660a4931754432d','192.168.1.11'),
('f660a4931754432e','192.168.1.12'),
('a660a4931754432f','192.168.1.13');

ALTER TABLE `#__iot_details` ADD COLUMN  `asset_id` int(10) unsigned NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `#__iot_details` ADD KEY `idx_asset_id` (`asset_id`);

ALTER TABLE `#__iot_details` ADD COLUMN  `access` int(10) unsigned NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN  `metadesc` text AFTER `access`;

ALTER TABLE `#__iot_details` ADD KEY `idx_access` (`access`);

ALTER TABLE `#__iot_details` ADD COLUMN  `catid` int(11) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN  `created` datetime AFTER `catid`;

ALTER TABLE `#__iot_details` ADD COLUMN  `created_by` int(10) unsigned NOT NULL DEFAULT 0 AFTER `created`;

ALTER TABLE `#__iot_details` ADD COLUMN  `modified` datetime AFTER `created_by`;

ALTER TABLE `#__iot_details` ADD COLUMN  `modified_by` int(10) unsigned NOT NULL DEFAULT 0 AFTER `modified`;

ALTER TABLE `#__iot_details` ADD COLUMN  `state` tinyint(3) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD KEY `idx_catid` (`catid`);

ALTER TABLE `#__iot_details` ADD COLUMN  `published` tinyint(1) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN  `publish_up` datetime AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN  `publish_down` datetime AFTER `alias`;

ALTER TABLE `#__iot_details` ADD KEY `idx_state` (`published`);

ALTER TABLE `#__iot_details` ADD COLUMN  `language` char(7) NOT NULL DEFAULT '*' AFTER `alias`;

ALTER TABLE `#__iot_details` ADD KEY `idx_language` (`language`);

ALTER TABLE `#__iot_details` ADD COLUMN  `ordering` int(11) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN  `params` text NOT NULL AFTER `alias`;

ALTER TABLE `#__iot_details` ADD COLUMN `checked_out` int(10) unsigned DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_details` ADD KEY `idx_checkout` (`checked_out`);

ALTER TABLE `#__iot_details` ADD COLUMN `checked_out_time` datetime AFTER `alias`;

CREATE TABLE IF NOT EXISTS `#__iot_data` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
    `name` varchar(255) NOT NULL DEFAULT '',
    `iotdata` text NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__iot_data` ADD COLUMN  `access` int(10) unsigned NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__iot_data` ADD KEY `idx_access` (`access`);

ALTER TABLE `#__iot_data` ADD COLUMN  `created` datetime AFTER `alias`;
