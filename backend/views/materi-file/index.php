<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Module Materi File';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();

?>
<div class="module-materi-file-index">
    <div class="box box-success">
        <div class="box-header">
                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
                <p>
                    <?= Html::a('Tambah Module Materi File', ['create'], ['class' => 'btn btn-success']) ?>
                                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                            </p>
                            <div class="search-form" style="display:none">
                    <?=  $this->render('_search', ['model' => $searchModel]); ?>
                </div>
                        </div>
        <div class="box-body">
                        <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                                            ['attribute' => 'id', 'visible' => false],
                                [
                'attribute' => 'materi_id',
                'label' => 'Materi',
                'value' => function($model){                   
                    return $model->materi->id;                   
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateri::find()->asArray()->all(), 'id', 'id'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Module materi', 'id' => 'grid-module-materi-file-search-materi_id']
            ],
                                'nama_file',
                                'link_file',
                                ['attribute' => 'lock', 'visible' => false],
                                [
                        'class' => 'yii\grid\ActionColumn',
                                ],
                ]; 
                            ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
        'columns' => $gridColumn,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-file']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                    ],
                                'export' => false,
                                // your toolbar can include the additional full export menu
                    'toolbar' => [
                        '{export}',
                        ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumn,
                            'target' => ExportMenu::TARGET_BLANK,
                            'fontAwesome' => true,
                            'dropdownOptions' => [
                                'label' => 'Full',
                                'class' => 'btn btn-default',
                                'itemsBefore' => [
                                    '<li class="dropdown-header">Export All Data</li>',
                                ],
                            ],
                                        'exportConfig' => [
                                ExportMenu::FORMAT_PDF => false
                            ]
                                    ]) ,
                    ],
                ]); ?>
                        
        </div>
    </div>

</div>
