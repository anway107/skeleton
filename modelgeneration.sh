#!/usr/bin/env bash
php yii gii/model --tableName=$1 --modelClass=$2
mv console/models/$2.php backend/models/$2.php
echo "File moved to backend/models"