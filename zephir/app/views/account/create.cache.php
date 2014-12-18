<?php return function ($in, $debugopt = 1) {
    $cx = array(
        'flags' => array(
            'jstrue' => false,
            'jsobj' => false,
            'spvar' => true,
            'prop' => false,
            'method' => false,
            'mustlok' => false,
            'mustsec' => false,
            'echo' => false,
            'debug' => $debugopt,
        ),
        'helpers' => array(),
        'blockhelpers' => array(),
        'hbhelpers' => array(),
        'partials' => array(),
        'scopes' => array($in),
        'sp_vars' => array('root' => $in),
'funcs' => array(
)

    );
    
    return '<div class="message-box-green">
    <div class="content">
        Un email a été envoyé a l\'adresse <b>'.((isset($in['email']) && is_array($in)) ? $in['email'] : null).'</b>, veulliez le lire pour valider votre compte
    </div>
</div>';
}
?>