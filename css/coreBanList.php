<?php
include 'config.php';

ini_set("allow_url_fopen", 1);

$type = $_GET['type'];

function getName($uuid) {
    if ($uuid == 'f78a4d8d-d51b-4b39-98a3-230f2de0c670') {
        return 'Console';
    }
    global $pdo;
    $sql = 'SELECT username FROM nm_players WHERE uuid=?';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(1, $uuid, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();
    return $row['username'];
}

function getUUID($name) {
    global $pdo;
    $sql = 'SELECT uuid FROM nm_players WHERE username=?';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(1, $name, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();
    return $row['uuid'];
}

function getPlayerNames() {
    global $pdo;
    $result = "[";
    $data_result = $pdo->query('SELECT username, uuid FROM nm_players');
    $data = array();
    foreach ($data_result as $row){
        $data[] = $row;
        $result = $result . '{name: "' . $row['username'] . '", icon: "https://crafatar.com/avatars/' . $row['uuid'] . '?size=20&overlay"}, ' ;
    }
    $result = $result . "]";
    return $result;
}

function echoSelectedClassIfRequestMatches($requestUri) {
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}

function getCurrentMinecraftVersion($id) {
    switch($id) {
        case '340':
            return '1.12.2';
            break;
        case '338':
            return '1.12.1';
            break;
        case '335':
            return '1.12';
            break;
        case '316':
            return '1.11.2';
            break;
        case '315':
            return '1.11';
            break;
        case '210':
            return '1.10 - 1.10.2';
            break;
        case '110':
            return '1.9.3 - 1.9.4';
            break;
        case '109':
            return '1.9.2';
            break;
        case '108':
            return '1.9.1';
            break;
        case '107':
            return '1.9';
            break;
        case '47':
            return '1.8 - 1.8.9';
            break;
        case '5':
            return '1.7.6 - 1.7.10';
            break;
        case '4':
            return '1.7.2 - 1.7.5';
            break;
        default:
            return 'snapshot';
            break;
    }
}

function getPlayerData($uuid) {
    global $pdo;
    $data = array();
    $stmnt = $pdo->prepare('SELECT username, firstlogin, lastlogin, lastlogout, version, playtime, ip FROM nm_players WHERE uuid=?');
    $stmnt->bindParam(1, $uuid, 2);
    $stmnt->execute();
    if($stmnt->rowCount() == 0) {
        $data['STATUS'] = 'false';
        return $data;
    }
    $result = $stmnt->fetch(2);
    $data['STATUS'] = 'true';
    $data['username'] = $result['username'];
    $data['firstlogin'] = $result['firstlogin'];
    $data['lastlogin'] = $result['lastlogin'];
    $data['lastlogout'] = $result['lastlogout'];
    $data['version'] = $result['version'];
    $data['playtime'] = $result['playtime'];
    $data['ip'] = $result['ip'];
    return $data;
}

function getSecondAccounts($ip, $uuid) {
    global $pdo;
    $stmnt = $pdo->prepare('SELECT uuid, username FROM nm_players WHERE ip=?');
    $stmnt->bindParam(1, $ip, 2);
    $stmnt->execute();
    if($stmnt->rowCount() > 0) {
        $res = "";
        $data = $stmnt->fetchAll();
        foreach ($data as $item) {
            if($item['uuid'] !== $uuid) {
                $res = $res . '<a style="color: #039BE5 !important;" href="player?name=' . $item['username'] . '" player="' . $item['uuid'] . '">' . $item['username'] . '</a> ';
            }
        }
        return $res;
    }
    return '-';
}

function getTotalPlaytime($time) {
    global $pdo;
    $count = 'null';
    $stmnt = $pdo->prepare('SELECT count(playtime) FROM nm_players WHERE uuid=? as playtime');
    $stmnt->bindParam(1, $uuid, 2);
    $stmnt->execute();
    $data = $stmnt->fetch(2);
    $count = number_format(
        ((($data['count(playtime)']/1000)/60)/60),
        2,
        ".",
        " "
    );
    return $count;
}

function formatMilliseconds($milliseconds) {
    $seconds = floor($milliseconds / 1000);
    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    $milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;

    $format = '%u:%02u:%02u';
    $time = sprintf($format, $hours, $minutes, $seconds, $milliseconds);
    return rtrim($time, '0');
}

function getNameHistory($uuid) {
    if ($uuid == '') {
        return 'N/A';
    } else {
        $input = 'https://api.mojang.com/user/profiles/' . minifyUuid($uuid) . '/names';
        $content = json_decode(file_get_contents($input));
        $name = $content[0]->name;
        return $name;
    }
}

function minifyUuid($uuid) {
    if (is_string($uuid)) {
        $minified = str_replace('-', '', $uuid);
        if (strlen($minified) === 32) {
            return $minified;
        }
    }
    return false;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: player?name=' . $_POST['playername']);
}

$bannedPlayers = $pdo->query('SELECT COUNT(*) FROM nm_punishments WHERE type in (1,2,3,4,5,6,7,8)');
$banned = $bannedPlayers->fetchColumn();

$mutedPlayers = $pdo->query('SELECT COUNT(*) FROM nm_punishments WHERE type in (9,10,11,12,13,14,15,16)');
$muted = $mutedPlayers->fetchColumn();

$kickedPlayers = $pdo->query('SELECT COUNT(*) FROM nm_punishments WHERE type in (17,18)');
$kicked = $kickedPlayers->fetchColumn();

$warnedPlayers = $pdo->query('SELECT COUNT(*) FROM nm_punishments WHERE type = 19');
$warned = $warnedPlayers->fetchColumn();

$punishmentstotal += $banned + $muted + $kicked + $warned;

if ($type == 'getplayernames') {
    header('Content-Type: application/json');
    $search = $_GET['q'];
    $query = '%' . $search . '%';

    global $pdo;
    $result = '[';
    $stmnt = $pdo->prepare('SELECT uuid,username FROM nm_players WHERE username LIKE ?');
    $stmnt->bindParam(1, $query, 2);
    $stmnt->execute();
    $data_result = $stmnt->fetchAll();
    foreach ($data_result as $row) {
        $result = $result . '{"name":"' . $row['username'] . '", "icon":"https://crafatar.com/avatars/' . $row['uuid'] . '?size=20"}, ';
    }
    $result = substr_replace($result, "", -1);
    $result = substr_replace($result, "", -1);
    $result .= ']';
    echo $result;
} else if ($type == 'totalpunishments') {
    echo json_encode($punishmentstotal);
} else if ($type == 'totalbans') {
    echo json_encode($banned);
} else if ($type == 'totalmutes') {
    echo json_encode($muted);
} else if ($type == 'totalkicks') {
    echo json_encode($kicked);
} else if ($type == 'totalwarns') {
    echo json_encode($warned);
}

/* -------- Classes -------- */

class MinecraftColorcodes {
    const REGEX = '/(?:ยง|&amp;)([0-9a-fklmnor])/i';
    const START_TAG  = '<span style="%s">';
    const CLOSE_TAG  = '</span>';
    const CSS_COLOR  = 'color: #';
    const EMPTY_TAGS = '/<[^\/>]*>([\s]?)*<\/[^>]*>/';
    const LINE_BREAK = '<br />';
    static private $colors = array(
        '0' => '000000', //Black
        '1' => '0000AA', //Dark Blue
        '2' => '00AA00', //Dark Green
        '3' => '00AAAA', //Dark Aqua
        '4' => 'AA0000', //Dark Red
        '5' => 'AA00AA', //Dark Purple
        '6' => 'FFAA00', //Gold
        '7' => 'AAAAAA', //Gray
        '8' => '555555', //Dark Gray
        '9' => '5555FF', //Blue
        'a' => '55FF55', //Green
        'b' => '55FFFF', //Aqua
        'c' => 'FF5555', //Red
        'd' => 'FF55FF', //Light Purple
        'e' => 'FFFF55', //Yellow
        'f' => 'FFFFFF'  //White
    );
    static private $formatting = array(
        'k' => '',                               //Obfuscated
        'l' => 'font-weight: bold;',             //Bold
        'm' => 'text-decoration: line-through;', //Strikethrough
        'n' => 'text-decoration: underline;',    //Underline
        'o' => 'font-style: italic;',            //Italic
        'r' => ''                                //Reset
    );
    static private function UFT8Encode($text) {
        if (mb_detect_encoding($text) != 'UTF-8')
            $text = utf8_encode($text);
        return $text;
    }
    static public function convert($text, $line_break_element = false) {
        $text = self::UFT8Encode($text);
        $text = htmlspecialchars($text);
        preg_match_all(self::REGEX, $text, $offsets);
        $colors      = $offsets[0];
        $color_codes = $offsets[1];
        if (empty($colors))
            return $text;
        $open_tags = 0;
        foreach ($colors as $index => $color) {
            $color_code = strtolower($color_codes[$index]);
            if (isset(self::$colors[$color_code])) {
                $html = sprintf(self::START_TAG, self::CSS_COLOR.self::$colors[$color_code]);
                if ($open_tags != 0) {
                    $html = str_repeat(self::CLOSE_TAG, $open_tags).$html;
                    $open_tags = 0;
                }
                $open_tags++;
            }
            else {
                switch ($color_code) {
                    case 'r':
                        $html = '';
                        if ($open_tags != 0) {
                            $html = str_repeat(self::CLOSE_TAG, $open_tags);
                            $open_tags = 0;
                        }
                        break;
                    case 'k':
                        $html = '';
                        break;
                    default:
                        $html = sprintf(self::START_TAG, self::$formatting[$color_code]);
                        $open_tags++;
                        break;
                }
            }
            $text = preg_replace('/'.$color.'/', $html, $text, 1);
        }
        if ($open_tags != 0)
            $text = $text.str_repeat(self::CLOSE_TAG, $open_tags);
        if ($line_break_element) {
            $text = str_replace("\n", self::LINE_BREAK, $text);
            $text = str_replace('\n', self::LINE_BREAK, $text);
        }
        return preg_replace(self::EMPTY_TAGS, '', $text);
    }
}

?>