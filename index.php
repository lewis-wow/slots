<?php
class Slots {
    protected $openSlots = [];
    protected $defaultSlotOpen = false;
    protected $slots = [];

    /**
     * @param string|int $id
     */
    public function open($id) {
        if ($this->has($id)) return false;

        $this->slots[$id] = "";
        array_push($this->openSlots, $id);

        ob_start();
        ob_implicit_flush(false);
    }

    public function close() {
        $id = array_pop($this->openSlots);
        $this->slots[$id] = ob_get_clean();
    }

    /**
     * @param string|int $id
     * 
     * @return bool
     */
    public function has($id) {
        return isset($this->slots[$id]);
    }

    /**
     * @param string|int $id
     * 
     * @return bool
     */
    public function isOpen($id) {
        return in_array($id, $this->openSlots);
    }

    /**
     * @param string|int $id
     */
    public function slot($id) {
        if ($this->has($id)) {
            echo $this->slots[$id];
        } else {
            $this->defaultSlotOpen = true;
        }

        ob_start();
        ob_implicit_flush(false);
    }

    public function endSlot() {
        if (!$this->defaultSlotOpen) {
            ob_end_clean();
        } else {
            $this->defaultSlotOpen = false;
            echo ob_get_clean();
        }
    }
}
