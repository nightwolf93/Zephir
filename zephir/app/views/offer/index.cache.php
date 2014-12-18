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
        'helpers' => array(            'route' => function($cx, $args){
                        $url = \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/' . $args['to'];
                        if(array_key_exists("params", $args)){
                            $url .= '/' . $args['params'];
                        }
                        return $url;
                    },
),
        'blockhelpers' => array(),
        'hbhelpers' => array(),
        'partials' => array(),
        'scopes' => array($in),
        'sp_vars' => array('root' => $in),
'funcs' => array(
    'ifvar' => function ($cx, $v) {
        return !is_null($v) && ($v !== false) && ($v !== 0) && ($v !== '') && (is_array($v) ? (count($v) > 0) : true);
    },
    'ch' => function ($cx, $ch, $vars, $op) {
        return $cx['funcs']['chret'](call_user_func_array($cx['helpers'][$ch], $vars), $op);
    },
    'chret' => function ($ret, $op) {
        if (is_array($ret)) {
            if (isset($ret[1]) && $ret[1]) {
                $op = $ret[1];
            }
            $ret = $ret[0];
        }

        switch ($op) {
            case 'enc':
                return htmlentities($ret, ENT_QUOTES, 'UTF-8');
            case 'encq':
                return preg_replace('/&#039;/', '&#x27;', htmlentities($ret, ENT_QUOTES, 'UTF-8'));
        }
        return $ret;
    },
)

    );
    
    return ''.(($cx['funcs']['ifvar']($cx, ((isset($in['error']) && is_array($in)) ? $in['error'] : null))) ? '
    <div class="message-box-red">
        <div class="content">
            '.((isset($in['error']) && is_array($in)) ? $in['error'] : null).'
        </div>
    </div>

' : '
<center>
    Vous avez sélectionnez l\'offre <b>'.((isset($in['offer']['name']) && is_array($in['offer'])) ? $in['offer']['name'] : null).'</b> 
    pour le prix de <b>'.((isset($in['offer']['price']) && is_array($in['offer'])) ? $in['offer']['price'] : null).'€ / Mois</b>
    <br /><br />
    Posséder vous déjà un compte chez nous ?
    <br /><br />
    <a class="bt-1" href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'offer/buy','params'=>((isset($in['offer']['id']) && is_array($in['offer'])) ? $in['offer']['id'] : null))), 'raw').'">Oui</a>
    <a class="bt-1" href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'account/register')), 'raw').'">Non</a>
</center>

').'';
}
?>