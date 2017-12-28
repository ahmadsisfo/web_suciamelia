<?php

namespace frontend\models\master;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\User as CommonUser;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property TbFormulirPendaftaran $tbFormulirPendaftaran
 */
class UserBiasa extends CommonUser
{
    use \mdm\converter\EnumTrait;
    
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE  = 10;
    const STATUS_DELETED  = -1;
    
    const JK_PRIA   = 1;
    const JK_WANITA = 2;
    
    const SCENE_CREATE = 'create';
    
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            
            
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'trim'],
            ['username', 'required'],
            [['username'], 'unique'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on'=>  self::SCENE_CREATE],
                        
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email'], 'unique'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on'=>  self::SCENE_CREATE],
            
            [['password_reset_token'], 'unique'],
            
            ['password', 'required', 'on'=>  self::SCENE_CREATE],
            ['password', 'string', 'min' => 6],
            [['password'], 'safe'],
            //['fullname', 'required'],
            
            //['snode_id', 'exist', 'targetClass' => 'backend\models\master\Snode', 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jk' => 'Jenis Kelamin',
        ];
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbFormulirPendaftaran()
    {
        return $this->hasOne(TbFormulirPendaftaran::className(), ['user_id' => 'id']);
    }
    
    public function getCommonUser()
    {
        return $this->hasOne(\common\models\User::className(), ['user_id' => 'id']);
    }
    
    public function behaviors()
    {
       return [
            ['class'=>TimestampBehavior::className()],
            ['class'=>BlameableBehavior::className()],
            [               
                'class' => 'mdm\behaviors\ar\ExtendedBehavior',
                'relationClass' => TbFormulirPendaftaran::className(),
                'relationKey' => ['id' => 'user_id'],
            ],
       ];
    }
    
    use \mdm\behaviors\ar\RelationTrait;   
    
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['auth_key']);
        unset($fields['password_hash']);
        unset($fields['password_reset_token']);
        return $fields;
    }    
    
    
}
