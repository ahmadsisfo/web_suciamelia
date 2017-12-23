<?php

namespace backend\models\approval;


use Yii;
use backend\models\master\TbFormulirPendaftaran;
/**
 * This is the model class for table "tb_penerima".
 *
 * @property integer $id
 * @property integer $formulir_pendaftaran_id
 * @property integer $pernyataan_survey_id
 * @property string $jumlah_zakat
 * @property string $desc
 *
 * @property TbFormulirPendaftaran $formulirPendaftaran
 * @property TbPernyataanSurvey $pernyataanSurvey
 */
class TbPenerima extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_penerima';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formulir_pendaftaran_id', 'pernyataan_survey_id'], 'required'],
            [['formulir_pendaftaran_id', 'pernyataan_survey_id'], 'integer'],
            [['jumlah_zakat'], 'string', 'max' => 1024],
            [['desc'], 'string', 'max' => 2048],
            [['formulir_pendaftaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => TbFormulirPendaftaran::className(), 'targetAttribute' => ['formulir_pendaftaran_id' => 'id']],
            [['pernyataan_survey_id'], 'exist', 'skipOnError' => true, 'targetClass' => TbPernyataanSurvey::className(), 'targetAttribute' => ['pernyataan_survey_id' => 'id']],
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
            'pernyataan_survey_id' => 'Pernyataan Survey ID',
            'jumlah_zakat' => 'Jumlah Zakat',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirPendaftaran()
    {
        return $this->hasOne(TbFormulirPendaftaran::className(), ['id' => 'formulir_pendaftaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPernyataanSurvey()
    {
        return $this->hasOne(TbPernyataanSurvey::className(), ['id' => 'pernyataan_survey_id']);
    }
}
