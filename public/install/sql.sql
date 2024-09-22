SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `my_admin` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `username` char(50) NOT NULL DEFAULT '' COMMENT '用户账号',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `salt` varchar(100) NOT NULL DEFAULT '' COMMENT '加密钥',
  `nickname` char(50) DEFAULT '' COMMENT '用户昵称',
  `headimg` varchar(255) DEFAULT '' COMMENT '头像地址',
  `phone` char(20) DEFAULT '' COMMENT '电话',
  `email` char(50) DEFAULT '' COMMENT '邮箱',
  `login_ip` char(50) DEFAULT NULL COMMENT 'IP地址',
  `login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '登录时间',
  `login_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_ip` char(50) DEFAULT '' COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '上次登录时间',
  `user_agent` text COMMENT 'user_agent',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='用户表' ROW_FORMAT=DYNAMIC;

INSERT INTO `my_admin` (`id`, `is_admin`, `username`, `password`, `salt`, `nickname`, `headimg`, `phone`, `email`, `login_ip`, `login_time`, `login_num`, `last_login_ip`, `last_login_time`, `user_agent`, `status`, `create_time`, `update_time`) VALUES
(1, 1, 'admin', '7b12d0d85fa7906d8930a80b596c9dbf', 'C9MicVFvA51Gx83tUbkR', '管理员', '', '', '', '127.0.0.1', 1644965364, 65, '127.0.0.1', 1644416694, NULL, 1, 1606649826, 1644965364),
(2, 0, 'demo', '2557341819f9c65ae6141a146d4d2a0b', 'VLwf2qglxTHKjQDvGneb', '体验账号', '', '', '', '127.0.0.1', 1644337783, 801, '127.0.0.1', 1644337783, NULL, 1, 1606649826, 1644376354),
(18, 0, 'test', '91c81b847f3426275b8f189b304351a7', 'w3fmc7BPLyiOH6nAeu2F', '测试', '', '', '', NULL, NULL, 0, '', NULL, NULL, 1, 1628062269, 1644376365);

CREATE TABLE `my_attachment` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `admin_id` int(10) UNSIGNED DEFAULT NULL COMMENT '管理员ID',
  `url` varchar(255) DEFAULT '' COMMENT '物理路径',
  `filetype` char(6) DEFAULT '' COMMENT '文件类型',
  `filesize` int(10) UNSIGNED DEFAULT '0' COMMENT '文件大小',
  `mimetype` char(80) DEFAULT '' COMMENT 'mime类型',
  `storage` char(10) DEFAULT '' COMMENT '存储位置',
  `sha1` char(40) DEFAULT '' COMMENT '文件 sha1编码',
  `hash` char(40) DEFAULT '' COMMENT '云存储hash(ETag)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='附件表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '角色ID',
  `title` char(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `comments` varchar(255) DEFAULT '' COMMENT '角色描述',
  `rules` text COMMENT '角色所拥有的权限ID',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限角色表' ROW_FORMAT=DYNAMIC;

INSERT INTO `my_auth_group` (`id`, `title`, `comments`, `rules`, `status`, `create_time`, `update_time`) VALUES
(2, '普通用户', '普通用户', '1,3,11,4,13,5,17,2,6,21,7,26,8,30,31,32,33,36,37,41,42,43,46,47,48,49,52,53,54,57,58,59', 1, 1606650669, 1615447994),
(3, '游客', '游客', '1,3,11,4,13,5,17,2,6,21,7,24,26,8,30,31,32,33,36,37,38,41,42,43,46,47,48,49,52,53,54,57,58,59', 1, 1606650669, 1616749330);

CREATE TABLE `my_auth_group_access` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '管理员ID',
  `group_id` mediumint(8) UNSIGNED NOT NULL COMMENT '角色ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限角色组关系表' ROW_FORMAT=DYNAMIC;

INSERT INTO `my_auth_group_access` (`id`, `uid`, `group_id`) VALUES
(52, 1, 0),
(65, 18, 3),
(66, 0, 2),
(67, 0, 3),
(68, 2, 3);

CREATE TABLE `my_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '权限ID',
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` char(80) DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否为有效规则',
  `ismenu` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '规则类型(0链接,1按钮)	',
  `isnav` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '导航菜单(0否,1是)',
  `icon` char(100) DEFAULT '' COMMENT '菜单图标',
  `weight` mediumint(8) UNSIGNED NOT NULL DEFAULT '50' COMMENT '权重排序',
  `open` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '菜单(0收起,1展开)',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `condition` char(100) DEFAULT '' COMMENT '规则表达式',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限规则表' ROW_FORMAT=DYNAMIC;

INSERT INTO `my_auth_rule` (`id`, `pid`, `name`, `title`, `type`, `ismenu`, `isnav`, `icon`, `weight`, `open`, `status`, `condition`, `create_time`, `update_time`) VALUES
(1, 0, '', '系统配置', 0, 0, 1, 'mdi mdi-adobe-acrobat', 1, 1, 1, '', 1644328834, 1644329015),
(2, 0, '', '权限管理', 0, 0, 1, 'mdi mdi-air-conditioner', 2, 1, 1, '', 1644328865, 1644328876),
(3, 1, 'admin/configure/index', '参数配置', 1, 0, 1, '', 50, 1, 1, '', 1644332000, 1644332595),
(4, 1, 'admin/oplog/index', '日志管理', 1, 0, 1, '', 50, 1, 1, '', 1644332648, 1644332678),
(5, 1, 'admin/attach/index', '附件管理', 1, 0, 1, '', 50, 1, 1, '', 1644332746, 1644332746),
(6, 2, 'admin/admin/index', '用户管理', 1, 0, 1, '', 50, 1, 1, '', 1644332774, 1644332790),
(7, 2, 'admin/role/index', '角色管理', 1, 0, 1, '', 50, 1, 1, '', 1644332844, 1644332863),
(8, 2, 'admin/auth/index', '规则管理', 1, 0, 1, '', 50, 1, 1, '', 1644333083, 1644333365),
(9, 3, 'admin/configure/submit', '保存配置', 1, 1, 0, '', 50, 1, 1, '', 1644333560, 1644333787),
(10, 3, 'admin/upload/upload', '文件上传', 1, 1, 0, '', 50, 1, 1, '', 1644333665, 1644333779),
(11, 3, 'admin/configure/index', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644333769, 1644333769),
(12, 3, 'admin/tpl/password', '修改密码', 1, 1, 0, '', 50, 1, 1, '', 1644333821, 1644333821),
(13, 4, 'admin/oplog/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644333851, 1644333851),
(14, 4, 'admin/oplog/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644333873, 1644333873),
(15, 4, 'admin/oplog/delall', '一键清空', 1, 1, 0, '', 50, 1, 1, '', 1644333898, 1644333898),
(16, 5, 'admin/attach/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644333920, 1644333920),
(17, 5, 'admin/attach/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644333939, 1644333939),
(18, 6, 'admin/admin/add', '添加', 1, 1, 0, '', 50, 1, 1, '', 1644333964, 1644333964),
(19, 6, 'admin/admin/edit', '修改', 1, 1, 0, '', 50, 1, 1, '', 1644333981, 1644333981),
(20, 6, 'admin/admin/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644333999, 1644333999),
(21, 6, 'admin/admin/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644334017, 1644334017),
(22, 7, 'admin/role/add', '添加', 1, 1, 0, '', 50, 1, 1, '', 1644334037, 1644334037),
(23, 7, 'admin/role/edit', '修改', 1, 1, 0, '', 50, 1, 1, '', 1644334056, 1644334056),
(24, 7, 'admin/role/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644334074, 1644334074),
(25, 7, 'admin/role/authlist', '权限分配', 1, 1, 0, '', 50, 1, 1, '', 1644334099, 1644334099),
(26, 7, 'admin/role/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644334116, 1644334116),
(27, 8, 'admin/auth/add', '添加', 1, 1, 0, '', 50, 1, 1, '', 1644334144, 1644334144),
(28, 8, 'admin/auth/edit', '修改', 1, 1, 0, '', 50, 1, 1, '', 1644334165, 1644334165),
(29, 8, 'admin/auth/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644334184, 1644334184),
(30, 8, 'admin/auth/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644334203, 1644334203),
(31, 0, '', '网络验证', 1, 0, 1, 'mdi mdi-access-point-network', 3, 1, 1, '', 1644423309, 1644423309),
(32, 31, 'admin/classifyImpl/index', '软件分类', 1, 0, 1, '', 50, 1, 1, '', 1644423345, 1644424047),
(33, 32, 'admin/classifyImpl/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644424079, 1644424079),
(34, 32, 'admin/classifyImpl/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644424248, 1644424248),
(35, 32, 'admin/classifyImpl/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644425105, 1644425105),
(36, 31, 'admin/isoftware/index', '软件管理', 1, 0, 1, '', 50, 1, 1, '', 1644425364, 1644425364),
(37, 36, 'admin/isoftware/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644462019, 1644462019),
(38, 36, 'admin/isoftware/classify', '查分类', 1, 1, 0, '', 50, 1, 1, '', 1644462053, 1644462053),
(39, 36, 'admin/isoftware/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644462076, 1644462107),
(40, 36, 'admin/isoftware/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644462093, 1644462093),
(41, 31, 'admin/carlb/index', '卡密类别', 1, 0, 1, '', 50, 1, 1, '', 1644462166, 1644462166),
(42, 41, 'admin/carlb/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644473404, 1644473404),
(43, 41, 'admin/carlb/software', '查分类', 1, 1, 0, '', 50, 1, 1, '', 1644473433, 1644473433),
(44, 41, 'admin/carlb/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644473454, 1644473454),
(45, 41, 'admin/carlb/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644473502, 1644473502),
(46, 31, 'admin/camilovo/index', '卡密管理', 1, 0, 1, '', 50, 1, 1, '', 1644473541, 1644473541),
(47, 46, 'admin/camilovo/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644481068, 1644481068),
(48, 46, 'admin/camilovo/software', '查分类', 1, 1, 0, '', 50, 1, 1, '', 1644481107, 1644481107),
(49, 46, 'admin/camilovo/cardtware', '查卡类', 1, 1, 0, '', 50, 1, 1, '', 1644481138, 1644481138),
(50, 46, 'admin/camilovo/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644481162, 1644481162),
(51, 46, 'admin/camilovo/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644481186, 1644481186),
(52, 31, 'admin/member/index', '普通用户', 1, 0, 1, '', 50, 1, 1, '', 1644481226, 1644481226),
(53, 52, 'admin/member/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644498255, 1644498255),
(54, 52, 'admin/member/software', '查分类', 1, 1, 0, '', 50, 1, 1, '', 1644498276, 1644498276),
(55, 52, 'admin/member/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644498301, 1644498301),
(56, 52, 'admin/member/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644498320, 1644498320),
(57, 31, 'admin/kmuser/index', '卡密用户', 1, 0, 1, '', 50, 1, 1, '', 1644498396, 1644498396),
(58, 57, 'admin/kmuser/datalist', '查看', 1, 1, 0, '', 50, 1, 1, '', 1644581589, 1644581589),
(59, 57, 'admin/kmuser/software', '查分类', 1, 1, 0, '', 50, 1, 1, '', 1644581611, 1644581611),
(60, 57, 'admin/kmuser/post_submit', '保存', 1, 1, 0, '', 50, 1, 1, '', 1644581635, 1644581635),
(61, 57, 'admin/kmuser/del', '删除', 1, 1, 0, '', 50, 1, 1, '', 1644581685, 1644581685);

CREATE TABLE `my_camilo` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) NOT NULL COMMENT '软件id',
  `card_id` int(11) NOT NULL COMMENT '卡类id',
  `dop` varchar(255) DEFAULT NULL COMMENT '卡头',
  `camilo` varchar(255) DEFAULT NULL COMMENT '卡密',
  `duration` varchar(255) DEFAULT '1' COMMENT '时长',
  `fnLength` varchar(255) DEFAULT NULL COMMENT '卡密长度',
  `activate` tinyint(1) DEFAULT '0' COMMENT '是否被使用(0未使用,1已使用)',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间',
  `changdus` varchar(255) DEFAULT NULL COMMENT '卡密长度'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='卡密表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_camilouser` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) UNSIGNED DEFAULT '0' COMMENT '软件id',
  `camilo` varchar(255) DEFAULT NULL COMMENT '卡密',
  `login_ip` char(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'IP地址',
  `last_machine` varchar(255) DEFAULT NULL COMMENT '历史机器码',
  `machine` varchar(255) DEFAULT NULL COMMENT '机器码',
  `login_token` varchar(255) DEFAULT NULL COMMENT '用户token',
  `activate_time` int(10) DEFAULT NULL COMMENT '激活时间',
  `expiration_time` int(10) DEFAULT NULL COMMENT '到期时间',
  `login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '登录时间',
  `login_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_ip` char(50) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '上次登录时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='卡密用户表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_card` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) DEFAULT NULL COMMENT '软件ID',
  `cardtype` tinyint(1) DEFAULT '1' COMMENT '卡类 1:小时卡 2:周卡 3:月卡 4:年卡 5:终身卡',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',
  `comment` varchar(255) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='卡类表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_classify` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '分类名',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='软件分类表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_config` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT '配置ID',
  `type` char(20) DEFAULT '' COMMENT '分类',
  `value` longtext COMMENT '配置值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统配置表' ROW_FORMAT=DYNAMIC;

INSERT INTO `my_config` (`id`, `type`, `value`) VALUES
(1, 'system', '{\"typename\":\"system\",\"title\":\"MYadmin\",\"webname\":\"\",\"domain\":\"\",\"logo\":\"\",\"keywords\":\"\",\"description\":\"\",\"copyright\":\"\",\"miitbeian\":\"\"}'),
(2, 'storage', '{\"typename\":\"storage\",\"engine\":\"1\",\"accesskey\":\"\",\"secretkey\":\"\",\"bucket\":\"\",\"domain\":\"\"}'),
(3, 'weixin', '{\"typename\":\"weixin\",\"appid\":\"1\",\"appsecret\":\"2\",\"token\":\"3\",\"AesKey\":\"fsffsdfd\"}'),
(4, 'wxapp', '{\"typename\":\"wxapp\",\"appid\":\"1\",\"appsecret\":\"2\"}'),
(5, 'wxpay', NULL),
(6, 'email', '{\"typename\":\"email\",\"username\":\"\",\"fullname\":\"\",\"password\":\"\",\"host\":\"\",\"port\":\"\",\"subject\":\"\",\"body\":\"\",\"notice_email\":\"\"}'),
(7, 'jwttoken', '{\"typename\":\"jwttoken\",\"iss\":\"www.baidu.com\",\"aud\":\"myadmin\",\"secrect\":\"myadminv2\",\"exptime\":\"3600\"}');

CREATE TABLE `my_fileupdate` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) DEFAULT NULL COMMENT '软件id',
  `filename` varchar(255) DEFAULT NULL COMMENT '文件名',
  `md5` varchar(255) DEFAULT NULL COMMENT 'md5',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_machineku` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) NOT NULL COMMENT '软件ID',
  `uid` int(11) NOT NULL COMMENT '用户',
  `type` int(1) NOT NULL COMMENT '用户类型：0=普通用户，1=卡密用户',
  `machine` varchar(255) NOT NULL COMMENT '机器码',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机器码库';

CREATE TABLE `my_oplog` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `node` char(80) DEFAULT NULL COMMENT '当前操作节点',
  `geoip` char(50) DEFAULT '' COMMENT '操作者IP地址',
  `action` varchar(100) DEFAULT '' COMMENT '操作行为名称',
  `content` varchar(255) DEFAULT '' COMMENT '操作内容描述',
  `username` char(50) DEFAULT '' COMMENT '操作人用户名',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='日志表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_software` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) DEFAULT NULL COMMENT '分类ID',
  `secretKey` varchar(255) DEFAULT NULL COMMENT '秘钥',
  `title` varchar(255) DEFAULT NULL COMMENT '软件名',
  `versions` varchar(255) DEFAULT NULL COMMENT '版本号',
  `notice` varchar(255) DEFAULT NULL COMMENT '公告',
  `loginway` tinyint(1) DEFAULT '1' COMMENT '登录方式 1:账号密码 2:卡密',
  `updatestat` tinyint(1) DEFAULT NULL COMMENT '更新方式 1:本地MD5更新 2:远程压缩包更新',
  `catalogue` varchar(255) DEFAULT NULL COMMENT 'md5更新目录',
  `loRangeurl` varchar(255) DEFAULT NULL COMMENT '远程更新url',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间',
  `ryptedPass` varchar(255) DEFAULT NULL COMMENT '加密密码',
  `thebuckle` varchar(255) DEFAULT NULL COMMENT '解绑扣时',
  `time_mod` tinyint(1) DEFAULT NULL COMMENT '扣费模式',
  `machine` varchar(255) DEFAULT NULL COMMENT '机器码',
  `moremachine` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启多机器码',
  `setNumber` varchar(255) NOT NULL DEFAULT '1' COMMENT '允许台数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='软件表' ROW_FORMAT=DYNAMIC;

CREATE TABLE `my_token` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) NOT NULL COMMENT '软件ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `login_token` varchar(255) DEFAULT NULL COMMENT '用户登录token',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `my_user` (
  `id` int(11) NOT NULL COMMENT 'id',
  `pid` int(11) DEFAULT NULL COMMENT '软件ID',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `salt` varchar(255) DEFAULT NULL COMMENT '加密钥',
  `last_machine` varchar(255) DEFAULT NULL COMMENT '历史机器码',
  `login_ip` char(50) CHARACTER SET utf8mb4 DEFAULT NULL COMMENT 'IP地址',
  `expiration_time` int(10) DEFAULT NULL COMMENT '到期时间',
  `login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '登录时间',
  `login_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `last_login_ip` char(50) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED DEFAULT NULL COMMENT '上次登录时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `create_time` int(10) UNSIGNED DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED DEFAULT NULL COMMENT '更新时间',
  `machine` varchar(255) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='普通用户表' ROW_FORMAT=DYNAMIC;


ALTER TABLE `my_admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_attachment`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_auth_group`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_auth_group_access`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `uid` (`uid`) USING BTREE,
  ADD KEY `group_id` (`group_id`) USING BTREE;

ALTER TABLE `my_auth_rule`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_camilo`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_camilouser`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_card`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_classify`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_config`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_system_config_type` (`type`) USING BTREE;

ALTER TABLE `my_fileupdate`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_machineku`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `my_oplog`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_software`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `my_token`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `my_user`
  ADD PRIMARY KEY (`id`) USING BTREE;


ALTER TABLE `my_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=19;

ALTER TABLE `my_attachment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

ALTER TABLE `my_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色ID', AUTO_INCREMENT=4;

ALTER TABLE `my_auth_group_access`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=69;

ALTER TABLE `my_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '权限ID', AUTO_INCREMENT=62;

ALTER TABLE `my_camilo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_camilouser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_classify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `my_config`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '配置ID', AUTO_INCREMENT=8;

ALTER TABLE `my_fileupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_machineku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_oplog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

ALTER TABLE `my_software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

ALTER TABLE `my_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
