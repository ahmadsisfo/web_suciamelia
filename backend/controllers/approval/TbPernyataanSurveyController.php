<?php

namespace backend\controllers\approval;

use Yii;
use backend\models\approval\TbPernyataanSurvey;
use backend\models\approval\TbPernyataanSurveySearch;
use backend\models\master\TbFormulirPendaftaran;
use backend\models\master\TbJenisZakat;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TbPernyataanSurveyController implements the CRUD actions for TbPernyataanSurvey model.
 */
class TbPernyataanSurveyController extends Controller
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
        $searchModel = new TbPernyataanSurveySearch();
        $searchModel->all = true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
        
    public function actionIndexAll()
    {
        $searchModel = new TbPernyataanSurveySearch();
        $searchModel->all = true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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

        if ($model->load(Yii::$app->request->post())) {
            $existmodel = TbPernyataanSurvey::findOne(['formulir_pendaftaran_id'=>$model->formulir_pendaftaran_id]);
            if($existmodel != null){
                $model  = $existmodel;
                $model->load(Yii::$app->request->post());
            }
            $trans = Yii::$app->db->beginTransaction();
            try {
                $formulir = TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id);
                $formulir->status_formulir = $model->setuju;
                $formulir->save();

                if($model->save()){
                    $trans->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (Exception $ex) {
                $trans->rollBack();
            }
            
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
        
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

        if ($model->load(Yii::$app->request->post())) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $formulir = TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id);
                $formulir->status_formulir = $model->setuju;
                $formulir->save();

                if($model->save()){
                    $trans->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } catch (Exception $ex) {
                $trans->rollBack();
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TbPernyataanSurvey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model    = $this->findModel($id);
        $formulir = TbFormulirPendaftaran::findOne($model->formulir_pendaftaran_id);
        $formulir->status_formulir = null;
        $formulir->save();
        $model->delete();

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
        if (($model = TbPernyataanSurvey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetFormulirPendaftaran() {
        $term = Yii::$app->request->get('term');
        
        $data = TbFormulirPendaftaran::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])
                ->orFilterWhere(['like', 'lower(nomor)', strtolower($term)])
                ->limit(10)
                ->all();
        $datafix = [];
        foreach ($data as $item) {
            $datafix[] = [
                'id'    => $item->id, 
                'value' => $item->nomor, 
                'label' => $item->nomor." => ".$item->nama,
                'nama'  => $item->nama,
                'no_hp' => $item->no_hp,
                'tgl_lahir' => date("d M y", $item->tgl_lahir),
                'jenis_zakat'=> TbJenisZakat::enums('ZAKAT_')[$item->jenis_zakat_id],
                'ktp'   => Url::toRoute(['master/tb-formulir-pendaftaran/pict','id'=>$item->id,'field'=>'upload_ktp']),
                'detail'   => Url::toRoute(['master/tb-formulir-pendaftaran/view','id'=>$item->id])
            ];
        }
        
        return ($datafix !== null) ? json_encode($datafix) : json_encode([]);
    }

}
