<?

// CONTROLLER

include('functions.php');
include('model.php');

/* DO STUFF*/

$model = new model();
$var = '';
$foo_data = $model->foo($var);

include('view.php');
?>
