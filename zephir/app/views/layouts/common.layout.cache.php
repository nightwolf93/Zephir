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
        'helpers' => array(            'render' => function(){
                        return $this->renderView();
                    },
            'style' => function($cx, $args){
                        return '<link href="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/css/' . $args['name'] . '.css" rel="stylesheet">';
                    },
            'script' => function($cx, $args){
                        return '<script src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/js/' . $args['name'] . '.js"></script>';
                    },
            'image' => function($cx, $args){
                        return '<img src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/images/' . $args['name'] . '" />';
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
    
    return '<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Zephir Framework</title>
        '.$cx['funcs']['ch']($cx, 'style', array(array(),array('name'=>'app.min')), 'raw').'

        '.$cx['funcs']['ch']($cx, 'script', array(array(),array('name'=>'jquery-2.1.1.min')), 'raw').'
        '.$cx['funcs']['ch']($cx, 'script', array(array(),array('name'=>'handlebars-v2.0.0')), 'raw').'
        '.$cx['funcs']['ch']($cx, 'script', array(array(),array('name'=>'app')), 'raw').'
    </head>
    <body>
        <div id="overlay-black">
          <div class="black"></div>
        </div>

        <div id="navbar">
            <div class="container">
                <a href="http://nightwolf.fr/" target="blank">
                    <div class="item">
                        <b>Nightwolf.fr</b>
                    </div>
                </a>
                <div class="separator"></div>
                <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'')), 'raw').'"><div class="item">Accueil</div></a>
                <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'account/login')), 'raw').'"><div class="item">Connexion</div></a>
                <div class="item">API</div>
                <div class="item">A propos de</div>
            </div>
        </div>
        <div id="body">
          <div id="header">
            '.$cx['funcs']['ch']($cx, 'image', array(array(),array('name'=>'logo.png')), 'raw').'<a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'')), 'raw').'"><h1>exLauncher</h1></a><br />
            Make your launcher with simplicity
          </div>
          <div id="content">
            <div class="text-content">
                '.$cx['funcs']['ch']($cx, 'render', array(array(),array()), 'raw').'
            </div>
          </div>
          <div id="footer">
              Copyright ©2014, All Rights Reserved <br />
              <b style="font-size: 13px;">Nightwolf Coding Lounge</b>
              <div style="font-size: 8px; text-align: right;">Powered by Zephir Framework</div>
          </div>
        </div>
    </body>
</html>
';
}
?>