<?php

class Lang {
    public function __construct() {
        $array = array();
        $this->array = &$array;
        $array["index.welcome.main"] = "Sveiki Atvyke į {server} Nuobaudų Sąrašą";
        $array["index.welcome.sub"] = "Čia galite matyti visas Nuobaudas.";

        $array["title.index"] = 'Pagrindinis';
        $array["title.bans"] = 'Blokavimai';
        $array["title.mutes"] = 'Užtildymai';
        $array["title.warnings"] = 'Įspėjimai';
        $array["title.kicks"] = 'Išmetimai';
        $array["title.player-history"] = "Naujausios nuobaudos žaidėjui {name}";
        $array["title.staff-history"] = "Naujausiai paskirtos nuobaudos autorius {name}";


        $array["generic.ban"] = "Užblokavimas";
        $array["generic.mute"] = "Užtildymas";
        $array["generic.warn"] = "Įspėjimas";
        $array["generic.kick"] = "Išmetimas";

        $array["generic.banned"] = "Užblokuotas";
        $array["generic.muted"] = "Užtildytas";
        $array["generic.warned"] = "Įspėtas";
        $array["generic.kicked"] = "Išmestas";

        $array["generic.banned.by"] = "Užblokavimo Autorius";
        $array["generic.muted.by"] = "Užtildymo Autorius";
        $array["generic.warned.by"] = "Įspėjimo Autorius";
        $array["generic.kicked.by"] = "Išmetimo Autorius";

        $array["generic.ipban"] = "IP " . $array["generic.ban"];
        $array["generic.ipmute"] = "IP " . $array["generic.mute"];

        $array["generic.permanent"] = "Permanentinis";
        $array["generic.permanent.ban"] = $array['generic.permanent'] . ' ' . $array["generic.ban"];
        $array["generic.permanent.mute"] = $array['generic.permanent'] . ' ' . $array["generic.mute"];

        $array["generic.type"] = "Tipas";
        $array["generic.active"] = "Aktyvus";
        $array["generic.inactive"] = "Ne aktyvuas";
        $array["generic.expired"] = "Nebegalioja";
        $array["generic.player-name"] = "Žaidėjas";

        $array["page.expired.ban"] = '(Atblokuotas)';
        $array["page.expired.ban-by"] = '(Atblokuotas autorius {name})';
        $array["page.expired.mute"] = '(Atitildytas)';
        $array["page.expired.mute-by"] = '(Atitildytas Autorius {name})';
        $array["page.expired.warning"] = '(' . $array["generic.expired"] . ')';

        $array["table.player"] = $array["generic.player-name"];
        $array["table.type"] = $array["generic.type"];
        $array["table.executor"] = "Moderatorius";
        $array["table.reason"] = "Priežastis";
        $array["table.date"] = "Data";
        $array["table.expires"] = "Baigiasi";
        $array["table.received-warning"] = "Gautas Įspėjimas";

        $array["table.server.name"] = "Serveris";
        $array["table.server.scope"] = "Server Scope";
        $array["table.server.origin"] = "Originalus Serveris";
        $array["table.server.global"] = "*";
        $array["table.pager.number"] = "puslapis";

        $array["action.check"] = "Tikrinti";
        $array["action.return"] = "Sugrįžti į {origin}";

        $array["error.missing-args"] = "Truksta Argumentų.";
        $array["error.name.unseen"] = "{name} nebuvo prisijunges.";
        $array["error.name.invalid"] = "Netinkamas Vardas.";
        $array["history.error.uuid.no-result"] = "Nuobaudų nerastą.";
        $array["info.error.id.no-result"] = "Error: {type} not found in database.";
    }
}
