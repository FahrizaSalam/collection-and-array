<?php
interface ListInterface extends CollectionInterface {
    public function get($index);
    public function set($index, $element);
    public function addAt($index, $element);
    public function removeAt($index);
    public function indexOf($element);
}
?>
