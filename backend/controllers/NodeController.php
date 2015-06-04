<?php

namespace backend\controllers;

use Yii;
use app\models\Node;
use app\models\NodeField;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CreateAlias;

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
        $type = Yii::$app->request->getQueryParam('type');
        $dataProvider = new ActiveDataProvider([
            'query' => Node::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        if (isset($type)) {
            
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * List Node
     *
     *
     */
    public function actionTest(){
        $nodeField = new NodeField;
        $select = '';

        //get categories param
        $cate1 = Yii::$app->request->getQueryParam('cate1');
        $cate2 = Yii::$app->request->getQueryParam('cate2');
        $cate3 = Yii::$app->request->getQueryParam('cate3');
        $cate4 = Yii::$app->request->getQueryParam('cate4');

        $cateItem_root = Node::find()->where(['id' => 0, 'alias' => 'root'])->one();
        if (isset($cate1)){
            /*var_dump($cate1);exit();*/
            $cateItem_1 = Node::find()->where(['node_parent_id' => 0, 'alias' => $cate1])->one();
            if(empty($cateItem_1))
                $cateItem_1 = Node::find()->where(['node_parent_id' => -1, 'alias' => $cate1])->one();
            //$cateField_1 = $nodeField->getNodeField([], $cateItem_1->id);    //get fields to display
            
            if (isset($cate2)){
                $cateItem_2 = Node::find()->where(['node_parent_id' => $cateItem_1->id, 'alias' => $cate2])->one();
                //$cateField_2 = $nodeField->getNodeField([$cateField_1], $cateItem_2->id);

                if (isset($cate3)){
                    $cateItem_3 = Node::find()->where(['node_parent_id' => $cateItem_2->id, 'alias' => $cate3])->one();
                    //$cateField_3 = $nodeField->getNodeField([$cateField_1, $cateField_2], $cateItem_3->id);

                    if (isset($cate4)){
                        $cateItem_4 = Node::find()->where(['node_parent_id' => $cateItem_3->id, 'alias' => $cate4])->one();
                        //$cateField_4 = $nodeField->getNodeField([$cateField_1, $cateField_2, $cateField_3], $cateItem_4->id);
                        
                        //$modelItem = Node::find()->where(['id' => $cateItem_4->id])->all();
                        return $this->render('test',[
                            'model' => $cateItem_4,
                            //'modelItem' => $modelItem,
                            'isContent' => $cateItem_4->type_content,
                            //'fields'     => $cateField_4
                        ]);
                    } else {
                        //if ($cateItem_3->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                        //$modelItem = Node::find()->where([$select => $cateItem_3->id])->all();
                        
                        return $this->render('test',[
                            'model' => $cateItem_3,
                            //'modelItem' => $modelItem,
                            'isContent' => $cateItem_3->type_content,
                            //'fields'     => $cateField_3
                        ]);
                    }
                } else {
                    //if ($cateItem_2->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                    //$modelItem = Node::find()->where([$select => $cateItem_2->id])->all();
                    return $this->render('test',[
                        'model' => $cateItem_2,
                        //'modelItem' => $modelItem,
                        'isContent' => $cateItem_2->type_content,
                        //'fields'     => $cateField_2
                    ]);
                }
            } else {
                //if ($cateItem_1->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                //$modelItem = Node::find()->where([$select => $cateItem_1->id])->all();
                return $this->render('test',[
                    'model' => $cateItem_1,
                    //'modelItem' => $modelItem,
                    'isContent' => $cateItem_1->type_content,
                    //'fields'     => $cateField_1
                ]);
            }
        } else {
            // $modelItem_content = Node::find()->where(['node_parent_id' => 0])->all();
            // $modelItem_other = Node::find()->where(['node_parent_id' => -1])->all();
            // $modelItem = array_merge($modelItem_content, $modelItem_other);
            //$cateField = $nodeField->defaultField();
            //if(!$cateField)
            //    $cateField_1 = $nodeField->defaultField();
            return $this->render('test',[
                'model' => $cateItem_root,
                //'modelItem' => $modelItem,
                'isContent' => 0,
                //'fields'     => $cateField
            ]);
        }
    }

    /**
     * Edit Node
     * @author AuTN     <autn@greenglobal.vn>
     *
     */
    public function actionEdit(){
        $nodeField = new NodeField;
        $select = '';

        //get categories param
        $cate1 = Yii::$app->request->getQueryParam('cate1');
        $cate2 = Yii::$app->request->getQueryParam('cate2');
        $cate3 = Yii::$app->request->getQueryParam('cate3');
        $cate4 = Yii::$app->request->getQueryParam('cate4');

        if (isset($cate1)){
            $cateItem_1 = Node::find()->where(['node_parent_id' => 0, 'alias' => $cate1])->one();
            if(empty($cateItem_1))
                $cateItem_1 = Node::find()->where(['node_parent_id' => -1, 'alias' => $cate1])->one();
            $cateField_1 = $nodeField->fieldItem($cateItem_1->id);    //get fields to display
            if(!$cateField_1)
                $cateField_1 = $nodeField->defaultField();            //get default fields
            if (isset($cate2)){
                $cateItem_2 = Node::find()->where(['node_parent_id' => $cateItem_1->id, 'alias' => $cate2])->one();
                $cateField_2 = $nodeField->fieldItem($cateItem_2->id);
                if(!$cateField_2){
                    if(!$cateField_1){
                        $cateField_2 = $nodeField->defaultField();
                    }else 
                        $cateField_2 = $cateField_1;
                }

                if (isset($cate3)){
                    $cateItem_3 = Node::find()->where(['node_parent_id' => $cateItem_2->id, 'alias' => $cate3])->one();
                    $cateField_3 = $nodeField->fieldItem($cateItem_3->id);
                    if(!$cateField_3){
                        if(!$cateField_2){
                            if(!$cateField_1){
                                $cateField_3 = $nodeField->defaultField();
                            }else
                                $cateField_3 = $cateField_1;
                        }else 
                            $cateField_3 = $cateField_2;
                    }
                    if (isset($cate4)){
                        $cateItem_4 = Node::find()->where(['node_parent_id' => $cateItem_3->id, 'alias' => $cate4])->one();
                        $cateField_4 = $nodeField->fieldItem($cateItem_4->id);
                        if(!$cateField_4){
                            if(!$cateField_3){
                                if(!$cateField_2){
                                    if (!$cateField_1) {
                                        $cateField_4 = $nodeField->defaultField();
                                    }else
                                        $cateField_4 = $cateField_1;
                                }else
                                    $cateField_4 = $cateField_2;
                            }else 
                                $cateField_4 = $cateField_3;
                        }
                        $modelItem = Node::find()->where(['id' => $cateItem_4->id])->one();
                        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
                            return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                        }
                        return $this->render('edit',[
                            'modelItem' => $modelItem,
                            'isContent' => $cateItem_4->type_content,
                            'fields'     => $cateField_4,
                            'parent'    => Node::getParentNode($cateItem_4->node_parent_id)
                        ]);
                    } else {
                        //if ($cateItem_3->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                        $modelItem = Node::find()->where(['id' => $cateItem_3->id])->one();
                        if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
                            return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                        }
                        return $this->render('edit',[
                            'modelItem' => $modelItem,
                            'isContent' => $cateItem_3->type_content,
                            'fields'    => $cateField_3,
                            'parent'    => Node::getParentNode($cateItem_3->node_parent_id)
                        ]);
                    }
                } else {
                    //if ($cateItem_2->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                    $modelItem = Node::find()->where(['id' => $cateItem_2->id])->one();
                    if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
                        return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                    }
                    return $this->render('edit',[
                        'modelItem' => $modelItem,
                        'isContent' => $cateItem_2->type_content,
                        'fields'     => $cateField_2,
                        'parent'    => Node::getParentNode($cateItem_2->node_parent_id)
                    ]);
                }
            } else { 
                //if ($cateItem_1->type_content == 0) $select = 'node_parent_id'; else $select = 'id';
                $modelItem = Node::find()->where(['id' => $cateItem_1->id])->one();
                if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
                    return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                }
                return $this->render('edit',[
                    'modelItem' => $modelItem,
                    'isContent' => $cateItem_1->type_content,
                    'fields'     => $cateField_1,
                    //'parent'    => Node::getParentNode($cateItem_1->node_parent_id)
                ]);
            }
        } /*else {
            $modelItem = Node::find()->where(['node_parent_id' => 0, 'node_parent_id' => -1])->one();
            if ($modelItem->load(Yii::$app->request->post()) && $modelItem->save()) {
                return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
            }
            return $this->render('edit',[
                'modelItem' => $modelItem,
                'isContent' => $cateItem_1->type_content,
                'fields'     => $cateField_1,
                //'parent'    => Node::getParentNode($cateItem_1->node_parent_id)
            ]);
        }*/
    }

    /**
     * Edit Node
     * @author AuTN     <autn@greenglobal.vn>
     *
     */
    public function actionEditArticle(){

    }

    /**
     * Edit Node
     * @author AuTN     <autn@greenglobal.vn>
     *
     */
    public function actionAdd(){
        $nodeField = new NodeField;
        $select = '';

        //get categories param
        $cate1 = Yii::$app->request->getQueryParam('cate1');
        $cate2 = Yii::$app->request->getQueryParam('cate2');
        $cate3 = Yii::$app->request->getQueryParam('cate3');
        //$cate4 = Yii::$app->request->getQueryParam('cate4');

        $node = new Node; $createAlias = new CreateAlias; //var_export($createAlias->__autoCreateAlias(7, 'Asus 3 comPuter + 543  9   ')); exit();

        if (isset($cate1)){
            $cateItem_1 = Node::find()->where(['node_parent_id' => 0, 'alias' => $cate1])->one();
            if(empty($cateItem_1))
                $cateItem_1 = Node::find()->where(['node_parent_id' => -1, 'alias' => $cate1])->one();
            $cateField_1 = $nodeField->fieldItem($cateItem_1->id);    //get fields to display
            if(!$cateField_1)
                $cateField_1 = $nodeField->defaultField();            //get default fields
            if (isset($cate2)){
                $cateItem_2 = Node::find()->where(['node_parent_id' => $cateItem_1->id, 'alias' => $cate2])->one();
                $cateField_2 = $nodeField->fieldItem($cateItem_2->id);
                if(!$cateField_2){
                    if(!$cateField_1){
                        $cateField_2 = $nodeField->defaultField();
                    }else 
                        $cateField_2 = $cateField_1;
                }

                if (isset($cate3)){
                    $cateItem_3 = Node::find()->where(['node_parent_id' => $cateItem_2->id, 'alias' => $cate3])->one();
                    $cateField_3 = $nodeField->fieldItem($cateItem_3->id);
                    if(!$cateField_3){
                        if(!$cateField_2){
                            if(!$cateField_1){
                                $cateField_3 = $nodeField->defaultField();
                            }else
                                $cateField_3 = $cateField_1;
                        }else 
                            $cateField_3 = $cateField_2;
                    }
                    
                    if ($node->load(Yii::$app->request->post()) && $node->save()) {
                        return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                    }
                    return $this->render('add',[
                        'modelItem' => $node,
                        'isContent' => $cateItem_3->type_content,
                        'fields'    => $cateField_3,
                        'parent'    => Node::getParentNode($cateItem_3->id)
                    ]);
                } else {
                    if ($node->load(Yii::$app->request->post()) && $node->save()) {
                        return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                    }
                    return $this->render('add',[
                        'modelItem' => $node,
                        'isContent' => $cateItem_2->type_content,
                        'fields'     => $cateField_2,
                        'parent'    => Node::getParentNode($cateItem_2->id)
                    ]);
                }
            } else {
                if ($node->load(Yii::$app->request->post()) && $node->save()) {
                    return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
                }
                return $this->render('add',[
                    'modelItem' => $node,
                    'isContent' => $cateItem_1->type_content,
                    'fields'     => $cateField_1,
                    //'parent'    => Node::getParentNode($cateItem_1->node_parent_id)
                ]);
            }
        } else { 
            
            if ($node->load(Yii::$app->request->post()) && $node->saveNode($node)) {
                return $this->redirect(isset($_GET['continue']) ? $_GET['continue'] : '/admin/node/test');
            }
            return $this->render('add',[
                'modelItem' => $node,
                //'isContent' => $cateItem_1->type_content,
                'fields'     => $nodeField->defaultField(),
                //'parent'    => Node::getParentNode($cateItem_1->node_parent_id)
            ]);
        }
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
        $type = Yii::$app->request->getQueryParam('type');
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
