<?php
namespace app\controllers;
use app\models\user\LoginForm;
use \yii\web\Controller;
use Yii;
class SiteController extends Controller
{
	public function actionIndex()
	{
        return $this->render('homepage');
	}
	public function actionDocs()
	{
		return $this->render('docindex.md');
	}
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) and $model->login())
            return $this->goBack();

        return $this->render('login', compact('model'));
    }
	public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}