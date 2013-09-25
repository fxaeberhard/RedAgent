{extends file="menu-default.tpl"}

{block name=firstLevelClass} yui3-menu-horizontal redcms-hidden{/block}

{block name=footer}{/block}

{block name="categoryClass"}yui3-menu yui3-menu-hidden{/block}
{block name=aTag}
	<a class="{$aClass}" href="{ParamManager::getHashFromParams($block->getParams())|default:'#'}">{$block->getLabel()|default:'No label provided'}</a>
{/block}