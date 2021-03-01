<?php

use yii\db\Migration;

/**
 * Class m201215_084239_create_table_files
 */
class m201215_084239_create_table_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%files}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('file_id_seq'::regclass)")->comment('ID'),
		    'original_name' => $this->string()->notNull()->comment('Оригинальное название'),
		    'type' => $this->string()->null()->comment('Тип'),
		    'filename' => $this->string()->comment('Имя файла'),
		    'width' => $this->integer()->null()->comment('Ширина'),
		    'height' => $this->integer()->null()->comment('Высота'),
		    'size' => $this->integer()->null()->comment('Размер'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%files}}', 'Файлы');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%files}}');
    }

}
