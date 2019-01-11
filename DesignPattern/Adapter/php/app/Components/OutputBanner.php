<?php
namespace App\Components;

use App\Interfaces\Output;

/**
 * Adapter
 */
class OutputBanner extends Banner implements Output
{
    public function __construct($str)
    {
        parent::__construct($str);
    }

    public function outputWeak()
    {
        $this->showWithParen();
    }

    public function outputStrong()
    {
        $this->showWithAster();
    }
}
