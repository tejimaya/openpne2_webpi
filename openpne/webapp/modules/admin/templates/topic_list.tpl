({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="トピック・イベント管理"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

<h2>トピック・イベント管理</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<div id="c01">
<form action="./index.php" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('topic_list','page')})" />
<h3 class="item">検索キーワード</h3>
<input class="basic" type="text" name="keyword" value="({$keyword})" />
<span class="textBtnS"><input type="submit" value="　検　索　" /></span>
</form>

<form action="./index.php" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('topic_list','page')})" />
<h3 class="item">ID検索</h3>
<input class="basic" type="text" name="target_c_commu_topic_id" value="({$target_c_commu_topic_id})" />
<span class="textBtnS"><input type="submit" value="　検　索　" /></span>
</form>
</div>

({if !$topic_list})

<p class="info">該当するトピック・イベントが存在しません</p>

({else})

<script type="text/javascript" src="./js/select_delete.js"></script>

({if $page_list})
({capture name="pager"})
<div class="listControl">
<p class="display">
({$total_num})件中 ({$start_num})-({$end_num})件目を表示しています
</p>
<p class="listMove">
({if $page_list})({foreach from=$page_list item=item})({if $page!=$item})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('topic_list','page')})&amp;page=({$item})&amp;keyword=({$keyword_encode})">({$item})</a>({else})<b>({$item})</b>({/if})&nbsp;&nbsp;({/foreach})&nbsp;({/if})
({if $prev})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('topic_list','page')})&amp;page=({$page-1})&amp;keyword=({$keyword_encode})">＜＜前</a>　({/if})
({if $next})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('topic_list','page')})&amp;page=({$page+1})&amp;keyword=({$keyword_encode})">次＞＞</a>({/if})
</p>
</div>({*/div class="listControl"*})

({/capture})

({$smarty.capture.pager|smarty:nodefaults})
({/if})

({foreach from=$topic_list item=item})
<table class="basicType2">
<tbody>
({****})
<tr>
<th>ID</th>
<td class="type1">
<input type="checkbox" name="del" value="({$item.c_commu_topic_id})" />
({$item.c_commu_topic_id})
</td>
</tr>
({****})
<tr>
<th>トピック名</th>
<td>
<a href="({t_url _absolute=1 m=pc a=page_c_topic_detail})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})" target="_blank">({$item.topic_name})</a> (({$item.count_comments}))
</td>
</tr>
({****})
<tr>
<th>({$WORD_COMMUNITY})名</th>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_commu_detail','page')})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.commu_name})</a>
</td>
</tr>
({****})
<tr>
<th>トピック作成者</th>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail','page')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname})</a>
</td>
</tr>
({****})
<tr>
<th>作成日</th>
<td>
({$item.r_datetime})
</td>
</tr>
({****})
({if $item.event_flag})
<tr>
<th>開催日時</th>
<td>
({$item.open_date})&nbsp;({$item.open_date_comment})
</td>
</tr>
({****})
<tr>
<th>開催場所</th>
<td>
({$pref[$item.open_pref_id]})({$item.open_pref_comment})
</td>
</tr>
({****})
({/if})
<tr>
<th>トピック本文</th>
<td class="textbody">
({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})
<div>
({if $item.image_filename1})<span class="padding_s"><a href="({t_img_url filename=$item.image_filename1})" target="_blank"><img src="({t_img_url filename=$item.image_filename1 w=120 h=120})"></a></span>({/if})
({if $item.image_filename2})<span class="padding_s"><a href="({t_img_url filename=$item.image_filename2})" target="_blank"><img src="({t_img_url filename=$item.image_filename2 w=120 h=120})"></a></span>({/if})
({if $item.image_filename3})<span class="padding_s"><a href="({t_img_url filename=$item.image_filename3})" target="_blank"><img src="({t_img_url filename=$item.image_filename3 w=120 h=120})"></a></span>({/if})
</div>
({/if})
({if $smarty.const.OPENPNE_ADMIN_CONVERT_URL})
({$item.body|nl2br|t_url2cmd:'community':$item.c_member_id|t_cmd:'community'})
({else})
({$item.body|nl2br})
({/if})
</td>
</tr>
({****})
({if $item.filename && $smarty.const.OPENPNE_USE_FILEUPLOAD})
<tr>
<th>ファイル</th>
<td class="textbody">
<a href="./?m=({$module_name})&amp;a=do_({$hash_tbl->hash('file_download','do')})&amp;filename=({$item.filename})&amp;sessid=({$PHPSESSID})&amp;({$smarty.now})">
({$item.original_filename})
</a>
</td>
</tr>
({****})
({/if})
({if $item.event_flag})
<tr>
<th>募集期限</th>
<td>
({if $item.invite_period != "0000-00-00"})({$item.invite_period})({else})指定なし({/if})
</td>
</tr>
({****})
<tr>
<th>募集人数</th>
<td>
({if $item.capacity})({$item.capacity})人({else})無制限({/if})
</td>
</tr>
({****})
<tr>
<th>参加者</th>
<td>
<a href="({t_url _absolute=1 m=pc a=page_c_event_member_list})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})" target="_blank">({$item.member_num})人</td>
</td>
</tr>
({****})
({/if})
<tr>
<td class="formbutton" colspan="2">
<form action="./index.php" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('delete_topic')})" />
<input type="hidden" name="target_c_commu_topic_id" value="({$item.c_commu_topic_id})" />
<span class="textBtnS"><input type="submit" value="　削　除　" /></span>
</form>
</td>
</tr>
</tbody>
</table>
({/foreach})

<form id="select-delete-form" action="./" method="get">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('delete_topic_selected')})" />
<input type="hidden" id="del-ids" name="target_c_commu_topic_ids" value="" />
<span class="textBtnS"><input type="button" id="select-delete" value="選択したトピックを削除" /></span>
</form>

({if $page_list})
({$smarty.capture.pager|smarty:nodefaults})
({/if})

({/if})

({$inc_footer|smarty:nodefaults})
