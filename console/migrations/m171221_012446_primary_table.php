<?php

use yii\db\Migration;

/**
 * Class m171221_012446_primary_table
 */
class m171221_012446_primary_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('tb_jenis_zakat', [
            'id'    => $this->primaryKey(),
            'nama'  => $this->string(256)->notNull(),
            'desc'  => $this->string(2048),
                ], $tableOptions);

        $this->createTable('tb_admin', [
            'id'        => $this->primaryKey(),
            'user_id'   => $this->integer()->notNull(),
            'nama'      => $this->string(256),
            'jabatan'   => $this->string(256),
            'umur'      => $this->smallInteger(),
            'tgl_lahir' => $this->integer(),
            'jk'        => $this->smallInteger(),
            'agama'     => $this->string(256),
            'alamat'    => $this->string(1024),
            'status'    => $this->smallInteger(),
            'no_hp'     => $this->string(64),
            'foto'      => 'LONGBLOB',
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'FOREIGN KEY ([[user_id]]) REFERENCES user ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
                ], $tableOptions);

        $this->createTable('tb_formulir_pendaftaran', [
            'id'            => $this->primaryKey(),
            'user_id'       => $this->integer()->notNull(),
            'jenis_zakat_id'=> $this->integer()->notNull(),
            'nomor'         => $this->string(32),
            'nama'          => $this->string(256),
            'umur'          => $this->smallInteger(),
            'jk'            => $this->smallInteger(),
            'tgl_lahir'     => $this->integer(),
            'alamat'        => $this->string(1024),
            'agama'         => $this->string(256),
            'pekerjaan'     => $this->string(256),
            'status'        => $this->smallInteger(),
            'no_hp'         => $this->string(64),
            'upload_surat_permohonan'   => 'LONGBLOB',
            'upload_ktp'    => 'LONGBLOB',
            'upload_kk'     => 'LONGBLOB',
            'upload_surat_keterangan_tidak_mampu'   => 'LONGBLOB',
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'FOREIGN KEY ([[user_id]]) REFERENCES user ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[jenis_zakat_id]]) REFERENCES tb_jenis_zakat ([[id]]) ON UPDATE CASCADE',
                ], $tableOptions);
        
        $this->createTable('tb_zakat_bantuan_berobat', [
            'id'            => $this->primaryKey(),
            'formulir_pendaftaran_id'   => $this->integer()->notNull(),
            'upload_surat_keterangan_sakit' => 'LONGBLOB',
            'upload_foto_bukti_sakit'   => 'LONGBLOB',
            'upload_kwitansi'   => 'LONGBLOB',
            'upload_foto_rumah' => 'LONGBLOB',
            'FOREIGN KEY ([[formulir_pendaftaran_id]]) REFERENCES tb_formulir_pendaftaran ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',            
        ], $tableOptions);
        
        $this->createTable('tb_zakat_modal_usaha', [
            'id'            => $this->primaryKey(),
            'formulir_pendaftaran_id'   => $this->integer()->notNull(),
            'nama_usaha'    => $this->string(256),
            'jenis_usaha'   => $this->string(256),
            'rincian_anggaran_biaya'    => $this->string(10024),
            'upload_foto_ukm'   => 'LONGBLOB',
            'upload_foto_tempat_usaha' => 'LONGBLOB',
            'FOREIGN KEY ([[formulir_pendaftaran_id]]) REFERENCES tb_formulir_pendaftaran ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',            
        ], $tableOptions);
        
        $this->createTable('tb_zakat_terlilit_hutang', [
            'id'            => $this->primaryKey(),
            'formulir_pendaftaran_id'   => $this->integer()->notNull(),
            'upload_surat_keterangan_hutang'   => 'LONGBLOB',
            'upload_foto_rumah' => 'LONGBLOB',
            'FOREIGN KEY ([[formulir_pendaftaran_id]]) REFERENCES tb_formulir_pendaftaran ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',            
        ], $tableOptions);
        
        $this->createTable('tb_pernyataan_survey', [
            'id'                        => $this->primaryKey(),
            'formulir_pendaftaran_id'   => $this->integer()->notNull(),
            'nomor'                     => $this->string(32),
            'setuju'                    => $this->integer(),
            'desc'                      => $this->string(2048),
            'FOREIGN KEY ([[formulir_pendaftaran_id]]) REFERENCES tb_formulir_pendaftaran ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',            
        ], $tableOptions);
                
        $this->createTable('tb_penerima', [
            'id'                        => $this->primaryKey(),
            'formulir_pendaftaran_id'   => $this->integer()->notNull(),
            'pernyataan_survey_id'      => $this->integer()->notNull(),
            'jumlah_zakat'              => $this->string(1024),
            'desc'                      => $this->string(2048),
            'FOREIGN KEY ([[formulir_pendaftaran_id]]) REFERENCES tb_formulir_pendaftaran ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',            
            'FOREIGN KEY ([[pernyataan_survey_id]]) REFERENCES tb_pernyataan_survey ([[id]]) ON UPDATE CASCADE',            
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $table_list = ['tb_penerima','tb_pernyataan_survey','tb_zakat_terlilit_hutang','tb_zakat_modal_usaha','tb_zakat_bantuan_berobat','tb_formulir_pendaftaran','tb_admin','tb_jenis_zakat',];
        foreach ($table_list as $darr) {
            if ($this->db->schema->getTableSchema($darr, true) !== null) {
                $this->dropTable($darr);
            }
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171221_012446_primary_table cannot be reverted.\n";

        return false;
    }
    */
}
