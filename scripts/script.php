<?php

require_once '/faker/autoload.php';

$faker = Faker\Factory::create();


function generateDummySQL($faker, $num_records, $table_name, $column_map) {
    $sql_insertions = '';
    for ($i = 0; $i < $num_records; $i++) {
        $field_values = [];
        foreach ($column_map as $column_name => $faker_method) {
            // Escape special characters
            $field_value = addslashes($faker->$faker_method());
            $field_values[] = "'$field_value'";
        }

        $sql_insertions .= "INSERT INTO $table_name (" . implode(", ", array_keys($column_map)) . ") VALUES (" . implode(", ", $field_values) . ");\n";
    }

    return $sql_insertions;
}

$column_map_customers = [
    'name' => 'name',
    'email' => 'email',
    'phone_number' => 'phoneNumber',
    'address' => 'address'
];

$column_map_company = [
    'name' => 'company',
    'description' => 'catchPhrase',
    'address' => 'address',
    'country' => 'country',
    'phone_number' => 'phoneNumber'
];

$sql_insertions = '';
$sql_insertions .= generateDummySQL($faker, 10, 'customers', $column_map_customers);
$sql_insertions .= generateDummySQL($faker, 10, 'company', $column_map_company);



$sql_file_path = '/tmp/dummy_data.sql'; // Path inside the Docker container
file_put_contents($sql_file_path, $sql_insertions);

echo "Generated SQL file: $sql_file_path\n";
copy($sql_file_path, 'app/sample.sql');
