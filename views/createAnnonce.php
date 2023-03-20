<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php'?>
<body>
       <div> Création d'une Annonce</div>
       <div>
           <form method="post" action="" enctype="multipart/form-data">
               <div>
               <input type="text"
                      name="ann_nom"
                      id="ann_nom"
                      placeholder="Insérer le nom de l'annonce"
               >
               </div>

               <div>
                   <input type="file"
                          name="ann_photo"
                          id="ann_photo"
                          placeholder="Insérer la photo"

                   >
               </div>

               <div>
                   <input type="text"
                          name="ann_prix"
                          id="ann_prix"
                          placeholder="Insérer le prix"

                   >
               </div>

               <div>
                   <input type="text"
                          name="ann_description"
                          id="ann_description"
                          placeholder="Insérer une description"

                   >
               </div>

               <div>
                   <label for="cat_id[]"></label>
                   <select name="cat_id[]" id="cat_id[]" class="cat_id" multiple>
                       <?php
                       foreach ($categories as $category) {
                           $categoryLibelle = $category->getCatLibelle();
                           $categoryId = $category->getCatId();
                           ?>
                           <option value="<?= $categoryId ?>"><?= $categoryLibelle ?></option>
                           <?php
                           echo "<div> $categoryLibelle</div>";
                       }
                       ?>
                   </select>
               </div>

               <div>
                   <button type="submit" name="createAnnonce">Créer l'annonce</button>

               </div>

           </form>
       </div>


</body>

</html>
