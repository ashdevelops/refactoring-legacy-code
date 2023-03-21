<!-- // Build Search Form -->
<div class="feature-filters feature-filters--block">
    <p>Events Filters</p>
    <div class="grid-x grid-padding-x">

        <div class="cell medium-4">
            <label for="datepicker" class="show-for-sr">label</label>
            <input id="datepicker" value="<?php checkDateExists($eventsArray); ?>" class="hasDatepicker" />
        </div>

        <div class="cell medium-4">
            <label for="seewhatson" class="show-for-sr">When it's on</label>
            <select name="period" class="field" id="seewhatson">
                <option value="">When</option>
                <?php
                foreach ($when as $whenkey => $whendate) {
                    $selected    = '';
                    if (empty($eventsArray['when'])) {
                        echo '<option value="' . $whenkey . '" >' . $whendate . '</option>';
                    } else {
                        $eventPeriod = $eventsArray['when'];
                        $selected = ($whenkey == $eventPeriod)  ? 'selected="selected"' : '';
                        echo '<option value        ="' . $whenkey . '" ' . $selected . '>' . $whendate . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="cell medium-4">
            <label for="placestogo" class="show-for-sr">Where it's on</label>
            <select name="location" class="field" id="placestogo">
                <option value="">Where</option>
                <?php
                $args = array(
                    'post_type'         => 'event',
                    'posts_per_page'    => -1,
                    'fields'            => 'ids',
                    'orderby'           => 'meta_value',
                    'meta_key'          => 'location',
                    'order'             => 'ASC',
                    'meta_query'        => array(
                        array(
                            'key'       => 'end_date',
                            'value'     => $today,
                            'compare'   => '>=',
                            'type'      => 'DATE'
                        )
                    )
                );
                $locations = get_posts($args);
                $eventLocations = array();
                foreach ($locations as $location) {
                    $eventLocations[] = get_field('location', $location);
                }

                foreach (array_unique($eventLocations) as $eventLocation) {
                    $searchedLocation = '';
                    if (array_key_exists('where', $eventsArray)) {
                        $searchedLocation = $eventsArray['where'];
                    }
                    $selected = '';

                    if ($searchedLocation == $eventLocation) {
                        $selected = 'selected="selected"';
                    }

                    echo '<option value="' . $eventLocation . '" '.$selected.'>' . $eventLocation . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="cell medium-4">
            <label for="eventsbytype" class="show-for-sr">Event Type</label>
            <select name="categoryID" class="field" id="eventsbytype">
                <option value="">Type</option>
                <?php
                foreach ($taxonomies as $term) {
                    $searchedType = '';
                    $termSlug = $term->slug;
                    if (array_key_exists('type', $eventsArray)) {
                        $searchedType = $eventsArray['type'];
                    }

                    $selected = '';

                    if ($searchedType == $termSlug) {
                        $selected = 'selected="selected"';
                    }

                    echo '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';
                }
                ?>
            </select>
        </div>

        <div class="cell medium-4">
            <button class="cmd-filter cmd-filter--small event-filter" type="button">Filter Items</button>
            <button class="cmd-filter cmd-filter--small btn-clear" type="button">Clear Filters</button>
        </div>


    </div>
</div>
<!-- // Build Search Form -->