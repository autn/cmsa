<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Node;
use app\Models\NodeField;
use app\models\NodeArticle;

$uri = $_SERVER['REQUEST_URI'];
$node = new Node;
$modelItem = Node::find()->where(['node_parent_id' => $model->id])->all();
$nodeField = new NodeField;
$fields = $nodeField->getField($model->id, 'node');
?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?= $this->render('top-logo'); ?>
        <!-- /.navbar-header -->

        <?= $this->render('top-menu'); ?>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <?= $this->render('left-menu'); ?>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tables</h1>
            </div>
            <!-- /.col-lg-12 -->
            <?php $uri_add = str_replace("admin/node/test", "/node/add", $uri); ?>
            <a href="<?= Url::toRoute([$uri_add]); ?>">Add</a>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        DataTables Category
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover dataTables-list-order">
                                <thead>
                                    <tr>
                                    <?php
                                    
                                    if(($fields) && ($fields!=NULL))
                                        foreach ($fields as $field){
                                            echo "<th>". ucwords($field->label) ."</th>";
                                        }
                                    ?>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    
                                    if (isset($modelItem)) :
                                        foreach ($modelItem as $item) { 
                                            $uri_edit = str_replace("/node/test", "/node/edit", $uri) ;
                                            if($isContent != 1) 
                                                $uri_edit .= '/' . $item['alias']; ?>
                                            <tr class="odd gradeX">
                                            <?php foreach ($fields as $field) {
                                                echo "<td>". $item[$field->name] ."</td>";
                                            } ?>
                                                <td>
                                                    <a href="<?=$uri_edit .'?continue='. $uri ?>"><span>Edit</span></a>
                                                </td>
                                            </tr>
                                    <?php  } 
                                    endif;
                                    ?>      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php
                $nodeArticle = new NodeArticle; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        DataTables Article
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover dataTables-list-order">
                                <?= $nodeArticle->getArticleHtml($model->id, $fields) ?>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?= $this->render('script'); ?>
<script>   
    $(document).ready(function() {
        $('.dataTables-list-order').DataTable({
            responsive: true
        });
    });
</script>