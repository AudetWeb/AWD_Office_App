    <pre>
        <?php
            $fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

            function format_list(&$list, $key)
            {
                $list = "{$key}={$list}";
            }

            echo "Starting array:\n";
            print_r($fruits);

            echo "\nModified array:\n";
            array_walk($fruits, 'format_list');
            print_r($fruits);

            echo "\nFinal string:\n";
            echo implode(',',$fruits);

        ?>
    </pre>