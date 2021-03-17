<?php

    namespace Goa\Http\Routing;

    class Router  
    {

        public $response;
        public $request;

        public function __construct()
        {
            $this->response = new Response();
        }

        /**
         * Function which capture a GET request and execute a function
         * @param String $url The url to capture
         * @param $function The function to execute when the the request is captured
         * @param String $class The name of the class from which the function must be executed
         */
        public function get(String $url, $function, String $class = "")
        {
            
            if ($_SERVER["REQUEST_METHOD"] == "GET")
            {
                $i = strpos($url, ':');
                $param = [
                    "body" => [],
                    "params" => [],
                    "uri" => $_SERVER['REQUEST_URI'],
                    "ip" => $_SERVER['REMOTE_ADDR'],
                    "method" => $_SERVER["REQUEST_METHOD"]
                ];

                if ($i == false)
                {
                    if ($param["uri"] != $url)
                    {
                        return false;
                    }
                }
                else
                {
                    $url = explode("/", trim($url, "/"));
                    $uri = explode("/", trim($param["uri"], "/"));

                    if (count($url) != count($uri))
                    {
                        return false;
                    }

                    foreach ($url as $key => $value) {
                        if (strncmp($value, ":", 1) != 0)
                        {
                            if ($value != $uri[$key])
                            {
                                return false;
                            }
                            continue;
                        }

                        $param["params"][substr($value, 1)] = $uri[$key];
                    }
                }

                $this->request = new Request($param);

                try {
                    if (!empty($class))
                    {
                        call_user_func(array($class, $function), $this->request, $this->response);
                    }
                    else
                    {
                        call_user_func($function, $this->request, $this->response);
                    }
                } catch (Throwable $th) {
                    throw $th;
                }
            
            }
        }

        /**
         * Function which capture a POST request and execute a function
         * @param String $url The url to capture
         * @param $function The function to execute when the the request is captured
         * @param String $class The name of the class from which the function must be executed
         */
        public function post(String $url, $function, String $class = "")
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['REQUEST_URI'] == $url)
            {
                $param = [
                    "body" => $_POST,
                    "params" => [],
                    "uri" => $_SERVER['REQUEST_URI'],
                    "ip" => $_SERVER['REMOTE_ADDR'],
                    "method" => $_SERVER["REQUEST_METHOD"]
                ];

                $this->request = new Request($param);

                try {
                    if (!empty($class))
                    {
                        call_user_func(array($class, $function), $this->request, $this->response);
                    }
                    else
                    {
                        call_user_func($function, $this->request, $this->response);
                    }
                } catch (Throwable $th) {
                    throw $th;
                }
            }
        }

        /**
         * Function which capture a PUT request and execute a function
         * @param String $url The url to capture
         * @param $function The function to execute when the the request is captured
         * @param String $class The name of the class from which the function must be executed
         */
        public function put(String $url, $function, String $class = "")
        {
            if ($_SERVER["REQUEST_METHOD"] == "PUT")
            {
                $i = strpos($url, ':');
                $param = [
                    "body" => [],
                    "params" => [],
                    "uri" => $_SERVER['REQUEST_URI'],
                    "ip" => $_SERVER['REMOTE_ADDR'],
                    "method" => $_SERVER["REQUEST_METHOD"]
                ];
                parse_str(file_get_contents("php://input"), $param["body"]);

                if ($i == false)
                {
                    if ($param["uri"] != $url)
                    {
                        return false;
                    }
                }
                else
                {
                    $url = explode("/", trim($url, "/"));
                    $uri = explode("/", trim($param["uri"], "/"));

                    if (count($url) != count($uri))
                    {
                        return false;
                    }

                    foreach ($url as $key => $value) {
                        if (strncmp($value, ":", 1) != 0)
                        {
                            if ($value != $uri[$key])
                            {
                                return false;
                            }
                            continue;
                        }

                        $param["params"][substr($value, 1)] = $uri[$key];
                    }
                }

                $this->request = new Request($param);

                try {
                    if (!empty($class))
                    {
                        call_user_func(array($class, $function), $this->request, $this->response);
                    }
                    else
                    {
                        call_user_func($function, $this->request, $this->response);
                    }
                } catch (Throwable $th) {
                    throw $th;
                }
            
            }
        }

        /**
         * Function which capture a DELETE request and execute a function
         * @param String $url The url to capture
         * @param $function The function to execute when the the request is captured
         * @param String $class The name of the class from which the function must be executed
         */
        public function delete(String $url, $function, String $class = "")
        {
            if ($_SERVER["REQUEST_METHOD"] == "DELETE")
            {
                $i = strpos($url, ':');
                $param = [
                    "body" => [],
                    "params" => [],
                    "uri" => $_SERVER['REQUEST_URI'],
                    "ip" => $_SERVER['REMOTE_ADDR'],
                    "method" => $_SERVER["REQUEST_METHOD"]
                ];
                parse_str(file_get_contents("php://input"), $param["body"]);

                if ($i == false)
                {
                    if ($param["uri"] != $url)
                    {
                        return false;
                    }
                }
                else
                {
                    $url = explode("/", trim($url, "/"));
                    $uri = explode("/", trim($param["uri"], "/"));

                    if (count($url) != count($uri))
                    {
                        return false;
                    }

                    foreach ($url as $key => $value) {
                        if (strncmp($value, ":", 1) != 0)
                        {
                            if ($value != $uri[$key])
                            {
                                return false;
                            }
                            continue;
                        }

                        $param["params"][substr($value, 1)] = $uri[$key];
                    }
                }

                $this->request = new Request($param);

                try {
                    if (!empty($class))
                    {
                        call_user_func(array($class, $function), $this->request, $this->response);
                    }
                    else
                    {
                        call_user_func($function, $this->request, $this->response);
                    }
                } catch (Throwable $th) {
                    throw $th;
                }
            
            }
        }

        /**
         * Function which capture a request and execute a function
         * @param $function The function to execute when the the request is captured
         * @param String $class The name of the class from which the function must be executed
         */
        public function use($function, String $class = "")
        {

            $param = [
                "body" => [],
                "params" => [],
                "uri" => $_SERVER['REQUEST_URI'],
                "ip" => $_SERVER['REMOTE_ADDR'],
                "method" => $_SERVER["REQUEST_METHOD"]
            ];

            $this->request = new Request($param);

            try {
                if (!empty($class))
                {
                    call_user_func(array($class, $function), $this->request, $this->response);
                }
                else
                {
                    call_user_func($function, $this->request, $this->response);
                }
            } catch (Throwable $th) {
                throw $th;
            }

        }

    }
    

?>