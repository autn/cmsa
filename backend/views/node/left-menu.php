<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Node;
?>

<?php $node = new Node; ?>
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

        <?php 
        $node_menu = $node->getNode(0);
        foreach($node_menu as $menuItem): ?>
            <li>
                <!-- <a href="#"><i class="fa fa-dashboard fa-fw"></i> <?= $menuItem->title ?></a> -->
                <a href="<?= Url::toRoute('node/test/'. $menuItem->alias) ?>">
                    <i class="fa fa-dashboard fa-fw"></i>
                    <?= $menuItem->title ?>
                    <span class="fa arrow"></span>
                </a>
                <?php /*echoHtml::a("-".$menuItem->title, 
                                        ['node/test/'. $menuItem->alias])*/ ?>
                <?php $node_menu = $node->getNode($menuItem->id); ?>
                <ul class="nav nav-first-level">
                <?php foreach ($node_menu as $childItem): ?>
                    <li>
                        <a href="<?= Url::toRoute('node/test/'.$menuItem->alias.'/'.$childItem->alias) ?>">
                            <i class="fa fa-dashboard fa-fw"></i>
                            <?= $childItem->title ?>
                            <span class="fa arrow"></span>
                        </a>
                        <?php $child2 = $node->getNode($childItem->id);
                        if (!empty($child2)){ ?>
                            <ul class="nav nav-second-level">
                            <?php foreach ($child2 as $chile2Item): ?>
                                <li>
                                <a href="<?= Url::toRoute('node/test/'.$menuItem->alias.'/'. $childItem->alias .'/'. $chile2Item->alias) ?>">
                                    <i class="fa fa-dashboard fa-fw"></i>
                                    <?= $chile2Item->title ?>
                                    <span class="fa arrow"></span>
                                </a>
                                    <?php $child3 = $node->getNode($chile2Item->id);
                                    if (!empty($child3)){ ?>
                                        <ul class="nav nav-third-level">
                                        <?php foreach ($child3 as $child3Item) { ?>
                                            <li>
                                                <a href="<?= Url::toRoute('node/test/'.$menuItem->alias.'/'. $childItem->alias .'/'. $chile2Item->alias .'/'. $child3Item->alias) ?>">
                                                    <i class="fa fa-dashboard fa-fw"></i>
                                                    <?= $child3Item->title ?>
                                                <span class="fa arrow"></span>
                                                </a>
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

        <li>
            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Other Content</a>
            <?php $other_menu = $node->getNode(-1); ?>
            <ul class="nav nav-first-level">
            <?php foreach ($other_menu as $otherItem): ?>
                <li>
                    <?=Html::a($otherItem->title, 
                        ['node/test/'.$otherItem->alias]) ?>
                    <?php $child2 = $node->getNode($otherItem->id);
                    if (!empty($child2)){ ?>
                        <ul class="nav nav-second-level">
                        <?php foreach ($child2 as $chile2Item): ?>
                            <li>
                                <?=Html::a($chile2Item->title, 
                                    ['node/test/'. $otherItem->alias .'/'. $chile2Item->alias]) ?>
                                <?php $child3 = $node->getNode($chile2Item->id);
                                if (!empty($child3)){ ?>
                                    <ul class="nav nav-third-level">
                                    <?php foreach ($child3 as $child3Item) { ?>
                                        <li>
                                            <?=Html::a($child3Item->title, 
                                                ['node/test/'. $otherItem->alias .'/'. $chile2Item->alias .'/'. $child3Item->alias]) ?>
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