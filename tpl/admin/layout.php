<?php
/**
 * Base layout for all admin pages 
 */
?><div class="wrap" id="loco-admin"><?php 

    if( $this->has('breadcrumb') ):?> 
    <h1>
        <ul><?php
            /* @var Loco_mvc_ViewParams[] $breadcrumb */
            foreach( $breadcrumb as $item ):?> 
            <li><?php
                if( $item->href ):?> 
                <a href="<?php $item->e('href')?>">
                    <?php $item->e('name')?> 
                </a><?php
                else:?> 
                <span>
                    <?php $item->e('name')?> 
                </span><?php
                endif?> 
            </li><?php
            endforeach?> 
        </ul>
    </h1><?php
    elseif( $this->has('title') ):?> 
    <h1>
        <?php $params->e('title')?> 
    </h1><?php
    endif;

    
    if( $this->has('tabs') ):?> 
    <h2 class="nav-tab-wrapper"><?php
        /* @var Loco_mvc_ViewParams[] $tabs */
        foreach( $tabs as $item ):?> 
        <a href="<?php $item->e('href')?>" class="nav-tab<?php echo $item->active?' nav-tab-active':''?>">
            <?php $item->e('name')?> 
        </a><?php
        endforeach;?> 
    </h2><?php
    endif?> 


    <div id="loco-notices">
        <noscript>
            <div class="notice inline notice-danger">
                <p>
                    <strong class="has-icon icon-warn">JavaScript disabled:</strong>
                    <span>Loco Translate requires JavaScript for most functions to work as expected.</span>
                </p>
            </div>
        </noscript><?php 
        // flush message buffer
        do_action('loco_admin_notices');
        // standard file system dialogues
        if( $params->has('fsFields') ):
            echo $this->render('common/inc-fsconn');
        endif?> 
        <div class="notice inline notice-danger jshide">
            <p>
                <strong class="has-icon icon-warn">JavaScript problem:</strong>
                <span>.</span>
            </p>
        </div>
    </div>


    <div id="loco-content">
    <?php echo $this->_content;?> 
    </div>

</div>


<?php 
if( $this->has('js') && $js instanceof Loco_mvc_ViewParams ):?><script>
/*<![CDATA[*/
window.loco = { conf: <?php echo $js->exportJson()?> };
document.addEventListener && document.addEventListener('DOMContentLoaded', function(loco){
    return function() {
        if( window.loco !== loco || ! loco.validate || ! loco.validate(<?php $js->j('$v')?>,<?php $js->j('$js')?>) ) {
            document.getElementById('loco-content').innerHTML = '<div class="notice inline notice-danger"><p>Scripts on this page are not running as expected. Please empty all relevant caches and refresh the screen.<br />If the issue persists, try disabling other plugins that may be modifying the functionality of Loco Translate.</p></div>';
        }
    };
}(loco) );
/*]]>*/
</script><?php
endif;
