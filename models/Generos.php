<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generos".
 *
 * @property int $id
 * @property string $denom
 * @property string $created_at
 *
 * @property Juegos[] $juegos
 */
class Generos extends \yii\db\ActiveRecord
{
    private $_total = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denom'], 'required'],
            [['created_at'], 'safe'],
            [['denom'], 'string', 'max' => 255],
            [['denom'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denom' => 'Denom',
            'created_at' => 'Created At',
        ];
    }

    public function setTotal($total)
    {
        $this->_total = $total;
    }

    public function getTotal()
    {
        if ($this->_total === null && !$this->isNewRecord) {
            $this->setTotal($this->getJuegos()->count());
        }
        return $this->_total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJuegos()
    {
        return $this->hasMany(Juegos::className(), ['genero_id' => 'id']);
    }
    public static function findWithTotal()
    {
        return static::find()
            ->select(['generos.*', 'COUNT(j.id) AS total'])
            ->joinWith('juegos j', false)
            ->groupBy('generos.id');
    }
}
