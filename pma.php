<?php
function adminer_object()
{
    // required to run any plugin
    include_once "./plugins/plugin.php";

    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }

    // enable extra drivers just by including them
    //~ include "./plugins/drivers/simpledb.php";

    $plugins = array(
        // specify enabled plugins here
        new AdminerTablesHistory,
        new FasterTablesFilter,
        new AdminerJsonPreview,
        new AdminerSimpleMenu,
        new AdminerDumpJson,
        new AdminerDumpZip,
        new AdminerDumpDate,
        new AdminerJsonColumn,
        new AdminerDumpArray,
        new AdminerColorfields,
        new AdminerEnumOption(),
        // new AdminerFileUpload("data/"),
        // new AdminerTranslation(),
        // new AdminerForeignSystem(),
    );

    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
     */

    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
