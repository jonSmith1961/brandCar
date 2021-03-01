<?php

use yii\db\Migration;

/**
 * Class m201225_073615_create_content_block_to_city
 */
class m201225_073615_create_content_block_to_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%content_block_to_city}}', [
		    'content_block_id' => $this->integer()->notNull()->comment('ID контент блока'),
		    'city_id' => $this->integer()->notNull()->comment('ID города'),
	    ]);

	    $this->addPrimaryKey('content_block_id_city_id_pk', '{{%content_block_to_city}}', ['content_block_id', 'city_id']);

	    $this->addForeignKey(
		    'content_block_to_city_content_block_ibfk_1',
		    'content_block_to_city',
		    'content_block_id',
		    'content_block',
		    'id',
		    'CASCADE',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'content_block_to_city_city_id_ibfk_2',
		    'content_block_to_city',
		    'city_id',
		    'city',
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
	    $this->dropForeignKey('content_block_to_city_content_block_ibfk_1', '{{%content_block_to_city}}');
	    $this->dropForeignKey('content_block_to_city_city_id_ibfk_2', '{{%content_block_to_city}}');

	    $this->dropTable('{{%content_block_to_city}}');
    }

}
