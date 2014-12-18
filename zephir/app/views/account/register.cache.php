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
        'helpers' => array(            'captcha' => function($cx, $args){
                        return '<img id="' . $args['id'] . '" src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/security/captcha" />';
                    },
            'route' => function($cx, $args){
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

' : '').'
<h3>Création d\'un compte :</h3>
<form action="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'account/create')), 'raw').'" method="POST">
    <table>
        <tr>
            <td>
                Adresse e-mail : 
            </td>
            <td>
                <input name="email" type="email" />
            </td>
            <tr>
                <td>
                    Mot de passe : 
                </td>
                <td>
                    <input name="password" type="password" />
                </td>
            </tr>
            <tr>
                <td>
                    Conf. mot de passe : 
                </td>
                <td>
                    <input name="password_confirm" type="password" />
                </td>
            </tr>
            <tr><td><br /></td></tr>
            <tr>
                <td>
                    Question secrète : 
                </td>
                <td>
                    <input name="secret_question" type="text" />
                </td>
            </tr>
            <tr>
                <td>
                    Réponse secrète : 
                </td>
                <td>
                    <input name="secret_answer" type="text" />
                </td>
            </tr>
            <tr><td><br /></td></tr>
            <tr>
                <td>
                    Sécurité Anti-bot : 
                </td>
                <td>
                    <center>'.$cx['funcs']['ch']($cx, 'captcha', array(array(),array('id'=>'captcha')), 'raw').' <input type="button" class="bt-1 reload-captcha" value="Recharger" style="vertical-align: top;" /></center>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input name="captcha_answer" type="text" placeholder="Entrer le mot" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input class="bt-1" style="width: 55%;" type="submit" value="Confirmer" />
                </td>
            </tr>
        </tr>
    </table>
</form>

<script>

    $(body).on(\'click\', \'.reload-captcha\', function(){
        $("#captcha").attr(\'src\', $("#captcha").attr(\'src\'));
    });

</script>';
}
?>