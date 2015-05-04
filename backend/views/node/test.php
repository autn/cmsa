<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Node;
//var_export($modelItem); exit()

$uri = $_SERVER['REQUEST_URI'];
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
                        DataTables Advanced Tables
                    </div>
                    <?php
                    /*$listFields = array(); 
                    foreach ($fields as $field){
                        $listFields[] = $field->name;
                    } //echo($listFields); exit();
                    $listFields[]= ['class' => 'yii\grid\ActionColumn'];*/
                    ?>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                    <?php
                                    if(($fields) && ($fields!=NULL))
                                        foreach ($fields as $field){
                                            echo "<th>". ucwords($field->name) ."</th>";
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
                                    
                                    <!-- <tr class="even gradeC">
                                        <td>Trident</td>
                                        <td>Internet Explorer 5.0</td>
                                        <td>Win 95+</td>
                                        <td class="center">5</td>
                                        <td class="center">C</td>
                                    </tr>
                                    <tr class="odd gradeA">
                                        <td>Trident</td>
                                        <td>Internet Explorer 5.5</td>
                                        <td>Win 95+</td>
                                        <td class="center">5.5</td>
                                        <td class="center">A</td>
                                    </tr>
                                    <tr class="even gradeA">
                                        <td>Trident</td>
                                        <td>Internet Explorer 6</td>
                                        <td>Win 98+</td>
                                        <td class="center">6</td>
                                        <td class="center">A</td>
                                    </tr> -->
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
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
<?= $this->render('script'); ?>