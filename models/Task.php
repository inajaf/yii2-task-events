<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $due_date
 * @property int|null $complete
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Task extends Base
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['user_id', 'complete'], 'integer'],
            [['due_date', 'created_at', 'updated_at'], 'safe'],
            ['due_date', 'validateDate'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function afterFind()
    {
        $this->due_date = date("m/d/Y", strtotime($this->due_date));

        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->getId();
        $this->due_date = date("Y-m-d", strtotime($this->due_date));

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'due_date' => 'Due Date',
            'complete' => 'Complete',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function validateDate(): void
    {
        if (strtotime($this->due_date) < strtotime(date('m/d/Y'))) {
            $this->addError('due_date', 'Due date cannot less than today');
        }
    }
}