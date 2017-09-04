CREATE TABLE IF NOT EXISTS `user_perms` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `group` VARCHAR(100),
    `role` VARCHAR(100),
    `about` TEXT,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX `by_group` ON `user_perms` ( `group` );

INSERT IGNORE INTO `site_param` ( `name`, `type`, `group`, `value` ) VALUES
    ( 'google_map_api_key', 1, 'Code', '' );

INSERT IGNORE INTO `user_perms` ( `name`, `group`, `role`, `about` ) VALUES
    ( 'read_admin',     'Admin',    'Admin',        'Allow user to open admin panel home' ),
    ( 'read_user',      'User',     'Management',   'Allow user to see exists users' );

CREATE TABLE IF NOT EXISTS `user_perms_chain` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user` INTEGER NOT NULL,
    `user_perms` INTEGER NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX `by_user` ON `user_perms_chain` ( `user` );
CREATE INDEX `by_user_perms` ON `user_perms_chain` ( `user_perms` );

INSERT IGNORE INTO `user` ( `id`, `name`, `password`, `fullname`, `status` ) VALUES 
( 1, 'root', '$2y$10$0APx6EljuZioYeqY.twmOOwXKV6ETanSm53I.L0qzKGaBXiAvbupC', 'Root', 1 );
