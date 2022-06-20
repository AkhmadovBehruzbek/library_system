<?php

namespace app\modules\controllers;

use app\models\Contact;
use app\models\ContactSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends RoleController
{
    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Contact models.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $query = Contact::find()->orderBy('created_date DESC');
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
