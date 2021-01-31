<?php

/**
 * Class Item
 */
final class Item {
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $status;
    /**
     * @var bool
     */
    private bool $changed;
    /**
     * @var array
     */
    private array $data;

    /**
     * Item constructor.
     * @param $ID
     */
    public function __construct($ID) {
        $this->init();
    }

    /**
     * init method
     * get data and save it
     */
    private function init(): void {
        static $initiated = false;
        if ($initiated) {
            return;
        } else {
            $initiated = true;
        }

        $this->data = $this->getFromObjects();
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public function __set($name, $value): bool {
        switch ($name) {
            case "id":
                return false;
            case "status":
                if (gettype($value) !== "integer") {
                    return false;
                }
                break;
            case "name":
                if (gettype($value) !== "string" || $value == '') {
                    return false;
                }
                break;
            case "changed":
                if (gettype($value) !== "bool") {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
        $this->$name = $value;
        return true;
    }

    /**
     * @param $name
     * @return integer|string|bool|null
     */
    public function __get($name) {
        if (isset($this->$name)) {
            return $this->$name;
        }

        return null;
    }

    /**
     * if data changed, save it
     */
    public function save() {
        if (!$this->data) return;

        $this->__set("name", $this->data['name']);
        $this->__set("status", $this->data['status']);
    }

    /**
     * get data outside
     * @return array
     */
    private function getFromObjects(): array {
        return ["name" => "name", "status" => 1];
    }
}

$user = new Item(1);
$user->save();

