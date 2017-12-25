<?php

namespace backend\controllers\approval;

use Yii;
use backend\models\approval\TbPenerima;
use backend\models\approval\TbPenerimaSearch;
use backend\models\approval\TbPernyataanSurvey;
use backend\models\master\TbFormulirPendaftaran;
use backend\models\master\TbZakatBantuanBerobat;
use backend\models\master\TbZakatModalUsaha;
use backend\models\master\TbZakatTerlilitHutang;
use backend\models\master\TbJenisZakat;

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
            'model'    => $model = $this->findModel($id),
            'penerima' => TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id)
        ]);
    }

    /**
     * Creates a new TbPenerima model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model  = TbPenerima::findOne(['pernyataan_survey_id'=>$id]);
        
        if($model == null){
            $model  = new TbPenerima();
        }   
        
        $survey = TbPernyataanSurvey::findOne($id);
        if($survey == null){
            return $this->redirect(['index']);
        }
        
        $model->pernyataan_survey_id    = $survey->id;
        $model->formulir_pendaftaran_id = $survey->formulir_pendaftaran_id;
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $survey->setuju = TbPernyataanSurvey::SURVEY_PENERIMA;
            $survey->save();

            $formulir = TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id);
            $formulir->status_formulir = TbFormulirPendaftaran::STATUS_PENERIMA;
            $formulir->save();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } catch (\Exception $exc) {               
            $transaction->rollBack();               
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
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $survey->setuju = TbPernyataanSurvey::SURVEY_PENERIMA;
            $survey->save();

            $formulir = TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id);
            $formulir->status_formulir = TbFormulirPendaftaran::STATUS_PENERIMA;
            $formulir->save();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } catch (\Exception $exc) {               
            $transaction->rollBack();               
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
    
    public function actionPict($id, $field){
        $arr = ['upload_ktp','upload_kk','upload_surat_permohonan','upload_surat_keterangan_tidak_mampu'];
        if(!in_array($field, $arr)){
            $model = TbFormulirPendaftaran::findOne($id);
            switch ($model->jenis_zakat_id){
                case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                    $model = TbZakatBantuanBerobat::find();
                    break;
                case TbJenisZakat::ZAKAT_MODAL_USAHA:
                    $model = TbZakatModalUsaha::find();
                    break;
                case TbJenisZakat::ZAKAT_TERLILIT_HUTANG:
                    $model = TbZakatTerlilitHutang::find();
                    break;
            }
            $model->select($field);
            $model->where('formulir_pendaftaran_id=:did', [':did' => $id]);        
            
        } else {
            $model = TbFormulirPendaftaran::find();
            $model->select($field);
            $model->where('id=:did', [':did' => $id]);        
        }        
        $ddoc = $model->scalar();
        header('Content-type: image/png');
        echo hex2bin($ddoc);
        return;    
    }
}
