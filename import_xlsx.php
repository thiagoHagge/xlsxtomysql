<?php
  require_once('db.class.php');
  require_once('vendor/autoload.php'); // PhpSpreadsheet


  $filename = "teste.xlsx";
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  $spreadsheet = $reader->load($filename);
  
  foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
      $worksheets[$worksheet->getTitle()] = $worksheet->toArray(); // Array data
  }

  // print_r($worksheets);

  // Link db
  $db = new db;
  $link = $db->connect_mysql();
  
  while ($data = current($worksheets)) {
    $sheet = key($worksheets);
    $l = 0; // Line index
    foreach($worksheets[$sheet] as $line) {
      $c = 0; // Column index
      foreach($line as $data) {
        $sql = "INSERT INTO excel(coluna, linha, conteudo) VALUES ('$c', '$l', '$data')";
        mysqli_query($link, $sql) or die("Erro ao efetuar o cadastro!");
        $c++;
      }
      $l++;
    }
    next($worksheets);
  }

?>