    <?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use hscstudio\mimin\components\Mimin;

$menuItems =
        [
                //       [
                //         'visible' => !Yii::$app->user->isGuest,
                //         'label' => 'User / Group',
                //         'icon' => 'fa fa-share',
                //         'url' => '#',
                //         'items' => [
                //     ['label' => 'App. Route', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/route/'], 'visible' => !Yii::$app->user->isGuest],
                //     ['label' => 'Role', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/role/'], 'visible' => !Yii::$app->user->isGuest],
                //     ['label' => 'User', 'icon' => ' fa fa-circle-o', 'url' => ['/user/'], 'visible' => !Yii::$app->user->isGuest],
                //    ], ],
                      [
                        'visible' => !Yii::$app->user->isGuest,
                        'label' => 'Master',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Pangkat', 'icon' => ' fa fa-circle-o', 'url' => ['/pangkat/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => 'Alat Kelengkapan', 'icon' => ' fa fa-circle-o', 'url' => ['/alat-kelengkapan/index'], 'visible' => !Yii::$app->user->isGuest],
                            ['label' => 'Kegiatan', 'icon' => ' fa fa-circle-o', 'url' => ['/kegiatan/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Kota', 'icon' => ' fa fa-circle-o', 'url' => ['/kota/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Kendaraan', 'icon' => ' fa fa-circle-o', 'url' => ['/kendaraan/index'], 'visible' => !Yii::$app->user->isGuest],
                 ['label' => 'Tarif', 'icon' => ' fa fa-circle-o', 'url' => ['/tarif/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Personil', 'icon' => ' fa fa-circle-o', 'url' => ['/personil/index'], 'visible' => !Yii::$app->user->isGuest],
                                        ], ],
        [
            'visible' => !Yii::$app->user->isGuest,
            'label' => 'Perjalanan Dinas',
            'icon' => 'fa fa-share',
            'url' => '#',
            'items' => [
                ['label' => 'Mapping Alat Kelengkapan', 'icon' => ' fa fa-circle-o', 'url' => ['/alat-kelengkapan/index-mapping'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Surat Perintah Tugas', 'icon' => ' fa fa-circle-o', 'url' => ['/surat-perintah-tugas/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Surat Perintah Perjalanan Dinas', 'icon' => ' fa fa-circle-o', 'url' => ['/surat-perintah-tugas/index-sppd'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'Kwitansi', 'icon' => ' fa fa-circle-o', 'url' => ['/surat-perintah-tugas/index-kwitansi'], 'visible' => !Yii::$app->user->isGuest],
            ],
        ],
            ];

 if (!Yii::$app->user->isGuest) {
     if (Yii::$app->user->identity->username !== 'admin') {
         $menuItems = Mimin::filterMenu($menuItems);
     }
 }

?>


<?php
NavBar::begin([
        'brandLabel' => '<img src="'.Url::to(['/Image/logo.png']).'" class="pull-left"   /> ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-left',
        ],
        'innerContainerOptions' => [
            'class' => 'container',
        ],
    ]);

     echo Nav::widget([
         'options' => ['class' => 'navbar-nav navbar-left'],
         'items' => $menuItems,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => Yii::$app->user->isGuest ? 'Login' : 'Logout',
                'url' => [Yii::$app->user->isGuest ? 'site/login' : '/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
            ],
        ],
    ]);

    NavBar::end();
    ?>
