<?php foreach (Filter::$audiodeviceFilters as $key => $value): ?>
    <div class="filter-elem">
        <p class="filter-title" style="text-decoration: none;"> <?php echo $value; ?></p>
    </div>
    <?php $innerArray = Filter::getFilterParameters($value, $categoryInfo[0]['category_id']);
          foreach ($innerArray as $innerKey => $innerValue): ?>
            <input class="filter-radio-btn" type="checkbox" 
            <?php            
                if (!empty(Filter::$activeFilters)) {
                    if (array_key_exists($key, Filter::$activeFilters))
                        if (in_array($innerValue,Filter::$activeFilters[$key])) {
                           echo 'checked="checked" ';
                        }
                } ?> 
            name="<?php echo $key; ?>[]" value="<?php echo $innerValue; ?>"><span class="radio-btn-text"><?php echo $innerValue; ?></span><br>
    <?php endforeach;?>      
<?php endforeach;?>
