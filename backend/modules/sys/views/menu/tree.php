<?php
use common\helpers\Url;
use common\helpers\Html;
use common\helpers\ArrayHelper;

?>
<?php foreach($models as $k => $model){ ?>
    <tr id="<?= $model['id']?>" class="<?= $pid?>">
        <td>
            <?php if (!empty($model['-'])){ ?>
                <div class="fa fa-minus-square cf" style="cursor:pointer;"></div>
            <?php } ?>
        </td>
        <td>
            <?= ArrayHelper::itemsLevel($model['level'], $models, $k)?>
            <?= $model['title']?>
            <!--禁止显示二级分类再次添加三级分类-->
            <?php if ($model['level'] <= 2){ ?>
                <?= Html::a('<i class="fa fa-plus-circle"></i>', ['ajax-edit', 'pid' => $model['id'], 'cate_id' => $cate_id, 'parent_title' => $model['title'], 'level' => $model['level'] + 1], [
                    'data-toggle' => 'modal',
                    'data-target' => '#ajaxModalLg',
                ]); ?>
            <?php } ?>
        </td>
        <td><?= $model['url']?></td>
        <td><div class="fa <?= $model['menu_css']?>"></div></td>
        <td><?= Html::whether($model['dev'])?></td>
        <td class="col-md-1"><?= Html::sort($model['sort'])?></td>
        <td>
            <?= Html::edit(['ajax-edit', 'id' => $model['id'], 'cate_id' => $cate_id, 'parent_title' => $parent_title, 'level' => $model['level']], '编辑', [
                'data-toggle' => 'modal',
                'data-target' => '#ajaxModalLg',
            ]); ?>
            <?= Html::status($model['status']); ?>
            <?= Html::delete(['delete','id' => $model['id'], 'cate_id' => $cate_id])?>
        </td>
    </tr>
    <?php if (!empty($model['-'])){ ?>
        <?= $this->render('tree', [
            'models' => $model['-'],
            'parent_title' => $model['title'],
            'pid' => $model['id'] . " " . $pid,
            'cate_id' => $cate_id
        ])?>
    <?php } ?>
<?php } ?>