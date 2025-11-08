<?php
interface MapInterface {
    public function put($key, $value);
    public function get($key);
    public function remove($key);
    public function containsKey($key);
    public function size();
    public function isEmpty();
    public function clear();
}
?>
