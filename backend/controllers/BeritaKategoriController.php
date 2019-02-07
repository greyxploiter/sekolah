<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleBeritaKategori;
use common\models\ModuleBeritaKategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * BeritaKategoriController implements the CRUD actions for ModuleBeritaKategori model.
 */
class BeritaKategoriController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ModuleBeritaKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleBeritaKategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleBeritaKategori model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerModuleBerita = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleBeritas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleBerita' => $providerModuleBerita,
        ]);
    }

    /**
     * Creates a new ModuleBeritaKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('admin')){
            $model = new ModuleBeritaKategori();

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new  ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing ModuleBeritaKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('admin')){
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new  ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing ModuleBeritaKategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('admin')){
            $this->findModel($id)->deleteWithRelated();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    
    /**
     * Finds the ModuleBeritaKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleBeritaKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleBeritaKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleBerita
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleBerita()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleBerita');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleBerita', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
