<div id="oaNavigation">
    <ul id="oaNavigationTabs">
    	<li class="<?php echo ($page=='home')?'active':'passive';?> first">
         <div class="left"><div class="right">
          <a href="index.php" accesskey="Startseite">Dashboard</a>
        </div></div>
      </li>
      <li class="<?php echo ($page=='campaign')?'active':'passive';?><?php echo ($page=='home')?' after-active':'';?>">
        <div class="left"><div class="right">
          <a href="campaign.php" accesskey="Startseite">Kampagnen</a>
        </div></div>
      </li>
      <li class="<?php echo ($page=='status')?'active':'passive';?><?php echo ($page=='campaign')?' after-active':'';?>">
        <div class="left"><div class="right">
          <a href="status.php" accesskey="Startseite">Kampagnenstatus</a>
        </div></div>
      </li>
      <li class="<?php echo ($page=='report')?'active':'passive';?><?php echo ($page=='status')?' after-active':'';?>">
        <div class="left"><div class="right">
          <a href="stats.php" accesskey="Startseite">Reportings</a>
        </div></div>
      </li>
      <li class="<?php echo ($page=='website')?'active':'passive';?><?php echo ($page=='report')?' after-active':'';?>">
        <div class="left"><div class="right">
          <a href="website.php" accesskey="Startseite">Webseiten</a>
        </div></div>
      </li>
       <li class="<?php echo ($page=='customer')?'active':'passive';?><?php echo ($page=='website')?' after-active':'';?> last">
        <div class="left"><div class="right">
          <a href="customer.php" accesskey="Startseite">Kunden</a>
        </div></div>
      </li>
    </ul>
    <!--
    <ul id="oaNavigationExtra">
        <li class="accountSwitcher">
            <div class="triggerContainer"><div class="switchTrigger">General Manager</div> <a href="#" accesskey="w"><u>W</u>orking as</a> </div>
            <div class="accountsPanel">
              <div class="switchTop">&nbsp;</div>
              <div class="switchMiddle">
                <div class="switchMiddleBody">
	                <div class="label">
                      Wechseln zu
                                          </div>
                    <div id="accountLoading"></div>
	                <div class="result">
                      
<div>
<ul id="accounts">
  <li style="display: none"></li>
    
      <li class="opt">Manager für</li>
          <li class="inopt">
        <a href="http://ads20.wwe-media.de/www/admin/account-switch.php?account_id=2">General Manager</a>
      </li>                
  </ul>
</div>	                </div>
                </div>
              </div>
              <div class="switchDown">&nbsp;</div>
            </div>
        </li>
    </ul>
    <script type="text/javascript">
    
      <!--
      $(document).ready(function() {
    
        initAccoutSwitcher("http://ads20.wwe-media.de/www/admin/account-switch-search.php");
    
      });

      
    </script>        
    <div class="accountSwitcherOverlay">&nbsp;</div>
    -->
</div>
</--><!-- oaNavigation  -->