<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Auth extends CI_Migration {

        public function up()
        {
                $this->db->query("CREATE TABLE `aauth_groups` ( `id` int(11) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(100), `definition` text, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;");
				
                $this->db->query("INSERT INTO `aauth_groups` VALUES ('1', 'Admin', 'Super Admin Group'),('2', 'Public', 'Public Access Group'),('3', 'Default', 'Default Access Group');");

                $this->db->query("CREATE TABLE `aauth_perms` ( `id` int(11) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(100), `definition` text, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                
				$this->db->query("CREATE TABLE `aauth_perm_to_group` ( `perm_id` int(11) unsigned NOT NULL, `group_id` int(11) unsigned NOT NULL, PRIMARY KEY (`perm_id`,`group_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE `aauth_perm_to_user` ( `perm_id` int(11) unsigned NOT NULL, `user_id` int(11) unsigned NOT NULL, PRIMARY KEY (`perm_id`,`user_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE `aauth_pms` ( `id` int(11) unsigned NOT NULL AUTO_INCREMENT, `sender_id` int(11) unsigned NOT NULL, `receiver_id` int(11) unsigned NOT NULL, `title` varchar(255) NOT NULL, `message` text, `date_sent` datetime DEFAULT NULL, `date_read` datetime DEFAULT NULL, `pm_deleted_sender` int(1) DEFAULT NULL, `pm_deleted_receiver` int(1) DEFAULT NULL, PRIMARY KEY (`id`), KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE `aauth_users` ( `id` int(11) unsigned NOT NULL AUTO_INCREMENT, `email` varchar(100) COLLATE utf8_general_ci NOT NULL, `pass` varchar(64) COLLATE utf8_general_ci NOT NULL, `username` varchar(100) COLLATE utf8_general_ci, `banned` tinyint(1) DEFAULT '0', `last_login` datetime DEFAULT NULL, `last_activity` datetime DEFAULT NULL, `date_created` datetime DEFAULT NULL, `forgot_exp` text COLLATE utf8_general_ci, `remember_time` datetime DEFAULT NULL, `remember_exp` text COLLATE utf8_general_ci, `verification_code` text COLLATE utf8_general_ci, `totp_secret` varchar(16) COLLATE utf8_general_ci DEFAULT NULL, `ip_address` text COLLATE utf8_general_ci, PRIMARY KEY (`id`) ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
				
				$this->db->query("CREATE TABLE `aauth_user_to_group` ( `user_id` int(11) unsigned NOT NULL, `group_id` int(11) unsigned NOT NULL, PRIMARY KEY (`user_id`,`group_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE `aauth_user_variables` ( `id` int(11) unsigned NOT NULL AUTO_INCREMENT, `user_id` int(11) unsigned NOT NULL, `data_key` varchar(100) NOT NULL, `value` text, PRIMARY KEY (`id`), KEY `user_id_index` (`user_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE `aauth_group_to_group` ( `group_id` int(11) unsigned NOT NULL, `subgroup_id` int(11) unsigned NOT NULL, PRIMARY KEY (`group_id`,`subgroup_id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
				
				$this->db->query("CREATE TABLE IF NOT EXISTS `aauth_login_attempts` ( `id` int(11) NOT NULL AUTO_INCREMENT, `ip_address` varchar(39) DEFAULT '0', `timestamp` datetime DEFAULT NULL, `login_attempts` tinyint(2) DEFAULT '0', PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
				
        }

        public function down()
        {
                $this->dbforge->drop_table('aauth_groups');
                $this->dbforge->drop_table('aauth_perms');
                $this->dbforge->drop_table('aauth_perm_to_group');
                $this->dbforge->drop_table('aauth_perm_to_user');
                $this->dbforge->drop_table('aauth_pms');
                $this->dbforge->drop_table('aauth_users');
                $this->dbforge->drop_table('aauth_user_to_group');
                $this->dbforge->drop_table('aauth_user_variables');
                $this->dbforge->drop_table('aauth_group_to_group');
                $this->dbforge->drop_table('aauth_login_attempts');
        }
}

?>