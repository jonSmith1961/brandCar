<?php

use yii\db\Migration;

/**
 * Class m201214_155856_create_table_dealer_center
 */
class m201214_155856_create_table_dealer_center extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

	    $this->createTable('{{%dealer_center}}', [
		    'id' => $this->primaryKey()->notNull()->defaultValue("nextval('dealer_center_id_seq'::regclass)")->comment('ID'),
		    'name' => $this->string()->notNull()->comment('Название'),
		    'city_id' => $this->integer()->comment('Город'),
		    'phone' => $this->string()->notNull()->comment('Телефон'),
		    'email' => $this->string()->null()->comment('E-mail'),
		    'address' => $this->string()->notNull()->comment('Адрес'),
		    'post_code' => $this->string()->null()->comment('Индекс'),
		    'latitude' => $this->string()->null()->comment('Координаты широта'),
		    'longitude' => $this->string()->null()->comment('Координаты долгота'),
		    'map_link' => $this->string()->null()->comment('Ссылка для карты'),
		    'active' => $this->integer(1)->notNull()->defaultValue(1)->comment('Активность'),
		    'start_time' => $this->string()->notNull()->comment('Начало работы в будни'),
		    'end_time' => $this->string()->notNull()->comment('Окончание работы в будни'),
		    'start_time_saturday' => $this->string()->null()->comment('Начало работы в субботу'),
		    'end_time_saturday' => $this->string()->null()->comment('Окончание работы в субботу'),
		    'start_time_sunday' => $this->string()->null()->comment('Начало работы в восскресенье'),
		    'end_time_sunday' => $this->string()->null()->comment('Окончание работы в восскресенье'),
		    'start_time_holidays' => $this->string()->null()->comment('Начало работы в праздники'),
		    'end_time_holidays' => $this->string()->null()->comment('Окончание работы в праздники'),
		    'created_at' => $this->integer()->notNull()->comment('Дата создания'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата обновления')
	    ]);
	    $this->addCommentOnTable('dealer_center', 'Диллерские центры');


	    $this->addForeignKey(
		    'idx_dealer_center_city_id_fk_1',
		    'dealer_center',
		    'city_id',
		    'city',
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
	    $this->dropForeignKey('idx_dealer_center_city_id_fk_1', '{{%dealer_center}}');
	    $this->dropTable('{{%dealer_center}}');
    }

}
