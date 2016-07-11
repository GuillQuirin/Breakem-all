<div class="formteam">
    <form class="formteam1" action="<?php echo WEBPATH.'/creationteam/addTeam'; ?>" method="post" enctype="multipart/form-data">
    <table border=0>
        <tr>
            <td>Nom : </td>
            <td><input class="input-default" type="text" name="name"></td>
        </tr>
        <tr>
            <td>Description : </td>
            <td><textarea  class="desc-default" rows="3" name="description"></textarea></td>
        </tr>
        <tr>
            <td>Image : </td>
            <td><input class="image-default" type="file" name="img"></td>
        </tr>
        <tr>
            <td>Slogan : </td>
            <td><input class="input-default" type="text" name="slogan"></td>
        </tr>
        <tr>
            <td colspan=2>
                <button id='validate-form-games' type='submit' class='btn btn-pink admin-form-submit'>
                    <a>Créer ma team</a>
                </button>
            </td>
        </tr>
    </table>
</form>
</div>
