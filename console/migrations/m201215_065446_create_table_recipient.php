<?php

use yii\db\Migration;

/**
 * Class m201215_065446_create_table_recipient
 */
class m201215_065446_create_table_recipient extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%recipient}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('recipient_id_seq'::regclass)")->comment('ID'),
		    'center_id' => $this->integer()->comment('Диллерский центр'),
		    'city_id' => $this->integer()->notNull()->comment('Город'),
		    'theme_id' => $this->integer()->notNull()->comment('Тема'),
		    'recipient' => $this->text()->comment('Получатели'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%recipient}}', 'Получатели');

	    $this->addForeignKey(
		    'idx_recipient_center_id_fk_1',
		    'recipient',
		    'center_id',
		    'dealer_center',
		    'id',
		    null,
		    null
	    );

	    $this->addForeignKey(
		    'idx_recipient_city_id_fk_1',
		    'recipient',
		    'city_id',
		    'city',
		    'id',
		    null,
		    null
	    );

	    $this->addForeignKey(
		    'idx_recipient_theme_id_fk_1',
		    'recipient',
		    'theme_id',
		    'theme_message',
		    'id',
		    null,
		    null
	    );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropForeignKey('idx_recipient_city_id_fk_1', '{{%recipient}}');
	    $this->dropForeignKey('idx_recipient_center_id_fk_1', '{{%recipient}}');
	    $this->dropForeignKey('idx_recipient_theme_id_fk_1', '{{%recipient}}');
	    $this->dropTable('{{%recipient}}');
    }

}
