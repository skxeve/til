<?php
namespace App\Interfaces;

/**
 * Target
 * Adapterで解決するにあたり必要になるメソッドを定義しておく
 */
interface Output
{
    public function outputWeak();
    public function outputStrong();
}
