<?php

namespace entity;


class Session
{

    public function setFlash($message, $type = 'error')
    {
        $_SESSION['flash'] = array (
                'message' => $message,
                'type' => $type);
    }

    public function flash()
    {
        if(isset($_SESSION['flash']))
        { ?>
        <div id='alert' class="alerte alert-<?php echo $_SESSION['flash']['type']?>">
            <a class="close">x</a>
        <?php echo $_SESSION['flash']['message']; ?> </div>
        <?php unset ($_SESSION['flash']);
        }
    }
}