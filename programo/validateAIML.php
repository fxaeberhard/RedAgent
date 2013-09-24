<?php
  if (!file_exists('config/global_config.php'))
  {
    header('location: install/install_programo.php');
  }
  else
  {
    $thisFile = __FILE__;
    require_once ('config/global_config.php');
    if (!defined('SCRIPT_INSTALLED'))
      header('location: ' . _INSTALL_PATH_ . 'install_programo.php');
  }
  $status = 'No file to validate. Please select a file to test.';
  if (!empty ($_FILES))
  {
    $target = _UPLOAD_PATH_ . basename($_FILES['uploaded']['name']);
    if (move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
    {
      $fileName = str_replace($uploadDir, '' . $target);
      libxml_use_internal_errors(true);
      $xml = new DOMDocument();
      $xml->load($target);
      if (!$xml->validate())
      {
        $status = "File $fileName is invalid!<br />\n";
        libxml_display_errors();
      }
      else
      {
        $status = "File $fileName is valid.<br />\n";
      }
    }
  }

  function libxml_display_error($error)
  {
    $return = "<br/>\n";
    switch ($error->level)
    {
      case LIBXML_ERR_WARNING :
        $return .= "<b>Warning $error->code</b>: ";
        break;
      case LIBXML_ERR_ERROR :
        $return .= "<b>Error $error->code</b>: ";
        break;
      case LIBXML_ERR_FATAL :
        $return .= "<b>Fatal Error $error->code</b>: ";
        break;
    }
    $return .= trim($error->message);
    if ($error->file)
    {
      $return .= " in <b>$error->file</b>";
    }
    $return .= " on line <b>$error->line</b>\n";
    return $return;
  }

  function libxml_display_errors()
  {
    global $status;
    $errors = libxml_get_errors();
    foreach ($errors as $error)
    {
      $status .= libxml_display_error($error) . "<br />\n";
    }
    libxml_clear_errors();
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Program O AIML File Validation Utility</title>
</head>

<body>
<form enctype="multipart/form-data" action="validateAIML.php" method="post">
 Please choose a file: <input name="uploaded" type="file" /><br />
 <input type="submit" value="Validate" />
</form>
<br /><p><?php echo $status ?></p>
</body>

</html>