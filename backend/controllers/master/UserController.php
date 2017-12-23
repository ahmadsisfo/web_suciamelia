<?php

namespace backend\controllers\master;

use Yii;
use backend\models\master\User;
use backend\models\master\UserSearch;
use backend\models\master\TbAdmin;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
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
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexAll()
    {
        $searchModel = new UserSearch();
        $searchModel->all = true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single user model.
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
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario(User::SCENE_CREATE); 
        if ($model->load(Yii::$app->request->post())) {
            
            $model->setPassword($model->password);
            $model->generateAuthKey();
            $upload = \yii\web\UploadedFile::getInstance($model, "foto");
            if ($upload) {
                $dheks = bin2hex(file_get_contents($upload->tempName));
                $model->foto = $dheks;
            }
            
            if($model->tgl_lahir){
                $dateObj= \DateTime::createFromFormat('d/m/Y', $model->tgl_lahir); 
                $newDateString = $dateObj->format('Y/m/d');
                $model->tgl_lahir = strtotime($newDateString);
            }
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if($model->save()){
                    $transaction->commit();                     
                    return $this->redirect(['view', 'id' => $model->id]);
                } 
            } catch (\Exception $exc) {               
                $transaction->rollBack();               
            }
            //print_r($model->getErrors());*/
        }     
        
        $model->tgl_lahir = $model->tgl_lahir?date("d/m/Y", $model->tgl_lahir):'';
        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    public function actionPict($id) {
        $model = TbAdmin::find();
        $model->select('foto');
        $model->where('user_id=:did', [':did' => $id]);
        $ddoc = $model->scalar();

        header('Content-type: image/png');
        echo hex2bin($ddoc);
        return;
    }
    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(TbAdmin::SCENE_UPDATE); 
        if ($model->load(Yii::$app->request->post())) {
            if($model->password!= null){
                $model->setPassword($model->password);
                $model->generateAuthKey();
            }
            $upload = \yii\web\UploadedFile::getInstance($model, "foto");
            if ($upload) {
                $dheks = bin2hex(file_get_contents($upload->tempName));
                $model->foto = $dheks;
            } else {
                $model->unsetRelation(['foto']);                
            }
            
            if($model->tgl_lahir){
                $dateObj= \DateTime::createFromFormat('d/m/Y', $model->tgl_lahir); 
                $newDateString = $dateObj->format('Y/m/d');
                $model->tgl_lahir = strtotime($newDateString);
            }
            
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if($model->save()){
                    $transaction->commit();                                 
                    return $this->redirect(['view', 'id' => $model->id]);
                }                                 
            } catch (\Exception $exc) {               
                $transaction->rollBack();               
            }
            //print_r($model->relatedErrors);
        } 
        
        $model->tgl_lahir = $model->tgl_lahir?date("d/m/Y", $model->tgl_lahir):'';
        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Yii::STATUS_DELETED;
        
        if(!$model->save()){
            print_r($model->getErrors());
        }else{
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetArea() {
        $tingkat = Yii::$app->request->get('tingkat');
        $term    = Yii::$app->request->get('term');
        
        switch ($tingkat){
            case UserArea::TINGKAT_NASIONAL:
                return json_encode([]);
                break;
            case UserArea::TINGKAT_PROVINSI:
                $data = \backend\models\master\Provinsi::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])->limit(10)
                ->all();
                break;
            case UserArea::TINGKAT_KOTA:
                $data = \backend\models\master\Kota::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])->limit(10)
                ->all();
                break;
            case UserArea::TINGKAT_KECAMATAN:
                $data = \backend\models\master\Kecamatan::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])->limit(10)
                ->all();
                break;
            case UserArea::TINGKAT_KELURAHANs:
                $data = \backend\models\master\Kelurahan::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])->limit(10)
                ->all();
                break;
            case UserArea::TINGKAT_TPS:
                $data = \backend\models\master\Tps::find()
                ->andFilterWhere(['like', 'lower(nama)', strtolower($term)])->limit(10)
                ->all();
                break;
        }
        $datafix = [];
        foreach ($data as $item) {
            $datafix[] = ['id'    => $item->id, 'value' => $item->nama, 'label' => $item->nama];
        }       
        return ($datafix !== null) ? json_encode($datafix) : json_encode([]);
    }
}
