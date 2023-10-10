<?php
$categoryName = single_term_title("", false);
$categoryData = get_term_by('name', $categoryName, 'product_cat');

$brandPage = false;

if(!$categoryData){
    $categoryData = get_term_by('slug', $categoryName, 'brand');
    $brandPage = true;
}

?>
<?php include 'webshop-category-header.php'; ?>

<?php include 'webshop-category-products.php'; ?>

<?php include __DIR__ . '/../elements/you-may-also-like.php'; ?>