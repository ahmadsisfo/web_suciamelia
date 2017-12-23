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
    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url'=>['home/dashboard'],'visible' => !Yii::$app->user->isGuest],
    ['label' => 'Master', 'icon' => 'dns', 
        'items' => [
            ['label' => 'Jenis Zakat', 'url' => ['/master/tb-jenis-zakat']],
            ['label' => 'Formulir Pendaftaran', 'url' => ['/master/tb-formulir-pendaftaran']],
        ],
        'visible' => !Yii::$app->user->isGuest
    ],
    ['label' => 'Approval', 'icon'=>'check-square-o','fa'=>true,
        'items' => [
            ['label' => 'Pernyataan Survey', 'url' => ['/approval/tb-pernyataan-survey']],
            ['label' => 'Acc Sebagai Penerima', 'icon'=>'handshake-o','fa'=>true, 'url' => ['/approval/acc-sebagai-penerima']],
        ],
        'visible' => !Yii::$app->user->isGuest
    ],
    
    ['label' => 'Penerima', 'icon'=>'smile-o','fa'=>true, 'url'=>['/approval/tb-penerima'],        
        'visible' => !Yii::$app->user->isGuest
    ],
    /*['label' => 'Report', 'icon' => 'insert_chart', 
        'items' => [
        ],
        'visible' => !Yii::$app->user->isGuest
    ],*/
    //'<li class="header">ADMIN MENU</li>',
    ['label' => 'Setting', 'icon' => 'settings', 'iconOptions' => ['class' => 'text-orange'], 
        'items' => [
            ['label' => 'Users', 'icon' => 'user', 'fa'=>true, 'url' => ['master/user']],
            ['label' => 'RBAC', 'icon' => 'settings_input_component',
                'items' => [
                    ['label' => 'Routes', 'url' => ['/admin/route']],
                    ['label' => 'Rules', 'url' => ['/admin/rule']],
                    ['label' => 'Permissions', 'url' => ['/admin/permission']],
                    ['label' => 'Roles', 'url' => ['/admin/role']],
                    //['label' => 'Assignment', 'url' => ['/admin']],
                ],
            ],           
        ],
        'visible' => !Yii::$app->user->isGuest
    ],
    ['label' => 'Login', 'icon' => 'lock_open', 'iconOptions' => ['class' => 'text-green'], 'url' => ['/site/login'],
        'visible' => Yii::$app->user->isGuest],
    
];
