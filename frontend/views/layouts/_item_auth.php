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
    
    ['label' => !Yii::$app->user->isGuest?Yii::$app->user->identity->username:'', 'icon' => 'user','fa'=>true, 'iconOptions' => ['class' => 'text-blue'],
        'items' => [
            ['label' => 'Change Profile', 'icon' => 'user', 'iconOptions' => ['class' => 'text-green'], 'url' => ['/master/snode/asprofile'], 'visible' => in_array('/master/snode/asprofile', $temp_roles)],
            ['label' => 'Change Password', 'icon' => 'fingerprint', 'iconOptions' => ['class' => 'text-yellow'], 'url' => ['/admin/user/change-password']],
            ['label' => 'Logout', 'icon' => 'lock', 'linkOptions' => ['data-method' => 'post'], 'iconOptions' => ['class' => 'text-red'], 'url' => ['/site/logout']],
        ],
        'visible' => !Yii::$app->user->isGuest
    ],
];
