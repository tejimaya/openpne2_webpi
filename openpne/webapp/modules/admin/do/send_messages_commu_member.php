<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メッセージ一括送信
class admin_do_send_messages_commu_member extends OpenPNE_Action
{
    function handleError($errors)
    {
        $_REQUEST['msg'] = array_shift($errors);
        openpne_forward(ADMIN_MODULE_NAME, 'page', 'send_messages_commu_member' );
        exit;
    }

    function execute($requests)
    {
        $module_name = ADMIN_MODULE_NAME;
        $send_type = $requests['send_type'];

        if (empty($requests['c_member_ids']) || empty($requests['target_c_commu_id'])) {
            admin_client_redirect('send_messages_commu_member');
        }

        // 送信者はとりあえず1番で固定
        $c_member_id_from = 1;

        $send_num = 0;
        foreach ($requests['c_member_ids'] as $key => $c_member_id) {
            if ($c_member_id_from == $c_member_id) {
                $c_member_id_list[$key] = null;
                continue;
            }
            switch ($send_type) {
                case "mail":
                    do_admin_send_mail($c_member_id, $requests['subject'], $requests['body']);
                break;
                case "message":
                    do_admin_send_message($c_member_id_from, $c_member_id, $requests['subject'], $requests['body']);
                break;
                default:
                    openpne_forward($module_name, 'page', 'send_messages');
                    exit;
                break;
            }
            $send_num++;
        }

        //送信履歴登録
        db_admin_insert_c_send_messages_history(
            $requests['subject'],
            $requests['body'],
            $send_num,
            $send_type,
            $requests['c_member_ids']
        );

        switch ($send_type) {
            case "mail":
                $sended_name = "メール";
            break;
            case "message":
                $sended_name = "メッセージ";
            break;
        }

        admin_client_redirect('top', $sended_name.'を送信しました');
    }
}

?>
