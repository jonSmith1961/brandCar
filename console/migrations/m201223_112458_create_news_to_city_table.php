<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news_to_city}}`.
 */
class m201223_112458_create_news_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

	    $this->createTable('{{%news_to_city}}', [
		    'news_id' => $this->integer()->notNull()->comment('id новости'),
		    'city_id' => $this->integer()->notNull()->comment('id города'),
	    ]);

	    $this->addCommentOnTable('{{%news_to_city}}', 'Таблица связи новости с городами');

	    $this->addPrimaryKey('news_id_city_id_pk', 'news_to_city', ['news_id', 'city_id']);

	    $this->addForeignKey(
		    'news_to_city_news_fk_1',
		    'news_to_city', 'news_id',
		    'news', 'id',
		    'CASCADE',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'news_to_city_city_id_fk_2',
		    'news_to_city', 'city_id',
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
	    $this->dropForeignKey('news_to_city_news_fk_1', '{{%news_to_city}}');
	    $this->dropForeignKey('news_to_city_city_id_fk_2', '{{%news_to_city}}');

	    $this->dropTable('{{%news_to_city}}');
    }
}
