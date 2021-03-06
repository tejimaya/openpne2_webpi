<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

function smarty_block_t_form_block($params, $content, &$smarty, &$repeat)
{
    if ($repeat) {  // 開始タグでは実行しない
        return null;
    }

    $method = 'post';
    if (isset($params['_method'])) {
        if ($params['_method'] == 'get') {
            $method = 'get';
        }
        unset($params['_method']);
    }

    $enctype = '';
    if (isset($params['_enctype'])) {
        if ($params['_enctype'] == 'file' || $params['_enctype'] == 'multipart') {
            $enctype = 'multipart/form-data';
            $params['MAX_FILE_SIZE'] = max(IMAGE_MAX_FILESIZE * 1024, FILE_MAX_FILESIZE * 1024);
        }
        unset($params['_enctype']);
    }

    $attr = '';
    if (isset($params['_attr'])) {
        $attr = $params['_attr'];
        unset($params['_attr']);
    }

    $form_action = openpne_gen_url_head($params['m'], $params['a'], false);

    if (isset($params['_form_action'])) {
        $form_action .= $params['_form_action'];
        unset($params['_form_action']);
    }

    if (need_ssl_param($params['m'], $params['a'])) {
        $params['ssl_param'] = 1;
    }

    if (@session_id() && strpos($params['a'], 'do') === 0) {
        $params['sessid'] = md5(session_id());
    }

    $html = sprintf('<form action="%sindex.php" method="%s"', $form_action, $method);
    if ($enctype) {
        $html .= sprintf(' enctype="%s"', $enctype);
    }
    if ($attr) {
        $html .= sprintf(' %s', $attr);
    }
    $html .= ">";
    foreach ($params as $key => $value) {
        $html .= "\n";
        $html .= sprintf('<input type="hidden" name="%s" value="%s" />',
                         htmlspecialchars($key, ENT_QUOTES, 'UTF-8'),
                         htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }
    $html .= "\n";
    $html .= $content;
    $html .= "</form>\n";

    return $html;
}

?>
