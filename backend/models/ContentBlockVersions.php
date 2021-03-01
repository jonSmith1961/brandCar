<?php

namespace backend\models;


/**
 * This is the model class for table "content_block_versions".
 *
 * @property int $id ID
 * @property int $content_id Блок контента
 * @property string $content Контент
 * @property int $created_at Дата создания
 *
 * @property ContentBlock $content0
 */
class ContentBlockVersions  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_block_versions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_id', 'content'], 'required'],
            [['content_id', 'created_at'], 'default', 'value' => null],
            [['content_id', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentBlock::className(), 'targetAttribute' => ['content_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Блок контента',
            'content' => 'Контент',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Content0]].
     *
     * @return \yii\db\ActiveQuery|ContentBlockQuery
     */
    public function getContent0()
    {
        return $this->hasOne(ContentBlock::className(), ['id' => 'content_id']);
    }

    /**
     * {@inheritdoc}
     * @return ContentBlockVersionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentBlockVersionsQuery(get_called_class());
    }
}
