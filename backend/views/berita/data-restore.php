<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\StringHelper;
$this->title = 'Berita restore';
?>
<div class="module-berita-index">
    <div class="container-fluid">
    <?php 
    $gridColumn = [
        // ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'berita_kategori_id',
                'label' => 'Berita Kategori',
                'value' => function($model){
                    if(strlen($model->beritaKategori->nama) > 1){
                        return $model->beritaKategori->nama;
                    } else {
                        return "Kategori Berita Deleted";
                    }
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBeritaKategori::find()->asArray()->all(), 'id', 'nama'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Module berita kategori', 'id' => 'grid-module-berita-search-berita_kategori_id']
            ],
        'judul',
        [
            'attribute'=>'isi',
            'value' => function($dataProvider){
                return StringHelper::truncateWords($dataProvider->isi,5,'...',null,false);
            }
        ],
        // 'gambar',
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{restore} {permDeleteKategori}',
            'buttons' => [
                'restore' => function($url,$model){
                    if($model->getBeritaKategori()->one()->deleted_by !== null){
                        $id = $model->id;
                        return Html::a('Restore', ['restore', 'id' => $model->id], [
                            'class' => 'btn btn-info',
                                'data' => [
                                    'confirm' => 'Anda yakin ingin merestore data ini ?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    } else {
                        return Html::button('Restore', [
                            'value' => '#',
                            'class' => 'btn btn-disable',
                            ]
                        );
                    }
                },
                'permDeleteKategori' => function($url,$model){
                    $id = $model->id;
                    return Html::a('Hard Delete', ['dpermanent', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Anda yakin ingin menghapus permanen data ini ?',
                                'method' => 'post',
                            ],
                        ]
                    );
                }
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'responsiveWrap' => false,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-berita']],
        'panel' => false,
        'responsiveWrap' => false,
    ]); ?>
    </div>
</div>