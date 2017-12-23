<?php

namespace backend\models\approval;


use Yii;
use backend\models\master\TbFormulirPendaftaran;

/**
 * This is the model class for table "tb_pernyataan_survey".
 *
 * @property integer $id
 * @property integer $formulir_pendaftaran_id
 * @property string $nomor
 * @property integer $setuju
 * @property string $desc
 *
 * @property TbPenerima[] $tbPenerimas
 * @property TbFormulirPendaftaran $formulirPendaftaran
 */
class TbPernyataanSurvey extends \yii\db\ActiveRecord
{
    use \mdm\converter\EnumTrait;
    
    const SURVEY_DITOLAK   = 0;
    const SURVEY_DISETUJUI = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_pernyataan_survey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formulir_pendaftaran_id'], 'required'],
            [['formulir_pendaftaran_id', 'setuju'], 'integer'],
            [['nomor'], 'string', 'max' => 32],
            [['desc'], 'string', 'max' => 2048],
            [['formulir_pendaftaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TbFormulirPendaftaran::className(), 'targetAttribute' => ['formulir_pendaftaran_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'formulir_pendaftaran_id' => 'Formulir Pendaftaran ID',
            'nomor' => 'Nomor',
            'setuju' => 'Survey',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPenerimas()
    {
        return $this->hasMany(TbPenerima::className(), ['pernyataan_survey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirPendaftaran()
    {
        return $this->hasOne(TbFormulirPendaftaran::className(), ['id' => 'formulir_pendaftaran_id']);
    }
}
