<?php

namespace app\controllers;

use Yii;
use app\models\Image;
use app\models\Portfolio;
use app\models\Category;
use app\models\search\PortfolioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

/**
 * PortfolioController implements the CRUD actions for Portfolio model.
 */
class PortfolioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Portfolio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PortfolioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Portfolio model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelImage = Image::find()->where(['id' => $model->image_id])->one();

        return $this->render('view', [
            'model' => $model,
            'modelImage' => $modelImage,
            'encodeFile' => base64_encode($modelImage['image']),
        ]);
    }

    /**
     * Creates a new Portfolio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Portfolio();

        $modelImage = new Image();

        $modelCategory = ArrayHelper::map((new Category())::find()->all(), 'id', 'name');

        if ($modelImage->imageFile = UploadedFile::getInstance($modelImage, 'imageFile')) {

            $model->image_id = $modelImage->upload() ?  $modelImage->id : null;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_dump($model->getErrors());
                return true;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelImage' => $modelImage,
            'modelCategory' => $modelCategory,
        ]);
    }

    /**
     * Updates an existing Portfolio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelCategory = ArrayHelper::map((new Category())::find()->all(), 'id', 'name');

        $modelImage = Image::find()->where(['id' => $model->image_id])->one();

        if ($modelImage->imageFile = UploadedFile::getInstance($modelImage, 'imageFile')) {

            $modelImage->upload();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelCategory' => $modelCategory,
            'modelImage' => $modelImage,
            'encodeFile' => base64_encode($modelImage['image']),
        ]);
    }

    /**
     * Deletes an existing Portfolio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Portfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
