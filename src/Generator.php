<?php
/*******************************************************************************
 * @name: Generator & Random SQL
 * @note: Random data generation for testing and dev environments (data fixtures)
 * @author: Jgauthi <github.com/jgauthi>, created at [10oct2010]
 * @version: 2.0
 * @Todo: Implement the method debug_dupplicate_array in the class
 * @alternative: https://github.com/fzaninotto/Faker

 *******************************************************************************/
namespace Jgauthi\Component\Fakedata;

class Generator
{
    // Var random
    protected string $lorem;
    protected array $texte;
    protected int $text_count;
    protected array $phrase;
    protected int $phrase_count;

    public int $nb_data;
    protected array $liste = [];

    // Conserver une trace des donnees deja generer pour eviter les doublons
    public array $code_list = [];

    public function __construct(int $nb_data = 200)
    {
        // Variables
        $this->nb_data = $nb_data;

        $this->lorem = mb_strtolower('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eros tellus, semper eget tristique quis, volutpat non turpis. Ut dignissim placerat enim at tristique. Morbi mi tortor, rutrum at feugiat et, dignissim sed leo. Duis sagittis elit nec urna consequat porttitor. Aliquam at lacus ligula, vitae ultricies purus. Cras ornare felis non nibh volutpat placerat. Etiam ut posuere tellus. Ut turpis ipsum, faucibus vel rhoncus quis, auctor auctor lorem. Proin lacinia fermentum odio venenatis imperdiet. Duis sapien urna, congue eget semper at, imperdiet non justo. Suspendisse potenti. Nam vehicula risus aliquet turpis porta mattis adipiscing urna mattis. Curabitur nisi erat, molestie in congue vel, rhoncus quis nunc.

		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut accumsan, ipsum euismod malesuada dictum, tortor ligula pretium enim, eu eleifend felis turpis in libero. In hac habitasse platea dictumst. Duis et libero nibh. Suspendisse in dolor et felis ullamcorper tincidunt quis at sapien. Fusce sed lacus sed velit blandit condimentum quis ac metus. Donec vel ligula pretium justo condimentum mollis. Nunc feugiat ipsum vel tellus venenatis eleifend. Sed purus nunc, scelerisque vel sollicitudin a, sollicitudin in odio. Fusce tincidunt imperdiet tellus, id luctus sem dapibus at. Mauris felis urna, feugiat a consectetur quis, tincidunt vitae tellus. Nunc eu ligula metus, quis ultricies metus. Proin eleifend, nibh non adipiscing tincidunt, justo dui adipiscing nibh, id pharetra metus quam non ipsum. Morbi mauris augue, imperdiet ut consectetur in, hendrerit eu augue. Praesent aliquet eros et magna placerat fermentum. Etiam ipsum dui, tincidunt nec placerat nec, fringilla in tellus. Donec auctor viverra tortor a fermentum. Nam quis magna ligula, a tristique lectus. Vivamus condimentum tristique odio nec auctor. Nulla eget ipsum lacinia libero lobortis fermentum.

		Sed faucibus, nisi eu faucibus fermentum, diam dolor ultrices ligula, eu interdum nisi nisl sed lacus. Aenean faucibus dapibus massa, dapibus faucibus ante mollis non. Fusce vel magna ligula, sit amet aliquam orci. Vivamus quis felis quam. Etiam ullamcorper, nunc eget vulputate ultrices, nunc elit egestas elit, sed fringilla urna lorem id ipsum. Phasellus ut nisl erat, ut cursus metus. Suspendisse dictum viverra porttitor. Maecenas dictum neque eu sem vulputate elementum. Nunc auctor lectus ac ligula lobortis commodo. Integer posuere pulvinar mi, eget suscipit neque lobortis ac. Donec porttitor dapibus dolor, eu pulvinar sem adipiscing ut. Cras ultrices iaculis diam, eget faucibus risus gravida sit amet. Nulla nec libero et mauris vulputate suscipit. Donec tristique pulvinar faucibus. Proin molestie pellentesque dui sed aliquam. Maecenas feugiat ipsum vitae nisi blandit euismod. Donec elementum leo sodales augue vulputate et condimentum risus volutpat.

		Nullam convallis vestibulum sem. Morbi cursus, quam vel facilisis aliquam, ante eros malesuada ipsum, in semper tellus mauris id dolor. Aenean nibh urna, tristique nec imperdiet in, euismod eget arcu. Vivamus urna mauris, condimentum sagittis cursus sed, tincidunt in diam. Maecenas sollicitudin, sem sit amet viverra adipiscing, erat eros ultrices ligula, a condimentum turpis risus et magna. Aliquam molestie dapibus diam in cursus. Aliquam porttitor lobortis justo id auctor. Donec hendrerit pellentesque ligula a cursus. Ut dolor sem, vulputate sit amet porttitor mattis, pulvinar consectetur purus. Aenean non iaculis libero. Vestibulum eros ipsum, aliquam et sagittis ut, pretium quis nisl. Ut sed metus vel ante lobortis semper a quis neque. Sed eu enim massa. Suspendisse potenti.

		Nullam in justo augue. Nullam dignissim risus bibendum nisi dignissim facilisis. Phasellus viverra, lectus semper placerat congue, ante urna consequat dolor, nec tincidunt metus mi vitae nisi. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris quis lectus magna, at viverra purus. Maecenas eu massa turpis, eu dapibus tellus. Donec suscipit, tortor vel tempus pulvinar, nisl augue pulvinar elit, sed dictum dui sem sit amet tortor. Duis nibh lorem, euismod a cursus ac, condimentum in sapien. Nulla facilisi. In hac habitasse platea dictumst.');

        $this->texte = explode(' ', str_replace(['.', ',', "\n", "\r", "\t"], '', $this->lorem));
        $this->text_count = count($this->texte) - 1;

        $this->phrase = explode('.', str_replace(["\n", "\r", "\t"], '', $this->lorem));
        $this->phrase_count = count($this->phrase) - 1;
    }

    //-- function RANDOM () -------------------------------------------------------------------

    public function bool(): bool
    {
        return  (bool) rand(0, 1);
    }

    public function int(int $length = 3): int
    {
        $result = rand();
        if ($length > 5) {
            $result .= rand();
        }

        $result = mb_substr($result, 0, $length);

        return (int) $result;
        //return rand(0, 10 ^ $length );
    }

    public function pourcent(int $num): int
    {
        return  (rand(0, 10000) / 100) <= $num;
    }

    public function float(int $nb = 2, int $decimal = 2): float //todo: require update
    {
        return round((mt_rand() / mt_getrandmax() * 1000), $decimal, PHP_ROUND_HALF_UP);
    }

    public function txt(int $nb = 3): string
    {
        for ($i = 0; $i < $nb; ++$i) {
            if (!isset($var)) {
                $var = $this->texte[rand(0, $this->text_count)];
            } elseif ($this->bool() && $this->bool()) {
                $var .= ' '.$this->texte[rand(0, $this->text_count)];
            } elseif (2 === $i) {
                // Eviter un nom trop cours
                if (mb_strlen($var) < 4) {
                    $var .= ' '.$this->texte[rand(0, $this->text_count)];
                }

                // Mettre un symbole de ponctuation (8,5% de chance)
                elseif ($this->pourcent(8.5)) {
                    $var .= (($this->bool()) ? ' !' : '...');
                }
            }
        }

        return ucfirst($var);
    }

    public function nom(): string
    {
        static $save = [];

        do {
            $nom = $this->txt();
            $nom = str_replace([' ', '!', '.'], '', $nom);
        } while (in_array($nom, $save, true));
        // Ne pas avoir 2 fois le même nom généré

        $save[] = $nom;
        return $nom;
    }

    public function nom_roster(bool $uniq = false): string
    {
        static $save = [], $roster = [
            'Cave Johnson', 'Adam Jensen', 'Chloé Price', 'Max Caufield',
            'Dana Scully', 'Fox Mulder', 'Kallen Kōzuki', 'Lelouch vi Britannia',
            'Max Payne', 'Rei Ayanami', 'Azuka Langley', 'Alice Liddell',
            'Sarah Kerrigan', 'Jim Raynor', 'Lara Croft', 'Chris Redfield', 'Jill Valentine',
            'Corvo Attano', 'Emily Kaldwin', 'Zoey Chell', 'Setsuna F.Seiei',
            'Heero Yuy', 'Zechs Merquise', 'Asran Zala', 'Kira Yamato',
            'Eric Cartman', 'Stanley March', 'Kenny Mckornick', 'Butters Stoch',
            'Meyrin Stella', 'Barcley Teraknor', 'Jonathan Archer',
        ];

        if ($uniq) {
            do {
                $id_roster = rand(0, count($roster) - 1);
            } while (in_array($id_roster, $save, true));
        } else {
            $id_roster = rand(0, count($roster) - 1);
        }

        return $roster[$id_roster];
    }

    public function mail(?string $domain = null): string
    {
        static $save = [];

        if (empty($domain)) {
            if (!empty($_SERVER['HTTP_HOST']) && 'localhost' !== $_SERVER['HTTP_HOST']) {
                $domain = $_SERVER['HTTP_HOST'];
            } else {
                $domain = 'random.org';
            }
        }

        do {
            $nom = $this->txt();
            $nom = str_replace([' ', '!', '.'], '-', $nom);
            $mail = mb_strtolower($nom).'@'.$domain;
        } while (in_array($mail, $save, true));
        // Ne pas avoir 2 fois le même nom généré

        return  $save[] = $mail;
    }

    public function mail_roster(?string $domain = null): string
    {
        static $save = [];

        if (empty($domain)) {
            if (!empty($_SERVER['HTTP_HOST']) && 'localhost' !== $_SERVER['HTTP_HOST']) {
                $domain = $_SERVER['HTTP_HOST'];
            } else {
                $domain = 'random.org';
            }
        }

        do {
            $nom = $this->nom_roster(false);
            $nom = str_replace([' ', '!', '.'], '-', $nom);
            $mail = mb_strtolower($nom).'@'.$domain;
        } while (in_array($mail, $save, true));
        // Ne pas avoir 2 fois le même nom généré

        $save[] = $mail;
        return $mail;
    }

    /**
     * Random User API: https://randomuser.me/documentation#howto.
     */
    public function identite(): array
    {
        $args = ['ssl' => ['verify_peer' => false]];

        // Proxy support
        if (defined('PROXY_HOST') && PROXY_HOST !== '') {
            $args['http'] = ['proxy' => 'tcp://'.PROXY_HOST, 'request_fulluri' => true];
            if (defined('PROXY_PORT') && PROXY_PORT !== '') {
                $args['http']['proxy'] .= ':'.PROXY_PORT;
            }

            // Auth suport
            if (defined('PROXY_USERNAME') && PROXY_USERNAME !== '') {
                $auth = PROXY_USERNAME;
                if (defined('PROXY_PASSWORD') && PROXY_PASSWORD !== '') {
                    $auth .= ':'.PROXY_PASSWORD;
                }

                $args['http']['header'] = 'Proxy-Authorization: Basic '.base64_encode($auth);
            }
        }
        $url = 'https://randomuser.me/api/?nat=us,ca,fr,gb,de';
        $json = file_get_contents($url, false, stream_context_create(['ssl' => ['verify_peer' => false]]));

        $json = json_decode($json, true);

        return $json['results'][0];
    }

    public function identite_roster(?string $mail_domain = null): array
    {
        static $save = [];

        if (empty($mail_domain)) {
            if (!empty($_SERVER['HTTP_HOST']) && 'localhost' !== $_SERVER['HTTP_HOST']) {
                $mail_domain = $_SERVER['HTTP_HOST'];
            } else {
                $mail_domain = 'random.org';
            }
        }

        do {
            $nom_roster = $this->nom_roster(false);
            $nom = str_replace([' ', '!', '.'], '-', $nom_roster);
            $mail = mb_strtolower($nom).'@'.$mail_domain;
        } while (in_array($mail, $save, true));
        // Ne pas avoir 2 fois le même nom généré

        $save[] = $mail;

        preg_match('#^([^ ]+) ([^$]+)#i', $nom_roster, $extract);
        $identite = [
            'firstname' => $extract[1],
            'lastname' => $extract[2],
            'mail' => $mail,
            'address' => $this->adresse(),
            'city' => $this->city(),
            'country' => $this->country(),
            'birthday' => $this->date(null, 480272054, 1068090063),
            'website' => $this->url(),
        ];

        return $identite;
    }

    public function txt_phrase(int $nb = 1): string
    {
        static $save = [];
        $text = '';
        if ($nb > $this->phrase_count) {
            $nb = $this->phrase_count;
        }

        for ($i = 0; $i < $nb; ++$i) {
            do {
                $random = rand(0, $this->phrase_count);
            } while (in_array($random, $save, true));

            $save[] = $random;
            $text .= $this->phrase[$random].'. ';
        }

        return $text;
    }

    public function txt_paragraphe(int $nb = 1): string
    {
        $text = '';

        for ($i = 0; $i < $nb; ++$i) {
            $text .= $this->txt_phrase(4)."\n\n";
        }

        return $text;
    }

    public function timestamp(?int $debut = null, ?int $fin = null): int
    {
        $debut = ((!empty($debut) && is_numeric($debut)) ? $debut : 0);
        $fin = ((!empty($fin) && is_numeric($fin)) ? $fin : time());

        return  rand($debut, $fin);
    }

    public function date(?string $type = null, ?int $debut = null, ?int $fin = null): string
    {
        $type = ((!empty($type)) ? $type : 'd/m/Y');

        return  date($type, $this->timestamp($debut, $fin));
    }

    public function image(int $width = 400, int $height = 300): string
    {
        $url = "https://picsum.photos/{$width}/{$height}/?random";

        return $url;
    }

    /*public function image_specimen(): string
    {
        static $list_img = null, $nb_img;

        $imgdir = 'img/specimen';
        if (null === $list_img) {
            if (!defined('ASSET_PATH') || !defined('ASSET_URL')) {
                throw new InvalidArgumentException('Require mindev app init');
            }

            $files = glob(ASSET_PATH."/{$imgdir}/*.*");
            foreach ($files as $img) {
                if (preg_match('#\.(jpe?g|png|gif)$#i', $img)) {
                    $info = getimagesize($img);
                    $list_img[] = [
                        'path' => $img,
                        'url' => 'http://localhost'.str_replace(ASSET_PATH, ASSET_URL, $img),
                        'relative_url' => str_replace(ASSET_PATH, ASSET_URL, $img),
                        'width' => $info[0],
                        'height' => $info[1],
                        'mime' => $info['mime'],
                        'bits' => $info['bits'],
                        'channels' => ((isset($info['channels'])) ? $info['channels'] : null),
                    ];
                }
            }

            $nb_img = count($list_img);
        }

        return $list_img[rand(0, $nb_img - 1)];
    }*/

    public function url(): string
    {
        $url = (($this->bool()) ? 'https://' : 'http://');
        $url .= (($this->bool()) ? 'www.' : null);
        $url .= preg_replace('#[^a-z0-9]+#', '-', mb_strtolower($this->txt()));

        switch (rand(0, 4)) {
            case 0:  $url .= '.net'; break;
            case 1:  $url .= '.org'; break;
            case 2:  $url .= '.fr'; break;
            case 3:  $url .= '.ca'; break;
            default: $url .= '.com'; break;
        }

        return $url;
    }

    public function nbplus(): int
    {
        static $n = 0;

        return $n++;
    }

    public function password(int $max = 7): string
    {
        // The letter O (uppercase o) and the number 0 have been removed
        // The letter l (lowercase L) and the number 1 have been removed
        // --> as they can be mistaken for each other.
        $chars = 'abcdefghijkmnopqrstuvwxyz';
        $chars .= $chars.'ABCDEFGHIJKLMNPQRSTUVWXYZ23456789';

        srand((float) microtime() * 1000000);

        $password = '';
        for ($i = 0; $i <= $max; ++$i) {
            $password .= mb_substr($chars, rand() % 33, 1);
        }

        return $password;
    }

    public function code(int $max = 7, ?string $first_letter = null): string
    {
        // The letter O (uppercase o) and the number 0 have been removed
        // --> as they can be mistaken for each other.
        static $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        srand((float) microtime() * 1000000);

        do {
            $code = '';

            for ($i = 1; $i <= $max; ++$i) {
                $code .= mb_substr($chars, rand() % 33, 1);
            }

            if (!empty($first_letter)) {
                $code = $first_letter.$code;
                $code = mb_substr($code, 0, $max);
            }
        } while (in_array($code, $this->code_list, true));
        // Ne pas avoir 2 fois le même code généré

        $this->code_list[] = $code;
        return $code;
    }

    public function liste(string $index = '0'): string
    {
        $randKey = rand(0, count($this->liste[$index]) - 1);
        return $this->liste[$index][$randKey];
    }

    public function set_liste(array $array, string $index = '0'): self
    {
        $this->liste[$index] = $array;

        return $this;
    }

    public function status(): string
    {
        static $status = ['open', 'pending', 'resolved', 'closed'];

        return $status[rand(0, count($status) - 1)];
    }

    public function city(): string
    {
        static $ville = [
            // France
            'Paris', 'Marseille', 'Lyon', 'Lille', 'Nice', 'Toulouse', 'Bordeaux', 'Nantes', 'Toulon', 'Stratsbourg',

            // Canada
            'Belleville', 'Barrie', 'Chilliwack', 'Fredericton', 'Fort McMurray', 'Gatineau', 'Vancouver', 'Toronto',

            // US
            'New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphie', 'San Antonio', 'San Diego', 'Dallas',
        ];

        return $ville[rand(0, count($ville) - 1)];
    }

    public function country(): string
    {
        static $country = ['Chine', 'Etats-Unis', 'Inde', 'Indonesie', 'Bresil', 'Pakistan', 'Russie', 'Japon', 'Allemagne', 'France', 'Canada'];

        return $country[rand(0, count($country) - 1)];
    }

    public function adresse(): string
    {
        static $rue = ['rue', 'boulevard', 'avenue', 'place'];

        return  rand(1, 155).' '.$rue[rand(0, count($rue) - 1)].' '.$this->txt();
    }

    public function wysiwyg(): string
    {
        $nb_line = rand(3, 5);
        $data = [];

        for ($i = 0; $i < $nb_line; ++$i) {
            switch (rand(0, 2)) {
                case 0: // text with balise
                    $txt = $this->txt_phrase(rand(5, 10));
                    preg_match_all('#([a-z0-9]{5,15})#i', $txt, $extract);
                    $nb_found = count($extract[0]);
                    $nb_edit = rand(2, (($nb_found < 5) ? $nb_found : 5));

                    for ($j = 0; $j < $nb_edit; ++$j) {
                        // Trouver un mot au hasard
                        $key = rand(0, count($extract[0]) - 1);

                        // Trouver une balise au hasard
                        switch (rand(0, 3)) {
                            case 0:
                                $balise_start = '<strong>';
                                $balise_end = '</strong>';
                                break;

                            case 1:
                                $balise_start = '<em>';
                                $balise_end = '</em>';
                                break;

                            case 2:
                                $balise_start = '<a href="'.$this->url().'">';
                                $balise_end = '</a>';
                                break;

                            case 3:
                                $balise_start = '<del>';
                                $balise_end = '</del>';
                                break;
                        }

                        // Replace
                        $word = $extract[0][$key];
                        unset($extract[0][$key]);
                        $extract[0] = array_values($extract[0]);

                        $txt = str_replace($word, "{$balise_start}{$word}{$balise_end}", $txt);
                    }

                    $data[] = "<p>{$txt}</p>";
                    break;

                case 1: // Image
                    $img = [
                        'html' => '<img src="%s" alt="%s" align="%s" style="padding: 5px;">',
                        'src' => $this->image(rand(200, 400), rand(200, 400)),
                        'alt' => $this->txt(),
                    ];
                    switch (rand(0, 2)) {
                        case 0:  $img['align'] = 'left'; break;
                        case 1:  $img['align'] = 'center'; break;
                        case 2:  $img['align'] = 'right'; break;
                        default: $img['align'] = null; break;
                    }

                    $txt = call_user_func_array('sprintf', $img);
                    if ('center' === $img['align']) {
                        $data[] = '<p align="center">'.str_replace('align="center" ', '', $txt).'</p>';
                    } else {
                        $data[] = "<p>{$txt}</p>";
                    }
                    break;

                case 2: // liste
                    $nb_liste = rand(3, 7);
                    $typelist = (($this->bool()) ? 'ul' : 'ol');
                    $liste = '';
                    for ($j = 0; $j < $nb_liste; ++$j) {
                        $txt = $this->txt_phrase(1);
                        $liste .= "\t<li>{$txt}</li>\n";
                    }

                    $data[] = "<{$typelist}>{$liste}</{$typelist}>";
                    break;
            }
        }

        $html = implode("\n", $data);

        return $html;
    }
}

// A implémenter dans la class
function debug_dupplicate_array($array, $nb = 50, $colonne_edit = null)
{
    if (empty($array)) {
        return false;
    }

    // Récupérer le 1er élement pour le prendre comme modèle
    $first_key = current(array_keys($array));

    // Valeur aléatoire pour certaines colonnes
    if (!empty($colonne_edit)) {
        $rand = new Generator;
        $objet = is_object($array[$first_key]);
        if (!is_array($colonne_edit)) {
            $colonne_edit = preg_split('#[ ]+#', str_replace([',', ';', "\n", "\r"], ' ', $colonne_edit));
        }

        // Base de référence
        $first = (array) $array[$first_key];
    }

    // Ajout des élements supplémentaires
    for ($i = count($array); $i < $nb; ++$i) {
        $data = clone $array[$first_key];

        // Valeur aléatoire pour certaines colonnes
        if (null !== $colonne_edit) {
            foreach ($colonne_edit as $col) {
                $val = (($objet) ? $data->$col : $data[$col]);

                switch ($val) {
                    case is_bool($val): $val = $rand->bool(); break;
                    case $val === (string) (float) $val: $val = $rand->float(mb_strlen($first[$col])); break;

                    case $val === (string) (int) $val: $val = $rand->int(mb_strlen($first[$col])); break;
                    case is_array($val): case is_object($val): break; // Ne rien faire

                    default:  $val = $rand->nom(); break;
                }

                if ($objet) {
                    $data->$col = $val;
                } else {
                    $data[$col] = $val;
                }
            }
        }

        $array[] = $data;
    }

    return $array;
}
