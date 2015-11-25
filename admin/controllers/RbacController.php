<?php
namespace app\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class RbacController extends Controller {
    public $layout = 'main';
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    //权限重置
    public function actionInit() {

        if (Yii::$app->user->can('initRbac')) {
            $auth = Yii::$app->authManager;
            $auth->removeAll();
            $initRbac = $auth->createPermission('initRbac');
            $initRbac->description = 'Init rbac';
            $auth->add($initRbac);

            $manageRbac = $auth->createPermission('manageRbac');
            $manageRbac->description = 'Manage rbac';
            $auth->add($manageRbac);

            $author = $auth->createRole('user');
            $auth->add($author);

            $createPost = $auth->createPermission('createPost');
            $createPost->description = 'Create post';
            $auth->add($createPost);
            $auth->addChild($author, $createPost);

            $updatePost = $auth->createPermission('updatePost');
            $updatePost->description = 'update post';
            $auth->add($updatePost);
            $auth->addChild($author, $updatePost);

            $deletePost = $auth->createPermission('deletePost');
            $deletePost->description = 'Delete post';
            $auth->add($deletePost);
            $auth->addChild($author, $deletePost);

            $createComment = $auth->createPermission('createComment');
            $createComment->description = 'Create comment';
            $auth->add($createComment);
            $auth->addChild($author, $createComment);

            $admin = $auth->createRole('admin');
            $auth->add($admin);

            $auth->addChild($admin, $manageRbac);
            $auth->addChild($admin, $initRbac);
            $auth->addChild($admin, $author);
            $auth->assign($admin, Yii::$app->user->id);

        } else {
            throw new ForbiddenHttpException();
        }
    }

    //角色列表
    public function actionRoles() {
        if (Yii::$app->user->can('manageRbac')) {
            return $this->render('roles');
        } else {
            throw new ForbiddenHttpException();
        }
    }

    //分配角色权限
    public function actionGetRules() {
        if (Yii::$app->user->can('manageRbac')) {
            $role = Yii::$app->request->get('role');
            if (isset(Yii::$app->params['siteConf']['userRole'][$role])) {
                $auth = Yii::$app->authManager;
                $permissions = $auth->getPermissionsByRole($role);
                $allPermissions = $auth->getAllPermissions();
                return $this->render('get-rules', [
                    'role' => $role,
                    'permissions' => $permissions,
                    'allpermissions' => $allPermissions,
                ]);
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            throw new ForbiddenHttpException();
        }
    }

    //分配权限
    public function actionAsignRules() {
        if (Yii::$app->user->can('manageRbac')) {
            $auth = Yii::$app->authManager;
            $role = Yii::$app->request->post('role');
            if (isset(Yii::$app->params['siteConf']['userRole'][$role])) {
                $names = Yii::$app->request->post('names');
                $res = $auth->updateRolePermission($names, $role);
                return $this->redirect(['get-rules', 'role' => $role]);
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            throw new ForbiddenHttpException();
        }
    }
}
