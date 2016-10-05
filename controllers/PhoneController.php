<?php

namespace app\controllers;

use app\utilities\SubmodelController;
use Yii;
use app\models\customer\PhoneRecord;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhoneController implements the CRUD actions for PhoneRecord model.
 */
class PhoneController extends SubmodelController
{
    public $recordClass = 'app\models\customer\PhoneRecord';
    public $relationAttribute = 'customer_id';
}
