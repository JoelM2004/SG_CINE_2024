<?php

namespace app\libs\request;

final class Request{

    private $controller, $action, $id, $data ,$tipoUsuario;
    
    public function __construct(){
        $this->controller = $_GET["controller"] ?? APP_DEFAULT_CONTROLLER;
        $this->action = $_GET["action"] ?? APP_DEFAULT_ACTION;
        $this->id = $_GET["id"] ?? 0;
        $this->data = json_decode(file_get_contents("php://input"), true);
    }

    public function getController(): string{
        return $this->controller;
    }

    public function getAction(): string{
        return $this->action;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getData(): array{
        return $this->data;
    }

    public function getRequestMethod(): string{
        return $_SERVER["REQUEST_METHOD"];
    }

    public function getParam(string $key) {
        return $this->data[$key] ?? null;
    }

    public function setController($controller): void{
        $this->controller = $controller;
    }

    public function setAction($action): void{
        $this->action = $action;
    }

}