<?php
class Animal
{
  public function bark()
  {
    var_dump('----------1-----------');
    echo 'Yeah, it’s barking.' . PHP_EOL;
  }
}

class Dog extends Animal
{
  public $name;
  public $age;
  public function __construct($name, $age=1)
  {
    var_dump('----------2-----------');
    $this->name = $name;
    $this->age = $age;
  }
}
class MechaDog extends Dog
{
  private $data;
  public function __construct($name, $age=1)
  {
    var_dump('----------3-----------');
    parent::__construct($name);

    $this->data = array(
      'apache' => 'apache',
      'bsd' => 'mit',
      'chef' => 'apache'
    );
  }

  public function proc($arg)
  {
    var_dump('----------4-----------');

    $path = explode("/", explode(" ", $arg)[0]);
    var_dump($path);
      // この変数の内容が「[0]=> string(3) "GET"」になっているが、
      //「[0]=> string(0) "" [1]=> string(3) "bsb"」になるべき
    array_shift($path);

    if( is_null($path) ) {
      var_dump('----------5-----------');
      $keys = array();
      while (list($key, $val) = each($this->data)) {
        array_push($keys, $key);
      }
      var_dump($keys);
    }
    else if(count($path) == 2){
      var_dump('----------6-----------');
      $this->data[$path[0]] = $path[1];
      echo $path[1] . PHP_EOL;

    }
    else {
      var_dump('----------7-----------');
      var_dump($path);
      //この変数の内容が空の配列になっているので、「[0]=> string(3) "bsb"」になるべき
      echo $path[0] . "=>" . $this->data[$path[0]] . PHP_EOL;
      //中身が空の配列になっているので、「=>」と出力される。値を入れて「bsd=>mit」になるべき
    }
  }
}

$mdog = new MechaDog('tom');
$mdog->bark();
echo $mdog->name . PHP_EOL;
echo $mdog->age . PHP_EOL;
$mdog->proc("GET /bsd HTTP/1.1");
