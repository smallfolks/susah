<?php
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.1
*/function
adminer_errors($Cc,$Ec){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$Ec);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$ad=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($ad||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ii=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ii)$$X=$Ii;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($v){if(!preg_match('~^[`\'"]~',$v))return$v;$qe=substr($v,-1);return
str_replace($qe.$qe,$qe,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($tg,$ad=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($z,$X)=each($tg)){foreach($X
as$he=>$W){unset($tg[$z][$he]);if(is_array($W)){$tg[$z][stripslashes($he)]=$W;$tg[]=&$tg[$z][stripslashes($he)];}else$tg[$z][stripslashes($he)]=($ad?$W:stripslashes($W));}}}}function
bracket_escape($v,$Na=false){static$ui=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Na?array_flip($ui):$ui));}function
min_version($Zi,$De="",$h=null){global$g;if(!$h)$h=$g;$nh=$h->server_info;if($De&&preg_match('~([\d.]+)-MariaDB~',$nh,$C)){$nh=$C[1];$Zi=$De;}return(version_compare($nh,$Zi)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($yh,$ti="\n"){return"<script".nonce().">$yh</script>$ti";}function
script_src($Ni){return"<script src='".h($Ni)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($D,$Y,$db,$me="",$uf="",$hb="",$ne=""){$I="<input type='checkbox' name='$D' value='".h($Y)."'".($db?" checked":"").($ne?" aria-labelledby='$ne'":"").">".($uf?script("qsl('input').onclick = function () { $uf };",""):"");return($me!=""||$hb?"<label".($hb?" class='$hb'":"").">$I".h($me)."</label>":$I);}function
optionlist($_f,$gh=null,$Ri=false){$I="";foreach($_f
as$he=>$W){$Af=array($he=>$W);if(is_array($W)){$I.='<optgroup label="'.h($he).'">';$Af=$W;}foreach($Af
as$z=>$X)$I.='<option'.($Ri||is_string($z)?' value="'.h($z).'"':'').(($Ri||is_string($z)?(string)$z:$X)===$gh?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($D,$_f,$Y="",$tf=true,$ne=""){if($tf)return"<select name='".h($D)."'".($ne?" aria-labelledby='$ne'":"").">".optionlist($_f,$Y)."</select>".(is_string($tf)?script("qsl('select').onchange = function () { $tf };",""):"");$I="";foreach($_f
as$z=>$X)$I.="<label><input type='radio' name='".h($D)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ia,$_f,$Y="",$tf="",$fg=""){$Yh=($_f?"select":"input");return"<$Yh$Ia".($_f?"><option value=''>$fg".optionlist($_f,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$fg'>").($tf?script("qsl('$Yh').onchange = $tf;",""):"");}function
confirm($Ne="",$hh="qsl('input')"){return
script("$hh.onclick = function () { return confirm('".($Ne?js_escape($Ne):lang(0))."'); };","");}function
print_fieldset($u,$ve,$cj=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$ve</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$u');",""),"</legend>","<div id='fieldset-$u'".($cj?"":" class='hidden'").">\n";}function
bold($Ua,$hb=""){return($Ua?" class='active $hb'":($hb?" class='$hb'":""));}function
odd($I=' class="odd"'){static$t=0;if(!$I)$t=-1;return($t++%2?$I:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($z,$X=null){static$bd=true;if($bd)echo"{";if($z!=""){echo($bd?"":",")."\n\t\"".addcslashes($z,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$bd=false;}else{echo"\n}\n";$bd=true;}}function
ini_bool($Ud){$X=ini_get($Ud);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($Yi,$M,$V,$F){$_SESSION["pwds"][$Yi][$M][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($P){global$g;return$g->quote($P);}function
get_vals($G,$d=0){global$g;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$d];}return$I;}function
get_key_vals($G,$h=null,$qh=true){global$g;if(!is_object($h))$h=$g;$I=array();$H=$h->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($qh)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$h=null,$n="<p class='error'>"){global$g;$yb=(is_object($h)?$h:$g);$I=array();$H=$yb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($h)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$I;}function
unique_array($J,$x){foreach($x
as$w){if(preg_match("~PRIMARY|UNIQUE~",$w["type"])){$I=array();foreach($w["columns"]as$z){if(!isset($J[$z]))continue
2;$I[$z]=$J[$z];}return$I;}}}function
escape_key($z){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$z,$C))return$C[1].idf_escape(idf_unescape($C[2])).$C[3];return
idf_escape($z);}function
where($Z,$p=array()){global$g,$y;$I=array();foreach((array)$Z["where"]as$z=>$X){$z=bracket_escape($z,1);$d=escape_key($z);$I[]=$d.($y=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($y=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$z],q($X))));if($y=="sql"&&preg_match('~char|text~',$p[$z]["type"])&&preg_match("~[^ -@]~",$X))$I[]="$d = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$z)$I[]=escape_key($z)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$p=array()){parse_str($X,$bb);remove_slashes(array(&$bb));return
where($bb,$p);}function
where_link($t,$d,$Y,$wf="="){return"&where%5B$t%5D%5Bcol%5D=".urlencode($d)."&where%5B$t%5D%5Bop%5D=".urlencode(($Y!==null?$wf:"IS NULL"))."&where%5B$t%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($e,$p,$L=array()){$I="";foreach($e
as$z=>$X){if($L&&!in_array(idf_escape($z),$L))continue;$Ga=convert_field($p[$z]);if($Ga)$I.=", $Ga AS ".idf_escape($z);}return$I;}function
cookie($D,$Y,$ye=2592000){global$ba;return
header("Set-Cookie: $D=".urlencode($Y).($ye?"; expires=".gmdate("D, d M Y H:i:s",time()+$ye)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($gd=false){$Qi=ini_bool("session.use_cookies");if(!$Qi||$gd){session_write_close();if($Qi&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($z){return$_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z,$X){$_SESSION[$z][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Yi,$M,$V,$l=null){global$kc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($kc))."|username|".($l!==null?"db|":"").session_name()),$C);return"$C[1]?".(sid()?SID."&":"").($Yi!="server"||$M!=""?urlencode($Yi)."=".urlencode($M)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($C[2]?"&$C[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($B,$Ne=null){if($Ne!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($B!==null?$B:$_SERVER["REQUEST_URI"]))][]=$Ne;}if($B!==null){if($B=="")$B=".";header("Location: $B");exit;}}function
query_redirect($G,$B,$Ne,$Dg=true,$Jc=true,$Tc=false,$gi=""){global$g,$n,$b;if($Jc){$Fh=microtime(true);$Tc=!$g->query($G);$gi=format_time($Fh);}$Ah="";if($G)$Ah=$b->messageQuery($G,$gi,$Tc);if($Tc){$n=error().$Ah.script("messagesPrint();");return
false;}if($Dg)redirect($B,$Ne.$Ah);return
true;}function
queries($G){global$g;static$yg=array();static$Fh;if(!$Fh)$Fh=microtime(true);if($G===null)return
array(implode("\n",$yg),format_time($Fh));$yg[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$g->query($G);}function
apply_queries($G,$S,$Fc='table'){foreach($S
as$Q){if(!queries("$G ".$Fc($Q)))return
false;}return
true;}function
queries_redirect($B,$Ne,$Dg){list($yg,$gi)=queries(null);return
query_redirect($yg,$B,$Ne,$Dg,false,!$Dg,$gi);}function
format_time($Fh){return
lang(1,max(0,microtime(true)-$Fh));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Qf=""){return
substr(preg_replace("~(?<=[?&])($Qf".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($E,$Pb){return" ".($E==$Pb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($z,$Xb=false){$Zc=$_FILES[$z];if(!$Zc)return
null;foreach($Zc
as$z=>$X)$Zc[$z]=(array)$X;$I='';foreach($Zc["error"]as$z=>$n){if($n)return$n;$D=$Zc["name"][$z];$oi=$Zc["tmp_name"][$z];$Db=file_get_contents($Xb&&preg_match('~\.gz$~',$D)?"compress.zlib://$oi":$oi);if($Xb){$Fh=substr($Db,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Fh,$Jg))$Db=iconv("utf-16","utf-8",$Db);elseif($Fh=="\xEF\xBB\xBF")$Db=substr($Db,3);$I.=$Db."\n\n";}else$I.=$Db;}return$I;}function
upload_error($n){$Ke=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?lang(2).($Ke?" ".lang(3,$Ke):""):lang(4));}function
repeat_pattern($cg,$we){return
str_repeat("$cg{0,65535}",$we/65535)."$cg{0,".($we%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$we=80,$Mh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$we).")($)?)u",$P,$C))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$we).")($)?)",$P,$C);return
h($C[1]).$Mh.(isset($C[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($tg,$Jd=array(),$lg=''){$I=false;foreach($tg
as$z=>$X){if(!in_array($z,$Jd)){if(is_array($X))hidden_fields($X,array(),$z);else{$I=true;echo'<input type="hidden" name="'.h($lg?$lg."[$z]":$z).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Uc=false){$I=table_status($Q,$Uc);return($I?$I:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$I=array();foreach($b->foreignKeys($Q)as$r){foreach($r["source"]as$X)$I[$X][]=$r;}return$I;}function
enum_input($T,$Ia,$o,$Y,$zc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Fe);$I=($zc!==null?"<label><input type='$T'$Ia value='$zc'".((is_array($Y)?in_array($zc,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Fe[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$db=(is_int($Y)?$Y==$t+1:(is_array($Y)?in_array($t+1,$Y):$Y===$X));$I.=" <label><input type='$T'$Ia value='".($t+1)."'".($db?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$I;}function
input($o,$Y,$s){global$U,$b,$y;$D=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$s){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$s="json";}$Ng=($y=="mssql"&&$o["auto_increment"]);if($Ng&&!$_POST["save"])$s=null;$pd=(isset($_GET["select"])||$Ng?array("orig"=>lang(8)):array())+$b->editFunctions($o);$Ia=" name='fields[$D]'";if($o["type"]=="enum")echo
h($pd[""])."<td>".$b->editInput($_GET["edit"],$o,$Ia,$Y);else{$zd=(in_array($s,$pd)||isset($pd[$s]));echo(count($pd)>1?"<select name='function[$D]'>".optionlist($pd,$s===null||$zd?$s:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($pd))).'<td>';$Wd=$b->editInput($_GET["edit"],$o,$Ia,$Y);if($Wd!="")echo$Wd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ia value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ia value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Fe);foreach($Fe[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$db=(is_int($Y)?($Y>>$t)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$D][$t]' value='".(1<<$t)."'".($db?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$D'>";elseif(($ei=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($ei&&$y!="sqlite")$Ia.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ia.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ia>".h($Y).'</textarea>';}elseif($s=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ia cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Me=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$C)?((preg_match("~binary~",$o["type"])?2:1)*$C[1]+($C[3]?1:0)+($C[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($y=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Me+=7;echo"<input".((!$zd||$s==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Me?" data-maxlength='$Me'":"").(preg_match('~char|binary~',$o["type"])&&$Me>20?" size='40'":"")."$Ia>";}echo$b->editHint($_GET["edit"],$o,$Y);$bd=0;foreach($pd
as$z=>$X){if($z===""||!$X)break;$bd++;}if($bd)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $bd), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$v=bracket_escape($o["field"]);$s=$_POST["function"][$v];$Y=$_POST["fields"][$v];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($s=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($s=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($s=="json"){$s="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$Zc=get_file("fields-$v");if(!is_string($Zc))return
false;return$m->quoteBinary($Zc);}return$b->processInput($o,$Y,$s);}function
fields_from_edit(){global$m;$I=array();foreach((array)$_POST["field_keys"]as$z=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$z];$_POST["fields"][$X]=$_POST["field_vals"][$z];}}foreach((array)$_POST["fields"]as$z=>$X){$D=bracket_escape($z,1);$I[$D]=array("field"=>$D,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($z==$m->primary),);}return$I;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$jh="<ul>\n";foreach(table_status('',true)as$Q=>$R){$D=$b->tableName($R);if(isset($R["Engine"])&&$D!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$H=$g->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$H||$H->fetch_row()){$pg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$D</a>";echo"$jh<li>".($H?$pg:"<p class='error'>$pg: ".error())."\n";$jh="";}}}echo($jh?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($Hd,$Ve=false){global$b;$I=$b->dumpHeaders($Hd,$Ve);$Mf=$_POST["output"];if($Mf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Hd).".$I".($Mf!="file"&&preg_match('~^[0-9a-z]+$~',$Mf)?".$Mf":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$z=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$J[$z]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($s,$d){return($s?($s=="unixepoch"?"DATETIME($d, '$s')":($s=="count distinct"?"COUNT(DISTINCT ":strtoupper("$s("))."$d)"):$d);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$q=@tempnam("","");if(!$q)return
false;$I=dirname($q);unlink($q);}}return$I;}function
file_open_lock($q){$nd=@fopen($q,"r+");if(!$nd){$nd=@fopen($q,"w");if(!$nd)return;chmod($q,0660);}flock($nd,LOCK_EX);return$nd;}function
file_write_unlock($nd,$Rb){rewind($nd);fwrite($nd,$Rb);ftruncate($nd,strlen($Rb));flock($nd,LOCK_UN);fclose($nd);}function
password_file($i){$q=get_temp_dir()."/adminer.key";$I=@file_get_contents($q);if($I||!$i)return$I;$nd=@fopen($q,"w");if($nd){chmod($q,0660);$I=rand_string();fwrite($nd,$I);fclose($nd);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$A,$o,$fi){global$b;if(is_array($X)){$I="";foreach($X
as$he=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($he):"")."<td>".select_value($W,$A,$o,$fi);return"<table cellspacing='0'>$I</table>";}if(!$A)$A=$b->selectLink($X,$o);if($A===null){if(is_mail($X))$A="mailto:$X";if(is_url($X))$A=$X;}$I=$b->editVal($X,$o);if($I!==null){if(!is_utf8($I))$I="\0";elseif($fi!=""&&is_shortable($o))$I=shorten_utf8($I,max(0,+$fi));else$I=h($I);}return$b->selectVal($I,$A,$o,$X);}function
is_mail($wc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$jc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$cg="$Ha+(\\.$Ha+)*@($jc?\\.)+$jc";return
is_string($wc)&&preg_match("(^$cg(,\\s*$cg)*\$)i",$wc);}function
is_url($P){$jc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($jc?\\.)+$jc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($Q,$Z,$ce,$sd){global$y;$G=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ce&&($y=="sql"||count($sd)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$sd).")$G":"SELECT COUNT(*)".($ce?" FROM (SELECT 1$G GROUP BY ".implode(", ",$sd).") x":$G));}function
slow_query($G){global$b,$qi,$m;$l=$b->database();$hi=$b->queryTimeout();$vh=$m->slowQuery($G,$hi);if(!$vh&&support("kill")&&is_object($h=connect())&&($l==""||$h->select_db($l))){$ke=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$ke,'&token=',$qi,'\');
}, ',1000*$hi,');
</script>
';}else$h=null;ob_flush();flush();$I=@get_key_vals(($vh?$vh:$G),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$Ag=rand(1,1e6);return($Ag^$_SESSION["token"]).":$Ag";}function
verify_token(){list($qi,$Ag)=explode(":",$_POST["token"]);return($Ag^$_SESSION["token"])==$qi;}function
lzw_decompress($Ra){$gc=256;$Sa=8;$jb=array();$Pg=0;$Qg=0;for($t=0;$t<strlen($Ra);$t++){$Pg=($Pg<<8)+ord($Ra[$t]);$Qg+=8;if($Qg>=$Sa){$Qg-=$Sa;$jb[]=$Pg>>$Qg;$Pg&=(1<<$Qg)-1;$gc++;if($gc>>$Sa)$Sa++;}}$fc=range("\0","\xFF");$I="";foreach($jb
as$t=>$ib){$vc=$fc[$ib];if(!isset($vc))$vc=$nj.$nj[0];$I.=$vc;if($t)$fc[]=$nj.$vc[0];$nj=$vc;}return$I;}function
on_help($rb,$sh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $rb, $sh) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$p,$J,$Li){global$b,$y,$qi,$n;$Rh=$b->tableName(table_status1($Q,true));page_header(($Li?lang(10):lang(11)),$n,array("select"=>array($Q,$Rh)),$Rh);$b->editRowPrint($Q,$p,$J,$Li);if($J===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$D=>$o){echo"<tr><th>".$b->fieldName($o);$Yb=$_GET["set"][bracket_escape($D)];if($Yb===null){$Yb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Yb,$Jg))$Yb=$Jg[1];}$Y=($J!==null?($J[$D]!=""&&$y=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($J[$D])?array_sum($J[$D]):+$J[$D]):(is_bool($J[$D])?+$J[$D]:$J[$D])):(!$Li&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Yb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$s=($_POST["save"]?(string)$_POST["function"][$D]:($Li&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Li&&$Y==$o["default"]&&preg_match('~^[\w.]+\(~',$Y))$s="SQL";if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$s="now";}input($o,$Y,$s);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Li?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Li?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."…', this); };"):"");}}echo($Li?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$qi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0Ė\0\n @\0ԂCĐ蕜"\0`E䑸¿ǿtvM'ՊdYd\\͢0\0Ŝ"ڀfӈŮs5܏蒁ݖXPaJӰĥњ8ģR˔ɑz`ȣ.ʇc��-\0m?.֖̍\0ȯ(̉��/(%͜0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇ԙ͞l7܇B1Ĵvb0ٍfsѼ뮲B͑ҙٞn:ǣ(ݢ.\rDc)Ɉa7EēѤìǃє驱̎sش筴هfӉɎi7ƃӹňt4ŦԹ雦4݅ѩׁT̖Vѩf:Ϧ,:1Ǒݼ񢲙`ǣ��GҘӳЙLؘD*bv<܌#ĥ@ֺ4秡foзǴ:<Ɯ咾گ㜎\nią𧬩ۖa_ĺکv𼎻4.5Nf©öpѨذlɪۜOƁʮ= ÚOFQфk\$Ɠi��ä2T㢰኶ā̾ǡ-ٚà޶ݣph:̐a̬Σ둮2ͣ8АѣҘ6n㮑ǱJȢh̴Ōъ䴆O42��ޒުr)@p@ơĜߏĴ��6	r[ΰL°˺2BɪǓ!Hb󃐤=!1Vʜ"Ȳ0ſ\nSƙǏD7ĬDڛÏC!ơܠǇʌǠȫҽtC橮Cŀ:+Ɋ=ʪڲq奟ˣ�R/տEȒ4ĩ2ѤѠ䡂8(⓹[W呜=ɜyS¢нܹ֭BS+ɯɜ��@pL4Yd㗄q˸㧰ꢶóĬϸAc܌鎨ͫÛ&>��Z°km]ص-c:ؕ؈Nt撎հҝ̊8轿#١[.𜞯͚~
­̹ȐP⽉֛񿀏숑ʹv[בՄ\nיr��+ѡTѲŭVµz䴍ø��߅y*#j̲]͕RӁѥ)Ā[NΒ\$ʼ>:󭾜$;־L\rۄψ΃Tɜnw 渘æ콯̇w᷶ڜ\Y󟠒t^̾Ϝr}͙S\rz鴽֜nLԥJ㓋\",Z8؞ِi��?ɻҴ³3#əɠ:󦻍㽖ɞE]xޒ³^8ΣK^ʷ*0Ҟwޔ቞~У��iپж2w޿ч󞷐㉲7ģޑu+U%΃{Pܪ4̼ꍘ./!܉1CƟqx!Hق䇤񭌨ěȒĠР6덨5Κڦ8ĆȽH𬠌V1ӛ\0a2׻6Ǡ��ȿĞ\0&��d)KE'ҀnՐ[Xɳ\0ZɊՆ[PҞـ១Ɏ񙂬`ɕ\"ڷ0Ee9yF>̔9bږͦF5:􈔜0}Ĵʇ(\$ߓȫ37H�� M߁в6Rֺ{MqݷGZCڃ뭲¨̓t>[쮴/&Cܝ릴G􌬜4@r>Ȃ弚Sqկ溔Q뎨m͚PǴ䴝L\#鵋̼ΙĶfKPޜr%tԈԖ=\"SH\$޽ ؁)wlW\0FӪu@٢ƹÜrrвã̈́̔Xó۹OI񾔻ƮFǢ%乐'̝_@t\rτzŜ\1٨lݝQ5Mp6kǐűhĜ$Ĉ~͂|Ҕݡ*4ͱ򜔛`S콲S t\\gҨ7Ȝn-ʺ袪pԕԈl̂ަӨcèwO0\\:֐wՁ݌p4ȓ򻔚򪏤6HÊײՒŃѱ\nǉ%%׹']\$aҚӮfcֱ*-뇗ۺk̈́zÕеjўΰlgጺȜ$\"ߎݜr#ʤヂÿѳcᭌĜ"j˜r6֕ƈՒݐh˱/݄A)2ޛkn°76ԉR{⍅Ő󰲀\n-١׶��zJH,פlBĨѯӍ쟂򝬫ǣDr^֞֙eڼEݽֆ ĜaPʴ��zᲴ񠲇Xٖ´VחࠠޙȳʑB_%K=Eɸb弾ࠂȫU(.!ܮ8؜􉌉.@ϋθn��Đ󎳇2˔m	C*컶㕅\nRكյˋ0uíĦ]ΛϘʔP/֊QdƻLמӺYO2bܜT 񝊳ӴƗ太Ɩ=пǌ4ϐrġࠂ𙳶͙΍eLʪܝ睶񩀯й< GԤƕЙMhm^Е܎ח򔲋5HiMԯͮĭݳT
[-<__Xr(<ǯʆω��uҖGNX20杲\$^Ǎ:'9跏ƭ;ثϏ܆֦N'a֔ǎ΢Ŭ̖Ŵū1֯HI!%6@򈏜$ӅGڜ̱ݨmU˥Ʋս校ѩN+Ü񩚜䱬ْf0ÆޛU㹖˨-:I^\$ٳˈb\reǑugʨ˾9ܟȝbص􂈦䫰͔ hXrݬɡ\$إ,ҷ+ŷ̳ͫǌ_ぅk۹\nkĲ��uWdY��={.󄍘Тgۉp8ݴ\rRZ࠶Ί:Ҿ��+ƀěCѴ\rjt}6Ӱ%¿ᵇϱҞ>񯆋ƍȰιF`ו島~KĐⷑRї̰zь뭭˷LǹYժq͸ź񨓥ϝ۳鷣~ۄᎡ׷޸ؾ쉟i7ղŸҏݻӻ_{񺵳㻴Иܟ࠵zԳ񤩋CЂ\$?KӪPeЏT&��\0P؎AϞξpƅ ��ӏյ\r\$߯і�+D6궦ψ߭J\$(ɯlߍh&լKBS>؋��֦xƯz>흚oŚ𜮊̛ж��Ȝհ2��і𰦻zО2BlʢkжZkՁhXcd갪ËTⰈ=͕πҰ0ˬV굋飜r܌Ʈϭǯ)(Ϩ��Т򅉜:CɃᚋ⍜rɇ\ré0��皌Ѿ:`Z1Q\n:`\r\0̧ȌqїѼ:`ߑ-ɍ#}1;龹ˁqѣ|񓑀ޢhlڄĆ\0fiDp돌
``ٰ瑑0y_1Řj\r񽐑MQ\\ĳ%oq֭\0؋񣒱Ȳ1Ϳ1Э ߘѧќbi:ԭ\rѯѢ۠`)ۄ0񙑛@ގћĉ1˟Nᄘʵ񏑱Ú񣘱Ϟүq1 򝕑��\rdIUǦv嫭± tۂ𓰢R0:Ű𰓱A2VűⰠ霱ϥӦi3!&QךRc%ӱ&w%Ҭ\rѠVș#˸ڑw`˞% ބӭ*rŐӹ&i߫r{*һ(rg(ѣ(2ͨ𥩒@iۭ
 Ȟձ\"\0ۚӒЪ��.r뛄,Yry(2˃ᨲb좂ޏ3%ҵ,R߱ӆ&鿴db顐\rLӳ-3ᓠ֌s\0挳Bpױ񹴳O'Rѿ3*ҳ=\$ᛓĞiI;/3iɵҋ&ӽ17ң ѹ8?\"߷ҥ8񹪒23١󏡱\\\0ϸӭrk9ѻSŲ3֋ᚓ*Ӻq]5S<ԁ#3͸3ݓ#eѽپ~9S螳ѝrթT*aࠀіڢesٛԕú-󀏩Ǟ*;,Xٳ!iԛҌҲퟲ� ͫn ˪ӣ@ӳi7ԗ1ɏ޴_ֆғ;3ІҜrAЩ3��:à\rӰϔ@ҭԯ͓wԛ7񄓓Ҋ3۠篆ꜤOłұץ4ɫtçg󌱜rJtȊ􋍲\r􍷱ƆT@ӣީⓣdΉ2P>ΰFi಴��\0ޓ٢皫(Մֿ䌑äգ1䜢2tմ��靲Ā,\$KCt򵴶#��␣Pi.ϕ2ՕC翞\"䢩;}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:یgCIݜ\n8݅3)ы7܅Ƹ1ъx:\nOg#)Ѫr7\n\"Ǩՠ𼲛ͧSi׈)NǓҤȜrǝ\"0ڄ@䩝ࠠ(\$s6O!Ԩݖ/=݌' T4潄٩S؍6IOG#ҁXؖCΆs`Z1.Ѩp8,ԛǈ䵋~Czȉ岹lߣ3ۍ곣фډǢⵜnꆸTƚIٝʕ*fzل岰߅Ɠٹθ񦎙.:攃I͊(٣ء΋!Οlڭ^؞(֚N{S֓)ṟӖl٦3ʳۜnثGƓ빺퇋iׂ﹖3wԵh䟲ـڞա۔򹍣٨\rӨ먮ځChҼ\r)鑣 淣3'm5̣ȕ\nܺ2Đ۪΋q 򿅃Խīɺˁ곸ˎBذϨRʈr(ܰšb\\0͈r44́B͡°Ȝ$ϲZZ˲܉.Ƀ(\\εË|\nC(Ϝ"σPł𸮋ΐN͒TʕΓf>NŁ8HP❜̷Jp~ēݻ2%OCȱ㮃ȃ8·Hɲ*ɪЅ᝷S(ٯ¬̶KU݊ǡ<2ʰOIŴֿ`Δ䇢ӈdO^5ͭ􆴌䱘25-Ң򛈰z7ø\"(ѐ\\32:]Uڗ鮢߅!]ؼ؁ۆۤӐࠩڰ̬\r՜0vӎ#J8̏wm߭ɤȼˉf��p#䡘ބ͸��ퟻ�Еȹ𨥍A頓ŎwJ΄࠿޲ҹt̢*ퟻ�̎iIh\\9Ǖ鐺À杅⹯͵yl*څȈΗ癠ܗȸ긒WԢ?Վ۳ڰʡ\"6圮[͊\r͜*\$׆Ǿnzxƹ\r�3ףpޓﻶ޺(p\\;Ջmzüǒ9󜐑��ƁѪ2ͽ̎\rʈH&̲(ĺŁ7iܫàˊĂcċe򞽧t݌̲:SH󈠃/)׸߀ꦴʲi9Ž��Ѐ̯yҷݰϖī^WڦͬkZ癗l؊ÁL4׈Ƌʶ,ð\\Eɻ0ڰƒDiԭT翚󰬰%=`Ж˃9(ĵ𜮙\nn,4Ȝ0萡}܃.ѶRs\02B\\ܢ1ࠓҜ0003,՘PHJsp椓KàCA!в*Wߓձڲ\$䫙æ^\nĘ1́ղzEàIvŜ\䜲ɛ.*AЙԔE(dҡуbꝂ܄Бƹǂ⁁DhЦͪ?ĝHѳБزӸ~nÁJ̔2񗦣᥇RܽڇӑΐTw띑ܵPɢ䝜)6Ǵ❂򳅨\\3ɜ0R	'\r+*;Rퟢ�ӡқͧ~ͥt< 豜K#桚񬟌ퟰ�̳ܒ٬ŀΦ✤	}`ԕ׃XڐɅӆ0֭彻Ԅ:Mꨉ蚜G呡&3D|!萲3Ń?hėJʥ ۰hᒜr­՘ퟹ�أԎ҆ˎوl7nvêWI宋Ձ-ӵ֧eyρ\rEJ\ni*ݜ$@ےU0,\$UࠅƦՔªu)@(tΙSJkⰡ~͂ᤏ`̾ϕ\nû#\rp9Ɨjɹݝ&Nc(r֔QUʽSؚ\08n`˗y֢ŅޅLݏ5î,Ųޑ>΂Ǹ₢Ҧ䴒㘚ЫV\"҉{kMɛ\r%ƌ[	Ğe􎡔1! ꀭԔΩF@̢)Rߣ72ɮ0nWșҌӜ܆Үtdի­܇0wgl𰮀򪉢֩ĜnAȍ5n휤EӅױNܡlʝࠗ쥪1 Aݻړ򷝫񲮩FB��񯬬muNx-ΟVŃ( Pf邬\r1p[9x(iԘBҖӛzQl��ԉԂʘU TbĝIޠְ+V\0;˓CbπX񫏒γཝH��k̸̃G*􆏝ءwn򡅶ò㜐mS�IߍK̾/ޓŷ߹eeNʲͪS˯;d恆>}l~ߏꃠȥ^ԕf蘢pڜDEׂt\nx=īЎę*d۪𔖗ۼ󪝲ࠉjܝ\nѠɠ,٥=цM84��a֪@sД實ʝ\n\rdܐܰ߭��%ԓ홞~	Ȇ<֐ˋׁHࠇ8񙿝΃\$z̰{ֻӵ2*ƃᡏ׀>ۨw̘K.bP{Ńo��´ˌzգ낲��8>ʤԁ,ѥрū턨ȸ��ҭb=mǙ̡߬Ӄlzk݁ܤW��Њi犧ⷁ+̨��п.R˳K񇛤X瞝ZĻ2Ѡ̜(ĠvZ݅6霤٬愿HҖNxX��ȉ\$󬍍*\nѣ\$<q��!߹Sӗ℀࠸sA!غՋƁ}rԹ̣ݒ��kؘϰ\n<��ǽ쭬ș3иǈ֖Vͽħ&Yݍ!ƫ󻼸Yȳ࠙E3rԙϱ܃ǅ񢕳Ыk��כëϗt��ŭ)󛽟®}ٵԫl確D࠸+Ϗ _o㍤h140סʰ𢛔K٣̒v��lGʄ#ʚʪ΅Ʀʬ|Ud淉K̪·៬ค@ڮO\0HŚퟢ�6\rțʜ\\cg\0��ςĪeќn	ƺrЌ!ѮWz&ѿ {Hװ'\$X w@Ҹ도Gr*셝H娰#τ΀ǔ\nd􀷋,􏥗,��ό\0УLβEЂ\r׉`܅Ï𒥅Ү]`ʌЛŝ%&Ѯmѽ\r㞅%4SŶ𣜮fH\$%됌-£ΆұB㮦@Ñ-􎣲ʧ&L]ّ 膱h\r񬝠ϳPҨ䋷Ү#тÚ-᫅Іr祬&dXڥz톶ؐɁ\"ӈ|ߧó@ߚѮ溌)0rpڏ\0Ø\0ř齄L<!Ж��ǙD׻.B<Eʋ˰nB(|\r\n힩Π͠hӡÖ볜$ǒ(^˾Ш߂/pφqҐ͂ɅOڇɰ򬜜ՏȣRRΎϥ쥍dшjċ`tό͠V哅 bSӤȩυ𯯨ղ<i/k\$-ࠜ$oԼ+ǅ̎򬒞OӦevƒݩӪMPA'u'ώӿ( M(h/+̲WDߓo׮n׮𮔸�ܨ\"́'h��Ȓ/˯1D̊諥ȸE鞦⦀Ϭ'l\$/.,Ťȅ×bbO3󂳳H:J`!Ӯ*{Šϓ,FQ7(ȈԿӋ󱊬泠גΑҗŢqØ\r΃~R鰱`ϒބ󮙪仒ɹrJԓץLϫnٜ"ɸ\rǎ͇H!qb޲㍩ѥԞΓɗj#9ԔObE.I:ŶO7\0˶+ĥЮȒƞԡ7E8VS忇(DGȎӳB륻򬹔/<Ҵ򥀜r 쇴>󍀰@־HDsЋњ[tHąnx(ퟲ�x񏻀оGkjWԾ͂ڣT/8ϣ8ꑰ̨_ՉIGIIҗ!ưʅYEd̅՞дd굨àDV!C渎Ɯrʹࠢӳɡ3↎@ٳ3N}㛂󳐉ϳ忳0ۜM(꾂˽坜Ҵꃦf͋㊜rΒs337 X՜"tdά\nbtNO`P⻔͘ܕҭTМ$\nࠤZѭ5U5WU֞ho��tڐM/5K4EjԋQ&53GXԘx)Ҽ5DŒМr󖴜n࠲5b܀\\J\">Ȩ1S\r[-ǊDu\rӢȃ)00󙵈ˢث{\nք#֞\rԞ׋|鶜ܕ栮մʕ˾YtԜrIۃ@䏳ڒ 󎳺ӵePMS豔ַWϑXɲ򄨲ŋOUݠՇ;U��OYΩY͚Q,M[\0��ۍɗ>J*흲g(]ੜr\"ZCɩ6uꏫ֙󎈓Y6ôа˱��8}ѳ3AX3Th9j֟jᦇ��PJbqMP5>аɸ֩Yȫ%&\\±dØE4 ֙nъ<ƕ]Ӊ1ɓmbֶўӵڠꒅ\"NV꠰׫p��۞כWꜢ䩑\n ̜nf7\nׅ2յr8˗=Ek7tVڇ՞7PƶLʭa6򕔲v@'6iᰪ&>Ң;Σ`ӿa	\0pڨ(֊ҫ)̜\ߪn󲄬m\0ܨ2��qJ����Ҧj􂜢[\0ȷƇX,<\\ͮח⍷淫mdǥ~⍠څҳ%oдmnש,ׄ甇Ӝr4ׂ8\rҎ؜حEÈ]¦ټ׈W΍0D߀إ~ЋXK؋𙿸ՠ|fٞӈݗ\r>ԭz]2søD٤[sȴϓל0Qf-K`͢ôᘎŷTϹfZ`	𜮂ù Nbף<ۂ��دJ񰀏JNd挜rΨލÖвќ"ṦHCᝍֺθ��n16Ǵzr+zҹ����m ޕҔ ��@Y2lQ<2O+ťԍ.Ӄh񰁄߱؊Ě˓ϲRǀ1Ê/ШH\rɘƈaNB&Ǡō@כx̅ȊΥꗢ8&Lۖ͜vై*۪śۇH扜\ٮ	ٲ֦sۓ\0Qڠ\\\"颠ЉᅜrBs܉w݂	ޙែN`ڷǘCo(ڃੜnèݓȱڹ̪Eؠ񓅓UаUڠtڧ|խٰ޿h[Ü$.#ɵ	 劰ĄẂၒ��ꅀ|ħ{ڀː\0x��w%ŅsBdߧۃU۾O׷ᐅၘ㝄ԃŐͨZ3ȥ1ƥ{ʥLYɡ͚Т\\Ҩ*R`	ড়nŊΈیQCFȪιِᩜ͚pǘ|`NȂߜ$[ƉӀΕᰅƶᚥ`Zd\"\\\"ł£)ˇIȺ鴚�挜0[Ҩű­ɓg�ٮ*`hu%Â,ͣIշīӈ󵂭Ķ߽κN׍Ԝ$܍֕Yf&1񎀛e]pzŧۉŅmׇ/àچw ܡ֜\#5ŴIƤڅèqeƄ��k蹼۫ŚqDۢƺ?Ǻɾ򃾺Ɠ[鍒ƬZјڮ:޹ąؚ·j࠷5	י~0 ʂӭϚ\$\0CǤSg٫ {ހ՜n`މļC ׻Mڵ⌻ң t}xώŷڇ{ۛЩ뼃ĊFKZޏjڂ\0PFYՂ屆k֛0<ھ˄<JEٚg\r��2׼8ꖀ*εfkˌJD퉉4͕TDU76ɯըЀׂK+Ń��Ă=͜WIODӸ5MڍNۜ$R􏜰𵇨\rẟ𪏜템񏉫ϳN謣ӥy\\��qUPQ󜌠˜n@Ҩ[ۃpڬɐ۱˷ԽN\r��αmޜ$\0R՗ԓʁƥqЌÈ+U@߂ŧOf*ǃˬۍCϤ`_ 膼򽋵N맔⶙ǃ׻ɠ؇᝜WÅe&_X͟؍h嘂ǂܳۥܟFWĻ¼ڇޛ'ƛЅÀљ֖P#^\r猦GR>؀PҝFgb󮯀Yi 󥇺\n⩞+ࠞ/Өܥޜ\ն頢ݤmhآ@q폍ցh֩,JΗWׇcm��ϓХЫZb0ࠥ��񝹭˨Ȧ؞eڂ;ړ됉wࠡpDW󌉜Իۈ\0ـ-2/bNͳֽ޾RaԏϨ&qt\n\"՚i��hzХퟜ�݆S7֐PP򤖤㜺Bǈ㖳m֭Y d��}3?*ô򲩏lT۽پπ侣߽̂מǉߚ3ŻTӌ޵*	񾣵AվÑsϸ-7��`أ\"NԢ��ߋ����\Ōsј8-ǁٍ6ǣqqچ he5Ɯ0Ң1򪠢ퟥ�ʜFή9}��𙽠{��ɖkPذT<ĩZ9䰒<՚\r̀;!Öɧۜr\nKԋ\nՇ\0p*ޜnb7(_ؒ@,沈\r]׋ū\0ʿp C\\Ѣ,0̆^ǚڂɕӐ@ʻX\r՘𿃜$\rȪҕ+��̏B��݉񨊻\"aͶ٤ɜڼ夜n\0ܠ\\5ӁЉ156��ޛÕد\0d萲8Y瓎:!јґ=ۀX.ӵCʊͶ!SڸȯưԂ޼۷حůhΜ\hˈE=򄹺< :uԳ2ո0ԳiƟTsB܀\$ ͒ꁇu	ɑڈЦ.􁂔0M\\/ꁤ+ƃ\nѡ=ԌГd̎ƫA¸©\r@@è3י8.eZa|.ⷝYkѣ񖧄#ǨY򕀘αֽM¯44ڕB AMįdU\"̈w4>¬8ȖӃCؿe_`хX:Ł9øف��Ѥȇy6ރFԘrɡl��ػтÃŹRzʵhBŻ͞ڜ0즞Ã-Ⱙ%DܵF\"\"ᛜʃ򟩄`ˆڮAfȠ\"tDZ\"_ᗜ$ߝʡ/Ƅaچ𕿵ˈԈ٦F,25ʪܔ졗y\0Ǝݸ\r蚬Ə#҆Eq\nΈB2ݜn유6ׅĴԗԡ/\n󃔙ʑ؝ݪλ)bRٚ0\0ŃDő˞δ8ԵȐeҜn㧓%\\򐐉kЃǗ(0Lu/ٜ̇ӆي̼\\̽4FpўG󟎂��gɯtz[vߖ\0и?b;ˋ`(֛͠֎NS)\n丽鐫@뜷ÒЪ򰏗,𱃅zٓ͆;0ȉGc𣌅VX􃑱ܰʘ%DQ+ퟺ�ǆ��ܶоQ-䣝ҚȬɡӃŷ፺5GҪÀ(hңӗH��ȚNb��ɶȸѮlx3̕`ŲwʩԒUĔ��Խl#򵏬��8ƅ\"ؙ̃O6\nق1eĠ\\hKfؖ/зPaYK萌��鐠xщʏjųв7Ɔ;ԂꂂہҪĭ̒Ǽ>慐ƲV\rĖżɧJֺ˼ړԣӐB䄒Y5\0NCŞ\n~LrRӔ[̟Rì񧀥Z\0xܞܩ<Q㯩ӥ@ʐҙfBӈfʞ{%Pᜢ\"ݍퟡ�ʅ��򒈑ԄE(iM2ÓҪĹ򓁜"㲊e̒1̫ט\n4`ʩ>ƑτQ*ǜyѮԑҞƔ嶔ݚ㤔Ҿ%kWrXKˌđʔߠlѐYy#D٬D<̆L򳕀v']ƋȻ\rFŠѡե\nϰѣѴ˩%c8WrpGîTܚDoߕL2ت꽜$̺炘t5ǘYⅉɰ#񠲞^\nꇄ:#D򙀖1\r*ȄK7၄\0Γ؄CӃĸBhʅnK蜬1\"��ᣡ󗙢ٙʊѬ_¯��0ኚ5њȿ4\0005JǨ\"2Ȍǐ%YŁǡϡ1S󏝴Ɋ%ni𚐚͠ߴqʽ6Ě־ʎɉ\\ސڑd͚ʺdҸLΈ؄݈Ԑ53g^佀^6Նċ烈HDב.ksLՔ@񉈦nΉǄҾŜrԢ@ٓNߴ\0sݔꃝ:uퟹ�b@^б\0ݩŲ?镀󶤌Neɓ۫뜰ǺʐrlCz6q=̺xӧ莶\O,%@s۰\n睜)ҌL<򃊼מǐ݁עؼΝA>I˅✢	͜^K4􋄧IXѩ@PƪEɦ/1@秜	ՎỸ0coaߧjʳ,C'ݹ#6F@	Έ0Ǉ{z3t׼cXMJ.*BЩZDQ𥂏\0ѱԔ-vƘߡ*՝,*übUˣxјޤPǲKG8אƠyԋ	\\#=読gȑḣ&Ȝ8])ރƜnô񀹼zɗ\\ӧ��ʈ!ʛա󋆖ʛ֬,Ʋ9񲊆ɩ\$T\"Ã,ʨ%.F!˚ AۭᩏԜ𹭚᧐ȑ⋜0002R>KEȧٕڟIѷ쳓9ԋܡj(ёН@̀򴯬7��'J.−TƜ0]KSڄЇׁp5ݜrÈ0!䜂ե	d@RҝӠشʹÓɻ7߈҂bx󜊨ןކviҕ`@ȵēAMůX̏G٘iړU*̂۶J��'ퟍ�V򗊶Ąށ��\$쑺h\$d_yǒܓZ]ՙ͘󜙊г8ؔ��ɐ윐*hφߔ֧e;:pe󢜤k緧쁪7NӄTx_ՔǽGi��Ԇߴ͆ɢ靜Eǈ\$i΅\"crޥ0lɿ>±̑C(˗@3Ɂղ2aԍӈI ڕ»Ƃ`ݚӈiŸGo^6E\rzGٍŰ1iډܤX˜0003βǚK��޺l&ֆɧILל\Ϝ"ҷľͪ(>䫴FG_Ⅴ& 10IƓA31=h q\0ǆʫ֘ń׊ޟJʘ̄ԳVΖڇ܆qڕڢىà(/ޓdOCПsmǼg؁x\0҄ќ"°\n@EkH\0ȭθ(̨Ыm[ɞҬࠁS4𜮓Y40ێ˫L\nʦҬ#Bӫb耥R֖е׭тR:Ɛ<\$!ۥrл܏Ƈ	%|ʨᄐ(|̈Ȝ0ưҁЏ̓ИƝãҡ=0ЭZᩜ"\"=ט՘)ަ쎟жV}F֚=[ɐށৢhu��\0tƥbW~۵Q֕iJ˶،񵗭q#kbޠޗn˫Α𘔃!놁å��Гқ+ִEϼ-ǖa]ŃɬYbԜn\nJ~䘼JɃ8Π팂p߆ځ簱 N䩁ܨƊ.񍅃SȈrc9Īʹ߭`a\0Ŷ*했@\0+ԁ٭gʚ6бŔMe\0ˋQ ɐ_Ě}!I��GLf)Ę񯋬ԓhx\0000\"h𫌃ƍԘɠˑر˚	j؜0֠կ؝\$Ҩ>u*יZ9ծZ寥��+J܉ٸtzЁɋ󞈾RɋԯЙҢDyϞڱ᱃׭fÅm¶٪BIٙHBɜsQlXЃ.ޅ��٣Ȫ[׳ZhZ愬بܸÀ'ՠmlӋrQֲ6ݕ]ВخȤ[޶񎩇d��"GJ9u򻂃oӝʚߖ֡Ųn@jnѬW|*gXԇ\nn2憬|x`DkۄuPP͡Q\rr˙`W/ٌ߉1盘-o,71bUs؎©莸7ӋʛGqخ\\Q\"CCT\"撠ֈŒ*?uɴs։԰ȝ♩Pz[ƛYFϹFD3Ŝ"Vۇ]µ۝)wzͺ#׍މiw˪ްɛܱ{ρoփ0n𶛻֢\\길ј\0q׍m椭ʦپî7Ӹ99[ň겤L֏ڲն¼BдΦ˜\Ƥʈdǫ㈑\" 򬒎\n\0שGƧφ8Fɽ\"쭦QEKޑ{}\ryǎޘrכt܀^ůƷԕNuó[A𧨻SŮҠ҂ŋ|y񏛖Ն_b򖈨̡+R񨚘񀰎ꩆ��^쥡jDĂк	��[𕜢׻eҒ8��ՅL4JнŚ0ۡƃ获 4d׬ Q^`0`܁ՍНc𼧇@βhy8٭p.ef\n󃎥hǃaXњĸmSࠟjBژQ\"Ǟ\r옇K3ƽ>ǪAX՛,,\"'<՛֖%ס+ӴÄծ\$񜰧%\0ᑳVĝ̰M\$݀j☰>ĭ޽VeŜ$@؍ċ#ǪШ3:𠂛U𚙌׵暨󈐏⛎@Ŗ#EɌG/ټXD\$ɨՃavּxS\"]k18aБρ9dJROӊsҠEJнȸUoԭ{lڂ8ňh\n}eiҢ􇸬 ͻNԪ͇𑘜\萇ى5yRݜ$!>\\ʉͧuj*?nэԞӨ޸\r%sᕨd&N֤#}۰A:̨��\茁۪Ĵ2I.靲Жûń 0h@\\Եɐ8𳂲q]в񤸜"𑠌��:cǠyǴ	СњdaȎ6>U܁ڝБzݐ@ز̛��򥨞2ϴ󙆻ǜəN᫒̟\r��°d*��Σcjϊ󁴾!(ѓퟡ�Lɥ��Ǎ	9\0W:َBD��J̬֟@sȡ޲ueȸƇ𻍽̠+ڧB̉}\"B\"��ЫlܸF[錗ڋӅa9Jcdbݙߞ,ՕC=/2ܗ򼸬/\$Ѓƣ۷8½D[׶ϐ`^;6B0U7󷟽	,ʱ㪱V[Ȯ	H9(1ﲆҒЌzÃ؉Ȝ$.A˦h㖫ߍᰄrY	��~oךr19撗م\\۟Őҩ\"đٴ,ҥ򶓌ޔw0ϙ\0Ǘږ;w쌘ԇݨʧqoگ߾߫��9􃾽Ӳۤcࠜ0拧޶fϹq֚&9א٭��Ćʒت3^4m/̈ٯ\0\0006Ǯ8÷>䈴.ӗ꿒cphҋڹ՛ۏ۟A@[ɕ7̼9\$pMh>ɌuыŎ򃅽h��Ҙt˞㗗	ʜ"ωcĂ;ŶߩƕQҠt̑ܲꀬ\nةγɳԠߙЁлц4ԗI�ɑy -İyeʨؕՂӥ3HٝPȇ˵믒s|׺\r𝗞ޓќ$0䩲ֲ1ݩl3騪oF~PKԪ.��J/Гҏt𐑍̤кڗnȜnʰjƁY˃zꩆ󒄼ԷИݒZ줚ʉIoր1ǎی\$ಱƽVWzՉnς𗡔򛏁۵qʝ@ٴIp	@ѵӖάH{UۜoX��ϓࠜ\z֗.ǚҬ-\\ڗ^y n^ƗʐBqؾŤzX㉡Î\$ȪJ72ք4.ǕЅ!ō0׳D쭆ˠ󣠇\Ќɭ٣*mIĥ5ɌܞشߪӪl̷替Sב".iөהhȈ��ڱB6ԄhئʠƬ\\ʰWeˣϦ%kjځ ǰĒ=ͤiӀ.��䲏klHUW\"گƪݧӰ!S5ǨΰL'`\0ŏ *Ǒ3XʞlJ\08\nƜrײتa񼁫֞ݻrڠ<ĦڗXBhָ!xڮ&䎌BhtƜ$��ʮ߆괉cL
