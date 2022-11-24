<?php
echo Yii::$app->urlManager->createUrl(['site/index']);
echo Yii::$app->urlManager->addRules(['site/index'], true);