<?php
/**
 * Tencent is pleased to support the open source community by making TSF Solution available.
 * Copyright (C) 2017 THL A29 Limited, a Tencent company. All rights reserved.
 * Licensed under the BSD 3-Clause License (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * https://opensource.org/licenses/BSD-3-Clause
 * Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
 */
#!/usr/local/php/bin/php -q


//读取配置，启动对应的server 根据传进来的server名字 已经知道协议类型


// 定义根目录
define('SWOOLEBASEPATH', dirname(dirname(__FILE__)));
// 载入Swoole 框架
require_once SWOOLEBASEPATH . '/require.php';
//读取配置
$cmd = $argv[1];   //cmd name
$name = $argv[2];

//需要cmd 和 name  name 支持 all 和 具体的serverName
if (!$cmd || !$name) {
    echo "please input cmd and server name: start all,start testserv ";
    exit;
}
//读取配置文件 然后启动对应的server

$configPath = (dirname(dirname(SWOOLEBASEPATH))) . '/conf/' . $name . '.ini';//获取配置地址
// $config is file path? 提前读取 只读一次
if (!file_exists($configPath)) {
    throw new \Exception("[error] profiles [$configPath] can not be loaded");
}

// Load the configuration file into an array
$config = parse_ini_file($configPath, true);
//根据config里面的不同内容启动不同的server  定义网络层 UDP、TCP
if ($config['server']['type'] == 'http') {  //
    $server = new \Swoole\Network\HttpServer($config['server']['host']);
} elseif ($config['server']['type'] == 'tcp') {
    $server = new \Swoole\Network\TcpServer();

} elseif ($config['server']['type'] == 'udp') {
    $server = new  \Swoole\Network\UdpServer();
}

//合并config 只读一次
$server->config = array_merge($server->config, $config);

//通过root 来获取所有的源码

//获取index一次 加载tsf框架

//获取配置 载入index
//index require


//$server->serverClass='testHttpServ';
$server->setProcessName($name);
//$server->setProcessName('mark_server');

//root为index的路径
$server->setRequire($config['server']['root']);


//源码加载器
//$server->setRequire(BASEPATH . '/src/require.php');

// 启动 此时已经读到了root

$server->run();