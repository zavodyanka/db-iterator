<?php
require_once 'vendor/autoload.php';

use DbIterator\Initialization;
use DbIterator\TableIterator;

$pdo = Initialization::getConnection();

$sql = 'SELECT * FROM `books`';
$stmt = $pdo->prepare($sql);
$stmt->execute();

$data = new TableIterator($stmt, [\PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL]);

foreach ($data as $row) {
    echo sprintf(
    '%s "%s", pages %s',
    $row->author,
    $row->title,
    $row->pages
    ) . PHP_EOL;
}