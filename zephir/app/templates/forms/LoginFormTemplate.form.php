<?php echo $this->begin(); ?>

<table>
    <tr>
        <td style="color: black;">Nom de compte : </td>
        <td><?php echo $this->getField('username'); ?></td>
    </tr>
    <tr>
        <td style="color: black;">Mot de passe : </td>
        <td><?php echo $this->getField('password'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo $this->getField('submit'); ?></td>
    </tr>
</table>

<?php echo $this->end(); ?>