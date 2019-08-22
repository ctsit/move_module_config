<?php

namespace EMCC\ExternalModule;

use ExternalModules\AbstractExternalModule;
use REDCap;

class ExternalModule extends AbstractExternalModule {

    function collectModules() {
        // fetch module id to name mappings
        $sql = "SELECT * FROM redcap_external_modules;";
        $result = $this->query($sql);
        $module_mapping = [];

        while ($row = db_fetch_assoc($result)) {
            $module_mapping[$row['directory_prefix']] = $row['external_module_id'];
        }
        return $module_mapping;
    }

    function collectModuleSettings($external_module_id = NULL, $project_id = NULL) {
        $sql = "SELECT * FROM redcap_external_module_settings";
        $sql .= ($external_module_id) ? " WHERE external_module_id = '" . $external_module_id . "'" : "";
        $sql .= ($project_id) ? " AND project_id = '" . $project_id . "'" : "";
        $sql .= ";"; 
        $result = $this->query($sql);
        $module_settings = [];

        while ($row = db_fetch_assoc($result)) {
            $module_settings[$row['key']] = $row['value'];
        }
        return $module_settings;
    }
}
