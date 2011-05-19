<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 中カテゴリ削除
class admin_do_delete_c_commu_category_parent extends OpenPNE_Action
{
    function execute($requests)
    {
        db_admin_delete_c_commu_category_parent($requests['c_commu_category_parent_id']);

        admin_client_redirect('edit_category', '中カテゴリを削除しました');
    }
}

?>
