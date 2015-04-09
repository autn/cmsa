<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Node;

/* @var $this yii\web\View */
/* @var $model app\models\Node */

$this->title = Yii::t('app', 'Add {modelClass}: ', [
    'modelClass' => 'Node',
]) . ' ' . $modelItem->title;

?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php include('top-logo.php'); ?>
        <!-- /.navbar-header -->

        <?php include('top-menu.php'); ?>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <?php include('left-menu.php'); ?>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="node-update">
                    <?php 
                    $rootParent = [
                        0  => "Content",
                        -1   => "Other"
                    ]; ?>
				    <?= $this->render('_form_edit', [
				        'model' => $modelItem,
				        'fields'=> $fields,
				 		'parent'=> isset($parent) ? $parent : $rootParent
				    ]) ?>

				</div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include('script.php'); ?>