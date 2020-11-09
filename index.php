<?php
  
function binarySearchByKey(string $file, string $id){
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $string = fgets($handle);
        mb_convert_encoding($string, 'cp1251');
        $arr[] = explode("\t", $string);    
    }
    fclose($handle);

    array_pop($arr);

    $start = 0;
    $end = count($arr) - 1;
    
    while ($start <= $end) {
        $middle = floor(($start + $end) / 2);
        $strnatcmp = strnatcmp($arr[$middle][0], $id);
        if ($strnatcmp > 0) {
            $end = $middle - 1;
        } else if ($strnatcmp < 0) {
            $start = $middle + 1;
        } else {
            return $arr[$middle][1];
        }
    }
    return 'undef';
}

function generateFile(int $len, string $file = "smth.txt"){
    $handle = fopen($file, "w");
    for($id = 1; $id <= $len; $id++){
        fwrite($handle, "ключ$id\tзначение$id\x0A");
    }
    fclose($handle);

}

generateFile(100000, "test.txt");
$start = time();
echo binarySearchByKey("test.txt", "ключ24")."</br>";
echo time() - $start; 
?>