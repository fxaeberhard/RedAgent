<?php

  /***************************************
  * www.program-o.com
  * PROGRAM O
  * Version: 2.3.1
  * FILE: chatbot/core/conversation/intialise_conversation.php
  * AUTHOR: Elizabeth Perreau and Dave Morton
  * DATE: MAY 4TH 2011
  * DETAILS: this file contains the functions intialise
  *          the conversation
  ***************************************/

  /**
  * function intialise_convoArray()
  * A function to intialise the conversation array
  * This is the array that is built throught the conversation
  * @link http://blog.program-o.com/?p=1242
  * @param  array $convoArr - the current state of the conversation array
  * @return array $convoArr (updated)
  **/
  function intialise_convoArray($convoArr)
  {
    (!isset($convoArr['conversation'])) ? $convoArr['conversation'] = array() : '';
    //set the initial convoArr values
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Intialising conversation", 4);
    //load blank topics
    $convoArr = load_blank_array_element('topic', "", $convoArr);
    //load blank thats
    $convoArr = load_blank_array_element('that', "", $convoArr);
    //load blank stars
    $convoArr = load_blank_array_element('star', "", $convoArr);
    //load blank stars
    $convoArr = load_blank_array_element('input', "", $convoArr);
    //load blank stack
    $convoArr = load_blank_stack($convoArr);
    //load bot properties
    $convoArr = load_default_bot_values($convoArr);
    //load the new client defaults
    $convoArr = load_new_client_defaults($convoArr);
    return $convoArr;
  }

  /**
  * function load_blank_array_element()
  * A function to intialise the conversation array values
  * @link http://blog.program-o.com/?p=1244
  * @param  string $arrayIndex - the array element we are going to intialise
  * @param  string $defaultValue - the value which will be used to set the element
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function load_blank_array_element($arrayIndex, $defaultValue, $convoArr)
  {
    global $remember_up_to;
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Loading blank $arrayIndex array", 4);
    //set in global config file
    $remember_up_to = (isset($convoArr['conversation']['remember_up_to'])) ? $convoArr['conversation']['remember_up_to'] : $remember_up_to;
    for ($i = 1; $i <= ($remember_up_to + 1); $i++)
    {
      $convoArr[$arrayIndex][$i] = $defaultValue;
    }
    return $convoArr;
  }

  /**
  * function load_blank_stack()
  * A function to intialise the conversation stack values
  * @link http://blog.program-o.com/?p=1246
  * @param  string $arrayIndex - the array element we are going to intialise
  * @param  string $defaultValue - the value which will be used to set the element
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function load_blank_stack($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Loading blank stack", 4);
    global $stack_value;
    //set in global config file
    $convoArr['stack']['top'] = $stack_value;
    $convoArr['stack']['second'] = $stack_value;
    $convoArr['stack']['third'] = $stack_value;
    $convoArr['stack']['fourth'] = $stack_value;
    $convoArr['stack']['fifth'] = $stack_value;
    $convoArr['stack']['sixth'] = $stack_value;
    $convoArr['stack']['seventh'] = $stack_value;
    $convoArr['stack']['last'] = $stack_value;
    return $convoArr;
  }

  /**
  * function load_default_bot_values()
  * A function to intialise the chatbot properties
  * @link http://blog.program-o.com/?p=1248
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function load_default_bot_values($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Loading db bot personality properties", 4);
    global $con, $dbn, $bot_id;
    //set in global config file
    $sql = "SELECT * FROM `$dbn`.`botpersonality` WHERE `bot_id` = '" . $bot_id . "'";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "load db bot personality values SQL: $sql", 3);
    $result = db_query($sql, $con);
    while ($row = mysql_fetch_assoc($result))
    {
      $convoArr['bot_properties'][$row['name']] = $row['value'];
    }
    mysql_free_result($result);
    return $convoArr;
  }

  /**
  * function write_to_session()
  * A function to save the current conversation state to session for the next turn
  * @link http://blog.program-o.com/?p=1250
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr
  **/
  function write_to_session($convoArr)
  {
    // TODO: Reduce the convo array to only the barest info necessary before saving
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Saving to session", 4);
    $_SESSION['programo'] = $convoArr;
    return $convoArr;
  }

  /**
  * function read_from_session()
  * A function to read the current conversation state from session for this turn
  * @link http://blog.program-o.com/?p=1252
  * @return $convoArr
  **/
  function read_from_session()
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Reading from session", 4);
    $convoArr = array();
    //initialise
    if (isset ($_SESSION['programo']))
    {
      $convoArr = $_SESSION['programo'];
    }
    return $convoArr;
  }

  /**
  * function add_new_conversation_vars()
  * A function add the new values from the user input into the conversation state
  * @link http://blog.program-o.com/?p=1254
  * @param  string $say - the user input
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function add_new_conversation_vars($say, $convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, "New conversation vars", 4);
    //put what the user has said on the front of the 'user_say' and 'input' subarray with a minimum clean to prevent injection
    $convoArr = push_on_front_convoArr("user_say", strip_tags($say), $convoArr);
    $convoArr['aiml']['user_raw'] = strip_tags($say);
    $convoArr = push_on_front_convoArr('input', $convoArr['aiml']['user_raw'], $convoArr);
    return $convoArr;
  }

  /**
  * function add_firstturn_conversation_vars()
  * A function add the bot values to the conversation state if this is the first turn
  * @link http://blog.program-o.com/?p=1256
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function add_firstturn_conversation_vars($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, "First turn", 4);
    if (!isset ($convoArr['bot_properties']))
    {
      $convoArr = load_default_bot_values($convoArr);
    }
    return $convoArr;
  }

  /**
  * function push_on_front_convoArr()
  * A function to push items on the front of a subarray in convoArr
  * @link http://blog.program-o.com/?p=1258
  * @param  string $arrayIndex - the subarray index to push to
  * @param  string $value - the value to push on teh subarray
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  * TODO BETTER COMMENTING
  **/
  function push_on_front_convoArr($arrayIndex, $value, $convoArr)
  {
    global $rememLimit, $remember_up_to;
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Pushing '$value' to the front of the [$arrayIndex] array", 2);
    $remember_up_to = (isset($convoArr['conversation']['remember_up_to'])) ? $convoArr['conversation']['remember_up_to'] : $remember_up_to;
    //these subarray indexes are 2d
    $two_d_arrays = array("that", "that_raw");
    $arrayIndex = trim($arrayIndex);
    //mini clean
    $value = trim($value);
    $value = preg_replace('/\s\s+/', ' ', $value);
    $value = preg_replace('/\s\./', '.', $value);
    //there is a chance the subarray has not been set yet so check and if not set here
    if (!isset ($convoArr[$arrayIndex][1]))
    {
      $convoArr[$arrayIndex] = array();
      $convoArr = load_blank_array_element($arrayIndex, "", $convoArr);
    }
    //if the subarray is itself an array check it here
    if (in_array($arrayIndex, $two_d_arrays))
    {
      $matches = preg_match_all("# ?(([^\.\?!]*)+(?:[\.\?!]|(?:<br ?/?>))*)#ui", $value, $sentences);
      $cmatch = 0;
      //do another check to make sure the array is not just full of blanks
      foreach ($sentences as $temp)
      {
        foreach ($temp as $chk)
        {
          if (trim($chk) != "")
          {
            $cmatch++;
          }
        }
      }
      //if there definately is something in the sentence array build the temp sentence array
      if (($cmatch > 0) && ($matches !== FALSE))
      {
        foreach ($sentences[1] as $index => $value)
        {
          if ($arrayIndex == "that")
          {
            $t =($value != '') ? clean_that($value, __FILE__, __FUNCTION__, __LINE__) : '';
            if ($t != "")
            {
              $tmp_sentence[] = $t;
            }
          }
          else
          {
            $tmp_sentence[] = $value;
          }
        }
        //reverse the array and store
        $sentences = array();
        $sentences = array_reverse($tmp_sentence);
      }
      else
      {
        $sentences = array();
        if ($arrayIndex == "that")
        {
          $sentences[0] = clean_that($value, __FILE__, __FUNCTION__, __LINE__);
        }
        else
        {
          $sentences[0] = $value;
        }
      }
      //make a space so that [0] is null (in accordance with the AIML array offset)
      array_unshift($sentences, NULL);
      unset ($sentences[0]);
      //push this onto the subarray and then clear [0] element (in accordance with the AIML array offset)
      array_unshift($convoArr[$arrayIndex], $sentences);
      array_unshift($convoArr[$arrayIndex], null);
      unset ($convoArr[$arrayIndex][0]);
    }
    else
    {
      array_unshift($convoArr[$arrayIndex], $value);
      array_unshift($convoArr[$arrayIndex], NULL);
    }
    if ((trim($arrayIndex) == 'star') || (trim($arrayIndex) == 'topic'))
    {
    //keep 5 times as many topics and stars as lines of conversation
      $rememLimit_tmp = $rememLimit;
    }
    else
    {
      $rememLimit_tmp = $remember_up_to;
    }
    for ($i = $rememLimit_tmp + 1; $i <= count($convoArr[$arrayIndex]); $i++)
    {
      if (isset ($convoArr[$arrayIndex][$i]))
      {
        unset ($convoArr[$arrayIndex][$i]);
      }
    }
    unset ($convoArr[$arrayIndex][0]);
    if ($arrayIndex == "topic")
    {
      push_stack($convoArr, $value);
    }
    return $convoArr;
  }

  /**
  * function load_bot_config()
  * A function to get the bot/convo configuration values out of the database
  * @param  array $convoArr - current state of the conversation
  * @return $convoArr (updated)
  **/
  function load_bot_config($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Loading config data for the current bot.', 2);
    global $con, $dbn, $format, $pattern, $conversation_lines, $remember_up_to, $debugemail, $debug_level, $debug_mode, $save_state, $error_response;
    //get the values from the db
    $sql = "SELECT * FROM `$dbn`.`bots` WHERE bot_id = '" . $convoArr['conversation']['bot_id'] . "'";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "load bot config SQL: $sql", 3);
    if (($result = mysql_query($sql, $con)) === false) throw new Exception('You have a SQL error on line ' . __LINE__ . ' of ' . __FILE__ . '. Error message is: ' . mysql_error() . ".<br />\nSQL = $sql<br />\n");
    if (mysql_num_rows($result) > 0)
    {
      runDebug(__FILE__, __FUNCTION__, __LINE__, 'Loading bot details from the database.', 4);
      $row = mysql_fetch_assoc($result);
      $convoArr['conversation']['conversation_lines'] = $row['conversation_lines'];
      $convoArr['conversation']['remember_up_to'] = $row['remember_up_to'];
      $convoArr['conversation']['debugemail'] = $row['debugemail'];
      $convoArr['conversation']['debug_level'] = $row['debugshow'];
      $convoArr['conversation']['debugmode'] = $row['debugmode'];
      $convoArr['conversation']['save_state'] = $row['save_state'];
      $convoArr['conversation']['default_aiml_pattern'] = $row['default_aiml_pattern'];
      $convoArr['conversation']['bot_parent_id'] = $row['bot_parent_id'];
      $error_response = $row['error_response'];
    }
    else
    {
      runDebug(__FILE__, __FUNCTION__, __LINE__, 'Unable to load bot details from the database. Loading default values.', 4);
      $convoArr['conversation']['conversation_lines'] = $conversation_lines;
      $convoArr['conversation']['remember_up_to'] = $remember_up_to;
      $convoArr['conversation']['debugemail'] = $debugemail;
      $convoArr['conversation']['debug_level'] = $debug_level;
      $convoArr['conversation']['debugmode'] = $debug_mode;
      $convoArr['conversation']['save_state'] = $save_state;
      $convoArr['conversation']['default_aiml_pattern'] = $pattern;
      $convoArr['conversation']['bot_parent_id'] = 0;
    }
    mysql_free_result($result);
    //if return format is not html overide the debug type
    if ($convoArr['conversation']['format'] != "html")
    {
      $convoArr['conversation']['debugmode'] = 1;
    }
    return $convoArr;
  }

  /**
  * function log_conversation(()
  * A function to log the conversation
  * @link http://blog.program-o.com/?p=1262
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function log_conversation($convoArr)
  {
    //db globals
    global $con, $dbn;
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Saving the conversation to the DB.', 2);
    //clean and set
    $usersay = mysql_real_escape_string($convoArr['aiml']['user_raw']);
    $botsay = mysql_real_escape_string($convoArr['aiml']['parsed_template']);
    $user_id = $convoArr['conversation']['user_id'];
    $convo_id = $convoArr['conversation']['convo_id'];
    $bot_id = $convoArr['conversation']['bot_id'];
    $sql = "INSERT INTO `$dbn`.`conversation_log` (
      `id` ,
      `input` ,
      `response` ,
      `user_id` ,
      `convo_id` ,
      `bot_id` ,
      `timestamp`
    )
    VALUES (
      NULL ,
      '$usersay',
      '$botsay',
      '$user_id',
      '$convo_id',
      '$bot_id',
      CURRENT_TIMESTAMP
    )";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Saving conservation SQL: $sql", 3);
    db_query($sql, $con);
    return $convoArr;
  }

  /**
  * function log_conversation_state(()
  * A function to log the conversation state
  * @link http://blog.program-o.com/?p=1264
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function log_conversation_state($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Logging the state of the conversation.', 2);
    global $con, $dbn, $user_name;
    //get undefined defaults from the db
    runDebug(__FILE__, __FUNCTION__, __LINE__, "logging state", 4);
    runDebug(__FILE__, __FUNCTION__, __LINE__, "user name = $user_name. Stored user name = " . $convoArr['conversation']['user_name'], 4);
    $serialise_convo = mysql_real_escape_string(serialize(reduceConvoArr($convoArr)));
    $user_id = $convoArr['conversation']['user_id'];
    $sql_addon = (!empty ($user_name)) ? "`user_name` = '" . mysql_real_escape_string($user_name) . "', " : '';
    $sql = "UPDATE `$dbn`.`users`
                SET
                `state` = '$serialise_convo',
                `last_update` = NOW(),
                $sql_addon
                `chatlines` = `chatlines`+1
                WHERE `id` = '$user_id' LIMIT 1";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "updating conversation state SQL: $sql", 3);
    db_query($sql, $con);
    return $convoArr;
  }

  /**
  * function get_conversation_state(()
  * A function to get the conversation state from the db
  * @link http://blog.program-o.com/?p=1266
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function get_conversation_state($convoArr)
  {
    global $con, $dbn,$unknown_user;
    runDebug(__FILE__, __FUNCTION__, __LINE__, "getting state", 4);
    $user_id = $convoArr['conversation']['user_id'];
    $sql = "SELECT * FROM `$dbn`.`users` WHERE `id` = '$user_id' LIMIT 1";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Getting conversation state SQL: $sql", 3);
    $result = db_query($sql, $con);
    if (($result) && (mysql_num_rows($result) > 0))
    {
      	$row = mysql_fetch_assoc($result);
      	$convoArr = unserialize($row['state']);
    	$user_name = (!empty ($row['user_name'])) ? $row['user_name'] : $unknown_user;
    	$convoArr['conversation']['user_name'] = $user_name;
    	$convoArr['client_properties']['name'] = $user_name;
    }
    mysql_free_result($result);
    return $convoArr;
  }

  /**
  * function check_set_bot(()
  * A function to check and set the bot id, name and default format for bot
  * @link http://blog.program-o.com/?p=1269
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function check_set_bot($convoArr)
  {
    global  $form_vars;
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Checking and/or setting the current bot.', 2);
    global $con, $dbn, $bot_id, $error_response, $format,$unknown_user;
    //check to see if bot_id has been passed if not load default
    if ((isset ($form_vars['bot_id'])) && (trim($form_vars['bot_id']) != ""))
    {
      $bot_id = trim($form_vars['bot_id']);
    }
    elseif (isset ($convoArr['conversation']['bot_id']))
    {
      $bot_id = $convoArr['conversation']['bot_id'];
    }
    else
    {
      $bot_id = $bot_id;
    }
    //get the values from the db
    $sql = "SELECT * FROM `$dbn`.`bots` WHERE bot_id = '$bot_id' and `bot_active`='1'";
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Making sure the bot exists. SQL = $sql", 3);
    $result = db_query($sql, $con);
    if (($result) && (mysql_num_rows($result) > 0))
    {
      $row = mysql_fetch_assoc($result);
      $bot_name = $row['bot_name'];
      $error_response = $row['error_response'];
      $unknown_user = $row['unknown_user'];
      $convoArr['conversation']['bot_name'] = $bot_name;
      $convoArr['conversation']['bot_id'] = $bot_id;
      $convoArr['conversation']['format'] = $row['format'];
      $convoArr['conversation']['unknown_user'] = $unknown_user;
      runDebug(__FILE__, __FUNCTION__, __LINE__, "BOT ID: $bot_id", 2);
    }
    else
    {
      $convoArr['conversation']['format'] = $format;
      $convoArr['conversation']['bot_id'] = $bot_id;
      runDebug(__FILE__, __FUNCTION__, __LINE__, "ERROR - Cannot find bot id: $bot_id", 1);
    }
    mysql_free_result($result);
    return $convoArr;
  }

  /**
  * function check_set_convo_id(()
  * A function to check and set the convo id
  * @link http://blog.program-o.com/?p=1276
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function check_set_convo_id($convoArr)
  {
    global $form_vars;
    //check to see if convo_id has been passed if not load default
    if (isset($form_vars['convo_id']))
    {
      $convo_id = $form_vars['convo_id'];
      runDebug(__FILE__, __FUNCTION__, __LINE__, "Obtaining the convo id from form vars. Valie: $convo_id", 4);
    }
    elseif (isset ($convoArr['conversation']['convo_id']))
    {
      $convo_id = $convoArr['conversation']['convo_id'];
      runDebug(__FILE__, __FUNCTION__, __LINE__, "CONVO ID already exists. Value: $convo_id", 2);
    }
    else
    {
      $convo_id = session_id();
      runDebug(__FILE__, __FUNCTION__, __LINE__, "Cannot find CONVO ID. Using default: $convo_id", 1);
    }
    $convoArr['conversation']['convo_id'] = $convo_id;
    return $convoArr;
  }

  /**
  * function check_set_user(()
  * A function to check and set the user's information
  * @link http://blog.program-o.com/?p=1278
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function check_set_user($convoArr)
  {
    global $con, $dbn, $unknown_user;
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Checking and setting the user info, as needed.', 2);
    //check to see if user_name has been set if not set as default
    $convo_id = (isset ($convoArr['conversation']['convo_id'])) ? $convoArr['conversation']['convo_id'] : session_id();
    if (!isset ($convoArr['conversation']['convo_id']))
    $convoArr['conversation']['convo_id'] = $convo_id;
    $ip = $_SERVER['REMOTE_ADDR'];
    $convoArr['client_properties']['ip_address'] = $ip;
    $sql = "select `user_name`, `id`, `chatlines` from `$dbn`.`users` where `session_id` = '$convo_id' limit 1;";
    $result = mysql_query($sql, $con) or $msg = SQL_error(mysql_errno(), __FILE__, __FUNCTION__, __LINE__);
    $numRows = mysql_num_rows($result);
    if ($numRows == 0)
    {
      $convoArr = intisaliseUser($convoArr);
      $user_id = $convoArr['conversation']['user_id'];
    }
    else
    {
      $row = mysql_fetch_assoc($result);
      $user_id = (!empty ($row['id'])) ? $row['id'] : 0;
      $user_name = (!empty ($row['user_name'])) ? $row['user_name'] : $unknown_user;
    }
    mysql_free_result($result);
    $chatlines = (!empty ($row['chatlines'])) ? $row['chatlines'] : 0;
    $user_name = (!empty ($user_name)) ? $user_name : $unknown_user;
    $convoArr['conversation']['user_name'] = $user_name;
    $convoArr['conversation']['user_id'] = $user_id;
    $convoArr['client_properties']['name'] = $user_name;
    $convoArr['conversation']['totallines'] = $chatlines;
    return $convoArr;
  }

  /**
  * function check_set_format(()
  * A function to check and set the conversation output type
  * @link http://blog.program-o.com/?p=1281
  * @param  array $convoArr - the current state of the conversation array
  * @return $convoArr (updated)
  **/
  function check_set_format($convoArr)
  {
    global $format, $form_vars;
    $formatsArr = array('html', 'xml', 'json');
    if ((isset ($form_vars['format'])) && (trim($form_vars['format']) != ""))
    {
      $desired_format = strtolower(trim($form_vars['format']));
    }
    else
    {
      $desired_format = $format;
    }
    if (!in_array($format, $formatsArr))
    {
      $convoArr['conversation']['format'] = $format; // default format
      $convoArr['debug']['intialisation_error'] = "Incompatible return type: $format";
      runDebug(__FILE__, __FUNCTION__, __LINE__, "ERROR - bad return type: $format", 1);
    }
    else
    {
      //at this point we can overwrite the conversation format.
      $convoArr['conversation']['format'] = $desired_format;
      runDebug(__FILE__, __FUNCTION__, __LINE__, "Using format: $format", 4);
    }
    return $convoArr;
  }


  /**
   * function load_that(()
   * A function to load the previous bot responses into the convoArr['that'] array
   * @link http://blog.program-o.com/?p=1283
   * @param  array $convoArr - the current state of the conversation array
   * @return $convoArr (updated)
   **/
  function load_that($convoArr)
  {
    runDebug(__FILE__, __FUNCTION__, __LINE__, 'Loading the THAT array.', 2);
    global $con, $dbn, $remember_up_to;
    $remember_up_to = (!empty ($convoArr['conversation']['remember_up_to'])) ? $convoArr['conversation']['remember_up_to'] : $remember_up_to;
    $user_id = $convoArr['conversation']['user_id'];
    $bot_id = $convoArr['conversation']['bot_id'];
    $limit = $remember_up_to;
    $sql = "select `input`, `response` from `$dbn`.`conversation_log` where `user_id` = $user_id and `bot_id` = $bot_id order by `id` desc limit $limit;"; // desc
    runDebug(__FILE__, __FUNCTION__, __LINE__, "Getting conversation log entries for the current user. SQL:\n$sql", 3);
    $result = db_query($sql, $con);
    if ($result)
    {
      $tmpThatRows = array();
      $tmpInputRows = array();
      $tmpThat = array();
      $tmpInput = array();
      $puncuation = array(',', '?', ';', '!');
      while ($row = mysql_fetch_assoc($result))
      {
        $tmpThatRows[] = $row['response'];
        $tmpInputRows[] = $row['input'];
      }
      runDebug(__FILE__, __FUNCTION__, __LINE__, 'Inputs returned:' . print_r($tmpInputRows, true), 1);
      runDebug(__FILE__, __FUNCTION__, __LINE__, 'Loading previous responses into the ~THAT~ array.', 4);
      array_reverse($tmpThatRows);
      foreach ($tmpThatRows as $row)
      {
        $row = str_replace($puncuation, '.', $row);
        $tmpThat[] = explode('.', $row);
      }
      array_unshift($tmpThat, NULL);
      unset ($tmpThat[0]);
      foreach ($tmpThat as $index => $value)
      {
        $value = implode_recursive(' ', $value, __FILE__, __FUNCTION__, __LINE__);
        $value = clean_that($value, __FILE__, __FUNCTION__, __LINE__);
        $convoArr = push_on_front_convoArr('that', $value, $convoArr);
      }
      runDebug(__FILE__, __FUNCTION__, __LINE__, 'Loading previous user inputs into the ~INPUT~ array.', 4);
      array_reverse($tmpInputRows);
      foreach ($tmpInputRows as $row)
      {
        $row = str_replace($puncuation, '.', $row);
        $tmpInput[] = explode('.', $row);
      }
      array_unshift($tmpThat, NULL);
      unset ($tmpThat[0]);
      foreach ($tmpInput as $index => $value)
      {
        $value = implode_recursive(' ', $value, __FILE__, __FUNCTION__, __LINE__);
        $value = clean_that($value, __FILE__, __FUNCTION__, __LINE__);
        $convoArr = push_on_front_convoArr('input', $value, $convoArr);
      }
    }
    else runDebug(__FILE__, __FUNCTION__, __LINE__, 'Couldn\'t find any previous inputs or responses.', 4);
    mysql_free_result($result);
    return $convoArr;
  }
?>