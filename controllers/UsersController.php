<?php

namespace app\controllers;

use Yii;
use app\models\user\UserRecord;
use app\models\user\UserSearchModel;
use app\models\user\AuthAssignment;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;

/**
 * UsersController implements the CRUD actions for UserRecord model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true
                    ]
                ],
				'denyCallback' => function ($rule, $action) {
					Yii::$app->session->setFlash('warning', 'You are not allowed to access this operation');
					$this->redirect(\Yii::$app->request->getReferrer());
					#throw new \Exception('You are not allowed to access this page');
				}
            ]			
        ];
    }

    /**
     * Lists all UserRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize'=>6];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRecord model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserRecord();
        $authAssignment = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$authAssignment->user_id = $model->id;
			$authAssignment->item_name = $model->type;
			$authAssignment->created_at = time();
			if (!$authAssignment->save()){
				// Situazione che non dovrebbe mai capitare???
				// usato ai fini di studio. Verificare come applicare le transazioni:
				// Infatti se c'e' un errore su AuthAssignment, cancella l'utente
				// e ripristina i valori inseriti.
				Yii::$app->session->setFlash('warning', 'Error create authoritation');
				//throw new Exception('Error create authoritation');
				$attributes = $model->attributes;
				$model->find()->where(['id'=> $attributes['id']])->one();
				$model->delete();
				$model->load($attributes);
				return $this->render('create', [
					'model' => $model,
				]);
			}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		#$authAssignment = AuthAssignment::find()->where(['user_id' => $id])->one(); 
		$authAssignment = $model->authoritation; 
        $model->type = $authAssignment->item_name;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    $authAssignment->item_name = $model->type;
			if (!$authAssignment->save())
				throw new Exception('Error modify authoritation');
				
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
