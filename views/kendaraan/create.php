<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kendaraan */

$this->title = Yii::t('app', 'Kendaraan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Kendaraan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kendaraan-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
