<?php
/**
 * Created by PhpStorm.
 * User: stefa
 * Date: 05/09/2017
 * Time: 17:56
 */

class Message
{
    public static function setFlash($message, $type = 'error')
    {
        $_SESSION['flash'] = array(
            'message'   => $message,
            'type'      => $type
        );
    }

    public static function flash()
    {
        if (isset($_SESSION['flash']))
        {
            ?>
            <div id="alert" class="alert alert-<?= $_SESSION['flash']['type']; ?> alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">X</a>
                <?= $_SESSION['flash']['message']; ?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }

}