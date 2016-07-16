<?php
use yii\helpers\Url;
$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Options</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

          <li><a href="<?=Url::to(['options/create']);?>"><i class="fa fa-plus"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <p>All Options list</p>

        <!-- start project list -->
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 20%">OptionsDes</th>
              <th>OptionsKey</th>
              <th style="width: 20%">#Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($dataProvider->getModels() as $model):?>
            <tr>
              <td>#</td>
              <td>
                <a><?=$model->des;?></a>


              </td>
              <td>
                <?=$model->key;?>
              </td>
              <td>

                <a href="<?=Url::to(['options/update','id'=>$model->option_id]);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                <a href="<?=Url::to(['options/delete','id'=>$model->option_id]);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
              </td>
            </tr>
          <?php endforeach;?>

          </tbody>
        </table>
        <!-- end project list -->

      </div>
    </div>
  </div>
</div>

