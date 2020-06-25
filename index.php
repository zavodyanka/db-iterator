<?php

$pdo = new \PDO(
    $config['db']['dsn'],
    $config['db']['username'],
    $config['db']['password']
);

$sql = 'SELECT * FROM `books`';
$stmt = $pdo->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_SCROLL]);
$stmt->execute();

$data = new DbRowIterator($stmt);
//echo 'Getting the contacts that changed the last 3 months' . PHP_EOL;
//$lastPeriod = new LastPeriodIterator($data, '2015-04-01 00:00:00');
foreach ($data as $row) {
    echo sprintf(
    '%s (%s)| modified %s',
    $row->contact_name,
    $row->contact_email,
    $row->contact_modified
    ) . PHP_EOL;
}