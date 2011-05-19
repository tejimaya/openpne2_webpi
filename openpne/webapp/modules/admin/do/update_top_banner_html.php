<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// トップバナー用の任意HTML変更
class admin_do_update_top_banner_html extends OpenPNE_Action
{
    function execute($requests)
    {
        if ($requests['disp_type'] === 'html') {
            if (db_admin_c_siteadmin('top_banner_html_before')) {
                db_admin_update_c_siteadmin('top_banner_html_before', $requests['top_banner_html_before']);
            } else {
                db_admin_insert_c_siteadmin('top_banner_html_before', $requests['top_banner_html_before']);
            }
            if (db_admin_c_siteadmin('top_banner_html_after')) {
                db_admin_update_c_siteadmin('top_banner_html_after', $requests['top_banner_html_after']);
            } else {
                db_admin_insert_c_siteadmin('top_banner_html_after', $requests['top_banner_html_after']);
            }
        } else {
            if (db_admin_c_siteadmin('top_banner_html_before')) {
                db_admin_update_c_siteadmin('top_banner_html_before', '');
            }
            if (db_admin_c_siteadmin('top_banner_html_after')) {
                db_admin_update_c_siteadmin('top_banner_html_after', '');
            }
        }

        admin_client_redirect('edit_c_banner', 'トップバナーを変更しました');
    }
}

?>
