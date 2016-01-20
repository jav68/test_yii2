<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function ($data) {
                        return Html::a(Html::img(Yii::$app->homeUrl . Yii::$app->params['previewFolder'] . $data->preview,
                            ['width' => '60px']));
                    },
            ],
            [
                'attribute' => 'author_ids',
                'value' => function ($data) {
                        $str = '';
                        foreach ($data->authors as $name) {
                            $str .= $name->firstname . " " . $name->lastname . ',';
                        }
                        return substr($str, 0, -1);
                    },
            ],
            [
                'attribute' => 'date',
                'value' => function ($data) {
                        return date('d M Y', strtotime($data->date));
                    },
            ],
            [
                'attribute' => 'date_create',
                'value' => function ($data) {
                        return date('d M Y', strtotime($data->date_create));
                    },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $data) {
                            $url = Yii::$app->getUrlManager()->createAbsoluteUrl(['/books/view', 'id' => $data->id]);
                            return \yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#mymodal', [
                                'title' => 'open', 'data-toggle' => 'modal', 'data-backdrop' => false, 'data-remote' => $url
                            ]);
                        },
                ],
            ],
        ],
    ]); ?>

    <?php \yii\bootstrap\Modal::begin(['header' => 'Book', 'size' => 'modal-lg', 'id' => 'mymodal']) ?>
    <?php \yii\bootstrap\Modal::end() ?>
    <?php
    $js = <<<JS
            $(document).on("click","[data-remote]",function(e) {
                e.preventDefault();
                $("div#mymodal .modal-body").load($(this).data('remote'));
            });
            $('#Assigs').on('hidden.bs.modal', function (e) {
              $("div#mymodal .modal-body").html('');
            });
JS;

    $this->registerJs($js);
    ?>

</div>
