<?php
use common\helpers\Url;
use common\helpers\Html;
use common\helpers\ArrayHelper;

?>
<?php foreach($models as $k => $model){ ?>
    <tr id=<?= $model['key'] ?> name="<?= $model['name'] ?>" class="<?= $parent_key ?>">
        <td>
            <?php if (!empty($model['-'])){ ?>
                <div class="fa fa-minus-square cf" style="cursor:pointer;"></div>
            <?php } ?>
        </td>
        <td>
            <?= ArrayHelper::itemsLevel($model['level'], $models, $k, $treeStat)?>
            <?= $model['name']?>
            <?= Html::a('<i class="fa fa-plus-circle"></i>', ['edit', 'parent_key' => $model['key'], 'parent_title' => $model['name'],'level' => $model['level'] + 1])?>
        </td>
        <td class="col-md-1"><?= Html::sort($model['sort'])?></td>
        <td>
            <?= Html::edit(['edit', 'parent_key' => $model['parent_key'], 'parent_title' => $parent_title, 'name' => $model['name'], 'level' => $model['level']], '编辑')?>
            <?= Html::delete(['delete', 'name' => $model['name']])?>
        </td>
    </tr>
    <?php if (!empty($model['-'])) { ?>
        <?= $this->render('tree', [
            'models' => $model['-'],
            'parent_title' => $model['name'],
            'parent_key' => $model['key'] . " " . $parent_key,
            'treeStat' => $treeStat,
        ])?>
    <?php } ?>
<?php } ?>