<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specials_to_city}}`.
 */
class m201225_071727_create_specials_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

	    $this->createTable('{{%specials_to_city}}', [
		    'specials_id' => $this->integer()->notNull()->comment('id акции'),
		    'city_id' => $this->integer()->notNull()->comment('id города'),
	    ]);

	    $this->addCommentOnTable('{{%specials_to_city}}', 'Таблица связи акции с городами');

	    $this->addPrimaryKey('specials_id_city_id_pk', 'specials_to_city', ['specials_id', 'city_id']);

	    $this->addForeignKey(
		    'specials_to_city_specials_fk_1',
		    'specials_to_city', 'specials_id',
		    'specials', 'id',
		    'CASCADE',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'specials_to_city_city_id_fk_2',
		    'specials_to_city', 'city_id',
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
	    $this->dropForeignKey('specials_to_city_specials_fk_1', '{{%specials_to_city}}');
	    $this->dropForeignKey('specials_to_city_city_id_fk_2', '{{%specials_to_city}}');

	    $this->dropTable('{{%specials_to_city}}');
    }
}
