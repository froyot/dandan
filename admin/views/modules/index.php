<?php
use yii\helpers\Url;
?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Modules</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Modules</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-plus"></i></a>
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
                            <button type="button" class="btn btn-success btn-xs">Used</button>
                          <?php else:?>
                            <button type="button" class="btn btn-error btn-xs">Not Used</button>
                          <?php endif;?>
                          </td>
                          <td>
                            <a href="<?=Url::to(['modules/edit','module_id'=>$model->module_id]);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="<?=Url::to(['modules/delete','module_id'=>$model->module_id]);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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
          </div>
        </div>
