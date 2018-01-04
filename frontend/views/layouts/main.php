<?php

if(Yii::$app->user->isGuest){
    echo $this->render('main_guest', [
        'content' => $content,
    ]);
} else {
    echo $this->render('main_notguest', [
        'content' => $content,
    ]);
}
    

