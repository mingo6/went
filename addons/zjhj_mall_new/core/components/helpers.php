<?php 

namespace app\components;

class Helpers{


    public static function iunserializer($value) {
        if (empty($value)) {
            return array();
        }
        if (!self::is_serialized($value)) {
            return $value;
        }
        $result = unserialize($value);
        if ($result === false) {
            $temp = preg_replace_callback('!s:(\d+):"(.*?)";!s', function ($matchs){
                return 's:'.strlen($matchs[2]).':"'.$matchs[2].'";';
            }, $value);
            return unserialize($temp);
        } else {
            return $result;
        }
    }


    public static function is_serialized($data, $strict = true) {
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' == $data) {
            return true;
        }
        if (strlen($data) < 4) {
            return false;
        }
        if (':' !== $data[1]) {
            return false;
        }
        if ($strict) {
            $lastc = substr($data, -1);
            if (';' !== $lastc && '}' !== $lastc) {
                return false;
            }
        } else {
            $semicolon = strpos($data, ';');
            $brace = strpos($data, '}');
                    if (false === $semicolon && false === $brace)
                return false;
                    if (false !== $semicolon && $semicolon < 3)
                return false;
            if (false !== $brace && $brace < 4)
                return false;
        }
        $token = $data[0];
        switch ($token) {
            case 's' :
                if ($strict) {
                    if ('"' !== substr($data, -2, 1)) {
                        return false;
                    }
                } elseif (false === strpos($data, '"')) {
                    return false;
                }
                    case 'a' :
            case 'O' :
                return (bool)preg_match("/^{$token}:[0-9]+:/s", $data);
            case 'b' :
            case 'i' :
            case 'd' :
                $end = $strict ? '$' : '';
                return (bool)preg_match("/^{$token}:[0-9.E-]+;$end/", $data);
        }
        return false;
    }




   /* public static function iserializer($value) {
        return self::serialize($value);
    }*/


    /*public static function serialize($value) {

        
		$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$xml .= "\n" . '<definitions';

		foreach ($this->namespaces as $k => $v ) {
			$xml .= ' xmlns:' . $k . '="' . $v . '"';
		}

		if (isset($this->namespaces['wsdl'])) {
			$xml .= ' xmlns="' . $this->namespaces['wsdl'] . '"';
		}


		if (isset($this->namespaces['tns'])) {
			$xml .= ' targetNamespace="' . $this->namespaces['tns'] . '"';
		}


		$xml .= '>';

		if (0 < sizeof($this->import)) {
			foreach ($this->import as $ns => $list ) {
				foreach ($list as $ii ) {
					if ($ii['location'] != '') {
						$xml .= '<import location="' . $ii['location'] . '" namespace="' . $ns . '" />';
					}
					 else {
						$xml .= '<import namespace="' . $ns . '" />';
					}
				}
			}
		}


		if (1 <= count($this->schemas)) {
			$xml .= "\n" . '<types>' . "\n";

			foreach ($this->schemas as $ns => $list ) {
				foreach ($list as $xs ) {
					$xml .= $xs->serializeSchema();
				}
			}

			$xml .= '</types>';
		}


		if (1 <= count($this->messages)) {
			foreach ($this->messages as $msgName => $msgParts ) {
				$xml .= "\n" . '<message name="' . $msgName . '">';

				if (is_array($msgParts)) {
					foreach ($msgParts as $partName => $partType ) {
						if (strpos($partType, ':')) {
							$typePrefix = $this->getPrefixFromNamespace($this->getPrefix($partType));
						}
						 else if (isset($this->typemap[$this->namespaces['xsd']][$partType])) {
							$typePrefix = 'xsd';
						}
						 else {
							foreach ($this->typemap as $ns => $types ) {
								if (isset($types[$partType])) {
									$typePrefix = $this->getPrefixFromNamespace($ns);
								}

							}

							if (!isset($typePrefix)) {
								exit($partType . ' has no namespace!');
							}

						}

						$ns = $this->getNamespaceFromPrefix($typePrefix);
						$localPart = $this->getLocalPart($partType);
						$typeDef = $this->getTypeDef($localPart, $ns);

						if ($typeDef['typeClass'] == 'element') {
							$elementortype = 'element';

							if (substr($localPart, -1) == '^') {
								$localPart = substr($localPart, 0, -1);
							}

						}
						 else {
							$elementortype = 'type';
						}

						$xml .= "\n" . '  <part name="' . $partName . '" ' . $elementortype . '="' . $typePrefix . ':' . $localPart . '" />';
					}
				}


				$xml .= '</message>';
			}
		}


		if (1 <= count($this->bindings)) {
			$binding_xml = '';
			$portType_xml = '';

			foreach ($this->bindings as $bindingName => $attrs ) {
				$binding_xml .= "\n" . '<binding name="' . $bindingName . '" type="tns:' . $attrs['portType'] . '">';
				$binding_xml .= "\n" . '  <soap:binding style="' . $attrs['style'] . '" transport="' . $attrs['transport'] . '"/>';
				$portType_xml .= "\n" . '<portType name="' . $attrs['portType'] . '">';

				foreach ($attrs['operations'] as $opName => $opParts ) {
					$binding_xml .= "\n" . '  <operation name="' . $opName . '">';
					$binding_xml .= "\n" . '    <soap:operation soapAction="' . $opParts['soapAction'] . '" style="' . $opParts['style'] . '"/>';

					if (isset($opParts['input']['encodingStyle']) && ($opParts['input']['encodingStyle'] != '')) {
						$enc_style = ' encodingStyle="' . $opParts['input']['encodingStyle'] . '"';
					}
					 else {
						$enc_style = '';
					}

					$binding_xml .= "\n" . '    <input><soap:body use="' . $opParts['input']['use'] . '" namespace="' . $opParts['input']['namespace'] . '"' . $enc_style . '/></input>';

					if (isset($opParts['output']['encodingStyle']) && ($opParts['output']['encodingStyle'] != '')) {
						$enc_style = ' encodingStyle="' . $opParts['output']['encodingStyle'] . '"';
					}
					 else {
						$enc_style = '';
					}

					$binding_xml .= "\n" . '    <output><soap:body use="' . $opParts['output']['use'] . '" namespace="' . $opParts['output']['namespace'] . '"' . $enc_style . '/></output>';
					$binding_xml .= "\n" . '  </operation>';
					$portType_xml .= "\n" . '  <operation name="' . $opParts['name'] . '"';

					if (isset($opParts['parameterOrder'])) {
						$portType_xml .= ' parameterOrder="' . $opParts['parameterOrder'] . '"';
					}


					$portType_xml .= '>';

					if (isset($opParts['documentation']) && ($opParts['documentation'] != '')) {
						$portType_xml .= "\n" . '    <documentation>' . htmlspecialchars($opParts['documentation']) . '</documentation>';
					}


					$portType_xml .= "\n" . '    <input message="tns:' . $opParts['input']['message'] . '"/>';
					$portType_xml .= "\n" . '    <output message="tns:' . $opParts['output']['message'] . '"/>';
					$portType_xml .= "\n" . '  </operation>';
				}

				$portType_xml .= "\n" . '</portType>';
				$binding_xml .= "\n" . '</binding>';
			}

			$xml .= $portType_xml . $binding_xml;
		}


		$xml .= "\n" . '<service name="' . $this->serviceName . '">';

		if (1 <= count($this->ports)) {
			foreach ($this->ports as $pName => $attrs ) {
				$xml .= "\n" . '  <port name="' . $pName . '" binding="tns:' . $attrs['binding'] . '">';
				$xml .= "\n" . '    <soap:address location="' . $attrs['location'] . (($debug ? '?debug=1' : '')) . '"/>';
				$xml .= "\n" . '  </port>';
			}
		}


		$xml .= "\n" . '</service>';
		return $xml . "\n" . '</definitions>';


    }*/





	

    //define('CACHE_KEY_MODULE_SETTING', 'module_setting:%s:%s');
    public static function cache_system_key($cache_key) {
        $args = func_get_args();
        switch (func_num_args()) {
            case 1:
                break;
            case 2:
                $cache_key = sprintf($cache_key, $args[1]);
                break;
            case 3:
                $cache_key = sprintf($cache_key, $args[1], $args[2]);
                break;
            case 4:
                $cache_key = sprintf($cache_key, $args[1], $args[2], $args[3]);
                break;
            case 5:
                $cache_key = sprintf($cache_key, $args[1], $args[2], $args[3], $args[4]);
                break;
            case 6:
                $cache_key = sprintf($cache_key, $args[1], $args[2], $args[3], $args[4], $args[5]);
                break;
        }
        $cache_key = 'we7:' . $cache_key;
        if (strlen($cache_key) > 100) {
            trigger_error('Cache name is over the maximum length');
        }
        return $cache_key;
    }


    public static function cache_load($key, $unserialize = false,$module = '',$acid = '') {
        //$sql = "SELECT value FROM tab_core_cache WHERE ( `key` = '".$key."')";
        $sql = "SELECT * FROM ims_uni_account_modules WHERE ( `module` = '$module' AND `uniacid` = '$acid')";
        $cachedata = \Yii::$app->db->createCommand($sql)->queryOne();
        return $cachedata;
    }

    public static function cache_delete($key = 'zfst'){
        $sql = 'DELETE FROM `ims_core_cache` WHERE (`key` like "' .$key. '")';
        \Yii::$app->db->createCommand($sql)->execute();
    }

    public static function getcache($key, $module, $acid){

        $setting_cachekey = self::cache_system_key($key,$acid,$module);
        $setting = self::cache_load($setting_cachekey,false,$module ,$acid);

        if (empty($setting)) {
			//$sql = pdo_get('uni_account_modules', array('module' => $module, 'uniacid' => $_W['uniacid']));
            $sql = "SELECT * FROM ims_uni_account_modules WHERE ( `module` = '$module' AND `uniacid` = '$acid')";

            $setting = \Yii::$app->db->createCommand($sql)->queryOne();
			if (!empty($setting)) {
				self::cache_write($setting_cachekey, $setting);
			}
        }
        return $setting;

    }

    public static function cache_write($key, $data, $expire = 0) {
        if (empty($key) || !isset($data)) {
            return false;
        }
        $record = array();
        $record['key'] = $key;
        if (!empty($expire)) {
            $cache_data = array(
                'expire' => TIMESTAMP + $expire,
                'data' => $data
            );
        } else {
            $cache_data = $data;
        }
        //$record['value'] = iserializer($cache_data);
        //return pdo_insert('core_cache', $record, true);
        $record['value'] = serialize($cache_data);
        \Yii::$app->db->createCommand()->insert('tab_core_cache', [      
            'key' => $record['key'],      
            'value' => $record['value'],      
        ])->execute();

    }
}



?>