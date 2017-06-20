<?php

namespace AdminBundle\Twig\Extension;


class AdminExtension extends \Twig_Extension {
    
    
    public function getName() {
        return 'admin_extension';
    }
        
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('adminFormatDate', array($this, 'adminFormatDate'), array('is_safe' => array('html'))),
        );
    }

    
    public function adminFormatDate(\DateTime $datetime) {
        return $datetime->format('d.m.Y, H:i:s');
    }

}
