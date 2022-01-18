<?php
class Slots {
    protected $openSlots = [];
    protected $defaultSlotOpen = false;
    protected $slots = [];

    public function open($id) {
        if (array_key_exists($id, $this->slots)) return false;

        $this->slots[$id] = "";
        array_push($this->openSlots, $id);

        ob_start();
        ob_implicit_flush(0);
    }

    public function close() {
        $id = array_pop($this->openSlots);

        $this->slots[$id] = ob_get_clean();
        return $this;
    }

    public function has($id) {
        return isset($this->slots[$id]);
    }

    public function isOpen($id) {
        return in_array($id, $this->openSlots);
    }

    public function slot($id) {
        if ($this->has($id)) {
            echo $this->slots[$id];
            $this->defaultSlotOpen = false;
        } else {
            $this->defaultSlotOpen = true;
        }

        ob_start();
        ob_implicit_flush(0);
    }

    public function endSlot() {
        if (!$this->defaultSlotOpen) {
            ob_end_clean();
            return $this;
        }

        $this->defaultSlotOpen = false;
        echo ob_get_clean();
        return $this;
    }
}
