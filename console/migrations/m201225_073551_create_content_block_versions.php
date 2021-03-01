<?php

use yii\db\Migration;

/**
 * Class m201225_073551_create_content_block_versions
 */
class m201225_073551_create_content_block_versions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%content_block_versions}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('content_block_versions_id_seq'::regclass)")->comment('ID'),
		    'content_id' => $this->integer()->notNull()->comment('Блок контента'),
		    'content' => $this->text()->notNull()->comment('Контент'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
	    ]);

	    $this->addForeignKey(
		    'content_block_versions_ibfk_1',
		    'content_block_versions',
		    'content_id',
		    'content_block',
		    'id',
		    'CASCADE',
		    'CASCADE'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

	    $this->dropForeignKey('content_block_versions_ibfk_1', '{{%content_block_versions}}');

	    $this->dropTable('{{%content_block_versions}}');
    }

}
