<?php

use yii\db\Migration;

/**
 * Class m201214_141707_create_table_city
 */
class m201214_141707_create_table_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%city}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('city_id_seq'::regclass)")->comment('ID'),
		    'name' => $this->string()->notNull()->unique()->comment('Название'),
		    'code' => $this->string()->notNull()->unique()->comment('Символьный код'),
		    'social' => $this->text()->null()->comment('Соцсети'),
		    'phone' => $this->string()->notNull()->comment('Телефон'),
		    'email' => $this->string()->null()->comment('E-mail'),
		    'phone_support' => $this->string()->null()->comment('Телефон поддержки'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%city}}', 'Города');

	    $this->insert('{{%city}}', [
		    'name' => 'Нижний Новгород',
		    'code' =>'nn',
		    'phone' => '+7 (831) 2-826-530',
		    'email' => 'sale@domen.com',
		    'created_at' => time(),
		    'updated_at' => time(),
	    ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%city}}');
    }

}
