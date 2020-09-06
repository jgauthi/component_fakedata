<?php
namespace Jgauthi\Component\Fakedata;

class InsertTable extends Generator
{
    // var SQL
    public $table = [];
    public $debug = false;

    /**
     * random_sql constructor.
     *
     * @param int $nb_data
     */
    public function __construct($nb_data = 200)
    {
        // Changer config serveur
        @ini_set('max_execution_time', 0);
        @ini_set('memory_limit', '128M');

        parent::__construct($nb_data);
    }

    /**
     * @param $new_table
     */
    public function set_table($new_table)
    {
        if (is_array($new_table)) {
            $this->table = array_merge($this->table, $new_table);
        } else {
            $this->table[] = $new_table;
        }
    }

    /**
     * @param $req
     *
     * @return bool
     */
    public function query($req)
    {
        if ($this->debug) {
            echo "<pre>{$req}</pre>\n";
        }

        return mysql_query($req) or die(mysql_error());
    }

    /**
     * @param $var
     *
     * @return string
     */
    public function sql_data($var)
    {
        if ('' === $var || null === $var) {
            return 'NULL';
        } elseif (1 === get_magic_quotes_gpc()) {
            return "'".$var."'";
        }

        return "'".addslashes($var)."'";
    }

    /**
     * @param $index
     * @param $req
     *
     * @return bool
     */
    public function insert($index, $req)
    {
        return  $this->query("INSERT INTO `{$this->table[$index]}` SET {$req};");
    }

    /**
     * @param $index
     * @param $array
     *
     * @return bool
     */
    public function insert_data($index, $array)
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

    /**
     * @param int    $index
     * @param string $champ
     *
     * @return int
     */
    public function get_last_id($index = 0, $champ = 'id')
    {
        $last = mysql_query("SELECT MAX($champ) as max FROM `".$this->table[$index].'`;');
        if (1 === mysql_num_rows($last)) {
            $last = mysql_fetch_row($last);

            return  $last[0];
        }

        return 0;
    }

    /**
     * @return bool
     */
    public function boucle()
    {
        static $n = 0;

        if ($n++ <= $this->nb_data) {
            return true;
        }

        // Reset le compteur et mettre fin à la boucle
        $n = 0;

        return false;
    }

    /**
     * @return bool
     */
    public function reset()
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