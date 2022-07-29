<div class="filter-search">
  <?php
    $all_tax = get_terms(array(
      'taxonomy' => 'color',
      'hide_empty' => true,
    ));

    if ($all_tax) { ?>
    <div class="filter">
      <select name="filter" class="filter-taxonomy">
        <option value="all">All</option>
        <?php
          foreach ($all_tax as $tax_list) {
            $tax_slug = $tax_list->slug;
            $tax_name = $tax_list->name;
            echo '<option value="'.$tax_slug.'">'.$tax_name.'</option>';
          }
        ?>
      </select>
    </div>
  <?php } ?>
  <div class="search">
    <input type="text" name="s" class="search-field" placeholder="Search...">
  </div>
</div>