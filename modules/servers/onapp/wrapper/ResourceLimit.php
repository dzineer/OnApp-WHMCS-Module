<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Resource Limit
 * 
 * With OnApp you can assign resource limits to users. This will prevent users from exceeding the resources you specify.
 *
 * @category  API WRAPPER
 * @package   ONAPP
 * @author    Andrew Yatskovets
 * @copyright 2010 / OnApp
 * @link      http://www.onapp.com/
 * @see       ONAPP
 *
 * @todo Add description
 */

/**
 * require Base class
 */
require_once 'ONAPP.php';

/**
 * Resource Limit
 * 
 * This class represents the resource limits set to users.
 *
 * The ResourceLimit class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of resource limits
 *
 *     - <i>GET onapp.com/users/{USER_ID}/resource_limit.xml</i>
 *
 * Get a particular resource limit details 
 *
 *     - <i>GET onapp.com/users/{USER_ID}/resource_limit/{ID}.xml</i>
 *
 * Add new resource limit
 *
 *     - <i>POST onapp.com/users/{USER_ID}/resource_limit.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <resource-limit>
 *     <cpu-shares>{NUMBER}<cpu-shares>
 *     <cpus>{NUMBER}<cpus>
 *     <disk-size>{SIZE}<disk-size>
 *     <memory>{SIZE}<memory>
 * </resource-limit>
 * </code>
 *
 * Edit existing resource limit
 *
 *     - <i>PUT onapp.com/users/{USER_ID}/resource_limit/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <resource-limit>
 *     <cpu-shares>{NUMBER}<cpu-shares>
 *     <cpus>{NUMBER}<cpus>
 *     <disk-size>{SIZE}<disk-size>
 *     <memory>{SIZE}<memory>
 * </resource-limit>
 * </code>
 *
 * Delete resource limit
 *
 *     - <i>DELETE onapp.com/users/{USER_ID}/resource_limit/{ID}.xml</i>
 *
 *
 * Get the list of resource limits
 *
 *     - <i>GET onapp.com/users/{USER_ID}/resource_limit.json</i>
 *
 * Get a particular resource limit details 
 *
 *     - <i>GET onapp.com/users/{USER_ID}/resource_limit/{ID}.json</i>
 *
 * Add new resource limit
 *
 *     - <i>POST onapp.com/users/{USER_ID}/resource_limit.json</i>
 *
 * <code>
 * { 
 *      resource-limit: {
 *          cpu-shares:{NUMBER},
 *          cpus:{NUMBER},
 *          disk-size:{SIZE},
 *          memory:{SIZE}
 *      }
 * }
 * </code>
 *
 * Edit existing resource limit
 *
 *     - <i>PUT onapp.com/users/{USER_ID}/resource_limit/{ID}.json</i>
 *
 * <code>
 * {
 *      resource-limit: {
 *          cpu-shares:{NUMBER},
 *          cpus:{NUMBER},
 *          disk-size:{SIZE},
 *          memory:{SIZE}
 *      }
 * }
 * </code>
 *
 * Delete resource limit
 *
 *     - <i>DELETE onapp.com/users/{USER_ID}/resource_limit/{ID}.json</i>
 */
class ONAPP_ResourceLimit extends ONAPP {

    /**
     * the resource ID
     *
     * @var integer
     */
    var $_id;
    
    /**
     * the limit of the CPU Shares
     *
     * @var integer
     */
    var $_cpu_shares;
    
    /**
     * the limit of the CPUs
     *
     * @var integer
     */
    var $_cpus;

    /**
     * the date in the [YYYY][MM][DD]T[hh][mm]Z format
     *
     * @var datetime
     */
    var $_created_at;
    
    /**
     * the Disk Size limit
     *
     * @var integer
     */
    var $_disk_size;
    
    /**
     * the memory Limit
     *
     * @var integer
     */
    var $_memory;

    /**
     * the date when the resource limit was updated in the [YYYY][MM][DD]T[hh][mm]Z format  
     *
     * @var datetime
     */
    var $_updated_at;

    /**
     *
     *
     */
    var $_storage_disk_size;

    /**
     * the ID of the user these limits are set to
     *
     * @var integer
     */
    var $_user_id;
    
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot  = 'resource-limit';
    
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'resource_limit';
    
    /**
     * 
     * called class name
     * 
     * @var string
     */
    var $_called_class = 'ONAPP_ResourceLimit';
	
    /**
     * API Fields description
     *
     * @access private
     * @var    array
     */
    function _init_fields( $version = NULL ) {
    
      if ( is_null($version) )
        $version = $this->_version;

      switch ($version) {
        case '2.0.0':
            $this->_fields = array(
              'id' => array(
                  ONAPP_FIELD_MAP           => '_id',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_READ_ONLY     => true
              ),
              'cpu-shares' => array(
                  ONAPP_FIELD_MAP           => '_cpu_shares',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_REQUIRED      => true,
                  ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'cpus' => array(
                  ONAPP_FIELD_MAP           => '_cpus',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_REQUIRED      => true,
                  ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'created-at' => array(
                  ONAPP_FIELD_MAP           => '_created_at',
                  ONAPP_FIELD_TYPE          => 'datetime',
                  ONAPP_FIELD_READ_ONLY     => true,
              //    ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'disk-size' => array(
                  ONAPP_FIELD_MAP           => '_disk_size',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_REQUIRED      => true,
                  ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'memory' => array(
                  ONAPP_FIELD_MAP           => '_memory',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_REQUIRED      => true,
                  ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'updated-at' => array(
                  ONAPP_FIELD_MAP           => '_updated_at',
                  ONAPP_FIELD_TYPE          => 'datetime',
                  ONAPP_FIELD_READ_ONLY     => true,
              //    ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'user_id' => array(
                  ONAPP_FIELD_MAP           => '_user_id',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_READ_ONLY     => true,
              //    ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
              'storage_disk_size' => array(
                  ONAPP_FIELD_MAP           => '_storage_disk_size',
                  ONAPP_FIELD_TYPE          => 'integer',
                  ONAPP_FIELD_REQUIRED      => true,
                  ONAPP_FIELD_DEFAULT_VALUE => ''
              ),
            );
        break;    
        case '2.0.1':
          $this->_fields = $this->_init_fields("2.0.0");
        break;
      };
          
      return $this->_fields;
    }

    /**
     * Returns the URL Alias of the API Class that inherits the Class ONAPP
     *
     * @return string API resource
     * @access public
     */
    function getResource($action = ONAPP_GETRESOURCE_DEFAULT) {
        switch ($action) {
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null($this->_user_id) && is_null($this->_obj->_user_id) ) {
                    $this->_loger->error(
                       "getResource($action): argument _user_id not set.", 
                        __FILE__, 
                        __LINE__
                    );
                } else if ( is_null($this->_user_id) ) {
                    $this->_user_id = $this->_obj->_user_id;
                };
                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
                break;

            case ONAPP_GETRESOURCE_LOAD:
            case ONAPP_GETRESOURCE_EDIT:
                $resource = $this->getResource();
                break;

            default:
                $resource = parent::getResource($action);
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_DEFAULT,
            ONAPP_GETRESOURCE_LOAD,
            ONAPP_GETRESOURCE_EDIT,
        );
        if (in_array($action, $actions))
            $this->_loger->debug("getResource($action): return ".$resource);

        return $resource;
    }

    /**
     * Sends an API request to get the Object after sending, 
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting Class ONAPP.
     *
     * @param integer $id Object id
     *
     * @return object serialized Object instance from API
     * @access public
     */
    function load( $user_id = null ) {
        if ( is_null($user_id) && ! is_null($this->_user_id) )
            $user_id = $this->_user_id;

        if ( is_null($user_id) &&
            isset($this->_obj) &&
            ! is_null($this->_obj->_user_id)
        )
            $user_id = $this->_obj->_user_id;

        $this->_loger->add("load: Load class ( id => '$user_id').");

        if ( ! is_null($user_id) ) {
            $this->_user_id = $user_id;

            $this->setAPIResource( $this->getResource(ONAPP_GETRESOURCE_LOAD) );

            $response = $this->sendRequest(ONAPP_REQUEST_METHOD_GET);

            $result = $this->_castResponseToClass( $response );

            $this->_obj = $result;
            $this->_user_id = $this->_obj->_user_id;

            return $result;
        } else {
            $this->_loger->error(
               'load: argument _user_id not set.', 
                __FILE__, 
                __LINE__
            );
        }
    }

    /**
     * The method saves an Object to your account
     *
     * After sending an API request to create an object or change the data in
     * the existing object, the method checks the response and loads the
     * exisitng object with the new data. 
     *
     * @return void
     * @access public
     */
    function save() {
    	if ( isset( $this->_user_id ) ) {
        	$obj = $this->_edit();
			
        	if ( isset($obj) && ! isset($obj->error) )
        	   $this->load();
    	}
    }

    function activate($action_name) {
        switch ($action_name) {
            case ONAPP_ACTIVATE_DELETE:
                die("Call to undefined method ".__CLASS__."::$action_name()");
                break;
        }
    }
}

?>
