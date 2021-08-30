public function get_microtime() {
      $time = microtime();
      $time = explode(" ",$time);
      $time = floatval($time[1]) + floatval($time[0]);
      return $time;
   }

function nama_funcmu() {
$startTime = $this->get_microtime();
      
      // Query mu
      
      $endTime = $this->get_microtime();
      
      $queryTime = floatval($endTime) - floatval($startTime);
      echo $queryTime . ' micro seconds';
}