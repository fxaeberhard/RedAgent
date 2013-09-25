{*
 * Copyright (c) 2011, Francois-Xavier Aeberhard All rights reserved.
 * Code licensed under the BSD License:
 * http://redcms.red-agent.com/license.html
 *}
{extends file="conversation-default.tpl"}


{block name="conversation-title"}
	{*<img width="30" height="30"  src="http://www.gravatar.com/avatar/{md5(strtolower($user->email))}?s=30&d=mm" style="float: left;margin: 3px 2px 0 0;border:1px solid gray"/>*}
	
	<h2>{*par <a href="{ParamManager::getLink('User Profile', $user->id)}">{$user->getLabel()}</a>, *}
	{Utils::date("F Y", $block->dateadded)} 
	</h2>
	{*<h1><a name="{$block->title|escape:url}">{$block->title}</a></h1>*}
{/block}