<?php
namespace Utils;
class JSON
{
    public $statusCode;
    public $data;
    public function __construct($statusCode = 200, $data = array())
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }
    public function send()
    {
        header('X-PHP-Response-Code: ' . $this->statusCode, true, $this->statusCode);
        header('Content-Type: application/json;charset=utf-8');
        echo json_encode(array("status" => $this->statusCode, "content" => $this->data));
    }
}