<div class="admin-wrapper " id="admin-onglet-games-wrapper">
    <table class='full-width admin-form-table admin-table member' border='1'>
        <thead><tr><th>Image</th><th>Nom</th><th>Supprimer</th></tr></thead>
        <tbody>
            <?php  
            if(isset($listejeu) && is_array($listejeu)){
                foreach($listejeu as $key => $value){
                    echo "<tr>";
                        echo "<td>".$value->getName()."</td>";
                        echo "<td><img src='".$value->getImg()."'></TD>";
                        echo "<td><button onclick=deleteGame(".$value->getId().")>Effacer</button></td>";
                    echo "</tr>";
                }
            } 
            ?>
        </tbody>
    </table>
    <div class="formgame">
    <form class="formgame1" action="admin/addGame" method="post" enctype="multipart/form-data">
        <TABLE border=0>
            <TR>
                <TD>Nom</TD>
                <TD><INPUT class="input-default" type=text name="name"></TD>
            </TR>
            <TR>
                <TD>Description</TD>
                <TD><textarea class="desc-default" rows="3" name="description"></textarea></TD>
            </TR>
            <TR>
                <TD>Image</TD>
                <TD><INPUT type=file name="img"></TD>
            </TR>
            <TR>
                <TD>Année</TD>
                <td><input class="input-default" type="text" name="year"></td>
            </TR>
            <TR>
                <TD>Genre</TD>
                <td>
                    <SELECT class="input-default" name="idType" size="1">
                      <?php  if(isset($listetypejeu) && is_array($listetypejeu)){
                               foreach($listetypejeu as $key => $value){
                                    echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                }
                            } ?>
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
        </TABLE>
    </form>
    </div>
</div>