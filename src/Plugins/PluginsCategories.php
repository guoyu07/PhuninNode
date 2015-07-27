<?php

/*
 * This file is part of PhuninNode.
 *
 ** (c) 2013 - 2015 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\PhuninNode\Plugins;

use WyriHaximus\PhuninNode\Configuration;
use WyriHaximus\PhuninNode\Node;
use WyriHaximus\PhuninNode\PluginInterface;
use WyriHaximus\PhuninNode\Value;

/**
 * Class PluginsCategories
 * @package WyriHaximus\PhuninNode\Plugins
 */
class PluginsCategories implements PluginInterface
{
    /**
     * @var Node
     */
    private $node;

    /**
     * {@inheritdoc}
     */
    public function setNode(Node $node)
    {
        $this->node = $node;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return 'plugins_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        $configuration = new Configuration();
        $configuration->setPair('graph_category', 'phunin_node');
        $configuration->setPair('graph_title', 'Plugin Per Categories');

        return $this->getPluginCategories()->then(function ($values) use ($configuration) {
            foreach ($values as $key => $value) {
                $configuration->setPair($key . '.label', $key);
            }

            return \React\Promise\resolve($configuration);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->getPluginCategories()->then(function ($values) {
            $valuesStorage = new \SplObjectStorage();
            foreach ($values as $key => $value) {
                $valuesStorage->attach(new Value($key, $value));
            }

            return \React\Promise\resolve($valuesStorage);
        });
    }

    /**
     * @return \React\Promise\PromiseInterface
     */
    private function getPluginCategories()
    {
        $categories = [];
        $promises = [];
        $plugins = $this->node->getPlugins();
        foreach ($plugins as $plugin) {
            $promises[] = $plugin->getConfiguration()->then(
                function ($configuration) use (&$categories) {
                    $category = $configuration->getPair('graph_category')->getValue();
                    if (!isset($categories[$category])) {
                        $categories[$category] = 0;
                    }
                    $categories[$category]++;
                }
            );
        }

        return \React\Promise\all($promises)->then(function () use (&$categories) {
            return \React\Promise\resolve($categories);
        });
    }
}
