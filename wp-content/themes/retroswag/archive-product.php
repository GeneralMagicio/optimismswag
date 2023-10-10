<?php get_header(); ?>

<?php
$category = single_term_title("", false);
$catID = get_queried_object()->term_id;
$title = ucfirst($category);
$desc = category_description($catID);
$term = get_term($catID);
?>
<?php if (isset($term) && isset($term->taxonomy) && $term->taxonomy == 'brand'): ?>
    <?php include "templates/webshop/webshop-list-brand.php"; ?>
<?php else: ?>
    <?php include "templates/webshop/webshop-list.php"; ?>
<?php endif; ?>

<?php get_footer(); ?>