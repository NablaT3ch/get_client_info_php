<?php
class class_name
    {
        function __construct()
            {
                $this->user_agent=$_SERVER['HTTP_USER_AGENT'];
            }
        public function get_ip()
            {
                $clinet_ip='';
                if(getenv('HTTP_CLIENT_IP')){
                    $clinet_ip=getenv('HTTP_CLIENT_IP');
                    $this->ts=time();
                }
                elseif(getenv('HTTP_FORWARDED_FOR')){
                    $clinet_ip=getenv('HTTP_FORWARDED_FOR');
                    $this->ts=time();
                }
                elseif(getenv('HTTP_X_FORWARDED')){
                    $clinet_ip=getenv('HTTP_X_FORWARDED');
                    $this->ts=time();
                }
                elseif(getenv('REMOTE_ADDR')){
                    $clinet_ip=getenv('REMOTE_ADDR');
                    $this->ts=time();
                }
                else    
                    $clinet_ip="UNKNOW";
                return $clinet_ip;

            }
        public function get_B()
            {
                //$U_A=$this->user_agent;
                //$U_A;

                $client_B="UNKNOW Browser";
                
                $B_array=array(
                    '/msie/i'       =>  'Internet Explorer',
                    '/Trident/i'    =>  'Internet Explorer',
                    '/firefox/i'    =>  'Firefox',
                    '/safari/i'     =>  'Safari',
                    '/Chrome/i'     =>  'Chrome',
                    '/edge/i'       =>  'Edge',
                    '/opera/i'      =>  'Opera',
                    '/netscape/i'   =>  'Netscape',
                    '/maxthon/i'    =>  'Maxthon',
                    '/konqueror/i'  =>  'Konqueror',
                    '/ubrowser/i'   =>  'UC Browser',
                    #'/mobile/i'     =>  'Handheld Browser',
                    #'/Mobile Safari/i'	    => 'Dolfine',
                    '/OPR/i'    =>   'Opera',
                    '/UCBrowser/i' => 'UCBrowser'
                    #'/Chrome/62.0.320.2.84/i' =>   'chrome'
                );

                foreach($B_array as $key => $values)
                    {
                        
                        if(preg_match($key, $this->user_agent))
                        {        
                            $client_B=$values;
                        }
                    
                    }
                    


                return $client_B;

            }
        public function  get_OS()
            {
                //$U_A=$this->user_agent;
                $c_OS="UNKNOW";
                $OS_array=array(
                    '/Linux/i' =>   'Linux',
                    '/Windows NT 10/i' => 'Windows 10',
                    '/Windows nt 6.3/i' => 'Windows 8.1',
                    '/Windows nt 6.2/i' => 'Windows 8',
                    '/Windows nt 6.1/i' => 'Windows 7',
                    '/Windows nt 6.0/i' => 'Windows Vista',
                    '/Windows nt 5.2/i' => 'Windows Server',
                    '/Windows nt 5.1/i' => 'Windows XP',
                    '/Windows xp/i' => 'Windows xp',
                    '/Windows nt 5.0/i' => 'Windows 2000',
                    '/Windows me/i' => 'Windows ME',
                    '/Win98/i' => 'Windows 98',
                    '/Win95/i' => 'Windows 95',
                    '/Win16/i' => 'Windows 3.11',
                    '/macintosh|mac os x/i' => 'Mac OS X',
                    '/mac_powerpc/i' => 'Mac OS 9',
                    '/ubuntu/i' => 'Ubuntu',
                    '/iphone/i' => 'iPhone',
                    '/ipad/i' => 'iPad',
                    '/ipod/i' => 'iPod',
                    '/blackberry/i' => 'BlackBerry',
                    '/webos/i' => 'Mobile',
                    '/Android /i' => 'Android'
                );

                foreach($OS_array as $key => $value)
                    { 
                        if(preg_match($key,$this->user_agent))
                            $c_OS=$value;
                        
                    }
            return $c_OS;
            }
            

        public function save_file($c_info)
            {
                $file_name=fopen("log_file.txt" ,"w") or die("ERR");
                fwrite($file_name, $c_info);
                fclose($file_name);
            }
    }

$obj=new class_name;

$obj->save_file(sprintf("IP : %s \t time= %s \nBrowser : %s\nOS : %s" , $obj->get_ip(),date("F d,Y H:i:s",$obj->ts),$obj->get_B(), $obj->get_OS()));

?>  
