<?php
use Jgauthi\Component\Fakedata\Generator as DataGenerator;

// In this example, the vendor folder is located in "example/"
require_once __DIR__.'/vendor/autoload.php';

// Config
$date_debut = mktime(5, 15, 15, 7, 1, 2010);
$date_fin = mktime(11, 30, 48, 12, 24, 2017);
$liste = ['element1', 'element2', 'element3', 'element4'];
$max_value = 150;

$filtre = [
    'bool' => null,
    'int' => [4],
    'pourcent' => [2],
    'nom' => null,
    'nom_roster' => null,
    'mail' => null,
    'mail_roster' => ['asgard.net'],
    'identite' => null,
    'identite_roster' => ['mindev.local'],
    'float' => null,
    'txt' => [5],
    'txt_paragraphe' => [2],
    'txt_phrase' => [3],
    'date' => ['d/m/Y H\hi', $date_debut, $date_fin],
    'timestamp' => [$date_debut, $date_fin],
    'image' => [400, 300],
//  'image_specimen' => null,
    'url' => null,
    'adresse' => null,
    'country' => null,
    'city' => null,
    'liste' => [0],
    'status' => null,
    'password' => [15],
    'code' => [5, 'ASG_'],
    'wysiwyg' => null,
];

// Init random
$gen = new DataGenerator;
$gen->set_liste($liste);

// Convert $filtre to export
$data = [];
foreach ($filtre as $name => $args) {
    $function = [$gen, $name];
    $data[$name] = [];

    if (null !== $args) {
        $data[$name]['value'] = call_user_func_array($function, $args);
    } else {
        $data[$name]['value'] = call_user_func($function);
    }

    // Formate value
    if (is_array($data[$name]['value'])) {
        $data[$name]['value'] = '<pre>'. var_export($data[$name]['value'], true) .'</pre>';
    } elseif (is_bool($data[$name]['value'])) {
        $data[$name]['value'] = '<pre>'. var_export($data[$name]['value'], true) .'</pre>';
    } else {
        $data[$name]['value'] = mb_substr($data[$name]['value'], 0, ($max_value - 3), 'UTF-8').'…';
    }

    for ($i = 0; $i < 3; ++$i) {
        $data[$name]['arg'.($i + 1)] = (isset($args[$i]) ? $args[$i] : null);
    }
}

?>
<h1>Data random generator</h1>
<table border="1" class="table table-striped table-hover table-bordered">
    <thead class="thead-dark">
    <tr>
        <th scope="row">Filtre</th>
        <th scope="col">Value</th>
        <th scope="col">Argument 1</th>
        <th scope="col">Argument 2</th>
        <th scope="col">Argument 3</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $name => ['value' => $value, 'arg1' => $arg1, 'arg2' => $arg2, 'arg3' => $arg3]): ?>
    <tr>
        <th align="left" scope="row"><?=$name?></th>
        <td><?=$value?></td>
        <td><?=$arg1?></td>
        <td><?=$arg2?></td>
        <td><?=$arg3?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>

<h3>Exemple de génération WYSIWYG</h3>
<?=$gen->wysiwyg()?>

<style>
    tbody th:nth-child(1), tbody td:nth-child(1) 	{ background-color: #162e5e; color: white; }
    tr, td { padding: 5px; }
</style>