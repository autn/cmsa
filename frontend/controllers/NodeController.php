<?php

namespace frontend\controllers;

use Yii;
use app\models\Node;
use app\models\NodeTerm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NodeController implements the CRUD actions for Node model.
 */
class NodeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Node models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Node::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Node model.
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
     * Creates a new Node model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Node();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Node model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Node model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionProduct(){
        $cate1 = Yii::$app->request->getQueryParam('cate1');
        $cate2 = Yii::$app->request->getQueryParam('cate2');
        $cate3 = Yii::$app->request->getQueryParam('cate3');
        //var_dump($_GET); exit();
        if (isset($cate1)){
            $cate1Item = Node::find()->where(['node_parent_id' => 1, 'alias' => $cate1])->one()->id;
            if (isset($cate2)){
                $cate2Item = Node::find()->where(['node_parent_id' => $cate1Item, 'alias' => $cate2])->one()->id;
                //echo $cate2Item; exit();
                if (isset($cate3)){
                    $cate3Item = Node::find()->where(['node_parent_id' => $cate2Item, 'alias' => $cate3])->one()->id;
                    //echo $cate3Item; exit();
                    $modelItem = Node::find()->where(['id' => $cate3Item])->one();
                    return $this->render('product',[
                        'modelItem' => $modelItem,
                        'isContent' => 1
                    ]);
                } else {
                    $modelItem = Node::find()->where(['node_parent_id' => $cate2Item])->all();
                    return $this->render('product',[
                        'modelItem' => $modelItem,
                        'isContent' => 0
                    ]);
                }
            } else {
                $modelItem = Node::find()->where(['node_parent_id' => $cate1Item])->all();
                return $this->render('product',[
                    'modelItem' => $modelItem,
                    'isContent' => 0
                ]);
            }
        } else {
            $modelItem = Node::find()->where(['node_parent_id' => 1])->all();
            return $this->render('product',[
                'modelItem' => $modelItem,
                'isContent' => 0
            ]);
        }
    }

    public function actionProductdetail(){

    }

    public function actionAboutus(){
        $model = Node::find();
    }

    /**
     * Finds the Node model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Node the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Node::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
