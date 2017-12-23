<?php

namespace backend\models\master;

use Yii;

/**
 * This is the model class for table "tb_jenis_zakat".
 *
 * @property integer $id
 * @property string $nama
 * @property string $desc
 *
 * @property TbFormulirPendaftaran[] $tbFormulirPendaftarans
 */
class TbJenisZakat extends \yii\db\ActiveRecord
{
    use \mdm\converter\EnumTrait;
    
    const ZAKAT_BANTUAN_BEROBAT = 1;
    const ZAKAT_MODAL_USAHA     = 2;
    const ZAKAT_TERLILIT_HUTANG = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_jenis_zakat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 256],
            [['desc'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbFormulirPendaftarans()
    {
        return $this->hasMany(TbFormulirPendaftaran::className(), ['jenis_zakat_id' => 'id']);
    }
}
