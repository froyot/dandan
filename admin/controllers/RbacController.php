<?php
namespace app\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
            $allRoles = ArrayHelper::map(Yii::$app->authManager->getAllRoles(), 'name', 'name');
            if (isset($allRoles[$role])) {
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
