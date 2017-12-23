<?php

namespace backend\controllers\approval;

use Yii;
use backend\models\approval\TbPenerima;
use backend\models\approval\TbPenerimaSearch;
use backend\models\approval\TbPernyataanSurvey;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbPenerimaController implements the CRUD actions for TbPenerima model.
 */
class TbPenerimaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TbPenerima models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbPenerimaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbPenerima model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TbPenerima model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new TbPenerima();
                
        $survey= TbPernyataanSurvey::findOne($id);
        if($survey == null){
            return $this->redirect(['index']);
        }
        
        $model->pernyataan_survey_id    = $survey->id;
        $model->formulir_pendaftaran_id = $survey->formulir_pendaftaran_id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        
        return $this->render('create', [
            'model'  => $model,
            'survey' => $survey
        ]);
        
    }

    /**
     * Updates an existing TbPenerima model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model  = $this->findModel($id);

        $survey = TbPernyataanSurvey::findOne($model->pernyataan_survey_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        return $this->render('update', [
            'model' => $model,
            'survey'=> $survey
        ]);
        
    }

    /**
     * Deletes an existing TbPenerima model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TbPenerima model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbPenerima the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbPenerima::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
