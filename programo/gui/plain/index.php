<?php

  /***************************************
  * http://www.program-o.com
  * PROGRAM O
  * Version: 2.3.1
  * FILE: gui/plain/index.php
  * AUTHOR: Elizabeth Perreau and Dave Morton
  * DATE: 19 JUNE 2012
  * DETAILS: simple example gui
  ***************************************/
  $display = "";
  $thisFile = __FILE__;
  if (!file_exists('../../config/global_config.php')) header('Location: ../../install/install_programo.php');
  require_once ('../../config/global_config.php');
  require_once ('../chatbot/conversation_start.php');
  switch ($_SERVER['REQUEST_METHOD'])
  {
    case 'POST':
      $form_vars = filter_input_array(INPUT_POST);
      break;
    case 'GET':
      $form_vars = filter_input_array(INPUT_GET);
      break;
    default:
      $form_vars = array();
  }

  $bot_id = (!empty($form_vars['bot_id'])) ? $form_vars['bot_id'] : 1;
  $convo_id = session_id();
  $format = (!empty($form_vars['format'])) ? $form_vars['format'] : 'html';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
  <head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Program O AIML PHP Chatbot</title>
    <meta name="Description" content="A Free Open Source AIML PHP MySQL Chatbot called Program-O. Version2" />
    <meta name="keywords" content="Open Source, AIML, PHP, MySQL, Chatbot, Program-O, Version2" />
    <style type="text/css">
      body{
        height:100%;
        margin: 0;
        padding: 0;
      }
      #responses {
        width: 90%;
        min-width: 515px;
        height: auto;
        min-height: 150px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
      }
      #input {
        width: 90%;
        min-width: 535px;
        margin-bottom: 15px;
        margin-left: auto;
        margin-right: auto;
      }
      #shameless_plug {
        position: absolute;
        right: 10px;
        bottom: 10px;
        border: 1px solid red;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-shadow: 2px 2px 2px 0 #808080;
        padding: 5px;
        border-radius: 5px;
      }
    </style>
  </head>
  <body onload="document.getElementById('say').focus()">
    <h3>Program O Example GUI Page - HTML</h3>
    <form method="get" action="index.php#end">
      <div id="input">
        <label for="say">Say:</label>
        <input type="text" name="say" id="say" size="70" />
        <input type="submit" name="submit" id="say" value="say" />
        <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
        <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
        <input type="hidden" name="format" id="format" value="<?php echo $format;?>" />
      </div>
    </form>
    <div id="responses">
<?php echo $display . '<a id="end"/>' ?>
    </div>
    <div id="shameless_plug">
      To get your very own chatbot, visit <a href="http://www.program-o.com">program-o.com</a>!
    </div>
  </body>
</html>
