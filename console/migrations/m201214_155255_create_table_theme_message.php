<?php

use yii\db\Migration;

/**
 * Class m201214_155255_create_table_theme_message
 */
class m201214_155255_create_table_theme_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%theme_message}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('theme_message_id_seq'::regclass)")->comment('ID'),
		    'name' => $this->string()->notNull()->comment('Название'),
		    'code' => $this->string()->notNull()->unique()->comment('Символьный код'),
		    'theme_crm' => $this->string()->notNull()->comment('Причина обращения'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%theme_message}}', 'Темы обращений');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%theme_message}}');
    }

}
