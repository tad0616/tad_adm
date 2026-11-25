<?php // adminer-plugins.php
if (!class_exists('AdminerTablesHistory')) {
    http_response_code(403);
    exit('Restricted access');
}
return [
    new AdminerTablesHistory(),
    new AdminerTablesFilter(),
    new AdminerPrettyJsonColumn(),
    new AdminerJsonPreview(),
    new AdminerDumpJson(),
    new AdminerDumpPhp(),
    new AdminerDumpDate(),
    new AdminerDumpZip(),
    new AdminerColorfields(),
    new AdminerRestoreMenuScroll(),
    new AdminerReadableDates(),
    new AdminerBackwardKeys(),
    new AdminerShowColumnComment(),
    new AdminerFavoriteQuery(),
    new AdminerImagefields(),
    new searchAutocomplete(),
];
