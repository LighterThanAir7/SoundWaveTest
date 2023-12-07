<?php

################################################################################
# ime   : API Class
# opis  : Main class for handling RESTful API
# autor : Ivan Bozajic
# datum : 10/2021
################################################################################

class API
{
    /**
     * Property: method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     */
	protected $method = '';
    
    /**
     * Property: ClassName
     * Nane of clase (and File name in same time) requested in the URI. eg: /Users
     */
	protected $ClassName = '';
	
    /**
     * Property: ClassMethod
     * Metohod of classt that will be call, optional second parametar in URI. eg: /Users/LastLogins 
     */
	protected $ClassMethod = '';
	
    /**
     * Property: ClassMethodsParams
     * Any additional URI vue-components after the class and function
     * can be an integer ID for the resource. eg: /Users/LastLogins/<arg0>/<arg1>/.../<argN>/
     */
	protected $ClassMethodsParams = Array();
    
    /**
     * Property: apikey
     * Key for using API, always must be last parametar in URI. eg: /Users/LastLogins/<arg0>/<arg1>/.../<argN>/apikey
     */
    protected $ApiKey = '';    
    
	/**
     * Property: file
     * Stores the input of the PUT request
     */
	protected $file = Null;

	protected $request = null;
	
	/**************************************************************************/
	// Class Constructor
	/**************************************************************************/ 
	public function __construct($request, $origin) 
	{               
		$request_array = explode('/', rtrim($request, '/'));

		// Look in REQUEST parametars and extract them in atributes of class
		if(is_array($request_array) && count($request_array) > 0)
		{
			// Last element must be a ApiKey
			// Pop from end Array in to new variable
			$this->ApiKey = array_pop($request_array);
			
			// TODO: check ApiKey
			if($this->_checkApiKey($this->ApiKey))
			{
			}
			else
			{
				throw new Exception("E002: Error login. Unknow API key");
			}
		
			// Loop thru request vals and separate them
			// in class atributes
			$i = 1;
		
			foreach($request_array as $key => $val)
			{
				switch($i)
				{
					// First args is ClassName
					case 1:
						$this->ClassName = $val;
					break;
					
					// Second args is Class method
					case 2:
						$this->ClassMethod = $val;
					break;
					
					// Rest of args are Class methods parametars
					default:
						$this->ClassMethodsParams[] = $val;
				}
			
				$i++;
			}
		}
		else
		{
			throw new Exception("E001: Request parametars Too Small");
		}
		
		// Get Method from SERVER variable
		$this->method = $_SERVER['REQUEST_METHOD'];
		
		if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) 
		{
			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') 
			{
				$this->method = 'DELETE';
			} 
			else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') 
			{
				$this->method = 'PUT';
			} 
			else 
			{
				throw new Exception("E003: Unexpected Header Method");
			}
		}
		
		// collecting data from POST or GET var
		switch($this->method) 
		{
			case 'DELETE':
			case 'POST':
				$this->request = $this->_cleanInputs($_POST);

				if(is_array($this->request) && count($this->request) > 0)
				{
					foreach($this->request as $k => $v)
					{
						$this->ClassMethodsParams[$k] = $v;
					}
				}

			break;
			
			case 'GET':
				$this->request = $this->_cleanInputs($_GET);
			break;
			
			case 'PUT':
				$this->request = $this->_cleanInputs($_GET);
				$this->file = file_get_contents("php://input");
			break;
			
			default:
				throw new Exception("E004: Unexpected Method");
			break;
		}
		
		// after preparing variables, must find class file, include class file,
		// instanc object, call method and pass parametars
		if(isset($this->ClassName) && $this->ClassName != "")
		{
			$class_file = "../inc/".$this->ClassName.".class.php";
		
			// check if file exists, important for latter include
			if(file_exists($class_file))
			{
				$class_name = $this->ClassName;
				
				include($class_file);	
				
				#$class_name = "Api\\" . $class_name; // add namespace
				
				$ApiObject = new $class_name(); 	
			}
			else
			{
				throw new Exception("E006: Unknow API class call. File does not exist. (".$class_file.")");	
			}			
		}
		else
        {
			throw new Exception("E005: Unknow API call");
        }			
		
		// class method initialization	
		if(isset($this->ClassMethod) && $this->ClassMethod != "")
		{
			$method = $this->ClassMethod;
		
			// Checks if the class method exists
			if(method_exists($ApiObject, $method))
			{
				$this->_response($ApiObject->$method($this->ClassMethodsParams));
			}
			else
			{
				throw new Exception("E008: Unknow API method in class");
			}
		}
		else
        {
			throw new Exception("E007: Unknow API method");
        }			
	}
	
	/**************************************************************************/
	// Method: _response (Desc. Creating JSON resposne of API)
	// Params: data - array, with returning data
	//         status - int, status code of executing script 
	/**************************************************************************/ 	
    private function _response($data, $status = 200) 
	{	
		header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
		// Cross-Origin Resource Sharing - CORS Enabling
		header("Access-Control-Allow-Origin: *");
		// header("Access-Control-Allow-Origin: " . SITE_URL);
		header("Access-Control-Allow-Methods: *");
		header("Content-Type: application/json");			
        echo json_encode($data);
    }

	/**************************************************************************/
	// Method: _cleanInputs (Desc. cleaning data from input, security)
	// Params: data - array of POST vars
	/**************************************************************************/ 
    private function _cleanInputs($data) 
	{
        $clean_input = Array();
        
        if (is_array($data)) 
		{
            foreach ($data as $k => $v) 
			{
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } 
		else 
		{
            $clean_input = trim(strip_tags($data));
        }
        
        return $clean_input;
    }

	/**************************************************************************/
	// Method: _requestStatus (Desc. text status codes of executing script)
	// Params: code - int, number of code
	/**************************************************************************/ 
    private function _requestStatus($code) 
	{
        $status = array(  
            200 => 'OK',
            401 => 'Unauthorized',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        ); 
        
        // if code doesnot exists, returns status code 500
		return ($status[$code]) ? $status[$code] : $status[500]; 
    }
	
	/**************************************************************************/
    // TODO: check user API key
	// Method: _checkApiKey (Desc. checks api key is valid)
	// Params: key - string, users api key
	/**************************************************************************/ 
    private function _checkApiKey($key)
	{
		// bip96b26jme5mlftm9
		if($key == "mno344fs6ffws5667a")
			return true;
		else
			return false;
	}  		 		        
}

?>