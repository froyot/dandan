<?php

namespace app\models\util;
use yii\base\Model;
use yii\helpers\Url;
use Yii;
use yii\rbac\DbManager;
use yii\rbac\Item as RbacItem;

class RbacDbManager extends DbManager{

    public function getAllPermissions()
    {
        return $this->getItems(RbacItem::TYPE_PERMISSION);
    }

    public function updateRolePermission( $newPermitions, $role )
    {
        $oldPermissions = $this->getPermissionsByRole($role);
        $addPermition = [];
        $deletePermition = [];
        foreach ($oldPermissions as $key => $item)
        {
            if( !in_array($key, $newPermitions) )
            {
                $deletePermition[] = $key;
            }
        }

        foreach ($newPermitions as $key => $item) {
            if(!isset($oldPermissions[$item]))
            {
                $addPermition[] = [$role, $item];
            }
        }

        if($addPermition)
        {
            $this->db->createCommand()
                ->batchInsert($this->itemChildTable, ['parent','child'], $addPermition)
                ->execute();
        }

        if( $deletePermition )
        {
            $this->db->createCommand()
                ->delete($this->itemChildTable,['child'=>$deletePermition,'parent'=>$role])
                ->execute();
            $this->invalidateCache();
        }
        return true;

    }
}
