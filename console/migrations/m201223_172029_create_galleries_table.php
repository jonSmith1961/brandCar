<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%galleries}}`.
 */
class m201223_172029_create_galleries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%galleries}}', [
	        'id' => $this->primaryKey()->notNull()->defaultValue("nextval('galleries_id_seq'::regclass)")->comment('ID'),
	        'name' => $this->string()->notNull()->unique()->comment('Название'),
	        'title' => $this->string()->comment('Заголовок'),
	        'group' => $this->string()->comment('Группа'),
	        'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
	        'code' => $this->string()->notNull()->unique()->comment('Символьный код'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%galleries}}');
    }
}
