<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

$this->title = 'Admin';

$this->params['breadcrumbs'][] = [

    'label' => $this->title,
    'url' => Url::toRoute($this->title),
    //'template' => "<li>{link}</li>\n", // template for this link only

];

?>

<?php echo $this->render('../layouts/common'); ?>
