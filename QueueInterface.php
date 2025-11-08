<?php
interface QueueInterface extends CollectionInterface {
    public function offer($element);
    public function poll();
    public function peek();
}
?>
