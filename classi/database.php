<?php
include('costanti.php');
class Database{
  function __construct()
  {
    //apro la connessione al database
    $connString = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    $this->connection = new PDO($connString, DB_USERNAME, DB_PASSWORD);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->ScriviLog('Aperta la connessione col database: "' . $connString .', ' . DB_USERNAME .', ' . DB_PASSWORD . '"');
  }
  //eseguo una query
  public function Query($sql, $param = array()){
    $stmt = $this->connection->prepare($sql);
    if(count($param) > 0){
      $stmt->execute($param);
      $this->ScriviLog('Eseguita query: ' . $sql . ', parametri: ' . $this->arrayToString($param, ','));
    }
    else{
      $stmt->execute();
      $this->ScriviLog('Eseguita query: ' . $sql);
    }
    return $stmt;
  }
  public function Fetch($result){
    return $result->fetch(PDO::FETCH_ASSOC);
  }
  public function FetchAll($result){
      $res = array();
      while($array = $this->Fetch($result))
          $res[] = $array;
      return $res;
  }
  public function SingleResult($sql, $param = array()){
    $result = $this->Query($sql, $param);
    return $this->Fetch($result);
  }
  public function Close(){
    $this->connection = null;
      $this->ScriviLog('Chiuso il database');
  }
  private function arrayToString($vett, $separatore){
    $result = '[';
    foreach ($vett as $key => $value) {
      $result .= $key . ' => ' . $value . $separatore;
    }
    $result = substr($result, strlen($result) -1) . ']';
    return $result;
  }
  public function ScriviLog($messaggio){
    file_put_contents(DIR_LOG . "/log_file.log", date('Y-m-d H:i:s') . '|' . $messaggio . "\r\n", FILE_APPEND | LOCK_EX);
  }
}
?>
