<?php

namespace JMS\I18nRoutingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class CheckDefaultLocaleCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $defaultLocale = $container->resolveEnvPlaceholders(
            $container->getParameter('jms_i18n_routing.default_locale'),
            true
        );

        $locales = $container->resolveEnvPlaceholders(
            $container->getParameter('jms_i18n_routing.locales'),
            true
        );

        if (!in_array($defaultLocale, $locales, true)) {
            throw new InvalidArgumentException(sprintf(
                'The default locale "%s" must be one of the configured locales.',
                $defaultLocale
            ));
        }
    }
}