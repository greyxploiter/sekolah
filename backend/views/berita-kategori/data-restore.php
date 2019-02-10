<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBeritaKategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Berita Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-kategori-index">
    <div class="container-fluid">
        <?php 
        $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'nama',
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{restore}',
                'buttons' => [
                    'restore' => function($url,$model){
                        $id = $model->id;
                        return Html::a('Restore', ['restore', 'id' => $model->id], [
                            'class' => 'btn btn-info',
                                'data' => [
                                    'confirm' => 'Anda yakin ingin merestore data ini ?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
            ],
        ]; 
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumn,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-berita-kategori']],
            'panel' => false,
            'responsiveWrap' => false,
        ]); ?>
    </div>

</div>