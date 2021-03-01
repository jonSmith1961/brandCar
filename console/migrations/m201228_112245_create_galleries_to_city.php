<?php

use yii\db\Migration;

/**
 * Class m201228_112245_create_galleries_to_city
 */
class m201228_112245_create_galleries_to_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%galleries_to_city}}', [
		    'galleries_id' => $this->integer()->notNull()->comment('id новости'),
		    'city_id' => $this->integer()->notNull()->comment('id города'),
	    ]);

	    $this->addCommentOnTable('{{%galleries_to_city}}', 'Таблица связи галереи с городами');

	    $this->addPrimaryKey('galleries_id_city_id_pk', 'galleries_to_city', ['galleries_id', 'city_id']);

	    $this->addForeignKey(
		    'galleries_to_city_galleries_fk_1',
		    'galleries_to_city', 'galleries_id',
		    'galleries', 'id',
		    'CASCADE',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'galleries_to_city_city_id_fk_2',
		    'galleries_to_city', 'city_id',
		    'city', 'id',
		    'CASCADE',
		    'CASCADE'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropForeignKey('galleries_to_city_galleries_fk_1', '{{%galleries_to_city}}');
	    $this->dropForeignKey('galleries_to_city_city_id_fk_2', '{{%galleries_to_city}}');

	    $this->dropTable('{{%galleries_to_city}}');
    }

}
