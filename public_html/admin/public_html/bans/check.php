<?php
require_once './inc/page.php';

class Check {
    public function run($name, $from) {
        $page = new Page("check", false);

        $column = "name";

        // validate user input
        if ($page->is_uuid($name) && preg_match("/^[0-9a-zA-Z-]{32,36}$/", $name)) {
            $column = "uuid";
            $name = $page->uuid_dashify($name);
        } else if (strlen($name) > 16 || !preg_match("/^[0-9a-zA-Z_]{1,16}$/", $name)) {
            $this->println($page->t("error.name.invalid"));
            return;
        }
        $history = $page->settings->table['history'];

        try {
            $stmt = $page->conn->prepare("SELECT name,uuid FROM $history WHERE $column=:val ORDER BY date LIMIT 1");
            $stmt->bindParam(':val', $name, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if ($row = $stmt->fetch()) {
                    $name = $row['name'];
                    $uuid = $row['uuid'];
                }
            }
            $stmt->closeCursor();

            // sanitize $_POST['table'] ($from)
            $from_type = $page->type_info($from);
            $type = $from_type['type'];

            if (!isset($uuid)) {
                if (filter_var($name, FILTER_VALIDATE_FLOAT)) {
                    echo "<br>";
                    redirect("info.php?id=$name&type=$type", false);
                    return;
                }
                $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
                $this->println(str_replace("{name}", $name, $page->t("error.name.unseen")));
                return;
            }
            $uuid = $page->uuid_undashify($uuid);
            $href = "history.php?uuid=$uuid";

            if ($type !== null) {
                $href .= "&from=" . Page::lc_first($from_type['title']);
            }

            echo "<br>";
            redirect($href, false);
            /*
            $table = $page->settings->table['bans'];

            $stmt = $page->conn->prepare("SELECT * FROM $table WHERE (uuid=? AND active=" . Settings::$TRUE . ") LIMIT 1");
            if ($stmt->execute(array($uuid))) {
                if (!($row = $stmt->fetch())) {
                    $this->println("$name is not banned.");
                    return;
                }
                $banner = $page->get_banner_name($row);
                $reason = $page->clean($row['reason']);
                $time = $page->millis_to_date($row['time']);
                $until = $page->millis_to_date($row['until']);

                $this->println("$name is banned!");
                $this->println("Banned by: $banner");
                $this->println("Reason: $reason");
                $this->println("Banned on: $time");
                if ($row['until'] > 0) {
                    $this->println("Banned until: $until");
                } else {
                    $this->println("Banned permanently.");
                }
            }
            $stmt->closeCursor();
            */
        } catch (PDOException $ex) {
            Settings::handle_error($page->settings, $ex);
        }
    }

    function println($line) {
        echo "<br>$line<br>";
    }
}

if (isset($_GET['name'], $_GET['table']) && is_string($_GET['name']) && is_string($_GET['table'])) {
    $check = new Check();
    $check->run($_GET['name'], $_GET['table']);
}
