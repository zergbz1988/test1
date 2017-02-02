<?php

namespace app\controllers;

use app\models\User;
use yii;
use app\models\search\UserSearch;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use HttpRequestMethodException;

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
                    $searchModel = new UserSearch();
                    return $searchModel->search(Yii::$app->request->queryParams);
                }
            ],
        ];
    }

    public function actionUpdate($id)
    {
        if (!Yii::$app->request->isPut) {
            return new HttpRequestMethodException();
        }

        /** @var User $user */
        $user = User::findOne($id);

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return [
                'status' => 'success',
                'message' => 'User was successfully edited!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => implode(', ', $user->getFirstErrors())
            ];
        }
    }
}
