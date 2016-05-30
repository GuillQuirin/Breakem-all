<div class="admin-wrapper " id="admin-onglet-games-wrapper">
    <form action="admin/addGame" method="post" enctype="multipart/form-data">
        <TABLE border=0>
            <TR>
                <TD>Nom</TD>
                <TD>
                    <INPUT type=text name="name">
                </TD>
            </TR>

            <TR>
                <TD>Description</TD>
                <TD>
                    <textarea rows="3" name="description"></textarea>
                </TD>
            </TR>

            <TR>
                <TD>Image</TD>
                <TD>
                    <INPUT type=file name="img">
                </TD>
            </TR>

            <TR>
                <TD>Année</TD>
                <td>
                    <input type="text" name="year">
                </td>
            </TR>
            <?php ?>
            <TR>
                <TD>Genre</TD>
                <td>
                    <SELECT name=idType" size="1">
                        <option> <?php ?>
                    </SELECT>
                </td>
            </TR>

            <TR>
                <TD COLSPAN=2>
                    <button id='validate-form-games' type='submit' class='btn btn-pink admin-form-submit'>
                        <a>Ajouter</a>
                    </button>
                </TD>
            </TR>

            <TR>

            </TR>
        </TABLE>
    </form>
        <?php ?>

</div>