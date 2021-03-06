<?php

namespace app\controllers;

use Yii;
use app\models\customer\CustomerRecord;
use app\models\customer\CustomerRecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\customer\EmailRecord;
use app\models\customer\PhoneRecord;
use app\models\customer\AddressRecord;

/**
 * CustomerRecordsController implements the CRUD actions for CustomerRecord model.
 */
class CustomerRecordsController extends Controller
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
						'actions' => ['update','create','delete'],                        
						'roles' => ['manager'],                        
						'allow' => true                    
					],                    
					[                        
						'actions' => ['index','query','view' ],                        
						'roles' => ['user'],                        
						'allow' => true                    
					],                
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
     * Lists all CustomerRecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerRecord model.
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
     * Creates a new CustomerRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->storeReturnUrl();
    	$model = new CustomerRecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
            return $this->redirect(['update', 'id' => $model->id]);
		return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing CustomerRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->storeReturnUrl();
 		$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
            return $this->redirect(['view', 'id' => $model->id]);
        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing CustomerRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        EmailRecord::deleteAll(['customer_id' => $id]);
        PhoneRecord::deleteAll(['customer_id' => $id]);
        AddressRecord::deleteAll(['customer_id' => $id]);
  	    $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    private function storeReturnUrl()
    {
        Yii::$app->user->returnUrl = Yii::$app->request->url;
    }

}
