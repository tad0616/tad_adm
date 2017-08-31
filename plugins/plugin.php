<?php

/** Adminer customization allowing usage of plugins
* @link http://www.adminer.org/plugins/#use
* @author Jakub Vrana, http://www.vrana.cz/
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerPlugin extends Adminer
{
    /** @access protected */
    public $plugins;
    
    public function _findRootClass($class)
    { // is_subclass_of(string, string) is available since PHP 5.0.3
        do {
            $return = $class;
        } while ($class = get_parent_class($class));
        return $return;
    }
    
    /** Register plugins
    * @param array object instances or null to register all classes starting by 'Adminer'
    */
    public function AdminerPlugin($plugins)
    {
        if ($plugins === null) {
            $plugins = array();
            foreach (get_declared_classes() as $class) {
                if (preg_match('~^Adminer.~i', $class) && strcasecmp($this->_findRootClass($class), 'Adminer')) { //! can use interface
                    $plugins[$class] = new $class;
                }
            }
        }
        $this->plugins = $plugins;
        //! it is possible to use ReflectionObject to find out which plugins defines which methods at once
    }
    
    public function _callParent($function, $args)
    {
        return call_user_func_array(array('parent', $function), $args);
    }
    
    public function _applyPlugin($function, $args)
    {
        foreach ($this->plugins as $plugin) {
            if (method_exists($plugin, $function)) {
                switch (count($args)) { // call_user_func_array() doesn't work well with references
                    case 0: $return = $plugin->$function(); break;
                    case 1: $return = $plugin->$function($args[0]); break;
                    case 2: $return = $plugin->$function($args[0], $args[1]); break;
                    case 3: $return = $plugin->$function($args[0], $args[1], $args[2]); break;
                    case 4: $return = $plugin->$function($args[0], $args[1], $args[2], $args[3]); break;
                    case 5: $return = $plugin->$function($args[0], $args[1], $args[2], $args[3], $args[4]); break;
                    case 6: $return = $plugin->$function($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]); break;
                    default: trigger_error('Too many parameters.', E_USER_WARNING);
                }
                if ($return !== null) {
                    return $return;
                }
            }
        }
        return $this->_callParent($function, $args);
    }
    
    public function _appendPlugin($function, $args)
    {
        $return = $this->_callParent($function, $args);
        foreach ($this->plugins as $plugin) {
            if (method_exists($plugin, $function)) {
                $return += call_user_func_array(array($plugin, $function), $args);
            }
        }
        return $return;
    }
    
    // appendPlugin
    
    public function dumpFormat()
    {
        $args = func_get_args();
        return $this->_appendPlugin(__FUNCTION__, $args);
    }
    
    public function dumpOutput()
    {
        $args = func_get_args();
        return $this->_appendPlugin(__FUNCTION__, $args);
    }

    public function editFunctions()
    {
        $args = func_get_args();
        return $this->_appendPlugin(__FUNCTION__, $args);
    }

    // applyPlugin
    
    public function name()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function credentials()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function permanentLogin()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function database()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function schemas()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function databases()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function queryTimeout()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function headers()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function head()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function loginForm()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function login()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function tableName()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function fieldName()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLinks()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function foreignKeys()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function backwardKeys()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function backwardKeysPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectQuery()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function rowDescription()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function rowDescriptions()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLink()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectVal()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function editVal()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectColumnsPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectSearchPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectOrderPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLimitPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLengthPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectActionPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectCommandPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectImportPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectEmailPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectColumnsProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectSearchProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectOrderProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLimitProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectLengthProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectEmailProcess()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function selectQueryBuild()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function messageQuery()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function editInput()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function processInput()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function dumpDatabase()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function dumpTable()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function dumpData()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function dumpFilename()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function dumpHeaders()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function homepage()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function navigation()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function databasesPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }

    public function tablesPrint()
    {
        $args = func_get_args();
        return $this->_applyPlugin(__FUNCTION__, $args);
    }
}
