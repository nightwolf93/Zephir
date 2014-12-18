<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Zephir Framework</title>
        {{style name="app.min"}}

        {{script name="jquery-2.1.1.min"}}
        {{script name="handlebars-v2.0.0"}}
        {{script name="app"}}
    </head>
    <body>
        <div id="overlay-black">
          <div class="black"></div>
          <div class="message-box">
            <div class="container">
              <h3>Confirmation d'achat</h3>
            </div>
          </div>
        </div>

        <div id="navbar">
            <div class="container">
                <a href="http://nightwolf.fr/" target="blank">
                    <div class="item">
                        <b>Nightwolf.fr</b>
                    </div>
                </a>
                <div class="separator"></div>
                <a href="{{route to=""}}"><div class="item">Accueil</div></a>
                <div class="item">API</div>
                <div class="item">A propos de</div>
            </div>
        </div>
        <div id="body">
          <div id="header">
            {{image name="logo.png"}}<a href="{{route to=""}}"><h1>exLauncher</h1></a><br />
            Make your launcher with simplicity
          </div>
          <div id="content">
            <div class="text-content">
                {{render}}
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
