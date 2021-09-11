<?php
declare(strict_types = 1);

namespace Freesoftde\LiquibaseBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder {
        $treeBuilder = new TreeBuilder('freesoftde_liquibase');
        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('liquibase.properties')
                    ->children()
                        ->scalarNode('driver')
                            ->info('The database driver (example: "org.postgresql.Driver")')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('classpath')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('changeLogFile')
                            ->info('The path to the master changelog')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('liquibaseSchemaName')
                            ->info('The schema name were the liquibase tables exist.')
                            ->cannotBeEmpty()
                            ->isRequired()
                            ->defaultValue('maintanance')
                        ->end()
                        ->scalarNode('logLevel')
                            ->cannotBeEmpty()
                            ->isRequired()
                            ->defaultValue('info')
                        ->end()
                        ->scalarNode('url')
                            ->info('The database url where the changesets will be execute')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('username')
                        ->end()
                        ->scalarNode('password')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}