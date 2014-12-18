{{#if error}}

    <div class="message-box-red">
        <div class="content">
            {{error}}
        </div>
    </div>

{{else}}

<center>
    Vous avez sélectionnez l'offre <b>{{offer.name}}</b> 
    pour le prix de <b>{{offer.price}}€ / Mois</b>
    <br /><br />
    Posséder vous déjà un compte chez nous ?
    <br /><br />
    <a class="bt-1" href="{{route to="offer/buy" params=offer.id}}">Oui</a>
    <a class="bt-1" href="{{route to="account/register"}}">Non</a>
</center>

{{/if}}