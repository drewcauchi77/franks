<!--SHOP SIDEBAR WHERE THE FILTERS ARE SHOWN-->
<div class="shop-sidebar dior-sidebar">

    <div class="filter-container category-container">

    <?php 
    
    // product_slug is obtaining the slug of the post-title - in this case obtaining 'dior'
    $product_slug = $term->slug;
    
    // parent_category is merging the above slug with the name of the parent category - in this case obtaining 'dior-categories' 
    // which is the parent and LEVEL 1 category for all the filters (term_id = 5122)
    $parent_category = "dior-categories";

    // obtain the term id of the parent_category in this case of dior-categories which relates to term_id = 5122 above
    // saved into an unaccessible array
    $term_id =  $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT term_id FROM wp_terms WHERE slug = %s;",
        $parent_category
    ));
    
    // foreach to access the value of the array above - will only go through the 1 value above
    foreach($term_id as $term){

        //assigning the term value saved in an stdObject to a variable to be accessible
        $term_value = $term->term_id;

    }

    // SQL query to obtain the main product categories - LEVEL 2, values obtain are name and term_id
    $main_product_categories = $wpdb->get_results($wpdb->prepare(
        "SELECT DISTINCT t.name, t.term_id FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id = tt.term_id) WHERE parent = %s ORDER BY t.term_id;", 
        $term_value
    ));

    // Looping each value within the array from the SQL query with the foreach
    foreach($main_product_categories as $cat){
        
        // Obtain the t.name stated above by the SQL query from stdObject
        $category_name = $cat->name;

        // Obtain the t.term_id stated above by the SQL query from stdObject
        $category_id = $cat->term_id;
        $link = get_category_link($category_id);

        // The div which will contain all the filters
        echo '<div class="dior-cat-filter">';
        
        // SQL query to obtain the sub categories of each section - the parent id has changed to the current category which will be looped by foreach and change
        // to obtain LEVEL 3 categories
        $sub_product_categories = $wpdb->get_results($wpdb->prepare(
            "SELECT DISTINCT t.name, t.term_id FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id = tt.term_id) WHERE parent = %s ORDER BY t.term_id;",
            $category_id
        ));

        // Counter of how many sub categories there are valued as temporary variable sub_counter - these would be the children of the main parent
        // Eg: Eyes, Face, Nails etc for Makeup
        $count_of_sub_categories = $wpdb->get_results($wpdb->prepare(
            "SELECT COUNT(*) AS sub_counter FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id = tt.term_id) WHERE parent = %s;",
            $category_id
        ));
        
        // Looping to obtain the value above as sub_category to be able to work on
        foreach($count_of_sub_categories as $sub_category_count){

            $sub_cat_count = $sub_category_count->sub_counter;

        }

        // If there are children present, the parent category will only show and be as an opener for other categories
        if($sub_cat_count > 0){

            // The main category name printing - LEVEL 2 options - MASTER TITLES
            echo '<figure class="parent_filter"><i class="fas fa-caret-right"></i>' . $category_name . '</figure>';

            // List starting the LEVEL 3 categories
            echo '<ul class="level-two-list">';

            $counter = 1;

            if($counter == 1){
                echo '<li class="view-all-button"><a href="'.$link.'?orderby=date">ALL</a></li>';
            }

            $counter++;

            // Looping within each category of LEVEL 3 to do the above similar functionality
            // Obtain name and term_id to be dealt into further another LEVEL - LEVEL 4
            foreach($sub_product_categories as $sub_cat){

                $sub_category_name = $sub_cat->name;

                $sub_category_id = $sub_cat->term_id;
                $sub_link = get_category_link($sub_category_id);

                // LEVEL 4 categories - Children of Children
                $sub_sub_product_categories = $wpdb->get_results($wpdb->prepare(
                    "SELECT DISTINCT t.name, t.term_id FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id = tt.term_id) WHERE parent = %s ORDER BY t.term_id;",
                    $sub_category_id
                ));

                // Counter of how many sub sub categories there are valued as temporary variable sub_sub_counter - these would be the children of the children of the main parent
                // Eg: Foundation for Face, Eyeliners for Eyes, Lipsticks for Lips etc
                $count_of_sub_sub_categories = $wpdb->get_results($wpdb->prepare(
                    "SELECT COUNT(*) AS sub_sub_counter FROM wp_terms t JOIN wp_term_taxonomy tt ON (t.term_id = tt.term_id) WHERE parent = %s;",
                    $sub_category_id
                ));
                
                // Looping to obtain the value above as sub_category to be able to work on
                foreach($count_of_sub_sub_categories as $sub_sub_category_count){
    
                    $sub_sub_cat_count = $sub_sub_category_count->sub_sub_counter;
    
                }

                if($sub_sub_cat_count > 0){

                    // Name of sub category
                    echo '<li><a href="'.$sub_link.'?orderby=date">'.$sub_category_name.'</a></li>';

                    // List starting the LEVEL 4 categories
                    echo '<ul class="level-three-list">';
                    
                    // Looping the sub sub categories of LEVEL 4
                    foreach($sub_sub_product_categories as $sub_sub_cat){

                        $sub_sub_category_name = $sub_sub_cat->name;

                        $sub_sub_category_id = $sub_sub_cat->term_id;
                        $sub_sub_link = get_category_link($sub_sub_category_id);

                        echo '<li>';

                        echo '<a href="'.$sub_sub_link.'?orderby=date">';

                        echo $sub_sub_category_name;

                        echo '</a>';

                        echo '</li>';

                    }

                    echo '</ul>';

                }else{

                    // The main category name printing - LEVEL 2 options - MASTER TITLES
                    echo '<li>';

                    echo '<a href="'.$sub_link.'?orderby=date">';

                    echo $sub_category_name;

                    echo '</a>';

                    echo '</li>';
                
                }

            }

            echo '</ul>';

        }else{

            // The main category name printing - LEVEL 2 options - MASTER TITLES
            echo '<figure class="parent_filter">';

            echo '<a href="'.$link.'?orderby=date">';

            echo '<i class="fas fa-caret-right"></i>';

            echo $category_name;

            echo '</a>';

            echo '</figure>';
            
        }

        echo '</div>';

    }
    
    ?>

    </div>

</div>