<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\master\UserBiasa;
use frontend\models\master\TbFormulirPendaftaran;
use frontend\models\master\TbJenisZakat;
use frontend\models\master\TbZakatBantuanBerobat;
use frontend\models\master\TbZakatModalUsaha;
use frontend\models\master\TbZakatTerlilitHutang;
use backend\models\approval\TbPenerima;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        return $this->redirect(['pengumuman']);
        //return $this->render('index');
    }
    
    public function actionSyarat()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('syarat');
    }
    
    public function actionPengumuman()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        
        return $this->render('pengumuman',[
            'status' => $this->getStatus(),
        ]);
    }
    
    private function getStatus(){
        $user = Yii::$app->user->identity;
        $user = UserBiasa::findOne($user->id);
        if($user->tbFormulirPendaftaran == null){
            return [
                'status'    =>'Belum Terdaftar',
                'text'      =>'Anda Belum Terdaftar, Silahkan Isi dan Lengkapi Formulir Anda Terlebih Dahulu',
                'alert'     =>'warning',
            ];
        } else {
            switch($user->tbFormulirPendaftaran->status_formulir){
                case TbFormulirPendaftaran::STATUS_PENERIMA:
                    return [
                        'penerima'  => TbPenerima::findOne(['formulir_pendaftaran_id'=>$user->tbFormulirPendaftaran->id]),
                        'status'=>'Penerima',
                        'text'  =>'Selamat, Anda diterima sebagai penerima Zakat',
                        'alert' =>'success',

                    ];
                case TbFormulirPendaftaran::STATUS_SURVEY_DITOLAK:
                    return [
                        'status'=>'Survey Ditolak',
                        'text'  =>'Mohon Maaf, Permohonan anda belum kami setujui',
                        'alert' =>'danger',
                    ];
                case TbFormulirPendaftaran::STATUS_SURVEY_DISETUJUI:
                    return [
                        'status'=>'Survey Disetujui',
                        'text'  =>'Hasil survey menyatakan anda layak untuk menerima zakat. Saat ini sedang dalam proses approval oleh pihak Direksi. Harap Menunggu.',
                        'alert' =>'info',
                    ];                        
                default :
                    return [
                        'status'=>'Terdaftar',
                        'text'  =>'Anda Sudah Terdaftar.',
                        'alert' =>'primary',

                    ];
                    break;
                    
            }
            
            
        }        
    }
    
    public function actionFormulir(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user_id = Yii::$app->user->identity;
        
        $model = UserBiasa::findOne($user_id->id);
        $model->setScenario(TbFormulirPendaftaran::SCENE_UPDATE); 
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->tbFormulirPendaftaran == null){
                $newForm = new TbFormulirPendaftaran();
                $newForm->user_id = $model->id;
                $newForm->nama = $model->nama;
                $newForm->jenis_zakat_id = $model->jenis_zakat_id;
                if(!$newForm->save()){
                    print_r($newForm->getErrors());
                    return;
                }
                $model = UserBiasa::findOne($user_id->id);
                $model->load(Yii::$app->request->post());
            }
            
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
                    return $this->redirect(['formulir', 'id' => $model->tbFormulirPendaftaran->id]);
                    
                } 
            } catch (\Exception $exc) {               
                $transaction->rollBack();               
            }
            
            
        } 
        
        $zakat = $this->getTypeZakat($model);
        $model->tgl_lahir = $model->tgl_lahir?date("d/m/Y", $model->tgl_lahir):'';
        return $this->render('_form', [
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            return $this->redirect(['pengumuman']);
            //return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
