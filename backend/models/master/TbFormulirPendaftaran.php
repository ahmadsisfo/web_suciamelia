<?php

namespace backend\models\master;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "tb_formulir_pendaftaran".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $jenis_zakat_id
 * @property string $nomor
 * @property string $nama
 * @property integer $umur
 * @property integer $jk
 * @property integer $tgl_lahir
 * @property string $alamat
 * @property string $agama
 * @property string $pekerjaan
 * @property integer $status_formulir
 * @property string $no_hp
 * @property resource $upload_surat_permohonan
 * @property resource $upload_ktp
 * @property resource $upload_kk
 * @property resource $upload_surat_keterangan_tidak_mampu
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 *
 * @property User $user
 * @property TbJenisZakat $jenisZakat
 * @property TbPenerima[] $tbPenerimas
 * @property TbPernyataanSurvey[] $tbPernyataanSurveys
 * @property TbZakatBantuanBerobat[] $tbZakatBantuanBerobats
 * @property TbZakatModalUsaha[] $tbZakatModalUsahas
 * @property TbZakatTerlilitHutang[] $tbZakatTerlilitHutangs
 */
class TbFormulirPendaftaran extends \yii\db\ActiveRecord
{
    use \mdm\converter\EnumTrait;
     
    const SCENE_UPDATE      = 'update';
    const SCENE_NULL_NUMBER = 'blank';
    
    const STATUS_DELETED          = -1;
    //const STATUS_TERDAFTAR        = NULL;
    const STATUS_SURVEY_DISETUJUI = 1;
    const STATUS_SURVEY_DITOLAK   = 0;
    const STATUS_PENERIMA         = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_formulir_pendaftaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_zakat_id','nama'], 'required', 'on'=> UserBiasa::SCENE_CREATE],
            [['jenis_zakat_id','nama'], 'required', 'on'=>  self::SCENE_UPDATE],
            [['nomor'], 'autonumber', 'format' => 'BAZ' . date('y'). date('m') . '?', 'digit' => 3, 'on' => static::SCENE_NULL_NUMBER],
            [['user_id', 'jenis_zakat_id', 'umur', 'jk', 'tgl_lahir', 'status_formulir', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['upload_surat_permohonan', 'upload_ktp', 'upload_kk', 'upload_surat_keterangan_tidak_mampu'], 'string'],
            [['nomor'], 'string', 'max' => 32],
            [['nama', 'agama', 'pekerjaan'], 'string', 'max' => 256],
            [['alamat'], 'string', 'max' => 1024],
            [['no_hp'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserBiasa::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['jenis_zakat_id'], 'exist', 'skipOnError' => true, 'targetClass' => TbJenisZakat::className(), 'targetAttribute' => ['jenis_zakat_id' => 'id']],
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
            'jenis_zakat_id' => 'Jenis Zakat ID',
            'nomor' => 'Nomor',
            'nama' => 'Nama',
            'umur' => 'Umur',
            'jk' => 'Jenis kelamin',
            'tgl_lahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'agama' => 'Agama',
            'pekerjaan' => 'Pekerjaan',
            'status' => 'Status',
            'no_hp' => 'No Hp',
            'upload_surat_permohonan' => 'Upload Surat Permohonan',
            'upload_ktp' => 'Upload Ktp',
            'upload_kk' => 'Upload Kk',
            'upload_surat_keterangan_tidak_mampu' => 'Upload Surat Keterangan Tidak Mampu',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisZakat()
    {
        return $this->hasOne(TbJenisZakat::className(), ['id' => 'jenis_zakat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPenerimas()
    {
        return $this->hasMany(TbPenerima::className(), ['formulir_pendaftaran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPernyataanSurveys()
    {
        return $this->hasMany(TbPernyataanSurvey::className(), ['formulir_pendaftaran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbZakatBantuanBerobats()
    {
        return $this->hasMany(TbZakatBantuanBerobat::className(), ['formulir_pendaftaran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbZakatModalUsahas()
    {
        return $this->hasMany(TbZakatModalUsaha::className(), ['formulir_pendaftaran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbZakatTerlilitHutangs()
    {
        return $this->hasMany(TbZakatTerlilitHutang::className(), ['formulir_pendaftaran_id' => 'id']);
    }
    
    public function behaviors()
    {
        return [
            ['class'=>TimestampBehavior::className()],
            ['class'=>BlameableBehavior::className()],           
        ];       
    }
}
