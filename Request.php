<?php

    namespace Goa\Http\Routing;

    class Request 
    {

        public $body;
        public $params;
        public $uri;
        public $ip;
        public $method;
        
        public function __construct(Array $data)
        {
            $this->body = $data["body"];
            $this->params = $data["params"];
            $this->url = $data["uri"];
            $this->ip = $data["ip"];
            $this->method = $data["method"];
        }

    }

    class Response  
    {

        public $response;
        
        public function __construct(Array $data = [])
        {
            $this->response = "";
        }

        /**
         * Function which set a header in the response
         * @param String $name The name or key of the header
         * @param String $value The value of the header
         */
        public function setHeader(String $name, String $value)
        {
            header($name . ":" . $value);
        }

        /**
         * Function which set a json data as response data
         * @param Array $data A array which contains the data
         */
        public function json(Array $data)
        {
            $this->response = json_encode($data);
        }

        /**
         * Function which set a json data as response data
         * @param String $code The html code to send as response data
         */
        public function html(String $code)
        {
            $this->response = $code;
        }

        public function render(String $path, $params = null)
        {
            $output = View($path, $params);
            $this->html($output);
        }

        /**
         * Function which send the response data
         */
        public function end()
        {
            echo $this->response;
            exit();
        }
    }
    
    

?>