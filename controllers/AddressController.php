<?php

namespace app\controllers;

use app\utilities\SubmodelController;
use Yii;
use app\models\customer\AddressRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for AddressRecord model.
 */
class AddressController extends SubmodelController
{
	public $recordClass = 'app\models\customer\AddressRecord';
    public $relationAttribute = 'customer_id';
}
