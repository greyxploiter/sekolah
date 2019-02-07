<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */

$this->title = 'Tambah Berita';
$this->params['breadcrumbs'][] = ['label' => 'Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
