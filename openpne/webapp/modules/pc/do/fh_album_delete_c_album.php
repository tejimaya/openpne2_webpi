<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

/**
 * アルバム削除
 */
class pc_do_fh_album_delete_c_album extends OpenPNE_Action
{
    function execute($requests)
    {
        if (!OPENPNE_USE_ALBUM) {
            handle_kengen_error();
        }

        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $target_c_album_id = $requests['target_c_album_id'];
        // ----------

        //--- 権限チェック
        $c_album = db_album_get_c_album4c_album_id($target_c_album_id);
        if ($c_album['c_member_id'] != $u) {
            handle_kengen_error();
        }
        //---

        db_album_delete_c_album($target_c_album_id);

        $p = array('target_c_member_id' => $u);
        openpne_redirect('pc', 'page_fh_album_list', $p);
    }
}

?>
