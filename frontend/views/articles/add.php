<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Добавление/изменение статьи';
?>
<h2><?php if ($model->id): ?>Изменение<?php else: ?>Добавление<?php endif; ?> статьи</h2>
<div class="row">
    <div class="col-md-12">
    <?php $form = ActiveForm::begin(['action' => '#', 'enableClientScript' => false, 'options' => ['enctype' =>'multipart/form-data', 'enableAjaxValidation' => false, 'id' => 'addArticlesForm']]); ?>
        <?php if ($model->id): ?><?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false); ?><?php endif; ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'placeholder'=>'Введите название статьи']) ?>
        <?= $form->field($model, 'image')->fileInput()->label('Изображение jpg, gif, png') ?>
        <?= $form->field($model, 'alias')->textInput(['maxlength' => 48, 'placeholder'=>'Введите название статьи на английском или транслитом']) ?>
        <?= $form->field($model, 'announce')->textInput(['maxlength' => 255, 'placeholder'=>'Анонс новости']) ?>
        <?= $form->field($model, 'description')->textarea(['maxlength' => 255, 'placeholder'=>'Описание новости']) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'id' => 'articlesAddBtn']) ?>
        </div>
    </div>
</div>
<style>
    .form-group {
        margin: 15px;
    }
</style>
<script type="text/javascript">
    window.onload = function() {
        if (window.jQuery) {  
            $('#articlesAddBtn').click(function(e) {
                e.preventDefault();

                var artId    = $('#articles-id').val();
                var link     = <?php if ($model->id): ?>'/articles/update/<?= $model->id; ?>'<?php else: ?>'/articles/create'<?php endif; ?>;
                var form     = $('#addArticlesForm')[0];
                var formData =  new FormData(form);

                $.ajax({
                    url: link,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Успешно добавлена');
                        $(location).prop('href', '/')
                    },
                    error: function (jqXHR, exception) {
                        $('#addArticlesForm').prepend('<div id="errorText">' + jqXHR.responseText + '</div>');

                        setTimeout(function() { 
                            $('#errorText').remove();
                        }, 7000);    
                    }
                })
            })
        }
    }
</script>
<?php ActiveForm::end(); ?>