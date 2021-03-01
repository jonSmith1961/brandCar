<?php

use yii\db\Migration;

/**
 * Class m201215_182535_create_table_models
 */
class m201215_182535_create_table_models extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('{{%models}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('models_id_seq'::regclass)")->comment('ID'),
		    'name' => $this->string()->notNull()->comment('Название'),
		    'menu_name' => $this->string()->notNull()->comment('Название в меню'),
		    'title' => $this->string()->notNull()->comment('Заголовок'),
		    'code' => $this->string()->notNull()->unique()->comment('Символьный код'),
		    'brief' => $this->text()->notNull()->comment('Описание'),
		    'qualities' => $this->text()->notNull()->comment('Особенности'),
		    'text_middle' => $this->text()->null()->comment('Описание в середине'),
		    'text_preview' => $this->text()->null()->comment('Описание внизу слева'),
		    'text_col' => $this->text()->null()->comment('Описание внизу справа'),
		    'warranty_year' => $this->text()->null()->comment('Гарантия в годах'),
		    'warranty_mileage' => $this->text()->null()->comment('Гарантия в км'),
		    'preview_picture' => $this->integer()->null()->comment('Картинка анонса'),
		    'detail_picture' => $this->integer()->null()->comment('Детальная картинка'),
		    'specifications_file' => $this->integer()->comment('Файл технические характеристики модельного ряда'),
		    'catalog_file' => $this->integer()->comment('Файл каталога'),
		    'gallery1_id' => $this->integer()->comment('Слайдер1'),
		    'gallery2_id' => $this->integer()->comment('Слайдер2'),
		    'gallery3_id' => $this->integer()->comment('Слайдер3'),
		    'sort' => $this->integer()->comment('Порядок'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);
	    $this->addCommentOnTable('{{%models}}', 'Модели');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%models}}');
    }

}
