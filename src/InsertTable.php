<?php
namespace Jgauthi\Component\Fakedata;

use mysqli;

class InsertTable extends Generator
{
    // var SQL
    public array $table = [];
    public bool $debug = false;
    private mysqli $mysqli;

    public function __construct(mysqli $mysqli, int $nb_data = 200)
    {
        // Changer config serveur
        @ini_set('max_execution_time', 0);
        @ini_set('memory_limit', '128M');

        $this->mysqli = $mysqli;
        parent::__construct($nb_data);
    }

    public function set_table(string $new_table): self
    {
        if (is_array($new_table)) {
            $this->table = array_merge($this->table, $new_table);
        } else {
            $this->table[] = $new_table;
        }

        return $this;
    }

    /**
     * @return \mysqli_result|bool
     */
    public function query(string $req)
    {
        if ($this->debug) {
            echo "<pre>{$req}</pre>\n";
        }

        return mysqli_query($this->mysqli, $req) or die(mysqli_error($this->mysqli));
    }

    public function sql_data(string $var): string
    {
        if ('' === $var || null === $var) {
            return 'NULL';
        }

        return "'".addslashes($var)."'";
    }

    /**
     * @return mixed
     */
    public function insert(string $index, string $req)
    {
        return  $this->query("INSERT INTO `{$this->table[$index]}` SET {$req};");
    }

    /**
     * @return mixed
     */
    public function insert_data(string $index, iterable $array)
    {
        foreach ($array as $nom => $value) {
            if (!isset($req)) {
                $req = "\n\t";
            } else {
                $req .= ', ';
            }

            $req .= $nom.' = '.$this->sql_data($value);
        }

        return  $this->insert($index, $req);
    }

    public function get_last_id(string $index = '0', string $champ = 'id'): int
    {
        $last = mysqli_query($this->mysqli, "SELECT MAX($champ) as max FROM `".$this->table[$index].'`;');
        if (mysqli_num_rows($last)) {
            $last = mysqli_fetch_row($last);

            return $last[0];
        }

        return 0;
    }

    public function boucle(): bool
    {
        static $n = 0;

        if ($n++ <= $this->nb_data) {
            return true;
        }

        // Reset le compteur et mettre fin à la boucle
        $n = 0;

        return false;
    }

    public function reset(): bool
    {
        if (!is_array($this->table) || 0 === count($this->table)) {
            return false;
        }

        foreach ($this->table as $table_nom) {
            $this->query("TRUNCATE TABLE `$table_nom`;");
        }

        return true;
    }
}