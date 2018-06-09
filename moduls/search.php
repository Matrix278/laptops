<?php
if (!empty($_POST['searchProduct'])) { 
    $searchProduct=$_POST['searchProduct'];
    $sql = mysqli_query($link, "SELECT name FROM vn_products WHERE name LIKE '%$searchProduct%'");
    if (mysqli_num_rows($sql) > 0){
        $ln=$_GET['ln'];
        $productsTable=mysqli_query($link, "SELECT * FROM vn_products WHERE langCode = '$ln' AND name LIKE '%$searchProduct%'"); //для того чтобы в будущем использовать много раз
        $products=Array();
        echo '<div class="row justify-content-center" style="margin-left: 50px; margin-right: 50px;">';
        while($oneProduct=mysqli_fetch_assoc($productsTable)){
            $products[$oneProduct['code']]=$oneProduct;
            $descriptionExplode=explode('.', $oneProduct['description']);
            echo '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">';
            echo '<div class="card" style="margin-top: 30px; margin-bottom: 20px;">
                    <a href="'."?ln=".$ln."&page=productInfo&id=".$oneProduct['code']."".'" class="card-link">';
                    $productCodeForImage=$oneProduct['code'];
            $imageProductsTable=mysqli_query($link, "SELECT * FROM vn_images WHERE code='$productCodeForImage' LIMIT 1 ");
            while($oneImage=mysqli_fetch_assoc($imageProductsTable)){
                echo '<img class="card-img-top" src="'.$oneImage['mediumImage'].'" alt="'.$oneProduct['name'].'">';
            }
                    echo '<div class="card-body">
                    <form action="'."?ln=".$ln."&page=wishlist".'" method="post">
                        <input type="hidden" name="id" value="'.$oneProduct['code'].'" />
                        <h5 class="card-title">'.$oneProduct['name'].'</a>
                        <input type="hidden" name="name" value="'.$oneProduct['name'].'" /></h5>
                        <p class="card-text">
                        <ul>';
                        foreach($descriptionExplode as $descKey =>$descValue) {
                echo '<li>'.$descValue.'</li>';
               }
                            // <li>'.$descriptionExplode[0].'</li>
                            // <li>'.$descriptionExplode[1].'</li>
                            // <li>'.$descriptionExplode[2].'</li>
                            // <li>'.$descriptionExplode[3].'</li>
                            // <li>'.$descriptionExplode[4].'</li>
                            // <li>'.$descriptionExplode[5].'</li>
                            // <li>'.$descriptionExplode[6].'</li>
                            // <li>'.$descriptionExplode[7].'</li>
                            // <li>'.$descriptionExplode[8].'</li>
                            // <li>'.$descriptionExplode[9].'</li>
                        echo '</ul>
                        </p>
                        <span class="badge badge-dark" style="font-size: 30px; margin: 10px;">'.$oneProduct['price'].'€<input type="hidden" name="price" value="'.$oneProduct['price'].'€"/></span>
                        <p>
                        '.$terms['quantity'].': <input type="number" name="quantity" min="1" max="10" value="1" style="width: 15%;" />
                        </p>
                        <!--<a href="?page=wishlist" class="btn btn-primary">Добавить в желаемые</a>-->
                        <input type="submit" name="submit" class="btn btn-primary" value="'.$terms['addWishlist'].'" />
                    </form>
                    </div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }else{
        echo '<div class="card">
        <h3>'.$terms['searchError1'].' <b>'.$searchProduct.'</b> '.$terms['searchError2'].'</h3>
        </div>';
    }
}
?>