Inovarti_Templatedesign
=======================
Se o campo na categoria thumb estiver com imagem sera mostrado no menu, caso contrario tera um span 
exemplo <span class="icon"><i class="fa nomecategoria"></i></span>

Banner menu block statico

cms > bloco estatico
criar um block com o identificador (identifier) =  urlcategoria



Label
incluir na lista, view onde quer que apareça as label
<?php echo $this->helper('templatedesign')->getLabel($_product);  ?>

Informações do produto 
new_label: news_from_date/news_to_date
promotion_label:special_from_date/special_to_date
promotion_percent_label: round(((($product->getPrice() - $product->getFinalPrice()) / $product->getPrice()) * 100), 0) > 14
sale_label: mais vendido
shipping_label: frete gratis acima de 200
