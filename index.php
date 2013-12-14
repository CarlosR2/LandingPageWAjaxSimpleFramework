<?

// CONTROLLER

include('functions.php');
include('model.php');

/* DO STUFF*/

$model = new model();
$foo_data = $model->foo();

include('view.php');
?>