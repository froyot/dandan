<?php
/**
 * admin rules manage class
 */
namespace app\models\util;
use yii\base\Model;
use yii\rbac\DbManager;
use yii\rbac\Item as RbacItem;

class RbacDbManager extends DbManager {

    /**
     * get all permisions array for current site
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:08:03+0800
     * @return   array itemModel array
     */
    public function getAllPermissions() {
        return $this->getItems(RbacItem::TYPE_PERMISSION);
    }

    /**
     * update roles permission
     * @author Allon<xianlong300@sina.com>
     * @dateTime 2015-11-24T14:15:26+0800
     * @param    array                   $newPermitions  permission id arrays
     * @param    string                  $role           need to update role
     * @return   boolean                                 is update success
     */
    public function updateRolePermission($newPermitions, $role) {
        //get user old permissions
        $oldPermissions = $this->getPermissionsByRole($role);
        $addPermition = [];

        //the permisions should to delete in this time
        $deletePermition = [];
        foreach ($oldPermissions as $key => $item) {
            if (!in_array($key, $newPermitions)) {
                $deletePermition[] = $key;
            }
        }

        //get new added permision in this time
        foreach ($newPermitions as $key => $item) {
            if (!isset($oldPermissions[$item])) {
                $addPermition[] = [$role, $item];
            }
        }

        //if has new permission then add it
        if ($addPermition) {
            $this->db->createCommand()
                 ->batchInsert(
                     $this->itemChildTable,
                     ['parent', 'child'], $addPermition
                 )
                 ->execute();
        }

        //if has permission need to delete ,delete it
        if ($deletePermition) {
            $this->db->createCommand()
                 ->delete(
                     $this->itemChildTable,
                     ['child' => $deletePermition, 'parent' => $role]
                 )
                 ->execute();
            $this->invalidateCache();
        }
        return true;

    }
}
