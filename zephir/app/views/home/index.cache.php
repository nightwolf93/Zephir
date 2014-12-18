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
    
    return '<div class="message-box-purple">
  <div class="content">
    Offre spéciale de lancement <b>15 mises à jours offertes</b> pour les <b>100 premiers comptes</b>
  </div>
</div>

<div class="offers-container">
    
    <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'offer/1')), 'raw').'">
        <div class="offer">
            <div class="container">
                <div class="title">Gratuit</div>
                <div class="description">
                    Offre destiné a découvrir exLauncher et toutes ses fonctionnalités<br /><br />
                    <i>5 mises à jours max</i>
                </div>
            </div>
        </div>
    </a>
        
    <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'offer/2')), 'raw').'">
        <div class="offer">
            <div class="container">
                <div class="title">5€ / Mois</div>
                <div class="description">
                    Pour les petits projet nécessitant pas de mises a jour régulière<br /><br />
                    <i>30 mises à jours max</i>
                </div>
            </div>
        </div>
    </a>
    
    <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'offer/3')), 'raw').'">
        <div class="offer">
            <div class="container">
                <div class="title">10€ / Mois</div>
                <div class="description">
                    Pour les projet de moyennes taille nécessitant des mises a jours régulièrement<br /><br />
                    <i>75 mises à jours max</i>
                </div>
            </div>
        </div>
    </a>
    
    <a href="'.$cx['funcs']['ch']($cx, 'route', array(array(),array('to'=>'offer/4')), 'raw').'">
        <div class="offer">
            <div class="container">
                <div class="title">30€ / Mois</div>
                <div class="description">
                    Pour les gros projets éffectuant souvent des mises a jours<br /><br />
                    <i><b>Aucune limites</b></i>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="offers-description">
    <b>Les moyens de paiement disponible sont :</b> Allopass, Paypal.
</div>';
}
?>