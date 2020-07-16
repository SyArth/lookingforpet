<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigBootstrapExtension extends AbstractExtension{

    public function getFilters()
    {
        return [
            new TwigFilter('badge', [$this, 'bagdeFilter'],['is_safe' =>['html']]),
            new TwigFilter('booleanBadge', [$this, 'booleanBadgeFilter'], ['is_safe' =>['html']])        

    ];
    }

    public function bagdeFilter($content, array $options = []): string {

        $defaultOptions = [
            'color' => 'primary',
            'rounded'=> 'false'
        ];

        $options = array_merge($defaultOptions, $options);

        $color = $options['color'];
        $pill = $options['rounded']? "badge-pill" : "";

    $template = '<span class="badge badge-%s %s">%s</span>';

        return \sprintf(
            $template,
            $color, 
            $pill, 
            $content
        );
    }

    public function booleanBagdeFilter(bool $content, array $options = []){

        $defaultOptions = [
            'trueText' => 'Oui',
            'falseText'=> 'Non'
        ];

        $options = array_merge($defaultOptions, $options);

        if ($content){
            return $this->bagdeFilter($options['trueText']);
        }else {
            return $this->bagdeFilter($options['falseText'], ['color' => 'danger']);
        }
    }
}

