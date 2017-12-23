<?php

namespace backend\controllers\approval;

use Yii;
use backend\models\approval\TbPernyataanSurvey;
use backend\models\approval\TbPernyataanSurveySearch;
use backend\models\master\TbFormulirPendaftaran;
use backend\models\master\TbZakatBantuanBerobat;
use backend\models\master\TbZakatModalUsaha;
use backend\models\master\TbZakatTerlilitHutang;
use backend\models\master\TbJenisZakat;
use backend\models\master\UserBiasa;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbPernyataanSurveyController implements the CRUD actions for TbPernyataanSurvey model.
 */
class AccSebagaiPenerimaController extends Controller
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
     * Lists all TbPernyataanSurvey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel         = new TbPernyataanSurveySearch();
        $searchModel->setuju = TbPernyataanSurvey::SURVEY_DISETUJUI;
        $dataProvider        = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbPernyataanSurvey model.
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
     * Creates a new TbPernyataanSurvey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TbPernyataanSurvey();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TbPernyataanSurvey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = UserBiasa::findOne($model->user_id);
        $model->setScenario(TbFormulirPendaftaran::SCENE_UPDATE); 
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->password!= null){
                $model->setPassword($model->password);
                $model->generateAuthKey();
            }
            
            if($model->tgl_lahir){
                $dateObj= \DateTime::createFromFormat('d/m/Y', $model->tgl_lahir); 
                $newDateString = $dateObj->format('Y/m/d');
                $model->tgl_lahir = strtotime($newDateString);
            }
            
            if ($model->nomor == null) {
                $model->scenario = TbFormulirPendaftaran::SCENE_NULL_NUMBER;
            }
            
            $model = $this->uploadFile($model, 'upload_ktp');
            $model = $this->uploadFile($model, 'upload_kk');
            $model = $this->uploadFile($model, 'upload_surat_permohonan');
            $model = $this->uploadFile($model, 'upload_surat_keterangan_tidak_mampu');
            
            $zakat = $this->getTypeZakat($model);
            $zakat->formulir_pendaftaran_id = $model->tbFormulirPendaftaran->id;
            if ($zakat->load(Yii::$app->request->post())) {
                switch($model->jenis_zakat_id){
                    case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                        $zakat = $this->uploadFile2($zakat, 'upload_surat_keterangan_sakit');
                        $zakat = $this->uploadFile2($zakat, 'upload_foto_bukti_sakit');
                        $zakat = $this->uploadFile2($zakat, 'upload_kwitansi');
                        $zakat = $this->uploadFile2($zakat, 'upload_foto_rumah');
                        break;
                    case TbJenisZakat::ZAKAT_MODAL_USAHA:
                        $zakat = $this->uploadFile2($zakat, 'upload_foto_ukm');
                        $zakat = $this->uploadFile2($zakat, 'upload_foto_tempat_usaha');
                        break;
                    case TbJenisZakat::ZAKAT_TERLILIT_HUTANG:
                        $zakat = $this->uploadFile2($zakat, 'upload_surat_keterangan_hutang');
                        $zakat = $this->uploadFile2($zakat, 'upload_foto_rumah');
                        break;
                }
                if(!$zakat->save()){
                    print_r($zakat->getErrors());
                    return;
                }
                
            }
            
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if($model->save()){
                    $transaction->commit(); 
                    if(Yii::$app->request->post('submit')){                        
                        return $this->redirect(['view', 'id' => $model->tbFormulirPendaftaran->id]);
                    }
                } 
            } catch (\Exception $exc) {               
                $transaction->rollBack();               
            }
            
            
        } 
        
        $zakat = $this->getTypeZakat($model);
        $model->tgl_lahir = $model->tgl_lahir?date("d/m/Y", $model->tgl_lahir):'';
        return $this->render('update', [
            'model' => $model,
            'zakat' => $zakat,
        ]);
    }

    private function getTypeZakat($model){
        switch ($model->jenis_zakat_id){
            case TbJenisZakat::ZAKAT_BANTUAN_BEROBAT:
                $zakat = TbZakatBantuanBerobat::findOne(['formulir_pendaftaran_id'=>$model->tbFormulirPendaftaran->id]);
                if($zakat == null){
                    $zakat = new TbZakatBantuanBerobat();
                }
                break;
            case TbJenisZakat::ZAKAT_MODAL_USAHA:
                $zakat = TbZakatModalUsaha::findOne(['formulir_pendaftaran_id'=>$model->tbFormulirPendaftaran->id]);
                if($zakat == null){
                    $zakat = new TbZakatModalUsaha();
                }
                break;
            case TbJenisZakat::ZAKAT_TERLILIT_HUTANG:
                $zakat = TbZakatTerlilitHutang::findOne(['formulir_pendaftaran_id'=>$model->tbFormulirPendaftaran->id]);
                if($zakat == null){
                    $zakat = new TbZakatTerlilitHutang();
                }
                break;    
            default :
                $zakat = new TbZakatModalUsaha();
                break;
        }
        return $zakat;
    }
    
    private function uploadFile($model, $name){
        $sktm = \yii\web\UploadedFile::getInstance($model, $name);
        if ($sktm) {
            $dheks = bin2hex(file_get_contents($sktm->tempName));
            $model->$name = $dheks;
        } else {
            $model->unsetRelation([$name]);                
        }
        return $model;
    }
    
    private function uploadFile2($model, $name){
        $sktm = \yii\web\UploadedFile::getInstance($model, $name);
        if ($sktm) {
            $dheks = bin2hex(file_get_contents($sktm->tempName));
            $model->$name = $dheks;
        } else {
            unset($model->$name);                
        }
        return $model;
    }

    /**
     * Deletes an existing TbPernyataanSurvey model.
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
     * Finds the TbPernyataanSurvey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TbPernyataanSurvey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbFormulirPendaftaran::findOne($id)) !== null) {
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
