<?php
session_start();
include 'bdd.php';
include 'func_getprofile.php';
global $bdh;

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

$lang = array();
$lang['LANGUAGE'] = 'English';
$lang['AUTHOR'] = 'ChimpGamer';

$lang['TITLE_HOME'] = 'Home';
$lang['TITLE_BANS'] = 'Bans';
$lang['TITLE_MUTES'] = 'Mutes';
$lang['TITLE_KICKS'] = 'Kicks';
$lang['TITLE_WARNS'] = 'Warns';

$lang['VARIABLE_BAN'] = 'Ban';
$lang['VARIABLE_MUTE'] = 'Mute';
$lang['VARIABLE_KICK'] = 'Kick';
$lang['VARIABLE_WARN'] = 'Warn';
$lang['VARIABLE_PLAYERNAME'] = 'Playername';
$lang['VARIABLE_PUNISHER'] = 'Punisher';
$lang['VARIABLE_UNBANNEDBY'] = 'Unbanned by';
$lang['VARIABLE_DATE'] = 'Date';
$lang['VARIABLE_ENDS'] = 'Ends';
$lang['VARIABLE_REASON'] = 'Reason';
$lang['VARIABLE_BANNED_ON'] = 'Banned on';
$lang['VARIABLE_BANNED_UNTIL'] = 'Banned until';
$lang['VARIABLE_MUTED_ON'] = 'Muted on';
$lang['VARIABLE_MUTED_UNTIL'] = 'Muted until';
$lang['VARIABLE_JOINED'] = 'Joined';
$lang['VARIABLE_LASTLOGIN'] = 'Last login';
$lang['VARIABLE_LASTLOGOUT'] = 'Last logout';
$lang['VARIABLE_TOTALPLAYTIME'] = 'Total playtime';
$lang['VARIABLE_CURRENTMINECRAFTVERSION'] = 'Current Minecraft version';
$lang['VARIABLE_ALTERNATIVEACCOUNTS'] = 'Alternative accounts';
$lang['VARIABLE_NAMEHISTORY'] = 'Name history';
$lang['VARIABLE_INFORMATION'] = 'Information';
$lang['VARIABLE_PUNISHMENTS'] = 'Punishments';
$lang['VARIABLE_PERMANENT'] = 'Permanent';
$lang['VARIABLE_IPBAN'] = 'IP-Ban';
$lang['VARIABLE_TEMPIPBAN'] = 'Temp IP-Ban';
$lang['VARIABLE_IPMUTE'] = 'IP-Mute';
$lang['VARIABLE_TEMPIPMUTE'] = 'Temp IP-Mute';
$lang['VARIABLE_SERVER'] = 'Server';
$lang['VARIABLE_STATUS'] = 'Status';
$lang['VARIABLE_GLOBAL'] = 'Global';
$lang['VARIABLE_ACTIVE'] = 'ACTIVE';
$lang['VARIABLE_EXPIRED'] = 'EXPIRED';

$lang['PLACEHOLDER_SEARCH'] = 'Search player...';

$lang['MESSAGE_NORESULTS'] = 'No results could be displayed';
$lang['MESSAHE_404'] = '404 Error Page';
$lang['MESSAHE_404_PAGENOTFOUND'] = 'Oops! Page not found!';
$lang['MESSAHE_404_1STLINE'] = 'Unfortunately we could not find the page you were looking for.';
$lang['MESSAHE_404_2NDLINE'] = "Try to <a href='home'>return to home.</a>";
$lang['MESSAHE_UNOFFICIALSNAPSHOT'] = 'unofficial snapshot';
$lang['MESSAGE_HOME_HEADLINE'] = 'Welcome to the NetworkManager Ban List.';
$lang['MESSAGE_HOME_1STLINE'] = 'This site contains a list of all punishments by NetworkManager.';
$lang['MESSAGE_HOME_2NDLINE'] = ''; //Empty is disable
$lang['MESSAGE_HOME_3RDLINE'] = ''; //Empty is disable
$lang['MESSAGE_HOME_TOTALPUNISHMENTS'] = 'Total punishments:';
$lang['MESSAGE_NEXTPAGE'] = 'Next page';
$lang['MESSAGE_PREVIOUSPAGE'] = 'Previous page';



function getName($uuid, $bdh) {
    if ($uuid == 'f78a4d8d-d51b-4b39-98a3-230f2de0c670') {
        return 'Console';
    }
    $sql = 'SELECT username FROM nm_players WHERE uuid=?';
    $statement = $bdh->prepare($sql);
    $statement->bindParam(1, $uuid, PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetch();
    return $row['username'];
}


function getRankPlayer($uuid, $bdh){
    $rangColor = '';
    if ($uuid == 'f78a4d8d-d51b-4b39-98a3-230f2de0c670') {
        $rangColor = '<div style="color:orangered !important;"> ' . '[ C ]' . '</div>';
    }else{
            $getParams3 = $bdh->prepare("SELECT * FROM luckperms_user_permissions where uuid = ?");
            $getParams3->execute(array($uuid));
            $allParamGet3 = $getParams3->fetchAll();
            foreach ($allParamGet3 as $paramGet3) {
                if (strpos($paramGet3['permission'], 'group.') !== false) {
                    $rang = ucfirst(substr($paramGet3['permission'], 6));
                    if ($rang === 'Vendeur') {
                        $rangColor = '<div> 
                            <span style="color:white">[</span>
                            <span style="color:#FFFF55 ">V</span>
                            <span style="color:#FFFF55">e</span>
                            <span style="color:#FFFF55">n</span>
                            <span style="color:#FFFF55">d</span>
                            <span style="color:#FFFF55">e</span>
                            <span style="color:#FFFF55">u</span>
                            <span style="color:#FFFF55">r</span>
                            <span style="color:white">]</span>
                </div>';
                    } else if ($rang === 'Moderateur') {
                        $rangColor = '<div> 
                            <span style="color:white">[</span>
                            <span style="color:#AA00AA ">M</span>
                            <span style="color:#AA00AA">o</span>
                            <span style="color:#AA00AA">d</span>
                            <span style="color:#AA00AA">e</span>
                            <span style="color:#AA00AA">r</span>
                            <span style="color:#AA00AA">a</span>
                            <span style="color:#AA00AA">t</span>
                            <span style="color:#AA00AA">e</span>
                            <span style="color:#AA00AA">u</span>
                            <span style="color:#AA00AA">r</span>
                            <span style="color:white">]</span>
                            </div>';
                    } else if ($rang === 'Admin') {
                        $rangColor = '<div style="color:orangered !important;"> ' . '[ Admin ]' . '</div>';
                    } else if ($rang === 'Fondateur' || $rang === 'Fondateur2') {
                        $rangColor = '<div> 
                            <span style="color:white">[</span>
                            <span style="color:#FF5555 ">F</span>
                            <span style="color:#FFAA00">o</span>
                            <span style="color:#FFFF55">n</span>
                            <span style="color:#55FF55">d</span>
                            <span style="color:#5555FF">a</span>
                            <span style="color:#55FFFF">t</span>
                            <span style="color:#AA00AA">e</span>
                            <span style="color:#FF5555">u</span>
                            <span style="color:#FFAA00">r</span>
                            <span style="color:white">]</span>
                            </div>';
                    }
                }
            }

            if ($rangColor === ''){
                $rangColor = '<div> 
                            <span style="color:white">[</span>
                            <span style="color:#55FF55 ">M</span>
                            <span style="color:#55FF55">e</span>
                            <span style="color:#55FF55">m</span>
                            <span style="color:#55FF55">b</span>
                            <span style="color:#55FF55">r</span>
                            <span style="color:#55FF55">e</span>
                            <span style="color:white">]</span>
                </div>';
            }
    }
    return $rangColor;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="L-A-Craft est un serveur dans lequel vous pourrez avoir votre métier et gagner votre argent pour vous acheter un terrain, des items, services et bien plus !">
    <meta name="robots" content="index,map,voter,wiki,status">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" type="text/css">
    <link rel="icon" type="image/png" href="https://l-a-craft.fr/images/Litle-logoLADiscordSF.png">
    <title>Sanctions . L-A Craft</title>
</head>
<body>
<div class="grid">
    <?php include 'menu.php';?>
    <div class="body">
        <div class="body_punish_grid">
            <div class="punish_table_grid">
                <table class="vote_table_body table-fill">
                    <thead>
                    <tr>
                        <th class="thPunish" scope="col">Bannis</th>
                        <th class="thPunish" scope="col">Punisher</th>
                        <th class="thPunish" scope="col">Banni le</th>
                        <th class="thPunish" scope="col">Banni jusqu'au</th>
                        <th class="thPunish" scope="col">Raison</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    try {
                        $total = $bdh->query('SELECT COUNT(*) FROM nm_punishments WHERE type in (1,2,3,4,5,6,7,8)');
                        $total = $total->fetchColumn();
                        $limit = 10;
                        $pages = ceil($total / $limit);
                        $page = min($pages, filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT, array(
                            'options' => array(
                                'default' => 1,
                                'min_range' => 1,
                            ),
                        )));
                        $offset = ($page - 1) * $limit;
                        $start = $offset + 1;
                        $end = min(($offset + $limit), $total);
                        $prevlink = ($page > 1) ? '<a href="bans?p=' . ($page - 1) . '" title=' . $lang['MESSAGE_PREVIOUSPAGE'] . '><i class="material-icons-paging">keyboard_arrow_left</i></a>' : '';
                        $nextlink = ($page < $pages) ? '<a href="bans?p=' . ($page + 1) . '" title=' . $lang['MESSAGE_NEXTPAGE'] . '><i class="material-icons-paging">keyboard_arrow_right</i></a>' : '';
                        $stmt = $bdh->prepare('SELECT * FROM nm_punishments WHERE type in (1,2,3,4,5,6,7,8) ORDER BY id DESC LIMIT ? OFFSET ?');
                        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
                        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $iterator = new IteratorIterator($stmt);
                            foreach ($iterator as $row) {

                                $endban = '<span class="label label-warning">' . date("d/m/Y H:i:s", $row["end"] / 1000) . '</span>';
                                if ($row['end'] == '-1' || $row['end'] == '0') {
                                    $endban = '<span class="label label-danger">' . $lang['VARIABLE_PERMANENT'] . '</span>';
                                    if ($row['type'] == '5' || $row['type'] == '6') {
                                        $endban = '<span class="label label-danger">Permanent</span>';
                                    } elseif ($row['type'] == '7' || $row['type'] == '8') {
                                        $endban = '<span class="label label-danger">' . $lang['VARIABLE_TEMPIPBAN'] . '</span>';
                                    }
                                }
                                $thisDay = date("d/m/Y H:i:s", $row["time"] / 1000);
                                echo '<tr>
                                                <td class="tdPunish"><img draggable="false" src="https://mc-heads.net/avatar/' .  username_to_uuid(getName($row['uuid'], $bdh)) . '/30">' . getRankPlayer($row['uuid'], $bdh) .'<a class="a_punish" href="./infoPlayer.php?player=' . getName($row['uuid'], $bdh) . '">' . getName($row['uuid'], $bdh) . '</a></td>
                                                <td class="tdPunish"><img draggable="false" src="https://mc-heads.net/avatar/' . username_to_uuid(getName($row['punisher'], $bdh)) . '/30"> '. getRankPlayer($row['punisher'], $bdh) .'<a class="a_punish" href="./infoPlayer.php?player=' . getName($row['punisher'], $bdh) . '">' . getName($row['punisher'], $bdh) .'</td>
                                                <td class="tdPunish">' .  $thisDay  . '</td>
                                                <td class="tdPunish">' . $endban . '</td>
                                                <td class="tdreason tdPunish">' . MinecraftColorcodes::convert($row['reason'], true) . '</td>
                                                </tr>';
                            }

                        } else {
                            echo '<p>' . $lang['MESSAGE_NORESULTS'] . '</p>';
                        }
                    } catch (Exception $e) {
                        echo '<p>' . $lang['MESSAGE_NORESULTS'] . '</p>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include 'footer.php';?>
    </div>
</body>
<script src="js/50cab66c4a.js" crossorigin="anonymous" async defer></script>
<script src="js/jquery.min.js"></script>
<script src="js/getPlayer.js"></script>
</html>