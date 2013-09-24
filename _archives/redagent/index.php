<?php
require('redcms-include.php');

$redConfig = array(
	'path' => '/',
//	'smtpMode' => true,
//	'smtpHost' => '',
//	'smtpPort' => 25,
//	'smtpAuth' => true,
//	'smtpUsername' => '',
//	'smtpPassword' => '',
	'defaultPageTemplate' => 'page-redagent.tpl',
	'defaultLang' => 'en',
	'adminMail' => 'fx@red-agent.com',
	'windowTitleSuffix' => ' - red-agent.com',
	'keywordSuffix' => 'françois-xavier, aeberhard, gamedesign, webdesign, user experience',
	'mailFooter' => '',
	'googleAnalyticsId' => 'UA-12224039-1'
);

$redCMS = RedCMS::getInstance();

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$redConfig['path'] = '/RedCMS2/';
	$redCMS->init($redConfig, 'mysql:host=localhost;dbname=redcms_redagent;', 'root', '');
} else {
	$redCMS->init($redConfig, 'mysql:host=mysql.red-agent.com;dbname=redagentcom3;', 'redadmin', '78hzu45e');
}


if ($redCMS->currentBlock){
	$cMenuItem = $redCMS->currentBlock->getLinkerBlocks('target');
	if (!empty($cMenuItem)) {
		$cMenuItem = $cMenuItem[0];
		$cMenuItem = $cMenuItem->parentBlock();
		while ($cMenuItem && $cMenuItem instanceof Action) {
			array_unshift($redCMS->currentHierarchy, $cMenuItem);
			$cMenuItem = $cMenuItem->parentBlock();
		}
	}
}
if ($redCMS->paramManager->hasMore()){
	$nBlock = BlockManager::getBlocksBySelect('text1=?', array($redCMS->paramManager->current()));
	if (!empty($nBlock)) $redCMS->currentHierarchy[] = $nBlock[0];
}

$redCMS->render();
?>