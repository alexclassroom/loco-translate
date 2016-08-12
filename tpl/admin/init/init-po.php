<?php
/**
 * Intitialize a new PO translations file
 */
 
$this->extend('../layout');
?> 

    <?php if( $params->has('ext') ):?> 
    <div class="notice inline notice-info">
        <p>
            You're creating translations directly from source code.
            <a href="<?php $ext->e('link')?>" class="">Create template instead</a>.
        </p>
    </div><?php
    endif?> 
            

    <div class="notice inline notice-generic">

        <h2><?php $params->e('subhead')?></h2>
        <p><?php $params->e('summary')?></p>

        <form action="" method="post" enctype="application/x-www-form-urlencoded" id="loco-poinit"><?php
    
            foreach( $hidden as $name => $value ):?> 
            <input type="hidden" name="<?php echo $name?>" value="<?php $hidden->e($name)?>" /><?php
            endforeach;?> 
            
            <table class="form-table">
                <tbody class="loco-locales">
                    <tr valign="top">
                        <th scope="row">
                            <label for="loco-select-locale">
                                <?php esc_html_e('Choose a language','loco')?>:
                            </label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="loco-use-selector">
                                    <span><input type="radio" name="use-selector" value="1" checked id="loco-use-selector" /></span>
                                    <?php esc_attr_e('WordPress language','loco')?>:
                                </label>
                                <div>
                                    <span class="lang nolang"></span>
                                    <select id="loco-select-locale" name="select-locale">
                                        <option value=""><?php esc_attr_e('No language selected','loco')?></option>
                                        <optgroup label="<?php esc_attr_e( 'Installed languages', 'loco' )?>">
                                            <option value="en_US" lang="en">English (United States)</option><?php
                                            /* @var Loco_mvc_ViewParams $option */
                                            foreach( $installed as $option ):?> 
                                            <option value="<?php $option->e('value')?>" data-icon="<?php $option->e('icon')?>"><?php $option->e('label')?></option><?php
                                            endforeach;?> 
                                        </optgroup>
                                        <optgroup label="<?php esc_attr_e( 'Available languages', 'loco' )?>"><?php
                                            /* @var Loco_mvc_ViewParams $option */
                                            foreach( $locales as $option ):?> 
                                            <option value="<?php $option->e('value')?>" data-icon="<?php $option->e('icon')?>"><?php $option->e('label')?></option><?php
                                            endforeach;?> 
                                        </optgroup>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="disabled">
                                <label>
                                    <span><input type="radio" name="use-selector" value="0" /></span>
                                    <?php esc_attr_e('Custom language','loco')?>:
                                </label>
                                <div>
                                    <span class="lang nolang"></span>
                                    <span class="loco-clearable"><input type="text" maxlength="14" name="custom-locale" value="" /></span>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
                <tbody class="loco-paths">   
                    <tr valign="top">
                        <th scope="row">
                            <label>Choose a location:</label>
                        </th>
                        <td>
                            <p class="description"> </p>
                        </td>
                    </tr><?php
                    $choiceId = 0;
                    /* @var $location Loco_mvc_ViewParams */
                    foreach( $locations as $typeId => $location ):?> 
                    <tr class="compact">
                        <td>
                            <p class="description">
                                <?php $location->e('label')?>:
                            </p>
                        </td>
                        <td><?php
                        /* @var $parent Loco_mvc_FileParams */
                        foreach( $location['paths'] as $choice ): 
                            $parent = $choice['parent']; 
                            $offset = sprintf('%u',++$choiceId);?> 
                            <p>
                                <label>
                                    <input type="radio" name="select-path" value="<?php echo $offset?>" <?php echo $choice->checked?> />
                                    <input type="hidden" name="path[<?php echo $offset?>]" value="<?php $choice->e('hidden')?>" />
                                    <code class="path"><?php $parent->e('relpath')?>/<?php echo $choice->holder?></code>
                                    <?php $choice->locked && print('<!-- no direct fs -->')?> 
                                </label>
                            </p><?php
                        endforeach?> 
                        </td>
                    </tr><?php
                    endforeach;?> 
                </tbody><?php
    
                if( $params->has('sourceLocale') ):?> 
                <tbody>
                    <tr valign="top">
                        <th scope="row">
                            Template options:
                        </th>
                        <td>
                            <p>
                                <label>
                                    <input type="radio" name="strip" value="" />
                                    Copy target translations from <?php $params->e('sourceLocale')?> 
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="radio" name="strip" value="1" checked />
                                    Just copy English source strings
                                </label>
                            </p>
                        </td>
                    </tr>
                </tbody><?php
                endif?> 
            </table>
    
            <p class="submit">
                <button type="submit" class="button button-large button-primary" disabled><?php esc_html_e('Create translations file','loco')?></button>
                <a class="button button-link has-icon icon-help" href="https://localise.biz/help/wordpress/translate-plugin/manual/msginit" target="_blank"><?php esc_html_e('Help','loco')?></a>
            </p>
    
        </form>

    </div>