<?php
/* @var Loco_mvc_View $this */
$this->extend('debug-layout');
$this->start('form');

// Translators: This file is intentionally in English only.

/* @var Loco_mvc_ViewParams $form */
/* @var Loco_mvc_ViewParams $default */
?> 
    <form action="" method="get" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="page" value="loco-debug" />
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="debug-msgid">Source string *</label><br />
                    </th>
                    <td>
                        <textarea class="regular-text" name="msgid" rows="4" id="debug-msgid" placeholder="msgid"><?php $form->e('msgid')?></textarea>
                        <br />
                        <input type="text" class="regular-text" name="msgctxt" id="debug-msgctxt" value="<?php $form->e('msgctxt')?>" placeholder="msgctxt" />
                        <p class="description">
                            Enter the original (source) string <em>exactly</em> and unescaped. Context is optional.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="debug-plural">Plural</label>
                    </th>
                    <td>
                        <input type="text" class="regular-text" name="msgid_plural" id="debug-plural" value="<?php $form->e('msgid_plural')?>" placeholder="msgid_plural" />
                        <label for="debug-n">n=</label>
                        <input type="number" min="0" name="n" id="debug-n" value="<?php $form->e('n')?>" placeholder="<?php $default->e('n')?>" />
                        <p class="description">
                            Plural source is optional. Enter only if code uses <code>_n</code> or <code>_nx</code> etc..
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="debug-domain">Text domain</label>
                    </th>
                    <td>
                        <input type="text" class="regular-text" name="domain" id="debug-domain" value="<?php $form->e('domain')?>" placeholder="<?php $default->e('domain')?>"/>
                        <p class="description">Leaving empty will use WordPress core "default" text domain.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="debug-locale">Language</label>
                    </th>
                    <td>
                        <input type="text" class="regular-text" name="locale" id="debug-locale" value="<?php $form->e('locale')?>" placeholder="<?php $default->e('locale')?>" />
                        <p class="description">TODO this needs to unhook all existsing locale filters</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="debug-loader">Loader</label>
                    </th>
                    <td>
                        <select name="loader" id="debug-loader"><?php $value = $form['loader'];?> 
                            <option value="">
                                None
                            </option>
                            <option value="jit"<?php $value==='jit' and print(' selected')?>>
                                Auto (Just-in-time)
                            </option>
                            <option value="plugin"<?php $value==='plugin' and print(' selected')?>>
                                load_plugin_textdomain
                            </option>
                            <option value="theme"<?php $value==='theme' and print(' selected')?>>
                                load_theme_textdomain
                            </option>
                            <option value="custom"<?php $value==='custom' and print(' selected')?>>
                                load_textdomain
                            </option>
                        </select>
                        <label for="debug-loadpath">path: </label>
                        <input type="text" class="regular-text code" name="loadpath" id="debug-loadpath" value="<?php $form->e('loadpath')?>" placeholder="" />
                        <p class="description">
                            See the WordPress documentation for the expected format of the path argument.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Options
                    </th>
                    <td>
                        <label>
                            <input type="checkbox" name="unhook" value="1"<?php $form->unhook and print(' checked')?> />
                            Unhook all l10n filters before test
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="Submit" />
            <!--a class="button button-link" href="?page=loco-debug&surprise=me">Randomize</a-->
        </p>
    </form>

