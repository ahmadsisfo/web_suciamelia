<?php

$temp_task = [];
$task = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->getId());
foreach ($task as $key => $value) {
    $temp_task[] = $key;
}

$troles = [];
$user_roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
foreach ($user_roles as $key => $value) {
    $troles[] = $key;
}
$temp_roles = array_merge($troles, $temp_task);
//$temp_roles = [];

return[
    //'<li class="header">MAIN NAVIGATION</li>',
    ['label' => 'Syarat & Ketentuan', 'icon' => 'balance-scale', 'fa'=>true, 'url'=>['site/syarat'],'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Formulir', 'icon' => 'id-card-o', 'fa'=>true, 'url'=>['site/formulir'],'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Bukti Pendaftaran', 'icon' => 'print', 'fa'=>true, 'url'=>['site/cetak'],'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Status', 'icon' => 'handshake-o', 'fa'=>true, 'url'=>['site/pengumuman'],'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Login', 'icon' => 'sign-in', 'fa'=>true, 'iconOptions' => ['class' => 'text-green'], 'url' => ['/site/login'],
        'visible' => Yii::$app->user->isGuest],
    ['label' => 'Sign Up', 'icon' => 'vcard-o', 'fa'=>true, 'iconOptions' => ['class' => 'text-green'], 'url' => ['/site/signup'],
        'visible' => Yii::$app->user->isGuest],
    
];
