<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class StatusTwigExtension
 */
class StatusTwigExtension extends AbstractExtension
{
    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('status', array($this, 'statusFilter')),
        );
    }

    /**
     * @param int $status
     *
     * @return string
     */
    public function statusFilter(int $status)
    {
        switch ($status) {
            case 1:
                return 'active';
            case 0:
                return 'inactive';
        }

        return 'inactive';
    }
}
