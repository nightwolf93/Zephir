{{#if error}}

  <div class="message-box-red">
    <div class="content">
      {{error}}
    </div>
  </div>

{{/if}}

<h3>Connexion a votre espace client</h3>
<form action="{{route to="account/login"}}" method="POST">

  <table>
    <tr>
      <td><label for="email">E-mail :</label></td>
      <td><input name="email" type="text" /></td>
    </tr>
    <tr>
      <td><label for="password">Mot de passe :</label></td>
      <td><input name="password" type="password" /><br /></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input class="bt-1" style="width: 95%;" type="submit" value="Confirmer" />
      </td>
    </tr>
  </table>

</form>
