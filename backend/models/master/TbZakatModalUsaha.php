<?php

namespace backend\models\master;

use Yii;

/**
 * This is the model class for table "tb_zakat_modal_usaha".
 *
 * @property integer $id
 * @property integer $formulir_pendaftaran_id
 * @property string $nama_usaha
 * @property string $jenis_usaha
 * @property string $rincian_anggaran_biaya
 * @property resource $upload_foto_ukm
 * @property resource $upload_foto_tempat_usaha
 *
 * @property TbFormulirPendaftaran $formulirPendaftaran
 */
class TbZakatModalUsaha extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_zakat_modal_usaha';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formulir_pendaftaran_id'], 'required'],
            [['formulir_pendaftaran_id'], 'integer'],
            [['upload_foto_ukm', 'upload_foto_tempat_usaha'], 'string'],
            [['nama_usaha', 'jenis_usaha'], 'string', 'max' => 256],
            [['rincian_anggaran_biaya'], 'string', 'max' => 10024],
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
            'nama_usaha' => 'Nama Usaha',
            'jenis_usaha' => 'Jenis Usaha',
            'rincian_anggaran_biaya' => 'Rincian Anggaran Biaya',
            'upload_foto_ukm' => 'Upload Foto Ukm',
            'upload_foto_tempat_usaha' => 'Upload Foto Tempat Usaha',
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
