<?PHP
//-----------------------------------------------------------------------------------------------
//My Program-O Version: 2.3.1
//Program-O  chatbot admin area
//Written by Elizabeth Perreau and Dave Morton
//Aug 2011
//for more information and support please visit www.program-o.com
//-----------------------------------------------------------------------------------------------
// select_bots.php

$selectBot ='';
$post_vars = filter_input_array(INPUT_POST);

if((isset($post_vars['action']))&&($post_vars['action']=="update")) {
  $selectBot .= getChangeList();
  $msg = updateBotSelection();
  $selectBot .= getSelectedBot();
}
elseif((isset($post_vars['action']))&&($post_vars['action']=="change")) {
  changeBot();
  $selectBot .= getChangeList();
  $selectBot .= getSelectedBot();
}
elseif((isset($post_vars['action']))&&($post_vars['action']=="add")) {
  $selectBot .= addBot();
  $selectBot .= getChangeList();
  $selectBot .= getSelectedBot();
}
else {
  $selectBot .= getChangeList();
  $selectBot .= getSelectedBot();
}
    $topNav        = $template->getSection('TopNav');
    $leftNav       = $template->getSection('LeftNav');
    $main          = $template->getSection('Main');
    $topNavLinks   = makeLinks('top', $topLinks, 12);
    $navHeader     = $template->getSection('NavHeader');
    $leftNavLinks  = makeLinks('left', $leftLinks, 12);
    $FooterInfo    = getFooter();
    $errMsgClass   = (!empty($msg)) ? "ShowError" : "HideError";
    $errMsgStyle   = $template->getSection($errMsgClass);
    $noLeftNav     = '';
    $noTopNav      = '';
    $noRightNav    = $template->getSection('NoRightNav');
    $headerTitle   = 'Actions:';
    $pageTitle     = 'My-Program O - Select or Edit a Bot';
    $mainContent   = $selectBot;
    $mainTitle     = 'Choose/Edit a Bot';

function getBotParentList($current_parent,$dbConn) {
    //db globals
  $dbConn = db_open();
  //get active bots from the db
  if(empty($current_parent)) $current_parent = 0;
  $sql = "SELECT * FROM `bots` where bot_active = '1'";
  if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');;

  $options = '                  <option value="0"[noBot]>No Parent Bot</option>';

  while($row = mysql_fetch_assoc($result)) {
    if ($row['bot_id'] == 0) $options = str_replace('[noBot]', 'selected="selected"', $options);
    if($current_parent==$row['bot_id']) {
      $sel = "selected=\"selected\"";
    }
    else {
      $sel = '';
    }
    $options .= '                  <option value="'.$row['bot_id'].'" '.$sel.'>'.$row['bot_name'].'</option>';
  }
  $options = str_replace('[noBot]', 'selected="selected"', $options);

  return $options;
}


function getSelectedBot() {
  global $template, $pattern, $remember_up_to, $conversation_lines, $error_response;
  $bot_conversation_lines = $conversation_lines;
  $remember_up_to = $remember_up_to;
  $bot_default_aiml_pattern = $pattern;
  $bot_error_response = $error_response;
  $unknown_user = 'test';
  $dbConn = db_open();
  $inputs='';
  $form = $template->getSection('SelectBotForm');
  $sel_session = '';
  $sel_db = '';
  $sel_html = '';
  $sel_xml = '';
  $sel_json = '';
  $sel_yes = '';
  $sel_no = '';
  $sel_fyes = '';
  $sel_fno = '';
  $sel_fuyes = '';
  $sel_funo = '';
  $ds_ = '';
  $ds_i = '';
  $ds_ii = '';
  $ds_iii = '';
  $ds_iv = '';
  $dm_ = '';
  $dm_i = '';
  $dm_ii = '';
  $dm_iii = '';
  $dm_iv = '';
  $bot_id = (isset($_SESSION['poadmin']['bot_id'])) ? $_SESSION['poadmin']['bot_id'] : 'new';
  if($bot_id != "new")
  {
    #$bot_id = $_SESSION['poadmin']['bot_id'];
    //get data for all of the bots from the db
    $sql = "SELECT * FROM `bots` where bot_id = '$bot_id';";
    if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');
    while($row = mysql_fetch_assoc($result)) {
      //save_file(_LOG_PATH_ . 'bot_row.txt', print_r($row, true));
      foreach ($row as $key => $value) {
        if (strstr($key,'bot_') != false){
          $tmp = '';
          $$key = $value;
        }
        else {
          $tmp = "bot_$key";
          $$tmp = $value;
        }
      }
      if($bot_active=="1") {
        $sel_yes = ' selected="selected"';
      }
      else {
        $sel_no = ' selected="selected"';
      }
      if($bot_save_state=="database") {
        $sel_db = ' selected="selected"';
      }
      else {
        $sel_session = ' selected="selected"';
      }
      if($bot_format=="html") {
        $sel_html = ' selected="selected"';
      }
      elseif($bot_format=="xml") {
        $sel_xml = ' selected="selected"';
      }
      elseif($bot_format=="json") {
        $sel_json = ' selected="selected"';
      }
      if($bot_debugshow=="0") {
        $ds_ = ' selected="selected"';
      }
      elseif($bot_debugshow=="1") {
        $ds_i = ' selected="selected"';
      }
      elseif($bot_debugshow=="2") {
        $ds_ii = ' selected="selected"';
      }
      elseif($bot_debugshow=="3") {
        $ds_iii = ' selected="selected"';
      }
      elseif($bot_debugshow=="4") {
        $ds_iv = ' selected="selected"';
      }
      if($bot_debugmode=="0") {
        $dm_ = ' selected="selected"';
      }
      elseif($bot_debugmode=="1") {
        $dm_i = ' selected="selected"';
      }
      elseif($bot_debugmode=="2") {
        $dm_ii = ' selected="selected"';
      }
      elseif($bot_debugmode=="3") {
        $dm_iii = ' selected="selected"';
      }
      elseif($bot_debugmode=="4") {
        $dm_iv = ' selected="selected"';
      }
      $action = "update";
    }
    mysql_close($dbConn);
  }
  else {
    $bot_id = '';
    $bot_parent_id = 0;
    $bot_name = '';
    $bot_desc = '';
    $bot_active = '';
    $action = "add";
    $bot_format = '';
    $bot_conversation_lines = $conversation_lines;
    $remember_up_to = $remember_up_to;
    $bot_default_aiml_pattern = $pattern;
    $bot_error_response = $error_response;
    $bot_debugemail = '';
    $debugemail = '';
    $bot_debugshow = '';
    $bot_debugmode = '';
  }
  $unknown_user = $bot_unknown_user;
  $parent_options = getBotParentList($bot_parent_id,$dbConn);
  $searches = array(
    '[bot_id]','[bot_name]','[bot_desc]','[parent_options]','[sel_yes]','[sel_no]',
    '[sel_html]','[sel_xml]','[sel_json]','[sel_session]','[sel_db]','[sel_fyes]',
    '[sel_fno]','[sel_fuyes]','[sel_funo]','[bot_conversation_lines]','[remember_up_to]',
    '[bot_debugemail]','[dm_]','[dm_i]','[dm_ii]','[dm_iii]','[ds_]','[ds_i]','[ds_ii]',
    '[ds_iii]','[ds_iv]','[action]', '[bot_default_aiml_pattern]', '[bot_error_response]', '[unknown_user]',
  );
  foreach ($searches as $search) {
    $replace = str_replace('[', '', $search);
    $replace = str_replace(']', '', $replace);
    $form = str_replace($search, $$replace, $form);
  }
  return $form;
}

function updateBotSelection() {
  //db globals
  global $msg, $format, $post_vars;
  $logFile = _LOG_URL_ . 'admin.error.log';
  $dbConn = db_open();
  $sql = '';
  $msg = '';
  foreach($post_vars as $key => $value) {
    if(($key!="bot_id")||($key!="action")) {
      $value = mysql_real_escape_string(trim(stripslashes($value)));
      if(($key != "bot_id")&&($key != "action")&&($value!='')) {
        $sql = "UPDATE `bots` SET `$key` ='$value' where `bot_id` = '".$post_vars['bot_id']."' limit 1; ";
        if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');
        if(!$result) {
          $msg = "Error updating bot details. See the <a href=\"$logFile\">error log</a> for details.<br />";
          trigger_error("There was a problem adding '$key' to the database. The value was '$value'.");
          break;
        }
      }
    }
  }

  $format = filter_input(INPUT_POST,'format');

  if (strtoupper($format) !== strtoupper($format))
  {
    $format = strtoupper($format);
    $cfn = _CONF_PATH_ . 'global_config.php';
    $configFile = file(_CONF_PATH_ . 'global_config.php',FILE_IGNORE_NEW_LINES);
    $search = '    $format = \'' . $format . '\';';
    $replace = '    $format = \'' . $format . '\';';
    $index = array_search($search, $configFile);
    if (false === $index)
    {
      $msg .= "Error updating the config file. See the <a href=\"$logFile\">error log</a> for details.<br />";
      trigger_error("There was a problem with updating the default format in the config file. Please edit the value manually and submit a bug report.");
    }
    else
    {
      $configFile[$index] = $replace;
      $configContent = implode("\n", $configFile);
      $x = file_put_contents(_CONF_PATH_ . 'global_config.php', $configContent);
    }
  }
  if($msg == '') {
    $msg = 'Bot details updated.';
  }

  mysql_close($dbConn);
  return $msg;

}


function addBot() {
  //db globals
  global $msg, $post_vars;
  $dbConn = db_open();
  foreach ($post_vars as $key => $value) {
    $$key = mysql_real_escape_string(trim($value),$dbConn);
  }
  $dbConn = db_open();
  $sql = <<<endSQL
INSERT INTO `bots`(`bot_id`, `bot_name`, `bot_desc`, `bot_active`, `bot_parent_id`, `format`, `save_state`, `conversation_lines`, `remember_up_to`, `debugemail`, `debugshow`, `debugmode`, `default_aiml_pattern`, `error_response`)
VALUES (NULL,'$bot_name','$bot_desc','$bot_active','$bot_parent_id','$format','$save_state','$conversation_lines','$remember_up_to','$debugemail','$debugshow','$debugmode','$aiml_pattern','$error_response');
endSQL;
  if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');

  if($result) {
    $msg = "$bot_name Bot details added, please dont forget to create the bot personality and add the aiml.";

  }
  else {
    $msg = "$bot_name Bot details could not be added.";
  }

  $_SESSION['poadmin']['bot_id'] = mysql_insert_id();
  $bot_id = $_SESSION['poadmin']['bot_id'];
  $_SESSION['poadmin']['bot_name'] = $post_vars['bot_name'];
  $bot_name = mysql_real_escape_string($_SESSION['poadmin']['bot_name']);

  $sql = <<<endSQL
INSERT INTO `botpersonality` VALUES
  (NULL,  $bot_id, 'age', ''),
  (NULL,  $bot_id, 'baseballteam', ''),
  (NULL,  $bot_id, 'birthday', ''),
  (NULL,  $bot_id, 'birthplace', ''),
  (NULL,  $bot_id, 'botmaster', ''),
  (NULL,  $bot_id, 'boyfriend', ''),
  (NULL,  $bot_id, 'build', ''),
  (NULL,  $bot_id, 'celebrities', ''),
  (NULL,  $bot_id, 'celebrity', ''),
  (NULL,  $bot_id, 'class', ''),
  (NULL,  $bot_id, 'email', ''),
  (NULL,  $bot_id, 'emotions', ''),
  (NULL,  $bot_id, 'ethics', ''),
  (NULL,  $bot_id, 'etype', ''),
  (NULL,  $bot_id, 'family', ''),
  (NULL,  $bot_id, 'favoriteactor', ''),
  (NULL,  $bot_id, 'favoriteactress', ''),
  (NULL,  $bot_id, 'favoriteartist', ''),
  (NULL,  $bot_id, 'favoriteauthor', ''),
  (NULL,  $bot_id, 'favoriteband', ''),
  (NULL,  $bot_id, 'favoritebook', ''),
  (NULL,  $bot_id, 'favoritecolor', ''),
  (NULL,  $bot_id, 'favoritefood', ''),
  (NULL,  $bot_id, 'favoritemovie', ''),
  (NULL,  $bot_id, 'favoritesong', ''),
  (NULL,  $bot_id, 'favoritesport', ''),
  (NULL,  $bot_id, 'feelings', ''),
  (NULL,  $bot_id, 'footballteam', ''),
  (NULL,  $bot_id, 'forfun', ''),
  (NULL,  $bot_id, 'friend', ''),
  (NULL,  $bot_id, 'friends', ''),
  (NULL,  $bot_id, 'gender', ''),
  (NULL,  $bot_id, 'genus', ''),
  (NULL,  $bot_id, 'girlfriend', ''),
  (NULL,  $bot_id, 'hockeyteam', ''),
  (NULL,  $bot_id, 'kindmusic', ''),
  (NULL,  $bot_id, 'kingdom', ''),
  (NULL,  $bot_id, 'language', ''),
  (NULL,  $bot_id, 'location', ''),
  (NULL,  $bot_id, 'looklike', ''),
  (NULL,  $bot_id, 'master', ''),
  (NULL,  $bot_id, 'msagent', ''),
  (NULL,  $bot_id, 'name', '$bot_name'),
  (NULL,  $bot_id, 'nationality', ''),
  (NULL,  $bot_id, 'order', ''),
  (NULL,  $bot_id, 'orientation', ''),
  (NULL,  $bot_id, 'party', ''),
  (NULL,  $bot_id, 'phylum', ''),
  (NULL,  $bot_id, 'president', ''),
  (NULL,  $bot_id, 'question', ''),
  (NULL,  $bot_id, 'religion', ''),
  (NULL,  $bot_id, 'sign', ''),
  (NULL,  $bot_id, 'size', ''),
  (NULL,  $bot_id, 'species', ''),
  (NULL,  $bot_id, 'talkabout', ''),
  (NULL,  $bot_id, 'version', ''),
  (NULL,  $bot_id, 'vocabulary', ''),
  (NULL,  $bot_id, 'wear', ''),
  (NULL,  $bot_id, 'website', '');
endSQL;

  if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');

  if($result)
  {
    $msg .= 'Please create the bots personality.';

  }
  else {
    $msg .= 'Unable to create the bots personality.';
  }
  mysql_close($dbConn);
  return $msg;
}

function changeBot() {
  global $msg, $bot_id, $post_vars;
  $botId = (isset($post_vars['bot_id'])) ? $post_vars['bot_id'] : $bot_id;
  $dbConn = db_open();
  if($post_vars['bot_id']!="new") {
    $sql = "SELECT * FROM `bots` WHERE bot_id = '$botId'";
    if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');
    $count = mysql_num_rows($result);
    if($count>0) {
      $row=mysql_fetch_assoc($result);
      $_SESSION['poadmin']['bot_id']=$row['bot_id'];
      $_SESSION['poadmin']['bot_name']=$row['bot_name'];
    }
    else {
      $_SESSION['poadmin']['bot_id']="new";
      $_SESSION['poadmin']['bot_name']='';
    }
  }
  else {
      $_SESSION['poadmin']['bot_name']='';
      $_SESSION['poadmin']['bot_id']="new";
    }
  mysql_close($dbConn);
}


function getChangeList() {
  //db globals
  global $template;
  $bot_id = (isset($_SESSION['poadmin']['bot_id'])) ? $_SESSION['poadmin']['bot_id'] : 0;
  $dbConn = db_open();
  $inputs='';
  //get bot names from the db
  $sql = "SELECT * FROM `bots` ORDER BY bot_name";
  if (($result = mysql_query($sql, $dbConn)) === false) throw new Exception('You have a SQL error on line '. __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . '.');
  $options = '<option value="new" selected="selected">Add New Bot</option>' . "\n";
  while($row = mysql_fetch_assoc($result)) {
    if($bot_id == $row['bot_id']) {
      $sel = ' selected="selected"';
    }
    else {
      $sel= '';
    }
    $bot_id = $row['bot_id'];
    $bot_name = $row['bot_name'];
    $options .= "                <option value=\"$bot_id\"$sel>$bot_name</option>\n";
  }
  $options = rtrim($options);
  mysql_close($dbConn);
  $form = $template->getSection('ChangeBot');
  $form = str_replace('[options]', $options, $form);
  return $form;
}

?>
