
# Requirements 
php 7 +

# clone project 
git clone project

# Run composer
composer install

# Set mode directory
mkdir ./assets && chmod -R 777 ./assets
chmod -R 777 ./runtime

# Run migration

./yii migrate

# конфигурация компонента UrlManager

``` php
'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],





