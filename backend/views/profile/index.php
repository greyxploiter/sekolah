<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Daftar Profile';
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
<div class="module-profile-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="search-form" style="display:none">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="box-body">
            <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'user_id',
                        'label' => 'User',
                        'value' => function($model){
                            return $model->user->username;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'username'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih User', 'id' => 'grid-module-profile-search-user_id']
                    ],
                    'nama',
                    [
                        'attribute' => 'tgl_lahir',
                        'value' => function($model) {
                            return ($model->tgl_lahir !== null) ? date('d-m-Y',$model->tgl_lahir) : "";
                        }
                    ],
                    [
                        'attribute' => 'tempat_lahir',
                        'value' => function($model) {
                            return ($model->tempat_lahir !== null) ? $model->tempat_lahir : "";
                        }
                    ],
                    [
                        'attribute' => 'bio',
                        'value' => function($model) {
                            return ($model->bio !== null) ? $model->bio : "";
                        }
                    ],
                    [
                        'attribute' => 'no_telp',
                        'value' => function($model) {
                            return ($model->no_telp !== null) ? $model->no_telp : "";
                        }
                    ],
                    // [
                    //     'attribute' => 'avatar',
                    //     'value' => function($model) {
                    //         return ($model->avatar !== null) ? $model->avatar : "";
                    //     }
                    // ],
                    ['attribute' => 'lock', 'visible' => false],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function($url,$model){
                                return Html::button('<i class="glyphicon glyphicon-eye-open"></i>',[
                                    'value' => Url::to(['view-modal','id'=>$model->user_id]),
                                    'class' => 'btn-actionColumn showModalButton'
                                ]);
                            }
                        ]
                    ],
                ]; 
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumn,
                    'pjax' => true,
                    'responsiveWrap' => false,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-profile']],
                    'panel' => false,
                ]); ?>
        </div>
    </div>

</div>
