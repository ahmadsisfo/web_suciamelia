<?php

namespace frontend\models\master;

use Yii;

/**
 * This is the model class for table "tb_zakat_bantuan_berobat".
 *
 * @property integer $id
 * @property integer $formulir_pendaftaran_id
 * @property resource $upload_surat_keterangan_sakit
 * @property resource $upload_foto_bukti_sakit
 * @property resource $upload_kwitansi
 * @property resource $upload_foto_rumah
 *
 * @property TbFormulirPendaftaran $formulirPendaftaran
 */
class TbZakatBantuanBerobat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_zakat_bantuan_berobat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formulir_pendaftaran_id'], 'required'],
            [['formulir_pendaftaran_id'], 'integer'],
            [['upload_surat_keterangan_sakit', 'upload_foto_bukti_sakit', 'upload_kwitansi', 'upload_foto_rumah'], 'string'],
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
            'upload_surat_keterangan_sakit' => 'Upload Surat Keterangan Sakit',
            'upload_foto_bukti_sakit' => 'Upload Foto Bukti Sakit',
            'upload_kwitansi' => 'Upload Kwitansi',
            'upload_foto_rumah' => 'Upload Foto Rumah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirPendaftaran()
    {
        return $this->hasOne(TbFormulirPendaftaran::className(), ['id' => 'formulir_pendaftaran_id']);
    }
}
