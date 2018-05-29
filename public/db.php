<?php

require_once 'testData.php';

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=postcode;encoding=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Text: ' . $e->getMessage() . ' Code: ' . $e->getCode();
}
$rustart = getrusage();

$result = $pdo->query('SELECT * FROM post_codes');

$data =  $result->fetchAll();

echo '<pre>';

//foreach($testData as $value) {
for($i = 0; $i < count($testData); $i++) {
    $result = array_search($testData[$i], array_column($data, 'post_code'));
//    print_r($data[$result]);
}



echo '</pre>';
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
        -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}
$ru = getrusage();
echo "This process used " . rutime($ru, $rustart, "utime") .
    " ms for its computations\n";
echo "It spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls\n";