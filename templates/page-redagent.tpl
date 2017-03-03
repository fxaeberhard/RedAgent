{extends file="page-default.tpl"}

{block name="stylesheets"}
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssfonts/fonts-min.css&3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssgrids/grids-min.css&3.3.0/build/cssbase/base-min.css&3.3.0pr3/build/widget/assets/skins/sam/widget.css&3.3.0pr3/build/node-menunav/assets/skins/sam/node-menunav.css&" charset="utf-8" />
	<meta id="customstyles" />
	<link rel="stylesheet" type="text/css" href="{$redCMS->path}src/redcms-base/assets/redcms-base.css" />
	<link rel="stylesheet" type="text/css" href="{$redCMS->path}src/redagent/assets/redagent.css" />
{/block}

{block name="bodyclasses"}{*redagent-noflash*}{/block}

{block name='header'}
	<div class="redagent-mask"></div>
	<div class="redcms-hd"></div>
{/block}

{block name="redcms-left"}
	<div class="redcms-content">
		{foreach $this->getSiteBlocks() as $b}
			{if $b->canRead()}
				{$b->render()}
			{/if}
			{flush()}
		{/foreach}
		<div id="swfContainer"></div>
	</div>
{/block}

{block name='bd-header'}{/block}

{block name='currentPagePath'}{/block}
			
{block name=bdclass}{if $this->id EQ $redCMS->config['homePageId']}redcms-bd-hidden{/if}{/block}

{block name="bd"}
	{$isHomePage = $this->id EQ $redCMS->config['homePageId']}
	<div class="redcms-bd-content {if $isHomePage}redcms-bd-content-loading{/if}" widget="RedAgentHistory" requires="redagent" {$this->renderBlockAttributes()} >
		
		<div class="redcms-bd-title">
		
			<div class="redcms-bd-closebutton">back</div>
		
			<div class="redcms-bd-title-content">
				{foreach $redCMS->currentHierarchy as $b name='hierarchy'}
					<div class="redcms-bd-title-item">
						{$b->getLabel()}
					</div>
					{if NOT $smarty.foreach.hierarchy.last}
						<div class="redcms-bd-title-separator"></div>
					{/if}
				{/foreach}
				<div class="redcms-clear"></div>
			</div>
			<div class="redcms-bd-title-right"></div>
			<div class="redcms-clear"></div>
		</div>
		<div class="redcms-bd-content-body">
			{if $isHomePage}<noscript>{/if}
			{********** Display block content **********}
			{$this->longtext1}
			<div class="redcms-clear"></div>
			
			{********** Render the childs in a vertical list **********}
			{foreach $this->getChildBlocks() as $b}
				{if $b->canRead()}
					{*<br />*}
					{$b->render()}
				{/if}
				{flush()}
			{/foreach}
			{if $isHomePage}</noscript>{/if}
		</div>
	</div>
{/block}
				


{block name='bd-footer'}
	<span widget="LoginAction">
		<a href="#" role="menuitem" >Login</a>
	</span>
	 | Powered by <a href="http://redcms.red-agent.com">RedCMS</a> | Copyright &copy; 2011 Francois-Xavier Aeberhard All rights reserved.
{/block}

{block name='ft-content'}{/block}