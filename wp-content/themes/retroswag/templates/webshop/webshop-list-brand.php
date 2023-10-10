<?php
$categoryName = single_term_title("", false);
$categoryData = get_term_by('name', $categoryName, 'brand');
?>
<?php include 'webshop-category-header-brand.php'; ?>

<?php include 'webshop-category-products-brands.php'; ?>