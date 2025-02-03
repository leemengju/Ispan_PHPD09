<?php
include("bradapis.php");
try {
    $pdo->beginTransaction();
    $pdo->exec('INSERT INTO client(account,passwd,realname)VALUES ("brad,"123456","Brad")');
    $pdo->exec('INSERT INTO client(account,passwd,realname)VALUES ("brad2,"123456","Brad")');

    $pdo->commit();
    echo 'ok';
} catch (PDOException $e) {
    $pdo->rollBack();
    echo $e->getMessage().'<br/>';
}

echo'Game Over';
