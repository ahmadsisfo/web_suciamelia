<?php

namespace backend\models\master;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_admin".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $nama
 * @property string $jabatan
 * @property integer $umur
 * @property integer $tgl_lahir
 * @property integer $jk
 * @property string $agama
 * @property string $alamat
 * @property integer $status
 * @property string $no_hp
 * @property resource $foto
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property User $user
 */
class TbAdmin extends \yii\db\ActiveRecord
{
    const SCENE_UPDATE = 'update';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama','no_hp'], 'required', 'on'=>  User::SCENE_CREATE],
            [['nama','no_hp'], 'required', 'on'=>  self::SCENE_UPDATE],
            [['user_id', 'umur', 'jk', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['foto'], 'string'],
            [['nama', 'jabatan', 'agama'], 'string', 'max' => 256],
            [['alamat'], 'string', 'max' => 1024],
            [['no_hp'], 'string', 'max' => 64],
            [['tgl_lahir'],'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'umur' => 'Umur',
            'tgl_lahir' => 'Tgl Lahir',
            'jk' => 'Jk',
            'agama' => 'Agama',
            'alamat' => 'Alamat',
            'status' => 'Status',
            'no_hp' => 'No Hp',
            'foto' => 'Foto',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function behaviors()
    {
        return [
            ['class'=>TimestampBehavior::className()],
            ['class'=>BlameableBehavior::className()],
           
        ];
       
    }
    
   
}
