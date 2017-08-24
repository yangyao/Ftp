<?php

namespace Yangyao\Ftp;

class Ftp{

    private $resource = null;
    /** @var Config $config*/
    private $config = null;

    private $extensions = [
        'am', 'asp', 'bat', 'c', 'cfm', 'cgi', 'conf',
        'cpp', 'css', 'dhtml', 'diz', 'h', 'hpp', 'htm',
        'html', 'in', 'inc', 'js', 'm4', 'mak', 'nfs',
        'nsi', 'pas', 'patch', 'php', 'php3', 'php4', 'php5',
        'phtml', 'pl', 'po', 'py', 'qmail', 'sh', 'shtml',
        'sql', 'tcl', 'tpl', 'txt', 'vbs', 'xml', 'xrc', 'csv'
    ];

    public function __construct(Config $config){
        $this->config = $config;
    }

    public function connect(){
        try{
            $this->resource = ftp_connect($this->config->host,$this->config->port,$this->config->timeout);
        }catch (\Exception $e){
            throw(new \Exception("Unable to establish a FTP connection to host: ".$this->config->host.':'.$this->config->port));
        }
        $this->login();
    }

    private function login(){
        try{
            ftp_login($this->resource, $this->config->username, $this->config->password);
        }catch (\Exception $e){
            throw(new \Exception("Wrong credentials for Ftp connection: ".$this->config->username.':'.$this->config->password));
        }
    }

    public function disconnect(){
        ftp_close($this->resource);
    }

    public function uploadFile($fileFrom, $fileTo, $mode = null)
    {
        if(!file_exists($fileFrom)){
            throw(new \Exception("File ".$fileFrom." not found. Unable to upload."));
        }
        $mode  = is_null($mode)?$this->judgeFileMode($fileFrom):$mode;
        try {
            ftp_put($this->resource, $fileTo, $fileFrom, $mode);
        } catch(\Exception $e) {
            throw(new \Exception("File upload Failed  !"));
        }
    }

    private function judgeFileMode($file){
        $extension = pathinfo($file,PATHINFO_EXTENSION);
        !in_array(strtolower($extension),$this->extensions) ? $mode = FTP_BINARY : $mode = FTP_ASCII;
        return $mode;
    }
}
