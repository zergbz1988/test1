<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class UsersController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'only' => ['update', 'delete'],
//            'rules' => [
//                [
//                    'actions' => ['update', 'delete'],
//                    'allow' => true,
//                    'roles' => ['?'],
//                ],
//            ],
//        ];


        return $behaviors;
    }

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'prepareDataProvider' => function ($action) {
                    $query = User::find();
                    return new ActiveDataProvider([
                        'query' => $query,
                    ]);
                }
            ]
        ];
    }
}
