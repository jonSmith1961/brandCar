<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%content_block}}`.
 */
class m201225_073531_create_content_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%content_block}}', [
	        'id' => $this->primaryKey()->notNull()->defaultValue("nextval('content_block_id_seq'::regclass)")->comment('ID'),
	        'name' => $this->string()->notNull()->unique()->comment('Название'),
	        'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
	        'code' => $this->string()->notNull()->unique()->comment('Символьный код'),
	        'content' => $this->text()->notNull()->comment('Текст'),
	        'created_at' => $this->integer()->notNull()->comment('Дата создания'),
	        'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%content_block}}');
    }
}
