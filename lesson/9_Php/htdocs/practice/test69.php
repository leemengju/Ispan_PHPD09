<?php
use Workerman\Worker;
use Workerman\Connection\TcpConnection;
require_once __DIR__ . '/vendor/autoload.php';

// 创建一个Worker监听2345端口，使用http协议通讯
$http_worker = new Worker("websocket://0.0.0.0:8888");

// 启动4个进程对外提供服务 Process 程序
$http_worker->count = 4;

$http_worker->onConnect = function(TcpConnection $connection){
    echo "id: {$connection->id}\n";
    global $conns;
    $conns[$connection->id] = $connection;
};

// 接收到浏览器发送的数据时回复hello world给浏览器
$http_worker->onMessage = function(TcpConnection $connection, $data){
    global $conns;
    foreach($conns as $conn){
        $conn->send($data);
    }
};

$http_worker->onClose = function(TcpConnection $connection){
    global $conns;
    echo "id: {$connection->id} : exit\n";
    unset($conns[$connection->id]);
};

Worker::runAll();
?>