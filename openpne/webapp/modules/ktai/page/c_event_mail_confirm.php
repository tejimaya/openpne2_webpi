<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_c_event_mail_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $tail = $GLOBALS['KTAI_URL_TAIL'];

        // --- リクエスト変数
        $c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $c_member_ids = $requests['c_member_id'];
        $body = $requests['body'];
        // ----------

        if (!$c_member_ids) {
            $p = array('target_c_commu_topic_id' => $c_commu_topic_id);
            openpne_redirect('ktai', 'page_c_event_mail', $p);
        }

        $c_topic = db_commu_c_topic4c_commu_topic_id_2($c_commu_topic_id);
        $c_commu_id = $c_topic['c_commu_id'];


        //--- 権限チェック
        if (!db_commu_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }

        if (!db_commu_is_c_event_admin($c_commu_topic_id, $u)
            && !db_commu_is_c_commu_admin($c_commu_id, $u)) {
            handle_kengen_error();
        }

        // 対象者に自分が含まれている
        if (in_array($u, $c_member_ids)) {
            handle_kengen_error();
        }
        //---

        $this->set('c_commu', db_commu_c_commu4c_commu_id($c_commu_id));
        $this->set('c_mail_member', db_commu_c_event_mail_confirm_list4c_member_ids($c_member_ids));

        $this->set('body', $body);
        $this->set('c_member_ids', implode(',', $c_member_ids));
        $this->set("c_commu_id", $c_commu_id);
        $this->set("c_commu_topic_id", $c_commu_topic_id);
        return 'success';
    }
}

?>
