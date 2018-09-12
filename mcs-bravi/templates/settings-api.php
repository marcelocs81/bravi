<?php
/**
 * Created by Marcelo
 */

$post = $context->post;
$msg  = $context->msg;

/** @var \Mcs\Bravi\ValueObject\SettingApi $settings */
$settings = $context->settings;

?>


<div class="wrap">
    <h1>OMDB API</h1>

    <?php if (isset($post['wphw_submit'])): ?>
        <div id="message" class="updated below-h2">
            <p><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>

    <p>Enter the values below to update the OMDB API.</p>

    <div class="card">
        <form id="setting-movie" method="post">
            <input type="hidden" name="api_id" value="<?php echo $settings->getId(); ?>"/>
            <table class="form-table">
                <tr>
                    <th scope="row">API URL</th>
                    <td><input type="text" class="regular-text" name="api_url"
                               value="<?php echo $settings->getUrl(); ?>" maxlength="255"/></td>
                </tr>
                <tr>
                    <th scope="row">API KEY</th>
                    <td><input type="text" class="regular-text" name="api_key"
                               value="<?php echo $settings->getKey(); ?>" maxlength="50"/></td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>
                        <input type="submit" name="wphw_submit" value="Save changes" class="button-primary"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
