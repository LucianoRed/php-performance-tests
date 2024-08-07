<?php
if(!file_exists("/tmp/pv")) {
  mkdir("/tmp/pv");
}
if(isset($_GET['concurrent'])) {
  $file = '/tmp/pv/largefile.txt';
} else {
  $length = 20;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $characters = str_shuffle(str_repeat($characters, ceil($length / strlen($characters))));
  $file_name = substr($characters, 0, $length);
  $file = "/tmp/pv/$file_name";
}
$data = str_repeat("Some data to write to the file\n", 10000);

for ($i = 0; $i < 1000; $i++) {
    file_put_contents($file, $data, FILE_APPEND);
}

echo "Finished writing to the file.\n";
