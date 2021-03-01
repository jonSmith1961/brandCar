<?php

use yii\db\Migration;

/**
 * Class m201215_091323_create_table_news
 */
class m201215_091323_create_table_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%news}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('news_id_seq'::regclass)")->comment('ID'),
		    'alias' => $this->string()->notNull()->unique()->comment('Символьный код'),
		    'title' => $this->string()->notNull()->comment('Заголовок'),
		    'brief' => $this->text()->notNull()->comment('Анонс'),
		    'text' => $this->text()->null()->comment('Текст'),
		    'sub_title' => $this->text()->null()->comment('Подзаголовок'),
		    'active_from' => $this->integer()->notNull()->comment('Дата'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'sort' => $this->integer()->null()->comment('Сортировка'),
		    'preview_picture' => $this->integer()->null()->comment('Картинка анонса'),
		    'detail_picture' => $this->integer()->null()->comment('Детальная картинка'),
		    'gallery1_id' => $this->integer()->comment('Слайдер1'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);

	    $this->addCommentOnTable('{{%news}}', 'Новости');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%news}}');
    }

}
