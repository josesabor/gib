<?php

use yii\bootstrap4\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'Lista de Juegos';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="generos-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $juegosSearch,
        'columns' => [

            [
                'attribute' => 'id',
                'label' => 'Numero',
            ],
            [
                'attribute' => 'fecha',
                'format' => 'date',
            ],
            'nombre',
            [
                'attribute' => 'consola.denom',
                'label' => 'Consola',
                'filter' => ArrayHelper::map(\app\models\Consolas::find()->asArray()->all(), 'id', 'denom'),
            ],
            [
                'attribute' => 'pasado',
                'format' => 'boolean',
            ],
            [
                'attribute' => 'genero.denom',
                'label' => 'Genero',
                'filter' => ArrayHelper::map(\app\models\Generos::find()->asArray()->all(), 'id', 'denom'),
            ],
            'year_debut',
            ['class' => ActionColumn::class],
        ],
    ]) ?>

    <div class="row">
        <div class="col">
            <?= Html::a(
                'Insertar',
                ['juegos/create'],
                ['class' => 'btn btn-sm btn-primary']
            ) ?>
        </div>
    </div>
</div>