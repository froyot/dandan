<?php
use yii\helpers\Url;
use yii\web\View;
$this->title = 'Modules';
$this->params['breadcrumbs'][] = $this->title;
?>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Modules</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a href="<?=Url::to(['modules/create']);?>"><i class="fa fa-plus"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>Allow Module list</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">ModuleName</th>
                          <th>Desc</th>
                          <th>Path</th>
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($dataProvider->getModels() as $model):?>
                        <tr>
                          <td>#</td>
                          <td>
                            <a><?=$model->name;?></a>
                            <br />
                            <small>Created <?=$model->create_at;?></small>
                          </td>
                          <td>
                            <?=$model->des;?>
                          </td>
                          <td class="project_progress">
                            <?=$model->path;?>
                          </td>
                          <td>
                            <?php if($model->status):?>
                            <button type="button" class="btn btn-success btn-xs status-btn" data-id="<?=$model->module_id;?>">Used</button>
                          <?php else:?>
                            <button type="button" class="btn btn-error btn-xs status-btn" data-id="<?=$model->module_id;?>">Not Used</button>
                          <?php endif;?>
                          </td>
                          <td>
                            <a href="<?=Url::to(['modules/update','id'=>$model->module_id]);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="<?=Url::to(['modules/delete','id'=>$model->module_id]);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
            <?php $this->registerJs("
                var status_url = '".Url::to(['modules/set-status'])."';
              ",View::POS_BEGIN);
            ?>

