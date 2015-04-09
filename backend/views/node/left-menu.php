<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Node;
?>

<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </span>
            </div>
            <!-- /input-group -->
        </li>
        <li>
            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Content</a>
            <?php $node = new Node; $node_menu = $node->getNode(0); ?>
            <ul class="nav nav-first-level">
            <?php foreach ($node_menu as $menuItem): ?>
                <li>
                    <?=Html::a($menuItem->title, 
                        ['node/test/'.$menuItem->alias]) ?>
                    <?php $child2 = $node->getNode($menuItem->id);
                    if (!empty($child2)){ ?>
                        <ul class="nav nav-second-level">
                        <?php foreach ($child2 as $chile2Item): ?>
                            <li>
                                <?=Html::a($chile2Item->title, 
                                    ['node/test/'. $menuItem->alias .'/'. $chile2Item->alias]) ?>
                                <?php $child3 = $node->getNode($chile2Item->id);
                                if (!empty($child3)){ ?>
                                    <ul class="nav nav-third-level">
                                    <?php foreach ($child3 as $child3Item) { ?>
                                        <li>
                                            <?=Html::a($child3Item->title, 
                                                ['node/test/'. $menuItem->alias .'/'. $chile2Item->alias .'/'. $child3Item->alias]) ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php endforeach; ?>
            </ul>
        </li>
        <?php 
        $other_menu = $node->getNode(-1);
        foreach($other_menu as $otherItem): ?>
            <li>
                <!-- <a href="#"><i class="fa fa-dashboard fa-fw"></i> <?= $otherItem->title ?></a> -->
                <?=Html::a("-".$otherItem->title, 
                                        ['node/test/'. $otherItem->alias]) ?>
                <?php $node_menu = $node->getNode($otherItem->id); ?>
                <ul class="nav nav-first-level">
                <?php foreach ($node_menu as $menuItem): ?>
                    <li>
                        <?=Html::a($menuItem->title, 
                            ['node/test/'.$otherItem->alias.'/'.$menuItem->alias]) ?>
                        <?php $child2 = $node->getNode($menuItem->id);
                        if (!empty($child2)){ ?>
                            <ul class="nav nav-second-level">
                            <?php foreach ($child2 as $chile2Item): ?>
                                <li>
                                    <?=Html::a($chile2Item->title, 
                                        ['node/test/'.$otherItem->alias.'/'. $menuItem->alias .'/'. $chile2Item->alias]) ?>
                                    <?php $child3 = $node->getNode($chile2Item->id);
                                    if (!empty($child3)){ ?>
                                        <ul class="nav nav-third-level">
                                        <?php foreach ($child3 as $child3Item) { ?>
                                            <li>
                                                <?=Html::a($child3Item->title, 
                                                    ['node/test/'.$otherItem->alias.'/'. $menuItem->alias .'/'. $chile2Item->alias .'/'. $child3Item->alias]) ?>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
        <?php //echo Url::toRoute(['node/test', 'cate1' => 'computer']);
        //echo Html::a('label', ['/node/test']);
            /*$node = new Node; $menu = $node->getNode(0); 
            foreach ($menu as $menuItem) { ?>
                <li>
                    <?=Html::a($menuItem->title, 
                        ['node/test/'.$menuItem->alias]) ?>
                    <?php $child2 = $node->getNode($menuItem->id);
                    if (!empty($child2)){ ?>
                        <ul class="nav nav-second-level">
                        <?php foreach ($child2 as $chile2Item) { ?>
                            <li>
                                <?=Html::a($chile2Item->title, 
                                    ['node/test/'. $menuItem->alias .'/'. $chile2Item->alias]) ?>
                                <?php $child3 = $node->getNode($chile2Item->id);
                                if (!empty($child3)){ ?>
                                    <ul class="nav nav-third-level">
                                    <?php foreach ($child3 as $child3Item) { ?>
                                        <li>
                                            <?=Html::a($child3Item->title, 
                                                ['node/test/'. $menuItem->alias .'/'. $chile2Item->alias .'/'. $child3Item->alias]) ?>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
        <?php }*/ ?>                  
        <li>
            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="#">Second Level Item</a>
                </li>
                <li>
                    <a href="#">Second Level Item</a>
                </li>
                <li>
                    <a href="#">Third Level <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level Item</a>
                        </li>
                    </ul>
                    <!-- /.nav-third-level -->
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="blank.html">Blank Page</a>
                </li>
                <li>
                    <a href="login.html">Login Page</a>
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
    </ul>
</div>