<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// hash_table の削除
class admin_do_delete_hash_table extends OpenPNE_Action
{
    function execute($requests)
    {
        $hash_tbl =& AdminHashTable::singleton();
        $hash_tbl->deleteTable();

        admin_client_redirect('top', '管理用ページ名を元に戻しました');
    }
}

?>
