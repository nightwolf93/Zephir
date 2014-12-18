{{#if error}}

    <div class="message-box-red">
        <div class="content">
            {{error}}
        </div>
    </div>

{{/if}}

<h3>Création d'un compte :</h3>
<form action="{{route to="account/create"}}" method="POST">
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
                    <center>{{captcha id="captcha"}} <input type="button" class="bt-1 reload-captcha" value="Recharger" style="vertical-align: top;" /></center>
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

    $(body).on('click', '.reload-captcha', function(){
        $("#captcha").attr('src', $("#captcha").attr('src'));
    });

</script>